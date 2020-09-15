<?php
header('Access-Control-Allow-Origin: *');

$db = @new mysqli('localhost', 'ocppadmin', 'Ocpp@123', 'cepat');
if (mysqli_connect_errno()) {
	die ('Could not open a mysql connection: '.mysqli_connect_error().'('.mysqli_connect_errno().')');
}
error_reporting(0);
/* error_reporting(E_ALL); */
/* ini_set('display_errors', 1); */
date_default_timezone_set("Asia/Bangkok");
require('PHPMailer/PHPMailerAutoload.php');








if( $_POST['module'] == "CustomerRegistration" ){

	$query_get = "select * from mdb_customer where EMAIL = '".$_POST['email']."' ";
	$result_get = $db->query($query_get);
	$num_get = $result_get->num_rows;

	if( $num_get > 0 ){
		$json['RESULT'] = 3;
		$json['MESSAGE'] = 'Your email address is already exist in our system. Please try to login instead.';
	} else {

		$verification_id = uniqid();

		$query_add = "
			insert into mdb_customer(
				NAME,
				EMAIL,
				PASSWORD,
				VERIFICATION_ID
			)
			values(
				'".$_POST['fullname']."',
				'".$_POST['email']."',
				md5('".$_POST['password']."'),
				'".$verification_id."'
			)
		";
		//$json['QUERY'] = $query_add;
		$result = $db->query($query_add);

		if( $result ){

			$mail = new PHPMailer(true);
			$mail->isSMTP();
			$mail->Host = 'smtp.googlemail.com';  //gmail SMTP server
			$mail->SMTPAuth = true;
			$mail->Username = 'cepat.mailer@gmail.com';   //username
			$mail->Password = 'P@ssw0rd$123@';   //password
			$mail->SMTPSecure = 'ssl';
			$mail->Port = 465;                    //SMTP port
			$mail->setFrom('cepat.mailer@gmail.com', 'CEPAT MAILER');
			$mail->addAddress($_POST['email'], $_POST['fullname']);

			$mail->isHTML(true);

			$mail->Subject = '[NO REPLY] Email Verification for CEPAT';
			$mail->Body    = '
			<p>Hi '.$_POST['fullname'].'</p>
			<p>
				Welcome to CEPAT, your all in one mobile app for EV Charging. Your account has been successfully registered in our system. In order to login to your app, please click the verification link below.
			</p>
			<p>
				Verification link: <a href="http://192.168.43.251/cepat/public/account_verification/'.$verification_id.'">http://192.168.43.251/cepat/public/account_verification/'.$verification_id.'</a>
			</p>
			<p>
				Thank you!
			</p>
			';

			$mail->send();






			$json['RESULT'] = 1;
			$json['MESSAGE'] = 'Your account has been registered. Please verify your email.';
		} else {
			$json['RESULT'] = 2;
			$json['MESSAGE'] = 'Account registration failed. Please contact our administrator.';
		}

	}

}

if( $_POST['module'] == "CustomerLogin" ){

	$query_get = "select * from mdb_customer where EMAIL = '".$_POST['email']."' and PASSWORD = '".md5($_POST['password'])."' and IS_VERIFIED = 1";
	$result_get = $db->query($query_get);
	$num_get = $result_get->num_rows;

	if( $num_get == 1 ){
		$row_get = $result_get->fetch_assoc();

		$json['ID'] = $row_get['ID'];
		$json['FULLNAME'] = $row_get['NAME'];
		$json['EMAIL'] = $row_get['EMAIL'];
		$json['ID_TAG'] = $row_get['ID_TAG'];

		$json['RESULT'] = 1;
		$json['MESSAGE'] = 'Login success! Welcome back';
	} else {
		$json['RESULT'] = 2;
		$json['MESSAGE'] = 'Invalid login. Please try again.';
	}

}

