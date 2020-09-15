<?php
header('Access-Control-Allow-Origin: *');  

$db = @new mysqli('localhost', 'root', 'Passw0rdsql$1', 'cepat');
if (mysqli_connect_errno()) {
	die ('Could not open a mysql connection: '.mysqli_connect_error().'('.mysqli_connect_errno().')');
}
error_reporting(0);
/* error_reporting(E_ALL); */
/* ini_set('display_errors', 1); */
date_default_timezone_set("Asia/Bangkok");








if( $_POST['module'] == "LoadConnectorStatusByIDCS" ){

	$query_get_connector = "
	select
		t3.NAME as CONNECTOR_NAME,
		t2.connector_pk as CONNECTOR_PK
	from mdb_cs t1
		left join connector t2 on t2.charge_box_id collate utf8_general_ci = t1.CHARGE_BOX_ID collate utf8_general_ci
		left join mdb_connector_name t3 on t3.connector_id = t2.connector_id
	where t2.connector_id > 0
	";
	$result_get_connector = $db->query($query_get_connector);

	$json['CONNECTOR_INNER_DIV'] = '
							<div class="m-portlet">
								<div class="m-portlet__body m-portlet__body--no-padding">
									<div class="row m-row--no-padding m-row--col-separator-xl">
	';
	while( $row_get_connector = $result_get_connector->fetch_assoc() ){

		/*
		*
		*	GET LATEST STATUS 
		*
		*/
		$query_get_latest_status = "
			select 
    			* ,
    			DATE_ADD(status_timestamp, INTERVAL 7 HOUR) as STATUS_TIMESTAMP_GMT7
    		from connector_status 
    		where 
    			connector_pk = ".$row_get_connector['CONNECTOR_PK']."
    		order by status_timestamp DESC 
    		limit 0,1
		";
		$result_get_latest_status = $db->query($query_get_latest_status);
		$row_get_latest_status = $result_get_latest_status->fetch_assoc();

		if( $row_get_latest_status['status'] == "Available" ){
			$this_tr_class = "m-table__row--success";
			$this_header_class = "success";
		} else if( $row_get_latest_status['status'] == "Unavailable" || $row_get_latest_status['status'] == "SuspendedEV" ){
			$this_tr_class = "m-table__row--danger";
			$this_header_class = "danger";
		} else {
			$this_tr_class = "m-table__row--warning";
			$this_header_class = "warning";
		}



		/*
		*
		*	GET ENERGY CONSUMPTION
		*
		*/
		$latest_meter_value = '
	    		select 
	    			* 
	    		from connector_meter_value 
	    		where 
	    			connector_pk = '.$row_get_connector['CONNECTOR_PK'].'
	    		order by value_timestamp DESC 
	    		limit 0,1
	    		';
		$result_latest_meter_value = $db->query($latest_meter_value);
		$row_latest_meter_value = $result_latest_meter_value->fetch_assoc();
		$kwh_latest = $row_latest_meter_value['value'];






		$latest_start_value = "
			select *
			from transaction_start where connector_pk = ".$row_get_connector['CONNECTOR_PK']." 
			order by event_timestamp DESC limit 0,1
		";
		$result_start_value = $db->query($latest_start_value);
		$row_start_value = $result_start_value->fetch_assoc();
		$kwh_start = $row_start_value['start_value'];

		if( $row_get_latest_status['status'] == "Charging" ){
			$energy_consumption = $kwh_latest - $kwh_start;
		} else {
			$energy_consumption = 0;
		}


    	




		$json['CONNECTOR_INNER_DIV'] .= '
										<div class="col-md-12 col-lg-12 col-xl-4">
											<div class="text-center m--bg-'.$this_header_class.'" style="padding-top:15px;padding-bottom:15px;color:#fff;">
												<h4>'.$row_get_connector['CONNECTOR_NAME'].'</h4>
											</div>
											<div style="background:#333;color:#fff;text-align:center;min-height:40px;padding-top:10px;padding-bottom:10px;">'.$row_get_latest_status['error_info'].'</div>
											<div class="m-widget1">
												<div class="m-widget1__item">
													<div class="row m-row--no-padding align-items-center">
														<div class="col">
															<h3 class="m-widget1__title">Status</h3>
														</div>
														<div class="col m--align-right">
															<span class="m-widget1__number m--font-primary">
																'.$row_get_latest_status['status'].'
															</span>
														</div>
													</div>
												</div>
												<div class="m-widget1__item">
													<div class="row m-row--no-padding align-items-center">
														<div class="col">
															<h3 class="m-widget1__title">Current Consumption (in Wh)</h3>
														</div>
														<div class="col m--align-right">
															<span class="m-widget1__number m--font-brand">
																'.number_format($energy_consumption).'
															</span>
														</div>
													</div>
												</div>
												<div class="m-widget1__item">
													<div class="row m-row--no-padding align-items-center">
														<div class="col">
															<h3 class="m-widget1__title">Latest status timestamp</h3>
														</div>
														<div class="col m--align-right">
															<span class="m-widget1__number m--font-primary">
																'.substr($row_get_latest_status['STATUS_TIMESTAMP_GMT7'],0,19).'
															</span>
														</div>
													</div>
												</div>
											</div>
											<div>
												<a target="_blank" href="../cs/ForwardToDetailFromConnectorPK/'.$row_get_connector['CONNECTOR_PK'].'" class="btn btn-secondary btn-lg" style="width:100%;">View Detail</a>
											</div>

											<!--end:: Widgets/Stats2-1 -->
										</div>
		';

	}

	$json['CONNECTOR_INNER_DIV'] .= '
									</div>
								</div>
							</div>

	';

}

if( $_POST['module'] == "GetOngoingChargingData" ){

	$query_get = '
    		select 
    			t1.transaction_pk as TRANSACTION_PK,
    			t4.NAME as EVCS_NAME,
    			t5.NAME as CONNECTOR_NAME,
    			t1.start_timestamp as START_TIMESTAMP,
    			DATE_ADD(t1.start_timestamp, INTERVAL 7 HOUR) as START_TIMESTAMP_GMT7
    		from transaction_start t1
    			left join transaction_stop t2 on t1.transaction_pk = t2.transaction_pk
    			left join connector t3 on t3.connector_pk = t1.connector_pk
    			left join mdb_cs t4 on t4.CHARGE_BOX_ID collate utf8_general_ci = t3.charge_box_id collate utf8_general_ci
    			left join mdb_connector_name t5 on t5.connector_id = t3.connector_id
    		where
    			t2.transaction_pk is null
    		';
    $result_get = $db->query($query_get);
    while( $row_get = $result_get->fetch_assoc() ){

    	if( $_POST['page'] == 'normal' ){
    		$redirect_link = 'energy_streamer/detail/'.$row_get['TRANSACTION_PK'];
    	} else if( $_POST['page'] == 'detail' ){
    		$redirect_link = $row_get['TRANSACTION_PK'];
    	}

    	$json['ONGOING_TRANSACTION_TABLE_ROW'] .= '
			<tr>
				<td>'.$row_get['TRANSACTION_PK'].'</td>
				<td>'.$row_get['EVCS_NAME'].'</td>
				<td>'.$row_get['CONNECTOR_NAME'].'</td>
				<td>'.substr($row_get['START_TIMESTAMP_GMT7'],0,19).'</td>
				<td><a href="'.$redirect_link.'" class="btn btn-warning btn-sm" style="width:100%;">Detail</a></td>
			</tr>
    	';
    }

}

echo json_encode($json);

?>
