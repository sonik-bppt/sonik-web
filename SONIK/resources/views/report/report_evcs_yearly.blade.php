<!DOCTYPE html>
<html lang="en">

	@include('include.include_head')

	<style>
		td, th{
			text-align:center;
		}
	</style>

	<!-- begin::Body -->
	<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-light m-aside-left--fixed m-aside-left--offcanvas m-aside-left--minimize m-brand--minimize m-footer--push m-aside--offcanvas-default">

		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">

			@include('include.include_header')

			<!-- begin::Body -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

				@include('report.include_left_aside')

				<div class="m-grid__item m-grid__item--fluid m-wrapper">







					<!-- BEGIN: Subheader -->
					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-subheader__title m-subheader__title--separator">Reporting</h3>
								<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
									<li class="m-nav__item m-nav__item--home">
										<a href="#" class="m-nav__link m-nav__link--icon">
											<i class="m-nav__link-icon la la-home"></i>
										</a>
									</li>
									<li class="m-nav__separator">-</li>
									<li class="m-nav__item">
										<a href="" class="m-nav__link">
											<span class="m-nav__link-text">EVCS</span>
										</a>
									</li>
									<li class="m-nav__separator">-</li>
									<li class="m-nav__item">
										<a href="" class="m-nav__link">
											<span class="m-nav__link-text">Yearly</span>
										</a>
									</li>
								</ul>
							</div>
							<div>

								<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
									<table>
										<tr>
											<td><input type="number" class="form-control" value="{{ $year }}" id="change_year" /></td>
											<td style="padding-left:15px;"><button class="btn btn-primary" style="margin-right:15px;float:right;" onclick="window.location=document.getElementById('change_year').value">Update</button></td>
										</tr>
									</table>
								</div>

							</div>
						</div>
					</div>

					<!-- END: Subheader -->
					<div class="m-content">




						<?php
						$implode_bulan = implode(',', $array_bulan_with_quotes);
						$implode_total_usage = implode(',', $array_total_usage);
						$implode_energy_consumption = implode(',', $array_energy_consumption);
						$implode_energy_cost = implode(',', $array_energy_cost);
						?>



						<!--Begin::Section-->
						<div class="row">
							<div class="col-xl-12 text-center">
								<div class="alert alert-primary" role="alert">
									<strong>Monthly Data</strong>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xl-4">

								<!--begin:: Widgets/Application Sales-->
								<div class="m-portlet m-portlet--full-height ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													Total Usage
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools">
											<ul class="m-portlet__nav">
												<li class="m-portlet__nav-item">
													<a href="export/monthly_data/{{ $year }}" class="m-portlet__nav-link m-portlet__nav-link--icon"><i class="la la-download"></i></a>
												</li>
											</ul>
										</div>
									</div>
									<div class="m-portlet__body">
										<div class="m-widget14__chart" style="height:200px;">
											<canvas id="chart_total_usage"></canvas>
										</div>
										<div style="margin-top:20px;">
											<table class="table m-table m-table--head-bg-primary table-bordered table-hover">
												<thead>
													<tr>
														<th>Year</th>
														<th>Month</th>
														<th>Total Usage</th>
													</tr>
												</thead>
												<tbody>
													<?php
													for( $i=0;$i<count($array_bulan);$i++ ){
														?>
														<tr>
															<td><?php echo $year;?></td>
															<td><?php echo $array_month_name[$i];?></td>
															<td><?php echo $array_total_usage[$i];?></td>
														</tr>
														<?php
													}
													?>
												</tbody>
											</table>
										</div>
									</div>
								</div>

								<!--end:: Widgets/Application Sales-->
							</div>

							<div class="col-xl-4">

								<!--begin:: Widgets/Application Sales-->
								<div class="m-portlet m-portlet--full-height ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													Total Energy Consumption (kWh)
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools">
											<ul class="m-portlet__nav">
												<li class="m-portlet__nav-item">
													<a href="export/monthly_data/{{ $year }}" class="m-portlet__nav-link m-portlet__nav-link--icon"><i class="la la-download"></i></a>
												</li>
											</ul>
										</div>
									</div>
									<div class="m-portlet__body">
										<div class="m-widget14__chart" style="height:200px;">
											<canvas id="chart_total_consumption"></canvas>
										</div>
										<div style="margin-top:20px;">
											<table class="table m-table m-table--head-bg-primary table-bordered table-hover">
												<thead>
													<tr>
														<th>Year</th>
														<th>Month</th>
														<th>Total Energy Consumption (kWh)</th>
													</tr>
												</thead>
												<tbody>
													<?php
													for( $i=0;$i<count($array_bulan);$i++ ){
														?>
														<tr>
															<td><?php echo $year;?></td>
															<td><?php echo $array_month_name[$i];?></td>
															<td><?php echo number_format($array_energy_consumption[$i],2);?></td>
														</tr>
														<?php
													}
													?>
												</tbody>
											</table>
										</div>
									</div>
								</div>

								<!--end:: Widgets/Application Sales-->
							</div>

							<div class="col-xl-4">

								<!--begin:: Widgets/Application Sales-->
								<div class="m-portlet m-portlet--full-height ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													Total Cost of Energy (IDR)
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools">
											<ul class="m-portlet__nav">
												<li class="m-portlet__nav-item">
													<a href="export/monthly_data/{{ $year }}" class="m-portlet__nav-link m-portlet__nav-link--icon"><i class="la la-download"></i></a>
												</li>
											</ul>
										</div>
									</div>
									<div class="m-portlet__body">
										<div class="m-widget14__chart" style="height:200px;">
											<canvas id="chart_total_cost"></canvas>
										</div>
										<div style="margin-top:20px;">
											<table class="table m-table m-table--head-bg-primary table-bordered table-hover">
												<thead>
													<tr>
														<th>Year</th>
														<th>Month</th>
														<th>Total Cost of Energy (IDR)</th>
													</tr>
												</thead>
												<tbody>
													<?php
													for( $i=0;$i<count($array_bulan);$i++ ){
														?>
														<tr>
															<td><?php echo $year;?></td>
															<td><?php echo $array_month_name[$i];?></td>
															<td><?php echo number_format($array_energy_cost[$i]);?></td>
														</tr>
														<?php
													}
													?>
												</tbody>
											</table>
										</div>
									</div>
								</div>

								<!--end:: Widgets/Application Sales-->
							</div>

						</div>

						<!--End::Section-->






						<!--Begin::Section-->
						<div class="row" style="margin-top:50px;">
							<div class="col-xl-12 text-center">
								<div class="alert alert-primary" role="alert">
									<strong>Data per EV Charger</strong>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xl-4">

								<!--begin:: Widgets/Application Sales-->
								<div class="m-portlet m-portlet--full-height ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													Total Usage
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools">
											<ul class="m-portlet__nav">
												<li class="m-portlet__nav-item">
													<a href="export/monthly_data_per_evcs/{{ $year }}" class="m-portlet__nav-link m-portlet__nav-link--icon"><i class="la la-download"></i></a>
												</li>
											</ul>
										</div>
									</div>
									<div class="m-portlet__body">
										<div class="m-widget14__chart" style="height:200px;">
											<canvas id="chart_total_usage_per_evcs"></canvas>
										</div>
										<div style="margin-top:20px;">
											<table class="table m-table m-table--head-bg-primary table-bordered table-hover">
												<thead>
													<tr>
														<th>#</th>
														<th>EVCS</th>
														<th>Total Usage</th>
													</tr>
												</thead>
												<tbody>
													<?php $nomor = 0; ?>
													@foreach( $yearly_evcs as $this_yearly_evcs )
													<?php $nomor++; ?>
														<tr>
															<td>{{ $nomor }}</td>
															<td>{{ $this_yearly_evcs->NAME }}</td>
															<td>{{ $this_yearly_evcs->TOTAL_USAGE }}</td>
														</tr>
														<?php
														$array_chart_total_usage_per_evcs_nama[] = '"'.$this_yearly_evcs->NAME.'"';
														$array_chart_total_usage_per_evcs_total_usage[] = $this_yearly_evcs->TOTAL_USAGE;
														?>
													@endforeach
													<?php
														$implode_array_chart_total_usage_per_evcs_nama = implode(',', $array_chart_total_usage_per_evcs_nama);
														$implode_array_chart_total_usage_per_evcs_total_usage = implode(',', $array_chart_total_usage_per_evcs_total_usage);
													?>
												</tbody>
											</table>
										</div>
									</div>
								</div>

								<!--end:: Widgets/Application Sales-->
							</div>

							<div class="col-xl-4">

								<!--begin:: Widgets/Application Sales-->
								<div class="m-portlet m-portlet--full-height ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													Total Energy Consumption (kWh)
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools">
											<ul class="m-portlet__nav">
												<li class="m-portlet__nav-item">
													<a href="export/monthly_data_per_evcs/{{ $year }}" class="m-portlet__nav-link m-portlet__nav-link--icon"><i class="la la-download"></i></a>
												</li>
											</ul>
										</div>
									</div>
									<div class="m-portlet__body">
										<div class="m-widget14__chart" style="height:200px;">
											<canvas id="chart_total_consumption_per_evcs"></canvas>
										</div>
										<div style="margin-top:20px;">
											<table class="table m-table m-table--head-bg-primary table-bordered table-hover">
												<thead>
													<tr>
														<th>#</th>
														<th>EVCS</th>
														<th>Total Energy Consumption (kWh)</th>
													</tr>
												</thead>
												<tbody>
													<?php $nomor = 0; ?>
													@foreach( $yearly_evcs as $this_yearly_evcs )
													<?php $nomor++; ?>
														<tr>
															<td>{{ $nomor }}</td>
															<td>{{ $this_yearly_evcs->NAME }}</td>
															<td>{{ $this_yearly_evcs->ENERGY_CONSUMPTION }}</td>
														</tr>
														<?php
														$array_chart_total_consumption_per_evcs_nama[] = '"'.$this_yearly_evcs->NAME.'"';
														$array_chart_total_consumption_per_evcs_consumption[] = $this_yearly_evcs->ENERGY_CONSUMPTION;
														?>
													@endforeach
													<?php
														$implode_array_chart_total_consumption_per_evcs_nama = implode(',', $array_chart_total_consumption_per_evcs_nama);
														$implode_array_chart_total_consumption_per_evcs_consumption = implode(',', $array_chart_total_consumption_per_evcs_consumption);
													?>
												</tbody>
											</table>
										</div>
									</div>
								</div>

								<!--end:: Widgets/Application Sales-->
							</div>

							<div class="col-xl-4">

								<!--begin:: Widgets/Application Sales-->
								<div class="m-portlet m-portlet--full-height ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													Total Cost of Energy (IDR)
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools">
											<ul class="m-portlet__nav">
												<li class="m-portlet__nav-item">
													<a href="export/monthly_data_per_evcs/{{ $year }}" class="m-portlet__nav-link m-portlet__nav-link--icon"><i class="la la-download"></i></a>
												</li>
											</ul>
										</div>
									</div>
									<div class="m-portlet__body">
										<div class="m-widget14__chart" style="height:200px;">
											<canvas id="chart_total_cost_per_evcs"></canvas>
										</div>
										<div style="margin-top:20px;">
											<table class="table m-table m-table--head-bg-primary table-bordered table-hover">
												<thead>
													<tr>
														<th>#</th>
														<th>EVCS</th>
														<th>Total Cost of Energy (IDR)</th>
													</tr>
												</thead>
												<tbody>
													<?php $nomor = 0; ?>
													@foreach( $yearly_evcs as $this_yearly_evcs )
													<?php $nomor++; ?>
														<tr>
															<td>{{ $nomor }}</td>
															<td>{{ $this_yearly_evcs->NAME }}</td>
															<td>{{ $this_yearly_evcs->ENERGY_COST }}</td>
														</tr>
														<?php
														$array_chart_total_cost_per_evcs_nama[] = '"'.$this_yearly_evcs->NAME.'"';
														$array_chart_total_cost_per_evcs_cost[] = $this_yearly_evcs->ENERGY_COST;
														?>
													@endforeach
													<?php
														$implode_array_chart_total_cost_per_evcs_nama = implode(',', $array_chart_total_cost_per_evcs_nama);
														$implode_array_chart_total_cost_per_evcs_consumption = implode(',', $array_chart_total_cost_per_evcs_cost);
													?>
												</tbody>
											</table>
										</div>
									</div>
								</div>

								<!--end:: Widgets/Application Sales-->
							</div>

						</div>

						<!--End::Section-->







						<div class="row" style="margin-top:50px;">
							<div class="col-xl-12 text-center">
								<div class="alert alert-primary" role="alert">
									<strong>Data per ID TAG</strong>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xl-4">

								<!--begin:: Widgets/Application Sales-->
								<div class="m-portlet m-portlet--full-height ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													Total Usage
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools">
											<ul class="m-portlet__nav">
												<li class="m-portlet__nav-item">
													<a href="export/monthly_data_per_tag/{{ $year }}" class="m-portlet__nav-link m-portlet__nav-link--icon"><i class="la la-download"></i></a>
												</li>
											</ul>
										</div>
									</div>
									<div class="m-portlet__body">
										<div class="m-widget14__chart" style="height:200px;">
											<canvas id="chart_transaction_per_id_tag"></canvas>
											<?php
											foreach( $yearly_id_tag as $this_yearly_id_tag ){
												$array_id_tag[] = $this_yearly_id_tag->ID_TAG;
												$array_id_tag_with_quotes[] = '"'.$this_yearly_id_tag->ID_TAG.'"';
												$array_id_tag_transaction[] = $this_yearly_id_tag->TOTAL_ID_TAG;
											}
											$implode_array_id_tag_with_quotes = implode(',', $array_id_tag_with_quotes);
											$implode_array_id_tag_transaction = implode(',', $array_id_tag_transaction);
											?>
										</div>
										<div style="margin-top:20px;">
											<table class="table m-table m-table--head-bg-primary table-bordered table-hover">
												<thead>
													<tr>
														<th>#</th>
														<th>ID Tag</th>
														<th>Total Transaction</th>
													</tr>
												</thead>
												<tbody>
													<?php $nomor = 0; ?>
													@foreach( $yearly_id_tag as $this_yearly_id_tag )
													<?php $nomor++; ?>
													<tr>
														<td><?php echo $nomor;?></td>
														<td><?php echo $this_yearly_id_tag->ID_TAG;?></td>
														<td><?php echo $this_yearly_id_tag->TOTAL_ID_TAG;?></td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>

								<!--end:: Widgets/Application Sales-->
							</div>
							<div class="col-xl-4">

								<!--begin:: Widgets/Application Sales-->
								<div class="m-portlet m-portlet--full-height ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													Total Energy Consumption (kWh)
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools">
											<ul class="m-portlet__nav">
												<li class="m-portlet__nav-item">
													<a href="export/monthly_data_per_tag/{{ $year }}" class="m-portlet__nav-link m-portlet__nav-link--icon"><i class="la la-download"></i></a>
												</li>
											</ul>
										</div>
									</div>
									<div class="m-portlet__body">
										<div class="m-widget14__chart" style="height:200px;">
											<canvas id="chart_total_consumption_per_tag"></canvas>
										</div>
										<div style="margin-top:20px;">
											<table class="table m-table m-table--head-bg-primary table-bordered table-hover">
												<thead>
													<tr>
														<th>#</th>
														<th>ID Tag</th>
														<th>Total Energy Consumption (kWh)</th>
													</tr>
												</thead>
												<tbody>
													<?php $nomor = 0; ?>
													@foreach( $yearly_id_tag as $this_yearly_id_tag )
													<?php $nomor++; ?>
														<tr>
															<td>{{ $nomor }}</td>
															<td>{{ $this_yearly_id_tag->ID_TAG }}</td>
															<td>{{ $this_yearly_id_tag->ENERGY_CONSUMPTION }}</td>
														</tr>
														<?php
														$array_chart_total_consumption_per_tag_nama[] = '"'.$this_yearly_id_tag->ID_TAG.'"';
														$array_chart_total_consumption_per_tag_consumption[] = $this_yearly_id_tag->ENERGY_CONSUMPTION;
														?>
													@endforeach
													<?php
														$implode_array_chart_total_consumption_per_tag_nama = implode(',', $array_chart_total_consumption_per_tag_nama);
														$implode_array_chart_total_consumption_per_tag_consumption = implode(',', $array_chart_total_consumption_per_tag_consumption);
													?>
												</tbody>
											</table>
										</div>
									</div>
								</div>

								<!--end:: Widgets/Application Sales-->
							</div>

							<div class="col-xl-4">

								<!--begin:: Widgets/Application Sales-->
								<div class="m-portlet m-portlet--full-height ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													Total Cost of Energy (IDR)
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools">
											<ul class="m-portlet__nav">
												<li class="m-portlet__nav-item">
													<a href="export/monthly_data_per_tag/{{ $year }}" class="m-portlet__nav-link m-portlet__nav-link--icon"><i class="la la-download"></i></a>
												</li>
											</ul>
										</div>
									</div>
									<div class="m-portlet__body">
										<div class="m-widget14__chart" style="height:200px;">
											<canvas id="chart_total_cost_per_tag"></canvas>
										</div>
										<div style="margin-top:20px;">
											<table class="table m-table m-table--head-bg-primary table-bordered table-hover">
												<thead>
													<tr>
														<th>#</th>
														<th>ID Tag</th>
														<th>Total Cost of Energy (IDR)</th>
													</tr>
												</thead>
												<tbody>
													<?php $nomor = 0; ?>
													@foreach( $yearly_id_tag as $this_yearly_id_tag )
													<?php $nomor++; ?>
														<tr>
															<td>{{ $nomor }}</td>
															<td>{{ $this_yearly_id_tag->ID_TAG }}</td>
															<td>{{ $this_yearly_id_tag->ENERGY_COST }}</td>
														</tr>
														<?php
														$array_chart_total_cost_per_tag_nama[] = '"'.$this_yearly_id_tag->ID_TAG.'"';
														$array_chart_total_cost_per_tag_cost[] = $this_yearly_id_tag->ENERGY_COST;
														?>
													@endforeach
													<?php
														$implode_array_chart_total_cost_per_tag_nama = implode(',', $array_chart_total_cost_per_tag_nama);
														$implode_array_chart_total_cost_per_tag_cost = implode(',', $array_chart_total_cost_per_tag_cost);
													?>
												</tbody>
											</table>
										</div>
									</div>
								</div>

								<!--end:: Widgets/Application Sales-->
							</div>

						</div>














					</div>









				</div>
			</div>

			<!-- end:: Body -->

			@include('include.include_footer')

		</div>

		<!-- end:: Page -->

		@include('include.include_quicksidebar')

		@include('include.include_bottom_script')

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

			    //== Daily Sales chart.
			    //** Based on Chartjs plugin - http://www.chartjs.org/
			    var chartTotalUsage = function() {
			        var chartContainer = $('#chart_total_usage');

			        if (chartContainer.length == 0) {
			            return;
			        }

			        var chartData = {
			            labels: [<?php echo $implode_bulan;?>],
			            datasets: [{
			                label: 'Usage',
			                backgroundColor: mApp.getColor('success'),
			                data: [
			                <?php echo $implode_total_usage;?>
			                ]
			            }
			            /*
			            , {
			                //label: 'Dataset 2',
			                backgroundColor: '#f3f3fb',
			                data: [
			                    15, 20, 25, 30, 25, 20, 15, 20, 25, 30, 25, 20, 15, 10, 15, 20
			                ]
			            }
			            */
			            ]
			        };

			        var chart = new Chart(chartContainer, {
			            type: 'bar',
			            data: chartData,
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
			                barRadius: 4,
			                scales: {
			                    xAxes: [{
			                        display: true,
			                        gridLines: {
									    display: true,
									    drawBorder: true,
									  },
			                        stacked: true
			                    }],
			                    yAxes: [{
			                        display: true,
			                        stacked: true,
			                        gridLines: {
									    display: true,
									    drawBorder: true,
									  },
			                    }]
			                },
			                layout: {
			                    padding: {
			                        left: 0,
			                        right: 0,
			                        top: 0,
			                        bottom: 0
			                    }
			                }
			            }
			        });
			    }


			    //== Daily Sales chart.
			    //** Based on Chartjs plugin - http://www.chartjs.org/
			    var chartTotalConsumption = function() {
			        var chartContainer = $('#chart_total_consumption');

			        if (chartContainer.length == 0) {
			            return;
			        }

			        var chartData = {
			            labels: [<?php echo $implode_bulan;?>],
			            datasets: [{
			                label: 'Usage',
			                backgroundColor: mApp.getColor('success'),
			                data: [
			                <?php echo $implode_energy_consumption;?>
			                ]
			            }
			            /*
			            , {
			                //label: 'Dataset 2',
			                backgroundColor: '#f3f3fb',
			                data: [
			                    15, 20, 25, 30, 25, 20, 15, 20, 25, 30, 25, 20, 15, 10, 15, 20
			                ]
			            }
			            */
			            ]
			        };

			        var chart = new Chart(chartContainer, {
			            type: 'bar',
			            data: chartData,
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
			                barRadius: 4,
			                scales: {
			                    xAxes: [{
			                        display: true,
			                        gridLines: {
									    display: true,
									    drawBorder: true,
									  },
			                        stacked: true
			                    }],
			                    yAxes: [{
			                        display: true,
			                        stacked: true,
			                        gridLines: {
									    display: true,
									    drawBorder: true,
									  },
			                    }]
			                },
			                layout: {
			                    padding: {
			                        left: 0,
			                        right: 0,
			                        top: 0,
			                        bottom: 0
			                    }
			                }
			            }
			        });
			    }


			    //== Daily Sales chart.
			    //** Based on Chartjs plugin - http://www.chartjs.org/
			    var chartEnergyCost = function() {
			        var chartContainer = $('#chart_total_cost');

			        if (chartContainer.length == 0) {
			            return;
			        }

			        var chartData = {
			            labels: [<?php echo $implode_bulan;?>],
			            datasets: [{
			                label: 'Usage',
			                backgroundColor: mApp.getColor('success'),
			                data: [
			                <?php echo $implode_energy_cost;?>
			                ]
			            }
			            /*
			            , {
			                //label: 'Dataset 2',
			                backgroundColor: '#f3f3fb',
			                data: [
			                    15, 20, 25, 30, 25, 20, 15, 20, 25, 30, 25, 20, 15, 10, 15, 20
			                ]
			            }
			            */
			            ]
			        };

			        var chart = new Chart(chartContainer, {
			            type: 'bar',
			            data: chartData,
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
			                barRadius: 4,
			                scales: {
			                    xAxes: [{
			                        display: true,
			                        gridLines: {
									    display: true,
									    drawBorder: true,
									  },
			                        stacked: true
			                    }],
			                    yAxes: [{
			                        display: true,
			                        stacked: true,
			                        gridLines: {
									    display: true,
									    drawBorder: true,
									  },
			                    }]
			                },
			                layout: {
			                    padding: {
			                        left: 0,
			                        right: 0,
			                        top: 0,
			                        bottom: 0
			                    }
			                }
			            }
			        });
			    }




			    //== Daily Sales chart.
			    //** Based on Chartjs plugin - http://www.chartjs.org/
			    var chartTotalUsagePerEVCS = function() {
			        var chartContainer = $('#chart_total_usage_per_evcs');

			        if (chartContainer.length == 0) {
			            return;
			        }

			        var chartData = {
			            labels: [<?php echo $implode_array_chart_total_usage_per_evcs_nama;?>],
			            datasets: [{
			                label: 'Usage',
			                backgroundColor: mApp.getColor('success'),
			                data: [
			                <?php echo $implode_array_chart_total_usage_per_evcs_total_usage;?>
			                ]
			            }

			            /*
			            , {
			                //label: 'Dataset 2',
			                backgroundColor: '#f3f3fb',
			                data: [
			                    15, 20, 25, 30, 25, 20, 15, 20, 25, 30, 25, 20, 15, 10, 15, 20
			                ]
			            }
			            */
			            ]
			        };

			        var chart = new Chart(chartContainer, {
			            type: 'bar',
			            data: chartData,
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
			                barRadius: 4,
			                scales: {
			                    xAxes: [{
			                        display: false,
			                        gridLines: {
									    display: true,
									    drawBorder: true,
									  },
			                        stacked: true
			                    }],
			                    yAxes: [{
			                        display: true,
			                        stacked: true,
			                        gridLines: {
									    display: true,
									    drawBorder: true,
									  },
			                    }]
			                },
			                layout: {
			                    padding: {
			                        left: 0,
			                        right: 0,
			                        top: 0,
			                        bottom: 0
			                    }
			                }
			            }
			        });
			    }




			    //== Daily Sales chart.
			    //** Based on Chartjs plugin - http://www.chartjs.org/
			    var chartTotalConsumptionPerEVCS = function() {
			        var chartContainer = $('#chart_total_consumption_per_evcs');

			        if (chartContainer.length == 0) {
			            return;
			        }

			        var chartData = {
			            labels: [<?php echo $implode_array_chart_total_consumption_per_evcs_nama;?>],
			            datasets: [{
			                label: 'Usage',
			                backgroundColor: mApp.getColor('success'),
			                data: [
			                <?php echo $implode_array_chart_total_consumption_per_evcs_consumption;?>
			                ]
			            }

			            /*
			            , {
			                //label: 'Dataset 2',
			                backgroundColor: '#f3f3fb',
			                data: [
			                    15, 20, 25, 30, 25, 20, 15, 20, 25, 30, 25, 20, 15, 10, 15, 20
			                ]
			            }
			            */
			            ]
			        };

			        var chart = new Chart(chartContainer, {
			            type: 'bar',
			            data: chartData,
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
			                barRadius: 4,
			                scales: {
			                    xAxes: [{
			                        display: false,
			                        gridLines: {
									    display: true,
									    drawBorder: true,
									  },
			                        stacked: true
			                    }],
			                    yAxes: [{
			                        display: true,
			                        stacked: true,
			                        gridLines: {
									    display: true,
									    drawBorder: true,
									  },
			                    }]
			                },
			                layout: {
			                    padding: {
			                        left: 0,
			                        right: 0,
			                        top: 0,
			                        bottom: 0
			                    }
			                }
			            }
			        });
			    }




			    //== Daily Sales chart.
			    //** Based on Chartjs plugin - http://www.chartjs.org/
			    var chartTotalCostPerEVCS = function() {
			        var chartContainer = $('#chart_total_cost_per_evcs');

			        if (chartContainer.length == 0) {
			            return;
			        }

			        var chartData = {
			            labels: [<?php echo $implode_array_chart_total_cost_per_evcs_nama;?>],
			            datasets: [{
			                label: 'Usage',
			                backgroundColor: mApp.getColor('success'),
			                data: [
			                <?php echo $implode_array_chart_total_cost_per_evcs_consumption;?>
			                ]
			            }

			            /*
			            , {
			                //label: 'Dataset 2',
			                backgroundColor: '#f3f3fb',
			                data: [
			                    15, 20, 25, 30, 25, 20, 15, 20, 25, 30, 25, 20, 15, 10, 15, 20
			                ]
			            }
			            */
			            ]
			        };

			        var chart = new Chart(chartContainer, {
			            type: 'bar',
			            data: chartData,
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
			                barRadius: 4,
			                scales: {
			                    xAxes: [{
			                        display: false,
			                        gridLines: {
									    display: true,
									    drawBorder: true,
									  },
			                        stacked: true
			                    }],
			                    yAxes: [{
			                        display: true,
			                        stacked: true,
			                        gridLines: {
									    display: true,
									    drawBorder: true,
									  },
			                    }]
			                },
			                layout: {
			                    padding: {
			                        left: 0,
			                        right: 0,
			                        top: 0,
			                        bottom: 0
			                    }
			                }
			            }
			        });
			    }


			    //== Daily Sales chart.
			    //** Based on Chartjs plugin - http://www.chartjs.org/
			    var chartTransactionPerIDTag = function() {
			        var chartContainer = $('#chart_transaction_per_id_tag');

			        if (chartContainer.length == 0) {
			            return;
			        }

			        var chartData = {
			            labels: [<?php echo $implode_array_id_tag_with_quotes;?>],
			            datasets: [{
			                label: 'Usage',
			                backgroundColor: mApp.getColor('success'),
			                data: [
			                <?php echo $implode_array_id_tag_transaction;?>
			                ]
			            }
			            /*
			            , {
			                //label: 'Dataset 2',
			                backgroundColor: '#f3f3fb',
			                data: [
			                    15, 20, 25, 30, 25, 20, 15, 20, 25, 30, 25, 20, 15, 10, 15, 20
			                ]
			            }
			            */
			            ]
			        };

			        var chart = new Chart(chartContainer, {
			            type: 'bar',
			            data: chartData,
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
			                barRadius: 4,
			                scales: {
			                    xAxes: [{
			                        display: false,
			                        gridLines: {
									    display: true,
									    drawBorder: true,
									  },
			                        stacked: true
			                    }],
			                    yAxes: [{
			                        display: true,
			                        stacked: true,
			                        gridLines: {
									    display: true,
									    drawBorder: true,
									  },
			                    }]
			                },
			                layout: {
			                    padding: {
			                        left: 0,
			                        right: 0,
			                        top: 0,
			                        bottom: 0
			                    }
			                }
			            }
			        });
			    }


			    //== Daily Sales chart.
			    //** Based on Chartjs plugin - http://www.chartjs.org/
			    var chartTotalConsumptionPerTag = function() {
			        var chartContainer = $('#chart_total_consumption_per_tag');

			        if (chartContainer.length == 0) {
			            return;
			        }

			        var chartData = {
			            labels: [<?php echo $implode_array_chart_total_consumption_per_tag_nama;?>],
			            datasets: [{
			                label: 'Usage',
			                backgroundColor: mApp.getColor('success'),
			                data: [
			                <?php echo $implode_array_chart_total_consumption_per_tag_consumption;?>
			                ]
			            }

			            /*
			            , {
			                //label: 'Dataset 2',
			                backgroundColor: '#f3f3fb',
			                data: [
			                    15, 20, 25, 30, 25, 20, 15, 20, 25, 30, 25, 20, 15, 10, 15, 20
			                ]
			            }
			            */
			            ]
			        };

			        var chart = new Chart(chartContainer, {
			            type: 'bar',
			            data: chartData,
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
			                barRadius: 4,
			                scales: {
			                    xAxes: [{
			                        display: false,
			                        gridLines: {
									    display: true,
									    drawBorder: true,
									  },
			                        stacked: true
			                    }],
			                    yAxes: [{
			                        display: true,
			                        stacked: true,
			                        gridLines: {
									    display: true,
									    drawBorder: true,
									  },
			                    }]
			                },
			                layout: {
			                    padding: {
			                        left: 0,
			                        right: 0,
			                        top: 0,
			                        bottom: 0
			                    }
			                }
			            }
			        });
			    }




			    //== Daily Sales chart.
			    //** Based on Chartjs plugin - http://www.chartjs.org/
			    var chartTotalCostPerTag = function() {
			        var chartContainer = $('#chart_total_cost_per_tag');

			        if (chartContainer.length == 0) {
			            return;
			        }

			        var chartData = {
			            labels: [<?php echo $implode_array_chart_total_cost_per_tag_nama;?>],
			            datasets: [{
			                label: 'Usage',
			                backgroundColor: mApp.getColor('success'),
			                data: [
			                <?php echo $implode_array_chart_total_cost_per_tag_cost;?>
			                ]
			            }

			            /*
			            , {
			                //label: 'Dataset 2',
			                backgroundColor: '#f3f3fb',
			                data: [
			                    15, 20, 25, 30, 25, 20, 15, 20, 25, 30, 25, 20, 15, 10, 15, 20
			                ]
			            }
			            */
			            ]
			        };

			        var chart = new Chart(chartContainer, {
			            type: 'bar',
			            data: chartData,
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
			                barRadius: 4,
			                scales: {
			                    xAxes: [{
			                        display: false,
			                        gridLines: {
									    display: true,
									    drawBorder: true,
									  },
			                        stacked: true
			                    }],
			                    yAxes: [{
			                        display: true,
			                        stacked: true,
			                        gridLines: {
									    display: true,
									    drawBorder: true,
									  },
			                    }]
			                },
			                layout: {
			                    padding: {
			                        left: 0,
			                        right: 0,
			                        top: 0,
			                        bottom: 0
			                    }
			                }
			            }
			        });
			    }





			    return {
			        //== Init demos
			        init: function() {
			            // init charts

			            chartTotalUsage();
			            chartTotalConsumption();
			            chartEnergyCost();

			            chartTotalUsagePerEVCS();
			            chartTotalConsumptionPerEVCS();
			            chartTotalCostPerEVCS();

			            chartTransactionPerIDTag();
			            chartTotalConsumptionPerTag();
			            chartTotalCostPerTag();
			        }
			    };
			}();

			//== Class initialization on page load
			jQuery(document).ready(function() {
			    Dashboard.init();
			});
		</script>

	</body>

	<!-- end::Body -->
</html>