if( $_POST['module'] == "GetDashboardData" ){

	$query_get = "select * from mdb_customer where ID = '".$_POST['id']."' ";
	$result_get = $db->query($query_get);
	$row_get = $result_get->fetch_assoc();

	$json['RESULT'] = 1;
	$json['MESSAGE'] = 'Data has been retrieved';

	$json['SALDO'] = number_format($row_get['SALDO'],0,"",".");
	$json['IS_ACTIVE'] = $row_get['IS_ACTIVE'];

}


if( $_POST['module'] == "GetNearestCS" ){

	if( $_POST['longitude'] == null && $_POST['latitude'] == null ){
		$json['CS_LIST'] = '';
		$json['CS_NUM'] = 0;
	} else {
		$query_get = "select * from mdb_cs";
		$result_get = $db->query($query_get);
		$num_get = $result_get->num_rows;
		while( $row_get = $result_get->fetch_assoc() ){

			$lat1 = $row_get['LATITUDE'];
			$lat2 = $_POST['latitude'];
			$long1 = $row_get['LONGITUDE'];
			$long2 = $_POST['longitude'];

			if (($lat1 == $lat2) && ($lon1 == $lon2)) {
	    		return 0;
	  		}
	  		else {
	    		$theta = $lon1 - $lon2;
				$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
				$dist = acos($dist);
				$dist = rad2deg($dist);
				$miles = $dist * 60 * 1.1515;
				$unit = strtoupper($unit);

				$unit = "K";

				if ($unit == "K") {
					$coordinate_distance = ($miles * 1.609344);
				} else if ($unit == "N") {
					$coordinate_distance = ($miles * 0.8684);
				} else {
					$coordinate_distance = $miles;
				}
			}

			$json['CS_LIST'] .= '<div class="m-messenger__wrapper" onclick="GoToCSDetail('.$row_get['ID'].')">
										<div class="m-messenger__message m-messenger__message--in">
											<div class="m-messenger__message-pic">
												<img src="../../asset/media/charger.png" alt="" style="max-width:40px;"/>
											</div>
											<div class="m-messenger__message-body">
												<div class="m-messenger__message-arrow"></div>
												<div class="m-messenger__message-content">
													<div class="m-messenger__message-username">
														'.$row_get['NAME'].'
													</div>
													<div class="m-messenger__message-text">
														'.$row_get['LOCATION'].'
													</div>
													<div style="margin-top:10px;">Radius: '.number_format($coordinate_distance,2,",",".").' Kilometer</div>
												</div>
											</div>
										</div>
									</div>';
		}
		$json['CS_NUM'] = $num_get;
	}

}

if( $_POST['module'] == "GetNearestCSNew" ){

	if( $_POST['longitude'] == null && $_POST['latitude'] == null ){
		$json['CS_LIST'] = '';
		$json['CS_NUM'] = 0;
	} else {
		$query_get = "select * from mdb_cs";
		$result_get = $db->query($query_get);
		$num_get = $result_get->num_rows;
		while( $row_get = $result_get->fetch_assoc() ){

			$lat1 = $row_get['LATITUDE'];
			$lat2 = $_POST['latitude'];
			$lon1 = $row_get['LONGITUDE'];
			$lon2 = $_POST['longitude'];

			if (($lat1 == $lat2) && ($lon1 == $lon2)) {
	    		return 0;
	  		}
	  		else {
	    		$theta = $lon1 - $lon2;
				$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
				$dist = acos($dist);
				$dist = rad2deg($dist);
				$miles = $dist * 60 * 1.1515;
				$unit = strtoupper($unit);

				$unit = "K";

				if ($unit == "K") {
					$coordinate_distance = ($miles * 1.609344);
				} else if ($unit == "N") {
					$coordinate_distance = ($miles * 0.8684);
				} else {
					$coordinate_distance = $miles;
				}
			}

			$json['CS_LIST'] .= '	<div class="item shadow" onclick="GoToCSDetail('.$row_get['ID'].')">
										<div class="left">
				                        <img class="avatar circle" src="MEDIA/electric.png" style="height:70px;width:auto;">
				                    </div>
				                    <h2>'.$row_get['NAME'].'</h2>
				                    <p class="text-grey-500">'.substr($row_get['LOCATION'],0,65).'...</p>
				                    <span class="text-small green radius padding text-white" style="display:none;"><i class="ion ion-outlet"></i>6.0 kW</span>
				                    <span class="text-small green radius padding text-white"><i class="ion ion-ionic"></i>'.number_format($coordinate_distance,2,",",".").' km</span>
				                </div>
                ';
		}
		$json['CS_NUM'] = $num_get;
	}

}










