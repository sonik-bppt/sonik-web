<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;

class UACController extends Controller
{
    public function DisplayLoginPage(){

	    return view('uac.login');

    }

    public function PerformLogin(Request $request){

		$check = DB::table('mdb_user')
	    				->where('EMAIL', $request->email)
	    				->where('PASSWORD', md5($request->password))
                        ->get();

		if( count($check) == 1 ){

			foreach( $check as $this_check ){

				Session::put('ID', $this_check->ID);
				Session::put('NAME', $this_check->NAME);
				Session::put('EMAIL', $this_check->EMAIL);

				DB::table('mdb_user')->where('ID', $this_check->ID)->update([
					"LAST_LOGIN" => date('Y-m-d H:i:s')
				]);

			}

			Session::put('show_popup', base64_encode(1));
			Session::put('popup_type', base64_encode("success"));
			Session::put('popup_message', base64_encode("Login successful, welcome back"));

			return redirect('/dashboard/view');

		} else {

			Session::put('show_popup', base64_encode(1));
			Session::put('popup_type', base64_encode("error"));
			Session::put('popup_message', base64_encode("Invalid credentials, please try again"));

			return redirect('/login');

		}

    }

    public function Logout(){

		Session::forget('ID');
		Session::forget('NAME');
		Session::forget('EMAIL');

		return redirect('/login');

    }

    public function MyProfile(){

    	$user = DB::table('mdb_user')->where('ID', Session::get('ID'))->get();

    	return view('uac.myprofile', compact('user'));

    }

    public function UpdateMyProfile(Request $request){

    	if( $request->currentEmail == $request->email ){
    		$update = DB::table('mdb_user')->where('ID', Session::get('ID'))->update([
	    		"NAME" => $request->name,
	    		"DATE_MODIFIED" => date('Y-m-d H:i:s')
	    	]);

	    	Session::put('show_popup', base64_encode(1));
			Session::put('popup_type', base64_encode("success"));
			Session::put('popup_message', base64_encode("Your profile has been updated."));
    	} else {

			$check = DB::table('mdb_user')
				->where('EMAIL', $request->email)
				->get();

			if( count($check) > 0 ){
				Session::put('show_popup', base64_encode(1));
				Session::put('popup_type', base64_encode("error"));
				Session::put('popup_message', base64_encode("Your new email is already used by other account."));
			} else {
				$update = DB::table('mdb_user')->where('ID', Session::get('ID'))->update([
		    		"NAME" => $request->name,
		    		"EMAIL" => $request->email,
		    		"DATE_MODIFIED" => date('Y-m-d H:i:s')
		    	]);

		    	if( $update ){
		    		Session::put('show_popup', base64_encode(1));
					Session::put('popup_type', base64_encode("success"));
					Session::put('popup_message', base64_encode("Your profile has been updated."));
		    	} else {
		    		Session::put('show_popup', base64_encode(1));
					Session::put('popup_type', base64_encode("error"));
					Session::put('popup_message', base64_encode("Update failed. Please contact our administrator."));
		    	}
			}

    	}



    	return redirect('/my_profile');

    }

    public function MyPassword(){

    	return view('uac.change_password');

    }

    public function ChangeMyPassword(Request $request){

    	$current_user = DB::table('mdb_user')->where('ID', Session::get('ID'))->get();

    	foreach( $current_user as $this_current_user ){
    		$this_current_user = $this_current_user;
    	}

    	if( $this_current_user->PASSWORD != Hash::make($request->current_password) ){
    		Session::put('show_popup', base64_encode(1));
			Session::put('popup_type', base64_encode("error"));
			Session::put('popup_message', base64_encode("Your current password is not correct."));
    	} else {

    		if( $request->new_password != $request->confirm_new_password ){
    			Session::put('show_popup', base64_encode(1));
				Session::put('popup_type', base64_encode("error"));
				Session::put('popup_message', base64_encode("Your new password does not match."));
    		} else {

    			DB::table('mdb_user')->where('ID', Session::get('ID'))->update([
    				"PASSWORD" => Hash::make($request->new_password),
    				"DATE_MODIFIED" => date('Y-m-d H:i:s')
    			]);

    			Session::put('show_popup', base64_encode(1));
				Session::put('popup_type', base64_encode("success"));
				Session::put('popup_message', base64_encode("Your password has been updated."));

    		}

    	}

    	return redirect('/my_password');

    }

