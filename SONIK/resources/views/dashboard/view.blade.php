<!DOCTYPE html>
<html lang="en">

	@include('include.include_head')

	<!-- begin::Body -->
	<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-light m-aside-left--fixed m-aside-left--offcanvas m-aside-left--minimize m-brand--minimize m-footer--push m-aside--offcanvas-default">

		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">

			@include('include.include_header')

			<!-- begin::Body -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

				@include('include.include_left_aside')

				<div class="m-grid__item m-grid__item--fluid m-wrapper">
          <div class="m-subheader ">
              <div class="d-flex align-items-center">
                  <div class="mr-auto">
                      <h1 class="m-subheader__title">Overview</h1>
                  </div>
              </div>
          </div>
					<div class="m-content">
						<!--begin:: Widgets/Stats-->
            <div class="row">
                <!--begin:: Widgets/Stats-->
                <div class="col-xl-3">
                    <!--Number of usage-->
                    <div class="m-portlet m-portlet--bordered-semi m-portlet--space m-portlet--full-height ">
                        <div class="m-portlet__body">
                            <div class="m-widget25">
                                <span class="m-widget25__price m--font-brand"> {{ number_format($sum_of_using_device) }}</span><br>
                                <span class="m-widget25__desc">Charges</span>
                            </div>
                        </div>
                    </div>

                    <!--end:: Widgets/Product Sales-->
                </div>

                <div class="col-xl-3">
                    <!--Number of usage-->
                    <div class="m-portlet m-portlet--bordered-semi m-portlet--space m-portlet--full-height ">
                        <div class="m-portlet__body">
                            <div class="m-widget25">
                                <span class="m-widget25__price m--font-brand"> {{ number_format($sum_of_alert_device) }}</span><br>
                                <span class="m-widget25__desc">System Failures</span>
                            </div>
                        </div>
                    </div>

                    <!--end:: Widgets/Product Sales-->
                </div>

                <div class="col-xl-3">
                    <!--Number of usage-->
                    <div class="m-portlet m-portlet--bordered-semi m-portlet--space m-portlet--full-height ">
                        <div class="m-portlet__body">
                            <div class="m-widget25">
                                <span class="m-widget25__price m--font-brand"> {{ number_format($sum_energy_consumption) }}</span><br>
                                <span class="m-widget25__desc">kWh Delivered</span>
                            </div>
                        </div>
                    </div>

                    <!--end:: Widgets/Product Sales-->
                </div>

                <div class="col-xl-3">
                    <!--Number of usage-->
                    <div class="m-portlet m-portlet--bordered-semi m-portlet--space m-portlet--full-height ">
                        <div class="m-portlet__body">
                            <div class="m-widget25">
                                <span class="m-widget25__price m--font-brand"> {{ number_format($sum_energy_cost) }}</span><br>
                                <span class="m-widget25__desc">IDR Cost of Energy</span>
                            </div>
                        </div>
                    </div>

                    <!--end:: Widgets/Product Sales-->
                </div>
            </div>