if( $_POST['module'] == "GetNearestCSNewShell" ){

	if( $_POST['longitude'] == null && $_POST['latitude'] == null ){
		$json['CS_LIST'] = '';
		$json['CS_NUM'] = 0;
	} else {
		$query_get = "
			select
				t1.LATITUDE as LATITUDE,
				t1.LONGITUDE as LONGITUDE,
				t1.ID as ID,
				t1.LOCATION as LOCATION,
				t1.GENERAL_PRICE as GENERAL_PRICE,
				t3.connector_pk as CONNECTOR_PK,
				t3.connector_id as CONNECTOR_ID
			from mdb_cs t1
				left join charge_box t2 on t2.charge_box_id collate utf8_general_ci = t1.CHARGE_BOX_ID collate utf8_general_ci
				left join connector t3 on t3.charge_box_id = t2.charge_box_id
			where
				t3.connector_pk > 0
				and t3.connector_id > 0
			";
		$result_get = $db->query($query_get);
		$num_get = $result_get->num_rows;
		$even_odd_counter = 1;
		while( $row_get = $result_get->fetch_assoc() ){

			$lat1 = $row_get['LATITUDE'];
			$lat2 = $_POST['latitude'];
			$lon1 = $row_get['LONGITUDE'];
			$lon2 = $_POST['longitude'];

			if (($lat1 == $lat2) && ($lon1 == $lon2)) {
	    		return 0;
	  		}
	  		else {
	    		$theta = $lon1 - $lon2;
				$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
				$dist = acos($dist);
				$dist = rad2deg($dist);
				$miles = $dist * 60 * 1.1515;
				$unit = strtoupper($unit);

				$unit = "K";

				if ($unit == "K") {
					$coordinate_distance = ($miles * 1.609344);
				} else if ($unit == "N") {
					$coordinate_distance = ($miles * 0.8684);
				} else {
					$coordinate_distance = $miles;
				}
			}

			if( $even_odd_counter == 1 ){
				$background_div = "background:rgb(255,255,255);";
				$even_odd_counter = 2;
			} else if( $even_odd_counter == 2 ){
				$background_div = "background:rgb(243,243,243);";
				$even_odd_counter = 1;
			}

			$query_get_latest_status = "select * from connector_status where connector_pk = '".$row_get['CONNECTOR_PK']."' order by status_timestamp DESC limit 0,1";
			$result_get_latest_status = $db->query($query_get_latest_status);
			$row_get_latest_status = $result_get_latest_status->fetch_assoc();
			$latest_status = $row_get_latest_status['status'];

			if( $latest_status == "Available" ){
				$status_color = "text-green";
			} else if( $latest_status == "Unavailable" || $latest_status == "SuspendedEV" ){
				$status_color = "text-red";
			} else {
				$status_color = "text-orange";
			}

			if( $row_get['CONNECTOR_ID'] == 1 ){
				$connector_image = "charger1.png";
				$connector_name = 'CCS TYPE 2 - MODE 4';
				$max_power = 50;
			} else if( $row_get['CONNECTOR_ID'] == 2 ){
				$connector_image = "charger2.png";
				$connector_name = 'CHADEMO - MODE 4';
				$max_power = 50;
			} else if( $row_get['CONNECTOR_ID'] == 3 ){
				$connector_image = "charger3.png";
				$connector_name = 'TYPE 2';
				$max_power = 43;
			}

			$json['CS_LIST'] .= '

				               <div style="'.$background_div.'" onclick="getCSDetail('.$row_get['ID'].', '.$row_get['CONNECTOR_PK'].', '.$row_get['CONNECTOR_ID'].' )">
					            <div class="padding">
					              <div class="left">
					                '.substr($row_get['LOCATION'],0,30).'...
					              </div>
					              <div class="right" style="font-size:16px;margin-top:-2px;">
					                <span style="padding-right:10px;">'.number_format($coordinate_distance,2,",",".").' km</span> <i class="ion-ios-navigate-outline active strong" style="font-size:28px;float:right;font-weight:bold;margin-top:-7px;"></i>
					              </div>
					              <div class="space"></div>
					              <div style="height:5px;">&nbsp;</div>
					              <div class="row">
					                <div class="col-10">
					                  <img src="MEDIA/'.$connector_image.'" style="width:100%;height:auto;">
					                </div>
					                <div class="col '.$status_color.'" style="font-size:24px;padding-left:7px;padding-top:10px;">
					                  '.$latest_status.'
					                </div>
					              </div>
					              <div style="height:5px;">&nbsp;</div>
					              <div class="left">max. power <span style="font-size:16px;">'.$max_power.' kW</span></div>
					              <div class="right" style="font-size:16px;"><i class="ion-pricetag"></i> IDR '.number_format($row_get['GENERAL_PRICE']).'</div>
					              <div class="space"></div>
					            </div>
					          </div>



                ';
		}
		$json['CS_NUM'] = $num_get;
	}

}








