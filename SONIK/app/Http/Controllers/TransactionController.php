<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class TransactionController extends Controller
{
    public function View(){

    	$transaction = DB::select(DB::raw('
    		select
	    		t5.NAME as NAME,
	    		t1.transaction_pk as TRANSACTION_PK,
				t1.start_value as START_VALUE,
				t1.start_timestamp as START_TIMESTAMP,
				DATE_ADD(t1.start_timestamp, INTERVAL 7 HOUR) as START_TIMESTAMP_GMT7,
				t2.stop_value as STOP_VALUE,
				(( t2.stop_value - t1.start_value) / 1000) as ENERGY_CONSUMPTION,
				( (( t2.stop_value - t1.start_value) / 1000) * t5.GENERAL_PRICE ) as ENERGY_COST,
				t1.id_tag as ID_TAG,
				TIMEDIFF( t2.stop_timestamp , t1.start_timestamp) as DURATION,
				t6.NAME as CONNECTOR_NAME
	    	from transaction_start t1
	    		left join ( select distinct(transaction_pk) as transaction_pk, stop_value, stop_timestamp, stop_reason from transaction_stop ) as t2 on t1.transaction_pk = t2.transaction_pk
	    		left join connector t3 on t3.connector_pk = t1.connector_pk
	    		left join charge_box t4 on t4.charge_box_id = t3.charge_box_id
	    		left join mdb_cs t5 on t5.CHARGE_BOX_PK = t4.charge_box_pk
	    		left join mdb_connector_name t6 on t6.CONNECTOR_ID = t3.connector_id
	    	where 
	    		(( t2.stop_value - t1.start_value) / 1000) > 0
	    		and t2.stop_reason is not null
	    	order by
	    		t1.start_timestamp DESC
    		'));

    	$transaction_lifetime = DB::select(DB::raw('
    		select
	    		count(t1.transaction_pk) as total_row
	    	from transaction_start t1
	    		left join ( select distinct(transaction_pk) as transaction_pk, stop_value, stop_timestamp, stop_reason from transaction_stop ) as t2 on t1.transaction_pk = t2.transaction_pk
	    		left join connector t3 on t3.connector_pk = t1.connector_pk
	    		left join charge_box t4 on t4.charge_box_id = t3.charge_box_id
	    		left join mdb_cs t5 on t5.CHARGE_BOX_PK = t4.charge_box_pk
	    		left join mdb_connector_name t6 on t6.CONNECTOR_ID = t3.connector_id
	    	where 
	    		(( t2.stop_value - t1.start_value) / 1000) > 0
	    		and t2.stop_reason is not null
	    		and YEAR(DATE_ADD(t1.start_timestamp, INTERVAL 7 HOUR)) = '.date('Y').'
    		'));
    	foreach( $transaction_lifetime as $this_transaction_lifetime ){
    		$this_transaction_lifetime = $this_transaction_lifetime->total_row;
    	}

    	$transaction_this_year = DB::select(DB::raw('
    		select
	    		count(t1.transaction_pk) as total_row
	    	from transaction_start t1
	    		left join ( select distinct(transaction_pk) as transaction_pk, stop_value, stop_timestamp, stop_reason from transaction_stop ) as t2 on t1.transaction_pk = t2.transaction_pk
	    		left join connector t3 on t3.connector_pk = t1.connector_pk
	    		left join charge_box t4 on t4.charge_box_id = t3.charge_box_id
	    		left join mdb_cs t5 on t5.CHARGE_BOX_PK = t4.charge_box_pk
	    		left join mdb_connector_name t6 on t6.CONNECTOR_ID = t3.connector_id
	    	where 
	    		(( t2.stop_value - t1.start_value) / 1000) > 0
	    		and t2.stop_reason is not null
	    		and YEAR(DATE_ADD(t1.start_timestamp, INTERVAL 7 HOUR)) = '.date('Y').'
    		'));
    	foreach( $transaction_this_year as $this_transaction_this_year ){
    		$this_transaction_this_year = $this_transaction_this_year->total_row;
    	}

    	$transaction_this_month = DB::select(DB::raw('
    		select
	    		count(t1.transaction_pk) as total_row
	    	from transaction_start t1
	    		left join ( select distinct(transaction_pk) as transaction_pk, stop_value, stop_timestamp, stop_reason from transaction_stop ) as t2 on t1.transaction_pk = t2.transaction_pk
	    		left join connector t3 on t3.connector_pk = t1.connector_pk
	    		left join charge_box t4 on t4.charge_box_id = t3.charge_box_id
	    		left join mdb_cs t5 on t5.CHARGE_BOX_PK = t4.charge_box_pk
	    		left join mdb_connector_name t6 on t6.CONNECTOR_ID = t3.connector_id
	    	where 
	    		(( t2.stop_value - t1.start_value) / 1000) > 0
	    		and t2.stop_reason is not null
	    		and YEAR(DATE_ADD(t1.start_timestamp, INTERVAL 7 HOUR)) = '.date('Y').'
	    		and MONTH(DATE_ADD(t1.start_timestamp, INTERVAL 7 HOUR)) = '.date('m').'
    		'));
    	foreach( $transaction_this_month as $this_transaction_this_month ){
    		$this_transaction_this_month = $this_transaction_this_month->total_row;
    	}

    	$transaction_today = DB::select(DB::raw('
    		select
	    		count(t1.transaction_pk) as total_row
	    	from transaction_start t1
	    		left join ( select distinct(transaction_pk) as transaction_pk, stop_value, stop_timestamp, stop_reason from transaction_stop ) as t2 on t1.transaction_pk = t2.transaction_pk
	    		left join connector t3 on t3.connector_pk = t1.connector_pk
	    		left join charge_box t4 on t4.charge_box_id = t3.charge_box_id
	    		left join mdb_cs t5 on t5.CHARGE_BOX_PK = t4.charge_box_pk
	    		left join mdb_connector_name t6 on t6.CONNECTOR_ID = t3.connector_id
	    	where 
	    		(( t2.stop_value - t1.start_value) / 1000) > 0
	    		and t2.stop_reason is not null
	    		and DATE(DATE_ADD(t1.start_timestamp, INTERVAL 7 HOUR)) = "'.date('Y-m-d').'"
    		'));
    	foreach( $transaction_today as $this_transaction_today ){
    		$this_transaction_today = $this_transaction_today->total_row;
    	}

    	return view('transaction.index', compact('transaction', 'this_transaction_lifetime', 'this_transaction_this_year', 'this_transaction_this_month', 'this_transaction_today'));

    }

    public function DownloadCSV(){

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="AllTransaction_'.date('Ymd_His').'.csv"');

        $transaction = DB::select(DB::raw('
    		select
	    		t5.NAME as NAME,
	    		t1.transaction_pk as TRANSACTION_PK,
				t1.start_value as START_VALUE,
				t1.start_timestamp as START_TIMESTAMP,
				DATE_ADD(t1.start_timestamp, INTERVAL 7 HOUR) as START_TIMESTAMP_GMT7,
				t2.stop_value as STOP_VALUE,
				(( t2.stop_value - t1.start_value) / 1000) as ENERGY_CONSUMPTION,
				( (( t2.stop_value - t1.start_value) / 1000) * t5.GENERAL_PRICE ) as ENERGY_COST,
				t1.id_tag as ID_TAG,
				TIMEDIFF( t2.stop_timestamp , t1.start_timestamp) as DURATION,
				t6.NAME as CONNECTOR_NAME
	    	from transaction_start t1
	    		left join ( select distinct(transaction_pk) as transaction_pk, stop_value, stop_timestamp, stop_reason from transaction_stop ) as t2 on t1.transaction_pk = t2.transaction_pk
	    		left join connector t3 on t3.connector_pk = t1.connector_pk
	    		left join charge_box t4 on t4.charge_box_id = t3.charge_box_id
	    		left join mdb_cs t5 on t5.CHARGE_BOX_PK = t4.charge_box_pk
	    		left join mdb_connector_name t6 on t6.CONNECTOR_ID = t3.connector_id
	    	where 
	    		(( t2.stop_value - t1.start_value) / 1000) > 0
	    		and t2.stop_reason is not null
	    	order by
	    		t1.start_timestamp DESC
    		'));

        $list[] = array('EVCS', 'CONNECTOR', 'TIME', 'CONSUMPTION (IN KWH)', 'DURATION', 'CHARGING COST (IDR)');

        foreach( $transaction as $this_transaction ){

            $evcs = $this_transaction->NAME;
            $connector = $this_transaction->CONNECTOR_NAME;
            $time = $this_transaction->START_TIMESTAMP_GMT7;
            $consumption = $this_transaction->ENERGY_CONSUMPTION;
            $duration = $this_transaction->DURATION;
            $charging_cost = $this_transaction->ENERGY_COST;

            $list[] = array($evcs, $connector, $time, $consumption, $duration, $charging_cost);
        }

        $fp = fopen('php://output', 'wb');
        foreach ($list as $fields) {
            fputcsv($fp, $fields, ";");
        }
        fclose($fp);

    }

    public function Detail($transaction_pk){

    	$transaction = DB::select(DB::raw('
    		select
	    		t5.NAME as NAME,
	    		t1.transaction_pk as TRANSACTION_PK,
				t1.start_value as START_VALUE,
				t1.start_timestamp as START_TIMESTAMP,
				DATE_ADD(t1.start_timestamp, INTERVAL 7 HOUR) as START_TIMESTAMP_GMT7,
				t2.stop_value as STOP_VALUE,
				(( t2.stop_value - t1.start_value) / 1000) as ENERGY_CONSUMPTION,
				( (( t2.stop_value - t1.start_value) / 1000) * t5.GENERAL_PRICE ) as ENERGY_COST,
				t1.id_tag as ID_TAG,
				TIMEDIFF( t2.stop_timestamp , t1.start_timestamp) as DURATION,
				t6.NAME as CONNECTOR_NAME,
				t7.NAME as CUSTOMER_NAME,
				t7.EMAIL as CUSTOMER_EMAIL,
				t7.PHONE_NUMBER as CUSTOMER_PHONE_NUMBER,
				t7.ID_TAG as CUSTOMER_ID_TAG
	    	from transaction_start t1
	    		left join ( select distinct(transaction_pk) as transaction_pk, stop_value, stop_timestamp, stop_reason from transaction_stop ) as t2 on t1.transaction_pk = t2.transaction_pk
	    		left join connector t3 on t3.connector_pk = t1.connector_pk
	    		left join charge_box t4 on t4.charge_box_id = t3.charge_box_id
	    		left join mdb_cs t5 on t5.CHARGE_BOX_PK = t4.charge_box_pk
	    		left join mdb_connector_name t6 on t6.CONNECTOR_ID = t3.connector_id
	    		left join mdb_customer t7 on t7.ID_TAG collate utf8_general_ci = t1.id_tag collate utf8_general_ci
	    	where 
	    		(( t2.stop_value - t1.start_value) / 1000) > 0
	    		and t2.stop_reason is not null
	    		and t1.transaction_pk = '.$transaction_pk.'
	    	order by
	    		t1.start_timestamp DESC
    		'));

    	return view('transaction.detail', compact('transaction'));

    }
}
