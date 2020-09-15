<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class Reporting extends Controller
{
    public function Forward_EVCSYearly(){
    	return redirect('/report/evcs_yearly/'.date('Y'));
    }

    public function EVCSYearly( $year ){

    	for( $i=1;$i<=12;$i++ ){
	    	$yearly_activity = DB::select(DB::raw('
		    	select
		    		count( t1.transaction_pk ) as TOTAL_USAGE,
					sum( (( t2.stop_value - t1.start_value) / 1000) ) as ENERGY_CONSUMPTION,
					sum( ( (( t2.stop_value - t1.start_value) / 1000) * t5.GENERAL_PRICE ) ) as ENERGY_COST
		    	from transaction_start t1
	    			left join ( select distinct(transaction_pk) as transaction_pk, stop_value, stop_timestamp, stop_reason from transaction_stop ) as t2 on t1.transaction_pk = t2.transaction_pk
		    		left join connector t3 on t3.connector_pk = t1.connector_pk
		    		left join charge_box t4 on t4.charge_box_id = t3.charge_box_id
		    		left join mdb_cs t5 on t5.CHARGE_BOX_PK = t4.charge_box_pk
		    	where 
		    		(( t2.stop_value - t1.start_value) / 1000) > 0
	    			and t2.stop_reason is not null
		    		and YEAR(DATE_ADD(t1.start_timestamp, INTERVAL 7 HOUR)) = '.$year.'
		    		and MONTH(DATE_ADD(t1.start_timestamp, INTERVAL 7 HOUR)) = '.$i.'
		    	'));

	    	foreach( $yearly_activity as $this_yearly_activity ){
	    		$array_bulan[] = $i;
	    		$array_bulan_with_quotes[] = '"'.$i.'"';
	    		$array_month_name[] = date("F", mktime(0, 0, 0, $i, 10));
	    		$array_month_name_with_quotes[] = '"'.date("F", mktime(0, 0, 0, $i, 10)).'"';

	    		if( $this_yearly_activity->TOTAL_USAGE > 0 ){
	    			$array_total_usage[] = $this_yearly_activity->TOTAL_USAGE;
	    		} else {
	    			$array_total_usage[] = 0;
	    		}

	    		if( $this_yearly_activity->ENERGY_CONSUMPTION > 0 ){
	    			$array_energy_consumption[] = $this_yearly_activity->ENERGY_CONSUMPTION;
	    		} else {
	    			$array_energy_consumption[] = 0;
	    		}

	    		if( $this_yearly_activity->ENERGY_COST > 0 ){
	    			$array_energy_cost[] = $this_yearly_activity->ENERGY_COST;
	    		} else {
	    			$array_energy_cost[] = 0;
	    		}

	    	}

    	}


    	$yearly_id_tag = DB::select(DB::raw('
	    	select
	    		t1.id_tag as ID_TAG,
	    		count( t1.transaction_pk ) as TOTAL_ID_TAG,
				sum( (( t2.stop_value - t1.start_value) / 1000) ) as ENERGY_CONSUMPTION,
				sum( ( (( t2.stop_value - t1.start_value) / 1000) * t5.GENERAL_PRICE ) ) as ENERGY_COST
	    	from transaction_start t1
    			left join ( select distinct(transaction_pk) as transaction_pk, stop_value, stop_timestamp, stop_reason from transaction_stop ) as t2 on t1.transaction_pk = t2.transaction_pk
	    		left join connector t3 on t3.connector_pk = t1.connector_pk
	    		left join charge_box t4 on t4.charge_box_id = t3.charge_box_id
	    		left join mdb_cs t5 on t5.CHARGE_BOX_PK = t4.charge_box_pk
	    	where 
	    		(( t2.stop_value - t1.start_value) / 1000) > 0
    			and t2.stop_reason is not null
	    		and YEAR(DATE_ADD(t1.start_timestamp, INTERVAL 7 HOUR)) = '.$year.'
	    	group by
	    		t1.id_tag
	    	'));




    	$yearly_evcs = DB::select(DB::raw('
	    	select
	    		t5.NAME as NAME,
	    		count( t1.transaction_pk ) as TOTAL_USAGE,
				sum( (( t2.stop_value - t1.start_value) / 1000) ) as ENERGY_CONSUMPTION,
				sum( ( (( t2.stop_value - t1.start_value) / 1000) * t5.GENERAL_PRICE ) ) as ENERGY_COST
	    	from transaction_start t1
    			left join ( select distinct(transaction_pk) as transaction_pk, stop_value, stop_timestamp, stop_reason from transaction_stop ) as t2 on t1.transaction_pk = t2.transaction_pk
	    		left join connector t3 on t3.connector_pk = t1.connector_pk
	    		left join charge_box t4 on t4.charge_box_id = t3.charge_box_id
	    		left join mdb_cs t5 on t5.CHARGE_BOX_PK = t4.charge_box_pk
	    	where 
	    		(( t2.stop_value - t1.start_value) / 1000) > 0
    			and t2.stop_reason is not null
	    		and YEAR(DATE_ADD(t1.start_timestamp, INTERVAL 7 HOUR)) = '.$year.'
	    	group by
	    		t5.NAME
	    	'));



    	return view('report.report_evcs_yearly', compact('year', 'array_bulan', 'array_bulan_with_quotes', 'array_month_name', 'array_month_name_with_quotes', 'array_total_usage', 'array_energy_consumption', 'array_energy_cost', 'yearly_id_tag', 'yearly_evcs'));

    }

    public function EVCSYearly_Export_MonthlyData( $year ){

    	header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="Report_MonthlyData_'.$year.'.csv"');

		$list[] = array('YEAR', 'MONTH' , 'TOTAL USAGE'  , 'TOTAL ENERGY CONSUMPTION (KWH)' , 'TOTAL COST OF ENERGY (IDR)');

    	for( $i=1;$i<=12;$i++ ){
	    	$yearly_activity = DB::select(DB::raw('
		    	select
		    		count( t1.transaction_pk ) as TOTAL_USAGE,
					sum( (( t2.stop_value - t1.start_value) / 1000) ) as ENERGY_CONSUMPTION,
					sum( ( (( t2.stop_value - t1.start_value) / 1000) * t5.GENERAL_PRICE ) ) as ENERGY_COST
		    	from transaction_start t1
	    			left join ( select distinct(transaction_pk) as transaction_pk, stop_value, stop_timestamp, stop_reason from transaction_stop ) as t2 on t1.transaction_pk = t2.transaction_pk
		    		left join connector t3 on t3.connector_pk = t1.connector_pk
		    		left join charge_box t4 on t4.charge_box_id = t3.charge_box_id
		    		left join mdb_cs t5 on t5.CHARGE_BOX_PK = t4.charge_box_pk
		    	where 
		    		(( t2.stop_value - t1.start_value) / 1000) > 0
	    			and t2.stop_reason is not null
		    		and YEAR(DATE_ADD(t1.start_timestamp, INTERVAL 7 HOUR)) = '.$year.'
		    		and MONTH(DATE_ADD(t1.start_timestamp, INTERVAL 7 HOUR)) = '.$i.'
		    	'));

	    	foreach( $yearly_activity as $this_yearly_activity ){
	    		$array_bulan[] = $i;
	    		$array_bulan_with_quotes[] = '"'.$i.'"';
	    		$array_month_name[] = date("F", mktime(0, 0, 0, $i, 10));
	    		$array_month_name_with_quotes[] = '"'.date("F", mktime(0, 0, 0, $i, 10)).'"';

	    		if( $this_yearly_activity->TOTAL_USAGE > 0 ){
	    			$array_total_usage = $this_yearly_activity->TOTAL_USAGE;
	    		} else {
	    			$array_total_usage = 0;
	    		}

	    		if( $this_yearly_activity->ENERGY_CONSUMPTION > 0 ){
	    			$array_energy_consumption = $this_yearly_activity->ENERGY_CONSUMPTION;
	    		} else {
	    			$array_energy_consumption = 0;
	    		}

	    		if( $this_yearly_activity->ENERGY_COST > 0 ){
	    			$array_energy_cost = $this_yearly_activity->ENERGY_COST;
	    		} else {
	    			$array_energy_cost = 0;
	    		}

	    		$list[] = array($year, date("F", mktime(0, 0, 0, $i, 10)) , $array_total_usage  , $array_energy_consumption , $array_energy_cost);

	    	}

    	}



    	$fp = fopen('php://output', 'wb');
		foreach ($list as $fields) {
		    fputcsv($fp, $fields, ";");
		}
		fclose($fp);

    }

    public function EVCSYearly_Export_MonthlyData_PerEVCS( $year ){

    	header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="Report_MonthlyData_PerEVCS'.$year.'.csv"');

		$list[] = array('YEAR', 'EVCS' , 'TOTAL USAGE'  , 'TOTAL ENERGY CONSUMPTION (KWH)' , 'TOTAL COST OF ENERGY (IDR)');

    	$yearly_evcs = DB::select(DB::raw('
	    	select
	    		t5.NAME as NAME,
	    		count( t1.transaction_pk ) as TOTAL_USAGE,
				sum( (( t2.stop_value - t1.start_value) / 1000) ) as ENERGY_CONSUMPTION,
				sum( ( (( t2.stop_value - t1.start_value) / 1000) * t5.GENERAL_PRICE ) ) as ENERGY_COST
	    	from transaction_start t1
    			left join ( select distinct(transaction_pk) as transaction_pk, stop_value, stop_timestamp, stop_reason from transaction_stop ) as t2 on t1.transaction_pk = t2.transaction_pk
	    		left join connector t3 on t3.connector_pk = t1.connector_pk
	    		left join charge_box t4 on t4.charge_box_id = t3.charge_box_id
	    		left join mdb_cs t5 on t5.CHARGE_BOX_PK = t4.charge_box_pk
	    	where 
	    		(( t2.stop_value - t1.start_value) / 1000) > 0
    			and t2.stop_reason is not null
	    		and YEAR(DATE_ADD(t1.start_timestamp, INTERVAL 7 HOUR)) = '.$year.'
	    	group by
	    		t5.NAME
	    	'));

    	foreach( $yearly_evcs as $this_yearly_evcs ){

    		$list[] = array($year, $this_yearly_evcs->NAME, $this_yearly_evcs->TOTAL_USAGE, $this_yearly_evcs->ENERGY_CONSUMPTION, $this_yearly_evcs->ENERGY_COST);

    	}


    	$fp = fopen('php://output', 'wb');
		foreach ($list as $fields) {
		    fputcsv($fp, $fields, ";");
		}
		fclose($fp);

    }

    public function EVCSYearly_Export_MonthlyData_PerTag( $year ){

    	header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="Report_MonthlyData_PerIDTag'.$year.'.csv"');

		$list[] = array('YEAR', 'ID TAG' , 'TOTAL USAGE'  , 'TOTAL ENERGY CONSUMPTION (KWH)' , 'TOTAL COST OF ENERGY (IDR)');

    	$yearly_id_tag = DB::select(DB::raw('
	    	select
	    		t1.id_tag as ID_TAG,
	    		count( t1.transaction_pk ) as TOTAL_ID_TAG,
				sum( (( t2.stop_value - t1.start_value) / 1000) ) as ENERGY_CONSUMPTION,
				sum( ( (( t2.stop_value - t1.start_value) / 1000) * t5.GENERAL_PRICE ) ) as ENERGY_COST
	    	from transaction_start t1
    			left join ( select distinct(transaction_pk) as transaction_pk, stop_value, stop_timestamp, stop_reason from transaction_stop ) as t2 on t1.transaction_pk = t2.transaction_pk
	    		left join connector t3 on t3.connector_pk = t1.connector_pk
	    		left join charge_box t4 on t4.charge_box_id = t3.charge_box_id
	    		left join mdb_cs t5 on t5.CHARGE_BOX_PK = t4.charge_box_pk
	    	where 
	    		(( t2.stop_value - t1.start_value) / 1000) > 0
    			and t2.stop_reason is not null
	    		and YEAR(DATE_ADD(t1.start_timestamp, INTERVAL 7 HOUR)) = '.$year.'
	    	group by
	    		t1.id_tag
	    	'));

    	foreach( $yearly_id_tag as $this_yearly_id_tag ){

    		$list[] = array($year, $this_yearly_id_tag->ID_TAG, $this_yearly_id_tag->TOTAL_ID_TAG, $this_yearly_id_tag->ENERGY_CONSUMPTION, $this_yearly_id_tag->ENERGY_COST);

    	}


    	$fp = fopen('php://output', 'wb');
		foreach ($list as $fields) {
		    fputcsv($fp, $fields, ";");
		}
		fclose($fp);


    }

























    public function Forward_EVCSMonthly(){
		return redirect('/report/evcs_monthly/'.date('Y').'/'.date('m'));    	
    }

    public function EVCSMonthly( $year, $month ){

    	$d=cal_days_in_month(CAL_GREGORIAN,$month,$year);

    	for( $i=1;$i<=$d;$i++ ){

    		$time = strtotime($year.'-'.$month.'-'.$i);
			$looped_date = date('Y-m-d',$time);

	    	$monthly_activity = DB::select(DB::raw('
		    	select
		    		count( t1.transaction_pk ) as TOTAL_USAGE,
					sum( (( t2.stop_value - t1.start_value) / 1000) ) as ENERGY_CONSUMPTION,
					sum( ( (( t2.stop_value - t1.start_value) / 1000) * t5.GENERAL_PRICE ) ) as ENERGY_COST
		    	from transaction_start t1
	    			left join ( select distinct(transaction_pk) as transaction_pk, stop_value, stop_timestamp, stop_reason from transaction_stop ) as t2 on t1.transaction_pk = t2.transaction_pk
		    		left join connector t3 on t3.connector_pk = t1.connector_pk
		    		left join charge_box t4 on t4.charge_box_id = t3.charge_box_id
		    		left join mdb_cs t5 on t5.CHARGE_BOX_PK = t4.charge_box_pk
		    	where 
		    		(( t2.stop_value - t1.start_value) / 1000) > 0
	    			and t2.stop_reason is not null
		    		and DATE(DATE_ADD(t1.start_timestamp, INTERVAL 7 HOUR)) = "'.$looped_date.'"
		    	'));

	    	foreach( $monthly_activity as $this_monthly_activity ){
	    		$array_bulan[] = $looped_date;
	    		$array_bulan_with_quotes[] = '"'.$looped_date.'"';

	    		if( $this_monthly_activity->TOTAL_USAGE > 0 ){
	    			$array_total_usage[] = $this_monthly_activity->TOTAL_USAGE;
	    		} else {
	    			$array_total_usage[] = 0;
	    		}

	    		if( $this_monthly_activity->ENERGY_CONSUMPTION > 0 ){
	    			$array_energy_consumption[] = $this_monthly_activity->ENERGY_CONSUMPTION;
	    		} else {
	    			$array_energy_consumption[] = 0;
	    		}

	    		if( $this_monthly_activity->ENERGY_COST > 0 ){
	    			$array_energy_cost[] = $this_monthly_activity->ENERGY_COST;
	    		} else {
	    			$array_energy_cost[] = 0;
	    		}

	    	}

    	}


    	$monthly_id_tag = DB::select(DB::raw('
	    	select
	    		count( t1.transaction_pk ) as TOTAL_ID_TAG,
	    		t1.id_tag as ID_TAG
	    	from transaction_start t1
    			left join ( select distinct(transaction_pk) as transaction_pk, stop_value, stop_timestamp, stop_reason from transaction_stop ) as t2 on t1.transaction_pk = t2.transaction_pk
	    		left join connector t3 on t3.connector_pk = t1.connector_pk
	    		left join charge_box t4 on t4.charge_box_id = t3.charge_box_id
	    		left join mdb_cs t5 on t5.CHARGE_BOX_PK = t4.charge_box_pk
	    	where 
	    		(( t2.stop_value - t1.start_value) / 1000) > 0
    			and t2.stop_reason is not null
	    		and YEAR(DATE_ADD(t1.start_timestamp, INTERVAL 7 HOUR)) = '.$year.'
	    		and MONTH(DATE_ADD(t1.start_timestamp, INTERVAL 7 HOUR)) = '.$month.'
	    	group by
	    		t1.id_tag
	    	'));




    	$monthly_evcs = DB::select(DB::raw('
	    	select
	    		t5.NAME as NAME,
	    		count( t1.transaction_pk ) as TOTAL_USAGE,
				sum( (( t2.stop_value - t1.start_value) / 1000) ) as ENERGY_CONSUMPTION,
				sum( ( (( t2.stop_value - t1.start_value) / 1000) * t5.GENERAL_PRICE ) ) as ENERGY_COST
	    	from transaction_start t1
    			left join ( select distinct(transaction_pk) as transaction_pk, stop_value, stop_timestamp, stop_reason from transaction_stop ) as t2 on t1.transaction_pk = t2.transaction_pk
	    		left join connector t3 on t3.connector_pk = t1.connector_pk
	    		left join charge_box t4 on t4.charge_box_id = t3.charge_box_id
	    		left join mdb_cs t5 on t5.CHARGE_BOX_PK = t4.charge_box_pk
	    	where 
	    		(( t2.stop_value - t1.start_value) / 1000) > 0
    			and t2.stop_reason is not null
	    		and YEAR(DATE_ADD(t1.start_timestamp, INTERVAL 7 HOUR)) = '.$year.'
	    		and MONTH(DATE_ADD(t1.start_timestamp, INTERVAL 7 HOUR)) = '.$month.'
	    	group by
	    		t5.NAME
	    	'));



    	return view('report.report_evcs_monthly', compact('year', 'array_bulan', 'array_bulan_with_quotes', 'array_total_usage', 'array_energy_consumption', 'array_energy_cost', 'monthly_id_tag', 'monthly_evcs'));

    }


}