if( $_POST['module'] == "GetCSDetail" ){

	$query_get = "
		select
			t1.LATITUDE as LATITUDE,
			t1.LONGITUDE as LONGITUDE,
			t1.NAME as NAME,
			t1.LOCATION as LOCATION,
			t1.GENERAL_PRICE as GENERAL_PRICE,
			t1.GOOGLE_MAP_LINK as GOOGLE_MAP_LINK,
			t2.charge_point_vendor as CHARGE_POINT_VENDOR,
			t2.charge_point_model as CHARGE_POINT_MODEL,
			t3.connector_pk as CONNECTOR_PK,
			t3.connector_id as CONNECTOR_ID
		from mdb_cs t1
			left join charge_box t2 on t2.charge_box_id collate utf8_general_ci = t1.CHARGE_BOX_ID collate utf8_general_ci
			left join connector t3 on t3.charge_box_id = t2.charge_box_id
		where
			t1.ID = '".$_POST['id']."'
			and t3.connector_pk = '".$_POST['connector_pk']."'
			and t3.connector_id = '".$_POST['connector_id']."'
		";
	$result_get = $db->query($query_get);
	$row_get = $result_get->fetch_assoc();


	$lat1 = $row_get['LATITUDE'];
	$lat2 = $_POST['latitude'];
	$lon1 = $row_get['LONGITUDE'];
	$lon2 = $_POST['longitude'];

	if (($lat1 == $lat2) && ($lon1 == $lon2)) {
		return 0;
		}
		else {
		$theta = $lon1 - $lon2;
		$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
		$dist = acos($dist);
		$dist = rad2deg($dist);
		$miles = $dist * 60 * 1.1515;
		$unit = strtoupper($unit);

		$unit = "K";

		if ($unit == "K") {
			$coordinate_distance = ($miles * 1.609344);
		} else if ($unit == "N") {
			$coordinate_distance = ($miles * 0.8684);
		} else {
			$coordinate_distance = $miles;
		}
	}


	$query_get_latest_status = "select * from connector_status where connector_pk = '".$row_get['CONNECTOR_PK']."' order by status_timestamp DESC limit 0,1";
	$result_get_latest_status = $db->query($query_get_latest_status);
	$row_get_latest_status = $result_get_latest_status->fetch_assoc();
	$latest_status = $row_get_latest_status['status'];

	if( $latest_status == "Available" ){
		$status_color = "text-green";
	} else if( $latest_status == "Unavailable" || $latest_status == "SuspendedEV" ){
		$status_color = "text-red";
	} else {
		$status_color = "text-orange";
	}

	if( $row_get['CONNECTOR_ID'] == 1 ){
		$connector_image = "charger1.png";
		$connector_name = 'CCS TYPE 2 - MODE 4';
		$max_power = 50;
	} else if( $row_get['CONNECTOR_ID'] == 2 ){
		$connector_image = "charger2.png";
		$connector_name = 'CHADEMO - MODE 4';
		$max_power = 50;
	} else if( $row_get['CONNECTOR_ID'] == 3 ){
		$connector_image = "charger3.png";
		$connector_name = 'TYPE 2';
		$max_power = 43;
	}


	$json['RESULT'] = 1;
	$json['MESSAGE'] = 'CS Data has been retrieved: ID'.$_POST['id'];

	$json['NAME'] = $row_get['NAME'];
	$json['LOCATION'] = substr($row_get['LOCATION'],0,33).'...';
	$json['DISTANCE_RADIUS'] = number_format($coordinate_distance,2,",",".").' km';
	$json['GENERAL_PRICE'] = number_format($row_get['GENERAL_PRICE']);
	$json['GENERAL_PRICE_PURE'] = $row_get['GENERAL_PRICE'];
	//$json['COORDINATE'] = $row_get['LATITUDE'].','.$row_get['LONGITUDE'];
	// $json['GOOGLE_MAP_LINK'] = '<a href="'.$row_get['GOOGLE_MAP_LINK'].'" target="_blank"><button class="green radius full">Click to Open Google Maps</button></a>  ';
	$json['GOOGLE_MAP_LINK'] = $row_get['GOOGLE_MAP_LINK'];
	// $json['GOOGLE_EMBED_CODE'] = $row_get['GOOGLE_EMBED_CODE'];
	$json['CHARGE_POINT_VENDOR'] = $row_get['CHARGE_POINT_VENDOR'];
	$json['CHARGE_POINT_MODEL'] = $row_get['CHARGE_POINT_MODEL'];
	$json['STATUS'] = $latest_status;
	$json['STATUS_COLOR'] = $status_color;
	$json['MAX_POWER'] = $max_power;

}





