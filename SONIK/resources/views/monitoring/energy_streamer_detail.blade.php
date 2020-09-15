<!DOCTYPE html>
<html lang="en">

	@include('include.include_head')

	<style>
		.m-widget1 .m-widget1__item .m-widget1__title{
			font-size:1.1rem!important;
		}
		.m-widget1 .m-widget1__item .m-widget1__number{
			font-size:1.3rem!important;
		}
		.m-widget1{
			padding:1rem;
		}
	</style>

	<!-- begin::Body -->
	<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-light m-aside-left--fixed m-aside-left--offcanvas m-aside-left--minimize m-brand--minimize m-footer--push m-aside--offcanvas-default">

		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">

			<!-- begin::Body -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body" style="padding-left:0;padding-top:0!important;">

				<div class="m-grid__item m-grid__item--fluid m-wrapper">
				
					
					<form action="../update_existing_cs" method="post">
				
						{{ csrf_field() }}

						<!-- END: Subheader -->
						<div class="m-content">

							<div class="col-xl-6" style="float:left;">
								<div class="m-portlet m-portlet--bordered-semi m-portlet--full-height ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													Ongoing Transaction
												</h3>
											</div>
										</div>
									</div>
									<div class="m-portlet__body">
										<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_2">
											<thead>
												<tr>
													<th>Transaction PK</th>
													<th>EVCS</th>
													<th>Connector</th>
													<th>Start</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody id="stream_table_row">
											</tbody>
										</table>
									</div>
								</div>
							</div>
							
							
							<!--Begin::Trends -->
							<div class="col-xl-6" style="float:left;">

								<div id="result"></div>

								<?php
			                	foreach( $energy_log as $this_energy_log ){
			                		$array_label_timestamp[] = '"'.$this_energy_log->value_timestamp.'"';
			                		$array_power_meter[] = (int)$this_energy_log->value - $this_value_energy_start;
			                	}
			                	$implode_label_timestamp = implode(",", $array_label_timestamp);
			                	$implode_power_meter = implode(",", $array_power_meter);
			                	?>

								<!--begin:: Widgets/Top Products-->
								<div class="m-portlet m-portlet--bordered-semi m-portlet--full-height " style="display:none;">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													EVCS BPPT Thamrin
												</h3>
											</div>
										</div>
									</div>
									<div class="m-portlet__body">

										<!--begin::Widget5-->
										<div class="m-widget4">
											<div class="m-widget4__chart m-portlet-fit--sides m--margin-top-10 m--margin-top-20" style="height:260px;">
												<canvas id="m_chart_trends_stats"></canvas>
											</div>
											<div class="m-widget4__item">
												<div class="m-widget4__info">
													<span class="m-widget4__title">
														Energy Consumption
													</span><br>
													<span class="m-widget4__sub">
														in Wh
													</span>
												</div>
												<span class="m-widget4__ext">
													<span class="m-widget4__number m--font-danger">{{ number_format($total_consumption) }}</span>
												</span>
											</div>
											<div class="m-widget4__item">
												<div class="m-widget4__info">
													<span class="m-widget4__title">
														Duration (in Minutes)
													</span><br>
													<span class="m-widget4__sub">
														Time duration
													</span>
												</div>
												<span class="m-widget4__ext">
													<span class="m-widget4__number m--font-danger">{{ $durationx }}</span>
												</span>
											</div>
											<div class="m-widget4__item">
												<div class="m-widget4__info">
													<span class="m-widget4__title">
														Charging Cost
													</span><br>
													<span class="m-widget4__sub">
														in IDR
													</span>
												</div>
												<span class="m-widget4__ext">
													<span class="m-widget4__number m--font-danger">{{ number_format($charging_cost) }}</span>
												</span>
											</div>
										</div>

										<!--end::Widget 5-->
									</div>
								</div>

								<!--end:: Widgets/Top Products-->
							</div>

							<!--End::Trends CNT-->

							

							
							
						</div>
						
					</form>
					
				</div>
			</div>

			<!-- end:: Body -->

			
		</div>

		<!-- end:: Page -->

		@include('include.include_bottom_script_monitor')

		<script>

			StreamTableRow();
			function StreamTableRow(){

				var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var jsonData = JSON.parse(this.responseText);
                        
                        document.getElementById('stream_table_row').innerHTML = jsonData.ONGOING_TRANSACTION_TABLE_ROW;
                        
                    } 
                    // else {
                    //  alert("Could not connect to server. Please restart the app and try again.");
                    // }
                };
                xhttp.open("POST", "<?php echo url('monitorapi/index.php');?>", true);
                xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhttp.send("module=GetOngoingChargingData&page=detail");


			}

			$('#result').load('<?php echo url('monitoring/energy_graph_live');?>/<?php echo $transaction_pk; ?>');

			function Repeater(){
				StreamTableRow();
				$('#result').load('<?php echo url('monitoring/energy_graph_live');?>/<?php echo $transaction_pk; ?>');
			}

			const interval_table = setInterval(function() {
			   Repeater();
			 }, 10000);


		</script>






		
		

		<script>
			var DatatablesBasicScrollable = function() {
			
				var initTable2 = function() {
					var table = $('#m_table_2');
			
					// begin second table
					table.DataTable({
						scrollY: '50vh',
						scrollX: true,
						scrollCollapse: true,
					});
				};
			
				return {
			
					//main function to initiate the module
					init: function() {
						initTable2();
					},
			
				};
			
			}();
			
			jQuery(document).ready(function() {
				DatatablesBasicScrollable.init();
			});
		</script>

		<script>
			// setTimeout(function(){
			//    window.location.reload(1);
			// }, 30000);
		</script>
		
	</body>

	<!-- end::Body -->
</html>
