<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class DashboardController extends Controller
{
    public function ViewDashboard(){

	    /*
	    $get_sum_energy_consumption = DB::select(DB::raw('
	    	select
	    		t1.transaction_pk as TRANSACTION_PK,
				t1.start_value as START_VALUE,
				t2.stop_value as STOP_VALUE,
				(( t2.stop_value - t1.start_value) / 1000) as ENERGY_CONSUMPTION,
				( (( t2.stop_value - t1.start_value) / 1000) * t5.GENERAL_PRICE ) as ENERGY_COST
	    	from transaction_start t1
	    		left join ( select distinct(transaction_pk) as transaction_pk, stop_value, stop_timestamp, stop_reason from transaction_stop ) as t2 on t1.transaction_pk = t2.transaction_pk
	    		left join connector t3 on t3.connector_pk = t1.connector_pk
	    		left join charge_box t4 on t4.charge_box_id = t3.charge_box_id
	    		left join mdb_cs t5 on t5.CHARGE_BOX_PK = t4.charge_box_pk
	    	where
	    		(( (select stop_value from transaction_stop where transaction_pk = TRANSACTION_PK order by event_timestamp DESC limit 0,1) - t1.start_value) / 1000) > 0
	    		and t2.stop_reason is not null
	    	'));
	    */
	    $get_sum_energy_consumption = DB::select(DB::raw('
	    	select
	    		t1.transaction_pk as TRANSACTION_PK,
				t1.start_value as START_VALUE,
				t2.stop_value as STOP_VALUE,
				(( t2.stop_value - t1.start_value) / 1000) as ENERGY_CONSUMPTION,
				( (( t2.stop_value - t1.start_value) / 1000) * t5.GENERAL_PRICE ) as ENERGY_COST
	    	from transaction_start t1
	    		left join ( select distinct(transaction_pk) as transaction_pk, stop_value, stop_timestamp, stop_reason from transaction_stop ) as t2 on t1.transaction_pk = t2.transaction_pk
	    		left join connector t3 on t3.connector_pk = t1.connector_pk
	    		left join charge_box t4 on t4.charge_box_id = t3.charge_box_id
	    		left join mdb_cs t5 on t5.CHARGE_BOX_PK = t4.charge_box_pk
	    	where
	    		t2.stop_reason is not null
	    	'));




	    $sum_energy_consumption = 0;
	    $sum_energy_cost = 0;
	    foreach( $get_sum_energy_consumption as $this_get_sum_energy_consumption ){
	    	$sum_energy_consumption += $this_get_sum_energy_consumption->ENERGY_CONSUMPTION;
	    	$sum_energy_cost += $this_get_sum_energy_consumption->ENERGY_COST;
	    }
	    $featured_cs = DB::table('mdb_cs')->where('IS_FEATURED', 1)->get();
	    $sum_of_alert_device = DB::table('mdb_cs')->where('OVERALL_STATUS', 0)->count('ID');
	    $sum_of_using_device = DB::table('transaction_start')->count();

	    $featured_cs_statistic = DB::select(DB::raw('
	    	select
	    		t1.ID as ID_CS,
	    		t1.NAME as NAME,
	    		t1.OVERALL_STATUS as OVERALL_STATUS,
	    		t1.STATUS_SOCKET as STATUS_SOCKET,
	    		t1.STATUS_LEACKAGE as STATUS_LEACKAGE,
	    		t1.STATUS_MCB as STATUS_MCB,
	    		t1.STATUS_GROUNDING as STATUS_GROUNDING,
	    		t1.STATUS_TEMPERED_DOOR_PROTECTION,
	    		count(t3.transaction_pk) as TOTAL_USAGE,
	    		sum(t4.stop_value - t3.start_value) as ENERGY_CONSUMPTION
	    	from mdb_cs t1
	    		left join connector t2 on t2.charge_box_id collate utf8_general_ci = t1.CHARGE_BOX_ID collate utf8_general_ci
	    		left join transaction_start t3 on t3.connector_pk = t2.connector_pk
	    		left join transaction_stop t4 on t4.transaction_pk = t3.transaction_pk
	    	where
	    		t1.IS_FEATURED = 1
    		group by
    			t1.ID
	    	'));

	    $latest_usage = DB::select(DB::raw('
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
				TIMEDIFF( t2.stop_timestamp , t1.start_timestamp) as DURATION
	    	from transaction_start t1
	    		left join ( select distinct(transaction_pk) as transaction_pk, stop_value, stop_timestamp, stop_reason from transaction_stop ) as t2 on t1.transaction_pk = t2.transaction_pk
	    		left join connector t3 on t3.connector_pk = t1.connector_pk
	    		left join charge_box t4 on t4.charge_box_id = t3.charge_box_id
	    		left join mdb_cs t5 on t5.CHARGE_BOX_PK = t4.charge_box_pk
	    	where
	    		(( t2.stop_value - t1.start_value) / 1000) > 0
	    		and t2.stop_reason is not null
	    	order by
	    		t1.start_timestamp DESC
	    	'));

	    $total_revenue_this_month = DB::select(DB::raw('
	    	select
	    		t5.NAME as NAME,
				sum(( t2.stop_value - t1.start_value) / 1000) as ENERGY_CONSUMPTION,
				sum( (( t2.stop_value - t1.start_value) / 1000) * t5.GENERAL_PRICE ) as ENERGY_COST
	    	from transaction_start t1
	    		left join ( select distinct(transaction_pk) as transaction_pk, stop_value, stop_timestamp, stop_reason from transaction_stop ) as t2 on t1.transaction_pk = t2.transaction_pk
	    		left join connector t3 on t3.connector_pk = t1.connector_pk
	    		left join charge_box t4 on t4.charge_box_id = t3.charge_box_id
	    		left join mdb_cs t5 on t5.CHARGE_BOX_PK = t4.charge_box_pk
	    	where
	    		(( t2.stop_value - t1.start_value) / 1000) > 0
	    		and t2.stop_reason is not null
	    	group by
	    		t5.NAME
	    	'));

	    return view('dashboard.view', compact('sum_energy_consumption', 'sum_energy_cost', 'featured_cs', 'sum_of_alert_device', 'sum_of_using_device', 'featured_cs_statistic', 'latest_usage', 'total_revenue_this_month'));

    }

    public function DownloadLatestUsageCSV(){

    	header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="LatestUsage.csv"');

		$latest_usage = DB::select(DB::raw('
	    	select
	    		t5.NAME as NAME,
	    		t1.id_tag as ID_TAG,
	    		t1.transaction_pk as TRANSACTION_PK,
				t1.start_value as START_VALUE,
				t1.start_timestamp as START_TIMESTAMP,
				DATE_ADD(t1.start_timestamp, INTERVAL 7 HOUR) as START_TIMESTAMP_GMT7,
				t2.stop_value as STOP_VALUE,
				((t2.stop_value - t1.start_value) / 1000) as ENERGY_CONSUMPTION,
				( ((t2.stop_value - t1.start_value) / 1000) * t5.GENERAL_PRICE ) as ENERGY_COST,
				t1.id_tag as ID_TAG,
				TIMEDIFF(t2.stop_timestamp, t1.start_timestamp) as DURATION
	    	from transaction_start t1
	    		left join ( select distinct(transaction_pk) as transaction_pk, stop_value, stop_timestamp, stop_reason from transaction_stop ) as t2 on t1.transaction_pk = t2.transaction_pk
	    		left join connector t3 on t3.connector_pk = t1.connector_pk
	    		left join charge_box t4 on t4.charge_box_id = t3.charge_box_id
	    		left join mdb_cs t5 on t5.CHARGE_BOX_PK = t4.charge_box_pk
	    	where
	    		(( t2.stop_value - t1.start_value) / 1000) > 0
	    		and t2.stop_reason is not null
	    	'));

		$list[] = array('EVCS', 'START TIMESTAMP' , 'START VALUE (in Wh)'  , 'STOP VALUE (in Wh)' , 'ENERGY CONSUMPTION (in Wh)' , 'ENERGY COST (in IDR)');

		foreach( $latest_usage as $this_latest_usage ){

			$name = $this_latest_usage->NAME;
			$id_tag = $this_latest_usage->ID_TAG;
			$start_value = $this_latest_usage->START_VALUE;
			$start_timestamp = $this_latest_usage->START_TIMESTAMP_GMT7;
			$stop_value = $this_latest_usage->STOP_VALUE;
			$energy_consumption = $this_latest_usage->ENERGY_CONSUMPTION;
			$energy_cost = $this_latest_usage->ENERGY_COST;

			$list[] = array($name, $start_timestamp, $start_value, $stop_value, $energy_consumption, $energy_cost);
		}

		$fp = fopen('php://output', 'wb');
		foreach ($list as $fields) {
		    fputcsv($fp, $fields, ";");
		}
		fclose($fp);

    }
}