if( $_POST['module'] == "MakeReservation" ){

	$query_get = "select max(reservation_pk) as max_id from reservation";
	$result_get = $db->query($query_get);
	$row_get = $result_get->fetch_assoc();
	$new_id = $row_get['max_id'] + 1;

	$query_add = "insert into reservation
		(
			reservation_pk,
			connector_pk,
			id_tag,
			start_datetime,
			expiry_datetime,
			status
		)
		values
		(
			'".$new_id."',
			'".$_POST['connector_pk']."',
			'".$_POST['id_user']."',
			NOW(),
			DATE_ADD(NOW(), INTERVAL ".$_POST['duration']." MINUTE),
			'ACCEPTED'
		)
	";
	$result_add = $db->query($query_add);
	$json['QUERY'] = $query_add;

}




if( $_POST['module'] == "GetCurrentUserAccountDetail" ){

	$query_get = "select * from mdb_customer where ID = '".$_POST['id_user']."' ";
	$result_get = $db->query($query_get);
	$row_get = $result_get->fetch_assoc();

	$json['FULLNAME'] = $row_get['NAME'];
	$json['EMAIL'] = $row_get['EMAIL'];

}





if( $_POST['module'] == "UpdateAccountData" ){

	if( $_POST['current_email'] == $_POST['email'] ){

		$query_update = "update mdb_customer set NAME = '".$_POST['fullname']."' where ID = '".$_POST['id_user']."' ";
		$result_update = $db->query($query_update);

		$json['RESULT'] = 1;
		$json['MESSAGE'] = 'Your profile has been updated';

	} else {

		$query_check = "select count(ID) as total_row from mdb_customer where EMAIL = '".$_POST['email']."' ";
		$result_check = $db->query($query_check);
		$row_check = $result_check->fetch_assoc();

		if( $row_check['total_row'] > 0 ){
			$json['RESULT'] = 0;
			$json['MESSAGE'] = 'Your new email has already used by another account. Please use another email and try again.';
		} else {

			$query_update = "update mdb_customer set NAME = '".$_POST['fullname']."', EMAIL = '".$_POST['email']."' where ID = '".$_POST['id_user']."' ";
			$result_update = $db->query($query_update);

			$json['RESULT'] = 1;
			$json['MESSAGE'] = 'Your profile has been updated';
		}

	}

}




