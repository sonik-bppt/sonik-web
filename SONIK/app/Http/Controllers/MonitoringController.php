<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class MonitoringController extends Controller
{
    public function Connector(){

    	$cs = DB::select(DB::raw('
    		select
    			t1.ID as ID,
    			t1.NAME as NAME
    		from mdb_cs t1
    			left join charge_box t2 on t2.charge_box_id collate utf8_general_ci = t1.CHARGE_BOX_ID collate utf8_general_ci
    		where 
    			t2.last_heartbeat_timestamp is not null
    		'));


    	return view('monitoring.connector_status_new', compact('cs'));

    }

    public function EnergyStreamer(){

    	$transaction = DB::select(DB::raw('
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
    		'));

    	return view('monitoring.energy_streamer', compact('transaction'));

    }

    public function EnergyStreamerDetail($transaction_pk){

        $transaction_pk = $transaction_pk;

    	$transaction = DB::select(DB::raw('
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
    		'));

    	$energy_log = DB::select(DB::raw('
    		select 
    		* ,
    		DATE_ADD(value_timestamp, INTERVAL 7 HOUR) as value_timestamp_gmt7
    		from connector_meter_value 
    		where 
    			transaction_pk = '.$transaction_pk.' 
    		order by 
    			value_timestamp ASC
    		'));

    	$energy_start = DB::select(DB::raw('
    		select *, DATE_ADD(start_timestamp, INTERVAL 7 HOUR) as start_timestamp_gmt7 from transaction_start where transaction_pk = '.$transaction_pk.' 
    		'));
    	foreach( $energy_start as $this_energy_start ){
    		$this_value_energy_start = $this_energy_start->start_value;
    		$timestart = $this_energy_start->start_timestamp_gmt7;
            $current_connector_pk = $this_energy_start->connector_pk;
    	}


    	/*
    	*
    	*	CALCULATE ENERGY CONSUMPTION
    	*
    	*/
    	foreach( $energy_log as $this_energy_log ){
    		$latest_energy_log = $this_energy_log->value;
    		$timelatest = $this_energy_log->value_timestamp_gmt7;
    	}
    	$total_consumption = $latest_energy_log - $this_value_energy_start;


    	/*
    	*
    	*	CALCULATE DURATION
    	*
    	*/
    	$datetime1 = strtotime($timestart);
		$datetime2 = strtotime($timelatest);
		$interval  = abs($datetime2 - $datetime1);
		$minutes   = round($interval / 60);
		$duration = $minutes;

		$format = '%02d:%02d';
	    $hours = floor($duration / 60);
	    $minutes = ($duration % 60);
	    $durationx = sprintf($format, $hours, $minutes);


    	/*
    	*
    	*	GET PRICE
    	*
    	*/
    	$price = DB::select(DB::raw('
    		select
    			t3.GENERAL_PRICE as GENERAL_PRICE
    		from transaction_start t1
    			left join connector t2 on t2.connector_pk = t1.connector_pk
    			left join mdb_cs t3 on t3.CHARGE_BOX_ID collate utf8_general_ci = t2.charge_box_id collate utf8_general_ci
    		'));
    	foreach( $price as $this_price ){
    		$this_price = $this_price->GENERAL_PRICE;
    	}
    	$charging_cost = $total_consumption / 1000 * $this_price;

        




        $transaction_stop = DB::select(DB::raw(
            "select count(transaction_pk) as total_row from transaction_stop where transaction_pk = ".$transaction_pk
        ));
        foreach( $transaction_stop as $this_transaction_stop ){
            $this_transaction_stop = $this_transaction_stop;
        }
        if( $this_transaction_stop->total_row == 0 ){
            return view('monitoring.energy_streamer_detail', compact('transaction_pk', 'transaction', 'energy_log', 'this_value_energy_start', 'total_consumption', 'durationx', 'charging_cost'));
        } else {
            return redirect('/monitoring/energy_streamer');
        }

    }

    public function DisplayStreamer($transaction_pk){

        $energy_log = DB::select(DB::raw('
            select 
            * ,
            DATE_ADD(value_timestamp, INTERVAL 7 HOUR) as value_timestamp_gmt7
            from connector_meter_value 
            where 
                transaction_pk = '.$transaction_pk.' 
            order by 
                value_timestamp ASC
            '));

        $energy_start = DB::select(DB::raw('
            select *, DATE_ADD(start_timestamp, INTERVAL 7 HOUR) as start_timestamp_gmt7 from transaction_start where transaction_pk = '.$transaction_pk.' 
            '));
        foreach( $energy_start as $this_energy_start ){
            $this_value_energy_start = $this_energy_start->start_value;
            $timestart = $this_energy_start->start_timestamp_gmt7;
            $current_connector_pk = $this_energy_start->connector_pk;
        }


        /*
        *
        *   CALCULATE ENERGY CONSUMPTION
        *
        */
        foreach( $energy_log as $this_energy_log ){
            $latest_energy_log = $this_energy_log->value;
            $timelatest = $this_energy_log->value_timestamp_gmt7;
        }
        $total_consumption = $latest_energy_log - $this_value_energy_start;


        /*
        *
        *   CALCULATE DURATION
        *
        */
        $datetime1 = strtotime($timestart);
        $datetime2 = strtotime($timelatest);
        $interval  = abs($datetime2 - $datetime1);
        $minutes   = round($interval / 60);
        $duration = $minutes;

        $format = '%02d:%02d';
        $hours = floor($duration / 60);
        $minutes = ($duration % 60);
        $durationx = sprintf($format, $hours, $minutes);


        /*
        *
        *   GET PRICE
        *
        */
        $price = DB::select(DB::raw('
            select
                t3.NAME as NAME,
                t3.GENERAL_PRICE as GENERAL_PRICE
            from transaction_start t1
                left join connector t2 on t2.connector_pk = t1.connector_pk
                left join mdb_cs t3 on t3.CHARGE_BOX_ID collate utf8_general_ci = t2.charge_box_id collate utf8_general_ci
            where t1.transaction_pk = '.$transaction_pk.'
            '));
        foreach( $price as $this_price ){
            $this_evcs_name = $this_price->NAME;
            $this_price = $this_price->GENERAL_PRICE;
        }
        $charging_cost = $total_consumption / 1000 * $this_price;

        




        $transaction_stop = DB::select(DB::raw(
            "select count(transaction_pk) as total_row from transaction_stop where transaction_pk = ".$transaction_pk
        ));
        foreach( $transaction_stop as $this_transaction_stop ){
            $this_transaction_stop = $this_transaction_stop;
        }
        if( $this_transaction_stop->total_row == 0 ){
            return view('monitoring.energy_graph_live', compact('transaction_pk', 'this_evcs_name', 'energy_log', 'this_value_energy_start', 'total_consumption', 'durationx', 'charging_cost'));
        } else {
            return redirect('/monitoring/energy_streamer');
        }

    }

}
