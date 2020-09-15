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
							
							





							<!--Begin::Section-->
							<div class="m-portlet" style="padding:10px;text-align:center;margin-bottom:0!important;"><h3>BPPT THAMRIN</h3></div>
							<div class="m-portlet">
								<div class="m-portlet__body m-portlet__body--no-padding">
									<div class="row m-row--no-padding m-row--col-separator-xl">
											
										<?php
										if( count($array_latest_status) > 1 ){
											for( $i=1;$i<count($array_latest_status);$i++ ){

												$this_connector_data = $array_latest_status[$i];
												$this_latest_meter_value = $array_latest_meter_value[$i];

												if( $this_connector_data->status == "Available" ){
													$this_tr_class = "m-table__row--success";
													$this_header_class = "success";
												} else if( $this_connector_data->status == "Unavailable" || $this_connector_data->status == "SuspendedEV" ){
													$this_tr_class = "m-table__row--danger";
													$this_header_class = "danger";
												} else {
													$this_tr_class = "m-table__row--warning";
													$this_header_class = "warning";
												}

												if( $array_this_connector_id[$i] == 1 ){
													$connector_image = "charger1.png";
													$connector_name = 'CCS TYPE 2 - MODE 4';
													$max_power = 50;
												} else if( $array_this_connector_id[$i] == 2 ){
													$connector_image = "charger2.png";
													$connector_name = 'CHADEMO - MODE 4';
													$max_power = 50;
												} else if( $array_this_connector_id[$i] == 3 ){
													$connector_image = "charger3.png";
													$connector_name = 'TYPE 2';
													$max_power = 43;
												}

												?>
										


												<div class="col-md-12 col-lg-12 col-xl-4">
													<div class="text-center m--bg-{{ $this_header_class }}" style="padding-top:15px;padding-bottom:15px;color:#fff;">
														<h4>{{ $connector_name }}</h4>
													</div>
													<div style="background:#333;color:#fff;text-align:center;min-height:40px;padding-top:10px;padding-bottom:10px;">{{ $this_connector_data->error_info }}</div>
													<div class="m-widget1">
														<div class="m-widget1__item" style="display:none;">
															<div class="row m-row--no-padding align-items-center">
																<div class="col">
																	<h3 class="m-widget1__title">Power Meter</h3>
																	<span class="m-widget1__desc">in Wh</span>
																</div>
																<div class="col m--align-right">
																	<span class="m-widget1__number m--font-brand">
																		{{ number_format($this_latest_meter_value) }}
																	</span>
																</div>
															</div>
														</div>
														<div class="m-widget1__item">
															<div class="row m-row--no-padding align-items-center">
																<div class="col">
																	<h3 class="m-widget1__title">Status</h3>
																</div>
																<div class="col m--align-right">
																	<span class="m-widget1__number m--font-primary">
																		{{ $this_connector_data->status }}
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
																		{{ number_format($array_current_energy_consumption[$i]) }}
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
																		{{ $this_connector_data->STATUS_TIMESTAMP_GMT7 }}
																	</span>
																</div>
															</div>
														</div>
													</div>
													<div>
														<a target="_blank" href="../cs/ForwardToDetailFromConnectorPK/{{ $array_connector_pk[$i] }}" class="btn btn-secondary btn-lg" style="width:100%;">View Detail</a>
													</div>

													<!--end:: Widgets/Stats2-1 -->
												</div>	
												
												<?php
											}
										}
										
										?>

										



									</div>
								</div>
							</div>

							<!--End::Section-->











							



							





							
						</div>
						
					</form>
					
				</div>
			</div>

			<!-- end:: Body -->

			
		</div>

		<!-- end:: Page -->

		@include('include.include_bottom_script_monitor')
		
		<script>
			setTimeout(function(){
			   window.location.reload(1);
			}, 5000);
		</script>
		
	</body>

	<!-- end::Body -->
</html>