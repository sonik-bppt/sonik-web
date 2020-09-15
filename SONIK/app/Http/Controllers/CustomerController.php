<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class CustomerController extends Controller
{
    public function View(){
	    
	    $customer = DB::table('mdb_customer')->get();

	    $customer_lifetime = DB::select(DB::raw('
	    	select count(ID) as total_row
	    	from mdb_customer
	    	'));
	    foreach( $customer_lifetime as $this_customer_lifetime ){
	    	$customer_lifetime = $this_customer_lifetime->total_row;
	    }

	    $customer_verified = DB::select(DB::raw('
	    	select count(ID) as total_row
	    	from mdb_customer
	    	where IS_VERIFIED = 1
	    	'));
	    foreach( $customer_verified as $this_customer_verified ){
	    	$customer_verified = $this_customer_verified->total_row;
	    }

	    $customer_not_verified = DB::select(DB::raw('
	    	select count(ID) as total_row
	    	from mdb_customer
	    	where IS_VERIFIED = 0
	    	'));
	    foreach( $customer_not_verified as $this_customer_not_verified ){
	    	$customer_not_verified = $this_customer_not_verified->total_row;
	    }

	    return view('customer.view', compact('customer', 'customer_lifetime', 'customer_verified', 'customer_not_verified'));


	    
    }

    public function DownloadCSV(){

    	header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="AllCustomer.csv"');

    	$customer = DB::table('mdb_customer')->get();

		$list[] = array('SYSTEM ID' , 'NAME' , 'EMAIL' , 'PHONE NUMBER' , 'ID TAG' , 'DATE REGISTERED' , 'LAST LOGGED IN');

		foreach( $customer as $this_customer ){

			$system_id = $this_customer->ID;
			$name = $this_customer->NAME;
			$email = $this_customer->EMAIL;
			$phone_number = $this_customer->PHONE_NUMBER;
			$id_tag = $this_customer->ID_TAG;
			$date_registered = $this_customer->DATE_CREATED;
			$last_login = $this_customer->LAST_LOGIN;

			$list[] = array($system_id, $name, $email, $phone_number, $id_tag, $date_registered, $last_login);
		}

		$fp = fopen('php://output', 'wb');
		foreach ($list as $fields) {
		    fputcsv($fp, $fields, ";");
		}
		fclose($fp);

    }
    
    public function Add(){
	    
	    return view('customer.add');
	    
    }
    
    public function SaveNewCustomer(Request $request){
    
    	DB::table('mdb_customer')->insert([
			'NAME' => $request->textName,
			'EMAIL' => $request->textEmail,
			'PHONE_NUMBER' => $request->textPhoneNumber,
			'ID_TAG' => $request->textIDTag
		]);

		$get_existing_id_tag = DB::table('ocpp_tag')->where('id_tag', $request->textIDTag)->count();

		if( $get_existing_id_tag == 0 ){

			$last_id_tag = DB::table('ocpp_tag')->orderBy('ocpp_tag_pk', 'DESC')->take(1)->get();

			foreach($last_id_tag as $this_last_id_tag){
				$next_id_tag = $this_last_id_tag->ocpp_tag_pk + 1;
			}

			DB::table('ocpp_tag')->insert([
				"ocpp_tag_pk" => $next_id_tag,
				"id_tag" => $request->textIDTag,
				"max_active_transaction_count" => 1
			]);

		}

		
		
		Session::put('show_popup', base64_encode(1));
		Session::put('popup_type', base64_encode("success"));
		Session::put('popup_message', base64_encode("New customer has been registered successfully."));

		return redirect('/customer/view');
	    
    }
    
    public function Detail($id){
	    
	    $customer = DB::table('mdb_customer')->where('ID', $id)->get();
	    $city = DB::table('mdb_city')->orderBy('CITY', 'ASC')->get();

	    foreach($customer as $this_customer){

	    	$number_of_transaction = DB::table('transaction_start')
	    		->where('id_tag', $this_customer->ID_TAG)
	    		->count();

	    	$list_of_energy_consumption = DB::select(
	    		DB::raw(
	    			"
	    			select
	    				t1.transaction_pk as TRANSACTION_PK,
	    				t1.start_value as START_VALUE,
	    				t2.stop_value as STOP_VALUE,
	    				(t2.stop_value - t1.start_value) as ENERGY_CONSUMPTION
	    			from transaction_start t1
	    				left join transaction_stop t2 on t2.transaction_pk = t1.transaction_pk
	    			where
	    				t1.id_tag = '".$this_customer->ID_TAG."'
	    			"
	    		)
	    	);

	    	$total_energy_consumed = 0;
	    	foreach( $list_of_energy_consumption as $this_list_of_energy_consumption ){
	    		$total_energy_consumed += $this_list_of_energy_consumption->ENERGY_CONSUMPTION;
	    	}

	    	$current_status_tag = -1;
	    	$status_tag = DB::table('ocpp_tag')->where('id_tag', $this_customer->ID_TAG)->get();
	    	foreach($status_tag as $this_status_tag){
	    		$current_status_tag = $this_status_tag->max_active_transaction_count;
	    	}

	    }

	    $activity_list = DB::select(
	    		DB::raw(
	    			"
	    			select
	    				t1.event_timestamp as EVENT_TIMESTAMP,
	    				DATE_ADD(t1.event_timestamp, INTERVAL 7 HOUR) as EVENT_TIMESTAMP_GMT7,
	    				t3.NAME as NAME,
	    				t1.id_tag as ID_TAG
	    			from transaction_start t1
	    				left join connector t2 on t1.connector_pk = t2.connector_pk
	    				left join mdb_cs t3 on t3.CHARGE_BOX_ID collate utf8_general_ci = t2.charge_box_id collate utf8_general_ci
	    			where
	    				t1.id_tag = '".$this_customer->ID_TAG."'
	    			"
	    		)
	    	);

	    return view('customer.detail', compact('customer', 'number_of_transaction', 'total_energy_consumed', 'current_status_tag', 'city', 'activity_list'));
	    
    }
    
    public function UpdateExistingCustomer(Request $request){

	    DB::table('mdb_customer')->where('ID', $request->currentID)->update([
			'NAME' => $request->name,
			'EMAIL' => $request->email,
			'PHONE_NUMBER' => $request->phone_number,
			'ADDRESS' => $request->address,
			'CITY' => $request->city,
			'POSTAL_CODE' => $request->postal_code,
			'ID_TAG' => $request->id_tag,
			'DATE_MODIFIED' => date('Y-m-d H:i:s')
		]);

		$check_existing_new_ocpp_tag = DB::table('ocpp_tag')->where('id_tag', $request->id_tag)->count();

		if( $check_existing_new_ocpp_tag == 0 ){

			$last_ocpp_tag_pk = DB::table('ocpp_tag')->orderBy('ocpp_tag_pk', 'DESC')->take(1)->get();

			foreach( $last_ocpp_tag_pk as $this_last_ocpp_tag_pk ){
				$new_ocpp_tag_pk = $this_last_ocpp_tag_pk->ocpp_tag_pk + 1;
			}

			DB::table('ocpp_tag')->insert([
				'ocpp_tag_pk' => $new_ocpp_tag_pk,
				'id_tag' => $request->id_tag,
				'max_active_transaction_count' => 1
			]);
		} else if( $check_existing_new_ocpp_tag > 0 ){
			DB::table('ocpp_tag')->where('id_tag', $request->current_id_tag)->update([
				'id_tag' => $request->id_tag
			]);
		}

		Session::put('show_popup', base64_encode(1));
		Session::put('popup_type', base64_encode("success"));
		Session::put('popup_message', base64_encode("Customer info has been updated."));
		
		return redirect('customer/detail/'.$request->currentID);
	    
    }

    public function BlockIDTag($id, $id_tag){

    	DB::table('ocpp_tag')->where('id_tag', $id_tag)->update([
    		'max_active_transaction_count' => 0
    	]);

    	Session::put('show_popup', base64_encode(1));
		Session::put('popup_type', base64_encode("success"));
		Session::put('popup_message', base64_encode("ID Tag has been successfully blocked."));
		
		return redirect('customer/detail/'.$id);

    }

    public function OpenIDTag($id, $id_tag){

    	DB::table('ocpp_tag')->where('id_tag', $id_tag)->update([
    		'max_active_transaction_count' => 1
    	]);

    	Session::put('show_popup', base64_encode(1));
		Session::put('popup_type', base64_encode("success"));
		Session::put('popup_message', base64_encode("ID Tag has been successfully opened."));
		
		return redirect('customer/detail/'.$id);

    }
    
    public function DeleteExistingCustomer($id){
	    
	    DB::table('mdb_customer')->where('ID', $id)->delete();
		
		Session::put('show_popup', base64_encode(1));
		Session::put('popup_type', base64_encode("success"));
		Session::put('popup_message', base64_encode("Charging station data has been deleted."));
	    
	    return redirect('/customer/view');
	    
    }

    public function VerifyAccount($verification_id){

    	$count = DB::table('mdb_customer')
    		->where('VERIFICATION_ID', $verification_id)
    		->where('IS_VERIFIED', 0)
    		->count('ID');

    	if( $count == 1 ){

    		DB::table('mdb_customer')
    			->where('VERIFICATION_ID', $verification_id)
    			->where('IS_VERIFIED', 0)
    			->update([
    				'IS_VERIFIED' => 1,
    				'DATE_VERIFIED' => date('Y-m-d H:i:s')
    			]);

    		return view('utility.verification_success');

    	} else {

    		return view('utility.verification_failed');

    	}

    }
}
