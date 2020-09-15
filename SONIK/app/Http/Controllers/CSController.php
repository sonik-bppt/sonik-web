<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class CSController extends Controller
{
    public function View(){
	    
	    $cs = DB::select(
    		DB::raw(
    			"
    			select
    				t1.ID as ID,
    				t1.NAME as NAME,
    				t1.CHARGE_BOX_ID as CHARGE_BOX_ID,
    				t1.ENDPOINT_ADDRESS as ENDPOINT_ADDRESS,
    				t3.CITY as CITY,
    				t1.LOCATION as LOCATION,
    				t1.OVERALL_STATUS as OVERALL_STATUS,
    				t2.charge_point_model as CHARGE_POINT_MODEL,
    				t2.last_heartbeat_timestamp as LAST_HEARTBEAT_TIMESTAMP,
    				DATE_ADD(t2.last_heartbeat_timestamp, INTERVAL 7 HOUR) as LAST_HEARTBEAT_TIMESTAMP_GMT7
    			from mdb_cs t1
    				left join charge_box t2 on t2.charge_box_pk = t1.CHARGE_BOX_PK
    				left join mdb_city t3 on t1.CITY = t3.ID
    			order by t1.DATE_CREATED DESC
    			"
    		)
    	);

    	$cs_lifetime = DB::select(DB::raw('
    		select count(t1.ID) as total_row
    		from mdb_cs t1
    				left join charge_box t2 on t2.charge_box_pk = t1.CHARGE_BOX_PK
    				left join mdb_city t3 on t1.CITY = t3.ID
    		'));
    	foreach( $cs_lifetime as $this_cs_lifetime ){
    		$cs_lifetime = $this_cs_lifetime->total_row;
    	}

    	$cs_connected = DB::select(DB::raw('
    		select count(t1.ID) as total_row
    		from mdb_cs t1
    				left join charge_box t2 on t2.charge_box_pk = t1.CHARGE_BOX_PK
    				left join mdb_city t3 on t1.CITY = t3.ID
    		where t2.last_heartbeat_timestamp is not null
    		'));
    	foreach( $cs_connected as $this_cs_connected ){
    		$cs_connected = $this_cs_connected->total_row;
    	}

    	$cs_operational = DB::select(DB::raw('
    		select count(t1.ID) as total_row
    		from mdb_cs t1
    				left join charge_box t2 on t2.charge_box_pk = t1.CHARGE_BOX_PK
    				left join mdb_city t3 on t1.CITY = t3.ID
    		where t1.OVERALL_STATUS = 1
    		and t2.last_heartbeat_timestamp is not null
    		'));
    	foreach( $cs_operational as $this_cs_operational ){
    		$cs_operational = $this_cs_operational->total_row;
    	}

	    return view('cs.view', compact('cs', 'cs_lifetime', 'cs_connected', 'cs_operational'));
	    
    }
    
    public function Add(){

    	$city = DB::table('mdb_city')->orderBy('CITY', 'ASC')->get();
	    
	    return view('cs.add', compact('city') );
	    
    }
    
    public function SaveNewCS(Request $request){

    	$check_existing_data = DB::table('charge_box')
    		->where('charge_box_id', $request->textChargeBoxID)
    		->where('endpoint_address', $request->textEndpointAddress)
    		->get()
    		->count();

    	if( $check_existing_data == 0 ){

    		$latest_charge_box_pk = DB::table('charge_box')->orderBy('charge_box_pk', 'DESC')->take(1)->get();

	    	foreach($latest_charge_box_pk as $this_latest_charge_box_pk){
	    		$this_latest_charge_box_pk = $this_latest_charge_box_pk;
	    	}

	    	$next_charge_box_pk = $this_latest_charge_box_pk->charge_box_pk+1;

	    	$add_charge_box_mdb = DB::table('charge_box')->insert([
	    		"charge_box_pk" => $next_charge_box_pk,
	    		"charge_box_id" => $request->textChargeBoxID,
	    		"endpoint_address" => $request->textEndpointAddress
	    	]);

	    
	    	DB::table('mdb_cs')->insert([
				'NAME' => $request->textName,
				'CHARGE_BOX_PK' => $next_charge_box_pk,
				'CHARGE_BOX_ID' => $request->textChargeBoxID,
				'ENDPOINT_ADDRESS' => $request->textEndpointAddress,
				'CITY' => $request->textCity,
				'LOCATION' => $request->textLocation,
				'LONGITUDE' => $request->textLongitude,
				'LATITUDE' => $request->textLatitude,
				'GOOGLE_MAP_LINK' => $request->textGoogleMapLink,
				'GOOGLE_EMBED_CODE' => $request->textareaGoogleMapEmbed,
				'GENERAL_PRICE' => $request->numberGeneralPrice
				
			]);
			
			Session::put('show_popup', base64_encode(1));
			Session::put('popup_type', base64_encode("success"));
			Session::put('popup_message', base64_encode("New charging station has been registered successfully."));

			return redirect('/cs/view');

    	} else {

    		Session::put('show_popup', base64_encode(1));
			Session::put('popup_type', base64_encode("error"));
			Session::put('popup_message', base64_encode("Chargebox ID or endpoint address already exists."));

			return redirect('/cs/add');

    	}

    }
    
    public function Detail($id){
	    
	    $cs = DB::table('mdb_cs')->where('ID', $id)->get();
	    $city = DB::table('mdb_city')->orderBy('CITY', 'ASC')->get();

	    foreach( $cs as $this_cs ){
	    	$charge_box_id = $this_cs->CHARGE_BOX_ID;
	    }

	    $get_evcs_detail_info = DB::table('charge_box')->where('charge_box_id', $charge_box_id)->get();

	    foreach( $get_evcs_detail_info as $this_get_evcs_detail_info ){
	    	$this_get_evcs_detail_info = $this_get_evcs_detail_info;
	    }

	    $connector_list = DB::table('connector')->where('charge_box_id', $charge_box_id)->where('connector_id', '>', 0)->get();


	    $array_latest_status[] = '';
	    $array_this_connector_id[] = '';
	    $array_latest_meter_value[] = '';
	    $array_socket_status[] = '';
	    $array_leackage_status[] = '';
	    $array_mcb_status[] = '';
	    $array_grounding_status[] = '';
	    $array_tempered_door_status[] = '';
	    $array_current_energy_consumption[] = '';

	    foreach( $connector_list as $this_connector_list ){

	    	$this_connector_pk = $this_connector_list->connector_pk;
	    	$array_this_connector_id[] = $this_connector_list->connector_id;


	    	// GET LATEST STATUS
	    	$latest_status = DB::select(DB::raw('
	    		select 
	    			* ,
	    			DATE_ADD(status_timestamp, INTERVAL 7 HOUR) as STATUS_TIMESTAMP_GMT7
	    		from connector_status 
	    		where 
	    			connector_pk = "'.$this_connector_pk.'"
	    		order by status_timestamp DESC 
	    		limit 0,1
	    		'));

	    	foreach( $latest_status as $this_latest_status ){
		    	$array_latest_status[] = $this_latest_status;

		    	if( $this_latest_status->error_code == "ConnectorLockFailure" ){
				    $array_socket_status[] = 0;
				    $array_leackage_status[] = 1;
				    $array_mcb_status[] = 1;
				    $array_grounding_status[] = 1;
				    $array_tempered_door_status[] = 1;
		    	} else if( $this_latest_status->error_code == "InternalError" ){
				    $array_socket_status[] = 1;
				    $array_leackage_status[] = 0;
				    $array_mcb_status[] = 1;
				    $array_grounding_status[] = 1;
				    $array_tempered_door_status[] = 1;
		    	} else if( $this_latest_status->error_code == "OverCurrentFailure" || $this_latest_status->error_code == "OverVoltage" || $this_latest_status->error_code == "HighTemperature" ){
				    $array_socket_status[] = 1;
				    $array_leackage_status[] = 1;
				    $array_mcb_status[] = 0;
				    $array_grounding_status[] = 1;
				    $array_tempered_door_status[] = 1;
		    	} else if( $this_latest_status->error_code == "GroundFailure" ){
				    $array_socket_status[] = 1;
				    $array_leackage_status[] = 1;
				    $array_mcb_status[] = 1;
				    $array_grounding_status[] = 0;
				    $array_tempered_door_status[] = 1;
		    	} else if( $this_latest_status->error_code == "OtherError" ){
				    $array_socket_status[] = 1;
				    $array_leackage_status[] = 1;
				    $array_mcb_status[] = 1;
				    $array_grounding_status[] = 1;
				    $array_tempered_door_status[] = 0;
		    	} else if( $this_latest_status->error_code == "NoError" ){
				    $array_socket_status[] = 1;
				    $array_leackage_status[] = 1;
				    $array_mcb_status[] = 1;
				    $array_grounding_status[] = 1;
				    $array_tempered_door_status[] = 1;
		    	}

		    }



		    // GET METER VALUE
	    	$latest_meter_value = DB::select(DB::raw('
	    		select 
	    			* 
	    		from connector_meter_value 
	    		where 
	    			connector_pk = "'.$this_connector_pk.'"
	    		order by value_timestamp DESC 
	    		limit 0,1
	    		'));

	    	if( count($latest_meter_value) > 0 ){
	    		foreach( $latest_meter_value as $this_latest_meter_value ){

	    			$meter_start = DB::table('transaction_start')->where('connector_pk', $this_connector_pk)->orderBy('event_timestamp', 'DESC')->take(1)->get();
	    			foreach( $meter_start as $this_meter_start ){
	    				$this_meter_start = $this_meter_start;
	    			}

	    			$array_latest_meter_value[] = $this_latest_meter_value->value;

	    			if( $this_latest_status->status == "Charging" ){
			    		$array_current_energy_consumption[] = $this_latest_meter_value->value - $this_meter_start->start_value;
			    	} else {
			    		$array_current_energy_consumption[] = 0;
			    	}

	    		}
	    	} else {
	    		$array_latest_meter_value[] = 0;
	    		$array_current_energy_consumption[] = 0;
	    	}

	    	



	    }

	    return view('cs.rincian', compact('cs','city', 'array_latest_status', 'array_this_connector_id', 'array_latest_meter_value', 'array_socket_status', 'array_leackage_status', 'array_mcb_status', 'array_grounding_status', 'array_tempered_door_status', 'array_current_energy_consumption', 'this_get_evcs_detail_info'));
	    
    }
    
    public function UpdateExistingCS(Request $request){
	    
	    DB::table('mdb_cs')->where('ID', $request->currentID)->update([
			'NAME' => $request->textName,
			'CITY' => $request->textCity,
			'LOCATION' => $request->textLocation,
			'LONGITUDE' => $request->textLongitude,
			'LATITUDE' => $request->textLatitude,
			'GOOGLE_MAP_LINK' => $request->textGoogleMapLink,
			'GOOGLE_EMBED_CODE' => $request->textareaGoogleMapEmbed,
			'GENERAL_PRICE' => $request->numberGeneralPrice,
			'DATE_MODIFIED' => date('Y-m-d H:i:s')
		]);
		
		Session::put('show_popup', base64_encode(1));
		Session::put('popup_type', base64_encode("success"));
		Session::put('popup_message', base64_encode("Charging station detail has been updated."));
		
		return redirect('cs/detail/'.$request->currentID);
	    
    }
    
    public function DeleteExistingCS($id){
	    
	    DB::table('mdb_cs')->where('ID', $id)->delete();
		
		Session::put('show_popup', base64_encode(1));
		Session::put('popup_type', base64_encode("success"));
		Session::put('popup_message', base64_encode("Charging station data has been deleted."));
	    
	    return redirect('/cs/view');
	    
    }

    public function DownloadCSV(){

    	header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="AllEVCS.csv"');

    	$cs = DB::select(
    		DB::raw(
    			"
    			select
    				t1.ID as ID,
    				t1.NAME as NAME,
    				t1.CHARGE_BOX_ID as CHARGE_BOX_ID,
    				t1.ENDPOINT_ADDRESS as ENDPOINT_ADDRESS,
    				t3.CITY as CITY,
    				t1.LOCATION as LOCATION,
    				t1.OVERALL_STATUS as OVERALL_STATUS,
    				t2.charge_point_model as CHARGE_POINT_MODEL
    			from mdb_cs t1
    				left join charge_box t2 on t2.charge_box_pk = t1.CHARGE_BOX_PK
    				left join mdb_city t3 on t1.CITY = t3.ID
    			order by t1.DATE_CREATED DESC
    			"
    		)
    	);

    	$list[] = array('SYSTEM ID' , 'NAME' , 'CHARGE BOX ID' , 'ENDPOINT ADDRESS' , 'CITY' , 'LOCATION');

    	foreach( $cs as $this_cs ){

			$system_id = $this_cs->ID;
			$name = $this_cs->NAME;
			$chargebox_id = $this_cs->CHARGE_BOX_ID;
			$endpoint_address = $this_cs->ENDPOINT_ADDRESS;
			$city = $this_cs->CITY;
			$location = $this_cs->LOCATION;

			$list[] = array($system_id, $name, $chargebox_id, $endpoint_address, $city, $location);
		}

		$fp = fopen('php://output', 'wb');
		foreach ($list as $fields) {
		    fputcsv($fp, $fields, ";");
		}
		fclose($fp);

    }

    public function ForwardToDetailFromConnectorPK($connector_pk){

    	$charge_box_id = DB::table('connector')->where('connector_pk', $connector_pk)->get();
    	foreach( $charge_box_id as $this_charge_box_id ){
    		$this_charge_box_id = $this_charge_box_id;
    	}

    	$cs_id = DB::table('mdb_cs')->where('CHARGE_BOX_ID', $this_charge_box_id->charge_box_id)->get();
    	foreach( $cs_id as $this_cs_id ){
    		$this_cs_id = $this_cs_id;
    	}

    	return redirect('/cs/detail/'.$this_cs_id->ID);

    }
}
