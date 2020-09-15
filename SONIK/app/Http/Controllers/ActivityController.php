<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class ActivityController extends Controller
{
    public function View(){

    	$activity = DB::select(DB::raw('
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
    			t1.error_code = "NoError"
                and t2.connector_id > 0
    		order by
    			STATUS_TIMESTAMP_GMT7 DESC
    		'));

        $activity_lifetime = DB::select(DB::raw('
            select
                count(t1.connector_pk) as total_row
            from connector_status t1
                left join connector t2 on t2.connector_pk = t1.connector_pk
                left join mdb_connector_name t3 on t2.connector_id = t3.CONNECTOR_ID
            where 
                t1.error_code = "NoError"
                and t2.connector_id > 0
            '));
        foreach( $activity_lifetime as $this_activity_lifetime ){
            $activity_lifetime = $this_activity_lifetime->total_row;
        }



        $activity_this_year = DB::select(DB::raw('
            select
                count(t1.connector_pk) as total_row
            from connector_status t1
                left join connector t2 on t2.connector_pk = t1.connector_pk
                left join mdb_connector_name t3 on t2.connector_id = t3.CONNECTOR_ID
            where 
                t1.error_code = "NoError"
                and t2.connector_id > 0
                and YEAR(DATE_ADD(t1.status_timestamp, INTERVAL 7 HOUR)) = '.date('Y').'
            '));
        foreach( $activity_this_year as $this_activity_this_year ){
            $activity_this_year = $this_activity_this_year->total_row;
        }



        $activity_this_month = DB::select(DB::raw('
            select
                count(t1.connector_pk) as total_row
            from connector_status t1
                left join connector t2 on t2.connector_pk = t1.connector_pk
                left join mdb_connector_name t3 on t2.connector_id = t3.CONNECTOR_ID
            where 
                t1.error_code = "NoError"
                and t2.connector_id > 0
                and YEAR(DATE_ADD(t1.status_timestamp, INTERVAL 7 HOUR)) = '.date('Y').'
                and MONTH(DATE_ADD(t1.status_timestamp, INTERVAL 7 HOUR)) = '.date('m').'
            '));
        foreach( $activity_this_month as $this_activity_this_month ){
            $activity_this_month = $this_activity_this_month->total_row;
        }



        $activity_today = DB::select(DB::raw('
            select
                count(t1.connector_pk) as total_row
            from connector_status t1
                left join connector t2 on t2.connector_pk = t1.connector_pk
                left join mdb_connector_name t3 on t2.connector_id = t3.CONNECTOR_ID
            where 
                t1.error_code = "NoError"
                and t2.connector_id > 0
                and DATE(DATE_ADD(t1.status_timestamp, INTERVAL 7 HOUR)) = "'.date('Y-m-d').'"
            '));
        foreach( $activity_today as $this_activity_today ){
            $activity_today = $this_activity_today->total_row;
        }

    	return view('activity.index', compact('activity', 'activity_lifetime', 'activity_this_year', 'activity_this_month', 'activity_today'));

    }

    public function DownloadCSV(){

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="AllActivity_'.date('Ymd_His').'.csv"');

        $activity = DB::select(DB::raw('
            select
                t2.charge_box_id as CHARGE_BOX_ID,
                t1.status_timestamp as STATUS_TIMESTAMP,
                DATE_ADD(t1.status_timestamp, INTERVAL 7 HOUR) as STATUS_TIMESTAMP_GMT7,
                t3.NAME as CONNECTOR_NAME,
                t1.status as STATUS,
                t1.vendor_id as VENDOR_ID,
                t1.error_info as ERROR_INFO
            from connector_status t1
                left join connector t2 on t2.connector_pk = t1.connector_pk
                left join mdb_connector_name t3 on t2.connector_id = t3.CONNECTOR_ID
            where 
                t1.vendor_error_code = ""
                and t2.connector_id > 0
            order by
                STATUS_TIMESTAMP_GMT7 DESC
            '));

        $list[] = array('CHARGE BOX ID' , 'CONNECTOR', 'STATUS TIMESTAMP' , 'STATUS' , 'VENDOR ID' , 'ERROR INFO');

        foreach( $activity as $this_activity ){

            $chargebox_id = $this_activity->CHARGE_BOX_ID;
            $connector_name = $this_activity->CONNECTOR_NAME;
            $status_timestamp = $this_activity->STATUS_TIMESTAMP;
            $status = $this_activity->STATUS;
            $vendor_id = $this_activity->VENDOR_ID;
            $error_info = $this_activity->ERROR_INFO;

            $list[] = array($chargebox_id, $connector_name, $status_timestamp, $status, $vendor_id, $error_info);
        }

        $fp = fopen('php://output', 'wb');
        foreach ($list as $fields) {
            fputcsv($fp, $fields, ";");
        }
        fclose($fp);

    }
}
