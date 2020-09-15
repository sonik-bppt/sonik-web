<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class AlertController extends Controller
{
    public function View(){

    	$alert = DB::select(DB::raw('
    		select
    			t2.charge_box_id as CHARGE_BOX_ID,
    			t1.status_timestamp as STATUS_TIMESTAMP,
                DATE_ADD(t1.status_timestamp, INTERVAL 7 HOUR) as STATUS_TIMESTAMP_GMT7,
                t3.NAME as CONNECTOR_NAME,
    			t1.status as STATUS,
    			t1.error_code as ERROR_CODE,
    			t1.vendor_id as VENDOR_ID,
    			t1.vendor_error_code as VENDOR_ERROR_CODE,
    			t1.error_info as ERROR_INFO
    		from connector_status t1
    			left join connector t2 on t2.connector_pk = t1.connector_pk
                left join mdb_connector_name t3 on t2.connector_id = t3.CONNECTOR_ID
    		where 
    			t1.vendor_error_code > 0
                and t2.connector_id > 0
    		order by
    			STATUS_TIMESTAMP_GMT7 DESC
    		'));

        $alert_lifetime = DB::select(DB::raw('
            select
                count(t1.connector_pk) as total_row
            from connector_status t1
                left join connector t2 on t2.connector_pk = t1.connector_pk
                left join mdb_connector_name t3 on t2.connector_id = t3.CONNECTOR_ID
            where 
                t1.vendor_error_code > 0
                and t2.connector_id > 0
            '));
        foreach( $alert_lifetime as $this_alert_lifetime ){
            $alert_lifetime = $this_alert_lifetime->total_row;
        }



        $alert_this_year = DB::select(DB::raw('
            select
                count(t1.connector_pk) as total_row
            from connector_status t1
                left join connector t2 on t2.connector_pk = t1.connector_pk
                left join mdb_connector_name t3 on t2.connector_id = t3.CONNECTOR_ID
            where 
                t1.vendor_error_code > 0
                and t2.connector_id > 0
                and YEAR(DATE_ADD(t1.status_timestamp, INTERVAL 7 HOUR)) = '.date('Y').'
            '));
        foreach( $alert_this_year as $this_alert_this_year ){
            $alert_this_year = $this_alert_this_year->total_row;
        }



        $alert_this_month = DB::select(DB::raw('
            select
                count(t1.connector_pk) as total_row
            from connector_status t1
                left join connector t2 on t2.connector_pk = t1.connector_pk
                left join mdb_connector_name t3 on t2.connector_id = t3.CONNECTOR_ID
            where 
                t1.vendor_error_code > 0
                and t2.connector_id > 0
                and YEAR(DATE_ADD(t1.status_timestamp, INTERVAL 7 HOUR)) = '.date('Y').'
                and MONTH(DATE_ADD(t1.status_timestamp, INTERVAL 7 HOUR)) = '.date('m').'
            '));
        foreach( $alert_this_month as $this_alert_this_month ){
            $alert_this_month = $this_alert_this_month->total_row;
        }



        $alert_today = DB::select(DB::raw('
            select
                count(t1.connector_pk) as total_row
            from connector_status t1
                left join connector t2 on t2.connector_pk = t1.connector_pk
                left join mdb_connector_name t3 on t2.connector_id = t3.CONNECTOR_ID
            where 
                t1.vendor_error_code > 0
                and t2.connector_id > 0
                and DATE(DATE_ADD(t1.status_timestamp, INTERVAL 7 HOUR)) = "'.date('Y-m-d').'"
            '));
        foreach( $alert_today as $this_alert_today ){
            $alert_today = $this_alert_today->total_row;
        }

    	return view('alert.index', compact('alert', 'alert_lifetime', 'alert_this_year', 'alert_this_month', 'alert_today'));

    }

    public function DownloadCSV(){

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="AllAlert_'.date('Ymd_His').'.csv"');

        $alert = DB::select(DB::raw('
            select
                t2.charge_box_id as CHARGE_BOX_ID,
                t1.status_timestamp as STATUS_TIMESTAMP,
                DATE_ADD(t1.status_timestamp, INTERVAL 7 HOUR) as STATUS_TIMESTAMP_GMT7,
                t3.NAME as CONNECTOR_NAME,
                t1.status as STATUS,
                t1.error_code as ERROR_CODE,
                t1.vendor_id as VENDOR_ID,
                t1.vendor_error_code as VENDOR_ERROR_CODE,
                t1.error_info as ERROR_INFO
            from connector_status t1
                left join connector t2 on t2.connector_pk = t1.connector_pk
                left join mdb_connector_name t3 on t2.connector_id = t3.CONNECTOR_ID
            where 
                t1.vendor_error_code > 0
                and t2.connector_id > 0
            order by
                STATUS_TIMESTAMP_GMT7 DESC
            '));

        $list[] = array('CHARGE BOX ID' , 'CONNECTOR', 'STATUS TIMESTAMP' , 'STATUS' , 'ERROR CODE' , 'VENDOR ID' , 'VENDOR ERROR CODE', 'ERROR INFO');

        foreach( $alert as $this_alert ){

            $chargebox_id = $this_alert->CHARGE_BOX_ID;
            $connector_name = $this_alert->CONNECTOR_NAME;
            $status_timestamp = $this_alert->STATUS_TIMESTAMP;
            $status = $this_alert->STATUS;
            $error_code = $this_alert->ERROR_CODE;
            $vendor_id = $this_alert->VENDOR_ID;
            $vendor_error_code = $this_alert->VENDOR_ERROR_CODE;
            $error_info = $this_alert->ERROR_INFO;

            $list[] = array($chargebox_id, $connector_name, $status_timestamp, $status, $error_code, $vendor_id, $vendor_error_code, $error_info);
        }

        $fp = fopen('php://output', 'wb');
        foreach ($list as $fields) {
            fputcsv($fp, $fields, ";");
        }
        fclose($fp);

    }
}
