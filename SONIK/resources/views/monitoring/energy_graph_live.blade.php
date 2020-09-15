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
						<div class="m-content" style="padding:0;">

							
							<!--Begin::Trends -->
							<div class="col-xl-12">

								<?php
			                	foreach( $energy_log as $this_energy_log ){
			                		$array_label_timestamp[] = '"'.$this_energy_log->value_timestamp.'"';
			                		$array_power_meter[] = (int)$this_energy_log->value - $this_value_energy_start;
			                	}
			                	$implode_label_timestamp = implode(",", $array_label_timestamp);
			                	$implode_power_meter = implode(",", $array_power_meter);
			                	?>

								
								<!--begin:: Widgets/Top Products-->
								<div class="m-portlet m-portlet--bordered-semi m-portlet--full-height ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													{{ $this_evcs_name }} (# {{ $transaction_pk }})
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
			
			//== Class definition
			var Dashboard = function() {

			    //== Sparkline Chart helper function
			    var _initSparklineChart = function(src, data, color, border) {
			        if (src.length == 0) {
			            return;
			        }

			        var config = {
			            type: 'line',
			            data: {
			                labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October"],
			                datasets: [{
			                    label: "",
			                    borderColor: color,
			                    borderWidth: border,

			                    pointHoverRadius: 4,
			                    pointHoverBorderWidth: 12,
			                    pointBackgroundColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
			                    pointBorderColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
			                    pointHoverBackgroundColor: mApp.getColor('danger'),
			                    pointHoverBorderColor: Chart.helpers.color('#000000').alpha(0.1).rgbString(),
			                    fill: false,
			                    data: data,
			                }]
			            },
			            options: {
			                title: {
			                    display: false,
			                },
			                tooltips: {
			                    enabled: false,
			                    intersect: false,
			                    mode: 'nearest',
			                    xPadding: 10,
			                    yPadding: 10,
			                    caretPadding: 10
			                },
			                legend: {
			                    display: false,
			                    labels: {
			                        usePointStyle: false
			                    }
			                },
			                responsive: true,
			                maintainAspectRatio: true,
			                hover: {
			                    mode: 'index'
			                },
			                scales: {
			                    xAxes: [{
			                        display: false,
			                        gridLines: false,
			                        scaleLabel: {
			                            display: true,
			                            labelString: 'Month'
			                        }
			                    }],
			                    yAxes: [{
			                        display: false,
			                        gridLines: false,
			                        scaleLabel: {
			                            display: true,
			                            labelString: 'Value'
			                        },
			                        ticks: {
			                            beginAtZero: true
			                        }
			                    }]
			                },

			                elements: {
			                    point: {
			                        radius: 4,
			                        borderWidth: 12
			                    },
			                },

			                layout: {
			                    padding: {
			                        left: 0,
			                        right: 10,
			                        top: 5,
			                        bottom: 0
			                    }
			                }
			            }
			        };

			        return new Chart(src, config);
			    }

			    

			    //== Trends Stats.
			    //** Based on Chartjs plugin - http://www.chartjs.org/
			    var trendsStats = function() {
			        if ($('#m_chart_trends_stats').length == 0) {
			            return;
			        }

			        var ctx = document.getElementById("m_chart_trends_stats").getContext("2d");

			        var gradient = ctx.createLinearGradient(0, 0, 0, 240);
			        gradient.addColorStop(0, Chart.helpers.color('#00c5dc').alpha(0.7).rgbString());
			        gradient.addColorStop(1, Chart.helpers.color('#f2feff').alpha(0).rgbString());

			        var config = {
			            type: 'line',
			            data: {
			                labels: [
			                <?php echo $implode_label_timestamp; ?>
			                ],
			                datasets: [{
			                    label: "Power Meter",
			                    backgroundColor: gradient, // Put the gradient here as a fill color
			                    borderColor: '#0dc8de',

			                    pointBackgroundColor: Chart.helpers.color('#ffffff').alpha(0).rgbString(),
			                    pointBorderColor: Chart.helpers.color('#ffffff').alpha(0).rgbString(),
			                    pointHoverBackgroundColor: mApp.getColor('danger'),
			                    pointHoverBorderColor: Chart.helpers.color('#000000').alpha(0.2).rgbString(),

			                    //fill: 'start',
			                    data: [
			                        <?php echo $implode_power_meter;?>
			                    ]
			                }]
			            },
			            options: {
			                title: {
			                    display: false,
			                },
			                tooltips: {
			                    intersect: false,
			                    mode: 'nearest',
			                    xPadding: 10,
			                    yPadding: 10,
			                    caretPadding: 10
			                },
			                legend: {
			                    display: false
			                },
			                responsive: true,
			                maintainAspectRatio: false,
			                hover: {
			                    mode: 'index'
			                },
			                scales: {
			                    xAxes: [{
			                        display: false,
			                        gridLines: false,
			                        scaleLabel: {
			                            display: true,
			                            labelString: 'Month'
			                        }
			                    }],
			                    yAxes: [{
			                        display: false,
			                        gridLines: false,
			                        scaleLabel: {
			                            display: true,
			                            labelString: 'Value'
			                        },
			                        ticks: {
			                            beginAtZero: true
			                        }
			                    }]
			                },
			                elements: {
			                    line: {
			                        tension: 0.19
			                    },
			                    point: {
			                        radius: 4,
			                        borderWidth: 12
			                    }
			                },
			                layout: {
			                    padding: {
			                        left: 0,
			                        right: 0,
			                        top: 5,
			                        bottom: 0
			                    }
			                },
			                animation: false
			            }
			        };

			        var chart = new Chart(ctx, config);
			    }

			    return {
			        //== Init demos
			        init: function() {
			            
			            trendsStats();
			        }
			    };
			}();

			//== Class initialization on page load
			jQuery(document).ready(function() {
			    Dashboard.init();
			});

			const interval = setInterval(function() {
			   jQuery(document).ready(function() {
				    Dashboard.init();
				});
			 }, 5000);
			
		</script>

		

		
	</body>

	<!-- end::Body -->
</html>