    public function ViewAllAdmin(){

    	$user = DB::table('mdb_user')->get();

    	return view('uac.view', compact('user'));

    }

    public function DownloadCSV(){

    	header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="AllAdminUser.csv"');

		$list[] = array('SYSTEM ID' , 'NAME' , 'EMAIL' , 'LAST LOGIN' , 'REGISTRATION DATE' , 'MODIFICATION DATE');

		$user = DB::table('mdb_user')->get();

		foreach( $user as $this_user ){

			$system_id = $this_user->ID;
			$name = $this_user->NAME;
			$email = $this_user->EMAIL;
			$last_login = $this_user->LAST_LOGIN;
			$registration_date = $this_user->DATE_CREATED;
			$modification_date = $this_user->DATE_MODIFIED;

			$list[] = array($system_id, $name, $email, $last_login, $registration_date, $modification_date);
		}

		$fp = fopen('php://output', 'wb');
		foreach ($list as $fields) {
		    fputcsv($fp, $fields, ";");
		}
		fclose($fp);

    }

    public function AddAdmin(){

    	return view('uac.add');

    }

    public function SaveNewAdminUser(Request $request){

    	$check = DB::table('mdb_user')
	    				->where('EMAIL', $request->email)
	    				->get();

		if( count($check) > 0 ){

			Session::put('show_popup', base64_encode(1));
			Session::put('popup_type', base64_encode("error"));
			Session::put('popup_message', base64_encode("Your email has been used by other account."));

			return redirect('/uac/add');

		} else {

			DB::table('mdb_user')->insert([
				"NAME" => $request->name,
				"EMAIL" => $request->email,
				"PASSWORD" => Hash::make($request->password)
			]);

			Session::put('show_popup', base64_encode(1));
			Session::put('popup_type', base64_encode("success"));
			Session::put('popup_message', base64_encode("New admin account has been registered."));

			return redirect('/uac/view');

		}

    }

    public function ViewAdminDetail($id){

    	$user = DB::table('mdb_user')->where('ID', $id)->get();

    	return view('uac.detail', compact('user'));

    }

    public function UpdateOtherAdminProfile(Request $request){

    	if( $request->currentEmail == $request->email ){
    		$update = DB::table('mdb_user')->where('ID', $request->currentID)->update([
	    		"NAME" => $request->name,
	    		"DATE_MODIFIED" => date('Y-m-d H:i:s')
	    	]);

	    	Session::put('show_popup', base64_encode(1));
			Session::put('popup_type', base64_encode("success"));
			Session::put('popup_message', base64_encode("Admin profile has been updated."));
    	} else {

			$check = DB::table('mdb_user')
				->where('EMAIL', $request->email)
				->get();

			if( count($check) > 0 ){
				Session::put('show_popup', base64_encode(1));
				Session::put('popup_type', base64_encode("error"));
				Session::put('popup_message', base64_encode("Admin new email is already used by other account."));
			} else {
				$update = DB::table('mdb_user')->where('ID', $request->currentID)->update([
		    		"NAME" => $request->name,
		    		"EMAIL" => $request->email,
		    		"DATE_MODIFIED" => date('Y-m-d H:i:s')
		    	]);

		    	if( $update ){
		    		Session::put('show_popup', base64_encode(1));
					Session::put('popup_type', base64_encode("success"));
					Session::put('popup_message', base64_encode("Admin profile has been updated."));
		    	} else {
		    		Session::put('show_popup', base64_encode(1));
					Session::put('popup_type', base64_encode("error"));
					Session::put('popup_message', base64_encode("Update failed. Please contact our administrator."));
		    	}
			}

    	}

    	return redirect('/uac/detail/'.$request->currentID);

    }

    public function DeleteAdminAccount($id){

    	DB::table('mdb_user')->where('ID', $id)->delete();

    	Session::put('show_popup', base64_encode(1));
		Session::put('popup_type', base64_encode("success"));
		Session::put('popup_message', base64_encode("Admin account has been deleted."));

		return redirect('/uac/view');

    }

    public function ResetPasswordAdmin($id){

    	$random_password = uniqid();

    	echo $random_password;

    }

}