if( $_POST['module'] == "UpdatePassword" ){

	$query_get = "select * from mdb_customer where ID = '".$_POST['id_user']."' ";
	$result_get = $db->query($query_get);
	$row_get = $result_get->fetch_assoc();

	if( $row_get['PASSWORD'] != md5($_POST['password_current']) ){
		$json['RESULT'] = 0;
		$json['MESSAGE'] = 'Your current password is not correct.';
	} else {

		if( $_POST['password_new'] != $_POST['password_new_confirm'] ){
			$json['RESULT'] = 0;
			$json['MESSAGE'] = 'Your new password does not match.';
		} else {

			$query_update = "update mdb_customer set PASSWORD = md5('".$_POST['password_new']."'), DATE_MODIFIED = NOW() where ID = '".$_POST['id_user']."' ";
			$result_update = $db->query($query_update);

			$json['RESULT'] = 1;
			$json['MESSAGE'] = 'Your password has been updated.';

		}

	}

}



if( $_POST['module'] == "GetCurrentCard" ){

	$query_get = "select * from mdb_customer where ID = '".$_POST['id_user']."' ";
	$result_get = $db->query($query_get);
	$row_get = $result_get->fetch_assoc();

	$json['ID_TAG'] = $row_get['ID_TAG'];

}




if( $_POST['module'] == "UpdateCardData" ){

	$query_get = "select * from mdb_customer where ID = '".$_POST['id_user']."' ";
	$result_get = $db->query($query_get);
	$row_get = $result_get->fetch_assoc();

	$current_id_tag = $row_get['ID_TAG'];

	if( $current_id_tag == $_POST['card_id_tag'] ){
		$json['RESULT'] = 0;
		$json['MESSAGE'] = 'Your card detail does not changed.';
	} else {

		$query_check = "select count(ocpp_tag_pk) as total_row from ocpp_tag where id_tag = '".$_POST['card_id_tag']."' ";
		$result_check = $db->query($query_check);
		$row_check = $result_check->fetch_assoc();

		if( $row_check['total_row'] == 0 ){

			$query_get = "select max(ocpp_tag_pk) as last_id from ocpp_tag";
			$result_get = $db->query($query_get);
			$row_get = $result_get->fetch_assoc();
			$last_id = $row_get['last_id'];
			$new_id = $last_id + 1;

			$query_add = "insert into ocpp_tag (ocpp_tag_pk, id_tag, max_active_transaction_count) values('".$new_id."', '".$_POST['card_id_tag']."', 1)";
			$result_add = $db->query($query_add);

		} else {

			$query_update = "update ocpp_tag set id_tag = '".$_POST['card_id_tag']."' where id_tag = '".$current_id_tag."' ";
			$result_update = $db->query($query_update);

		}

		$query_update = "update mdb_customer set ID_TAG = '".$_POST['card_id_tag']."' where ID = '".$_POST['id_user']."' ";
		$result_update = $db->query($query_update);

		$json['RESULT'] = 1;
		$json['MESSAGE'] = 'Your new card has been registered';
	}

}

echo json_encode($json);

?>