<!--end:: Widgets/Stats-->

            <div class="row">
                <div class="col-xl-6">
                    <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1k_wpHBrgTbZ3fT5C6xWkKEJ0H-7EkloN" width="100%" height="430"></iframe>
                </div>
								<div class="col-xl-6">

									<!--begin:: Widgets/Sale Reports-->
									<div class="m-portlet m-portlet--full-height ">
										<div class="m-portlet__head">
											<div class="m-portlet__head-caption">
												<div class="m-portlet__head-title">
													<h3 class="m-portlet__head-text">
														Latest Usage
													</h3>
												</div>
											</div>
											<div class="m-portlet__head-tools">
												<ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
													<li class="nav-item m-tabs__item">
														<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_widget11_tab2_content" role="tab">
															All Time
														</a>
													</li>
												</ul>
											</div>
										</div>
										<div class="m-portlet__body">

											<!--Begin::Tab Content-->
											<div class="tab-content">

												<!--begin::tab 1 content-->
												<div class="tab-pane active" id="m_widget11_tab1_content">

													<!--begin::Widget 11-->
													<div class="m-widget11">
														<div class="table-responsive">

															<!--begin::Table-->
															<table class="table">

																<!--begin::Thead-->
																<thead>
																	<tr>
																		<td class="m-widget11__app">EVCS</td>
																		<!-- <td class="m-widget11__price">Time</td> -->
																		<td class="m-widget11__price">Time</td>
																		<td class="m-widget11__sales">Consumption</td>
																		<td class="m-widget11__sales">Duration</td>
																		<td class="m-widget11__total m--align-right">Charging Cost</td>
																	</tr>
																</thead>

																<!--end::Thead-->

																<!--begin::Tbody-->
																<tbody>
																	<?php $latest_usage_counter = 0; ?>
																	@foreach($latest_usage as $this_latest_usage)
																		<?php
																		$latest_usage_counter++;
																		if( $latest_usage_counter > 3 ){
																			break;
																		}

																		if( $this_latest_usage->ENERGY_CONSUMPTION == 0 ){
																			$display_duration = 0;
																		} else {
																			$display_duration = $this_latest_usage->DURATION;
																		}

																		?>
																		<tr>
																			<td>
																				<span class="m-widget11__title">{{ $this_latest_usage->NAME }}</span>
																				<!-- <span class="m-widget11__title">{{ $this_latest_usage->ID_TAG }}</span> -->
																				<!-- <span class="m-widget11__sub">{{ $this_latest_usage->NAME }}</span> -->
																			</td>
																			<!-- <td>{{ $this_latest_usage->START_TIMESTAMP }}</td> -->
																			<td>{{ $this_latest_usage->START_TIMESTAMP_GMT7 }}</td>
																			<td>{{ number_format($this_latest_usage->ENERGY_CONSUMPTION,2) }} kWh</td>
																			<td>{{ $display_duration }}</td>
																			<td class="m--align-right m--font-brand">IDR {{ number_format($this_latest_usage->ENERGY_COST) }}</td>
																		</tr>
																	@endforeach
																</tbody>

																<!--end::Tbody-->
															</table>

															<!--end::Table-->
														</div>
														<div class="m-widget11__action m--align-right" style="display:none;">
															<button type="button" class="btn m-btn--pill btn-outline-brand m-btn m-btn--custom" onclick="window.location='DownloadLatestUsageCSV'">Download Complete Data</button>
														</div>
													</div>

													<!--end::Widget 11-->
												</div>



												<!--end::tab 3 content-->
											</div>

											<!--End::Tab Content-->
										</div>
									</div>

									<!--end:: Widgets/Sale Reports-->
								</div>
            </div>

						<!--Begin::Section-->
						<div class="row">

							<div class="col-xl-12">

								<!--begin:: Widgets/Product Sales-->
								<div class="m-portlet m-portlet--bordered-semi m-portlet--space m-portlet--full-height ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													Cost of Energy
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools">
											<ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
												<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_widget11_tab2_content" role="tab">
														All Time
													</a>
												</li>
											</ul>
										</div>
									</div>
									<div class="m-portlet__body">
										<div class="m-widget25">
											<?php $value_total_revenue_this_month = 0; ?>
											@foreach($latest_usage as $this_total_revenue_this_month)
												<?php
												$value_total_revenue_this_month += $this_total_revenue_this_month->ENERGY_COST;
												?>
											@endforeach
											<span class="m-widget25__price m--font-brand">IDR {{ number_format($sum_energy_cost) }}</span>
											<!--<span class="m-widget25__desc">Total Cost of Energy</span>-->
											<div class="m-widget25--progress">
												<?php
												$color_border_number = 0;
												$featured_cost_of_energy_counter = 0;
												foreach( $total_revenue_this_month as $this_total_revenue_this_month ){

														$featured_cost_of_energy_counter++;

														if( $featured_cost_of_energy_counter > 3 ){
															break;
														}

														if( $color_border_number == 0 ){
															$color_border_text = "danger";
														} else if( $color_border_number == 1 ){
															$color_border_text = "warning";
														} else if( $color_border_number == 2 ){
															$color_border_text = "success";
														}
														?>
														<div class="m-widget25__progress">
															<span class="m-widget25__progress-number">
																<?php
																if( $value_total_revenue_this_month > 0 ){
																	$revenue_percentage = $this_total_revenue_this_month->ENERGY_COST / $value_total_revenue_this_month* 100;
																} else {
																	$revenue_percentage = 0;
																}
																?>
																{{ number_format($revenue_percentage,2).'%' }}
															</span>
															<div class="m--space-10"></div>
															<div class="progress m-progress--sm">
																<div class="progress-bar m--bg-<?php echo $color_border_text;?>" role="progressbar" style="width: {{ number_format($revenue_percentage).'%' }};" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
																<div class="progress-bar m--bg-<?php echo $color_border_text;?>" role="progressbar" style="width: {{ number_format($revenue_percentage).'%' }};" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
																<div class="progress-bar m--bg-<?php echo $color_border_text;?>" role="progressbar" style="width: {{ number_format($revenue_percentage).'%' }};" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
															<span class="m-widget25__progress-sub">
																{{ $this_total_revenue_this_month->NAME }}
															</span>
														</div>
														<?php
														$color_border_number++;
												}
												?>

											</div>
										</div>
									</div>
								</div>

								<!--end:: Widgets/Product Sales-->
							</div>
						</div>

						<!--End::Section-->





					</div>
				</div>
			</div>

			<!-- end:: Body -->

			@include('include.include_footer')

		</div>

		<!-- end:: Page -->

		@include('include.include_quicksidebar')

		@include('include.include_bottom_script')

		<!--begin::Page Vendors -->
		<!-- <script src="../../assets/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script> -->

		<!--end::Page Vendors -->

		<!--begin::Page Scripts -->
		<!-- <script src="../../assets/app/js/dashboard.js" type="text/javascript"></script> -->

		<!--end::Page Scripts -->
	</body>

	<!-- end::Body -->
</html>
