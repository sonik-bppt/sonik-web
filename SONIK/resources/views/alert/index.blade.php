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

				@include('alert.include_left_aside')
				
				<div class="m-grid__item m-grid__item--fluid m-wrapper">

					<!-- BEGIN: Subheader -->
					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-subheader__title m-subheader__title--separator">Alert History</h3>
								<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
									<li class="m-nav__item m-nav__item--home">
										<a class="m-nav__link m-nav__link--icon">
											<i class="m-nav__link-icon la la-home"></i>
										</a>
									</li>
									<li class="m-nav__separator">-</li>
									<li class="m-nav__item">
										<a class="m-nav__link">
											<span class="m-nav__link-text">Alert</span>
										</a>
									</li>
									<li class="m-nav__separator">-</li>
									<li class="m-nav__item">
										<a class="m-nav__link">
											<span class="m-nav__link-text">View All History</span>
										</a>
									</li>
								</ul>
							</div>
							<div>
								<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
									<a href="DownloadCSV" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
										<i class="la la-plus m--hide"></i>
										<i class="la la-download"></i>
									</a>
									
								</div>
							</div>
						</div>
					</div>

					<!-- END: Subheader -->
					<div class="m-content">

						<!--begin:: Widgets/Stats-->
						<div class="m-portlet ">
							<div class="m-portlet__body  m-portlet__body--no-padding">
								<div class="row m-row--no-padding m-row--col-separator-xl">
									<div class="col-md-12 col-lg-6 col-xl-3">

										<!--begin::Total Profit-->
										<div class="m-widget24">
											<div class="m-widget24__item">
												<h4 class="m-widget24__title">
													Total Alert
												</h4><br>
												<span class="m-widget24__desc">
													Number of alert occur
												</span>
												<span class="m-widget24__stats m--font-warning">
													{{ number_format($alert_lifetime) }}
												</span>
												<div class="m--space-10"></div>
												<div class="progress m-progress--sm">
													<div class="progress-bar m--bg-warning" role="progressbar" style="width: 70%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<span class="m-widget24__change">
													&nbsp;
												</span>
												<span class="m-widget24__number">
													&nbsp;
												</span>
											</div>
										</div>

										<!--end::Total Profit-->
									</div>
									<div class="col-md-12 col-lg-6 col-xl-3">

										<!--begin::New Feedbacks-->
										<div class="m-widget24">
											<div class="m-widget24__item">
												<h4 class="m-widget24__title">
													This Year
												</h4><br>
												<span class="m-widget24__desc">
													Number of alert occur
												</span>
												<span class="m-widget24__stats m--font-danger">
													{{ number_format($alert_this_year) }}
												</span>
												<div class="m--space-10"></div>
												<div class="progress m-progress--sm">
													<div class="progress-bar m--bg-danger" role="progressbar" style="width: 70%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<span class="m-widget24__change">
													&nbsp;
												</span>
												<span class="m-widget24__number">
													&nbsp;
												</span>
											</div>
										</div>

										<!--end::New Feedbacks-->
									</div>
									<div class="col-md-12 col-lg-6 col-xl-3">

										<!--begin::New Orders-->
										<div class="m-widget24">
											<div class="m-widget24__item">
												<h4 class="m-widget24__title">
													This Month
												</h4><br>
												<span class="m-widget24__desc">
													Number of alert occur
												</span>
												<span class="m-widget24__stats m--font-info">
													{{ number_format($alert_this_month) }}
												</span>
												<div class="m--space-10"></div>
												<div class="progress m-progress--sm">
													<div class="progress-bar m--bg-info" role="progressbar" style="width: 70%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<span class="m-widget24__change">
													&nbsp;
												</span>
												<span class="m-widget24__number">
													&nbsp;
												</span>
											</div>
										</div>

										<!--end::New Orders-->
									</div>
									<div class="col-md-12 col-lg-6 col-xl-3">

										<!--begin::New Users-->
										<div class="m-widget24">
											<div class="m-widget24__item">
												<h4 class="m-widget24__title">
													Today
												</h4><br>
												<span class="m-widget24__desc">
													Number of alert occur
												</span>
												<span class="m-widget24__stats m--font-success">
													{{ number_format($alert_today) }}
												</span>
												<div class="m--space-10"></div>
												<div class="progress m-progress--sm">
													<div class="progress-bar m--bg-success" role="progressbar" style="width: 70%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<span class="m-widget24__change">
													&nbsp;
												</span>
												<span class="m-widget24__number">
													&nbsp;
												</span>
											</div>
										</div>

										<!--end::New Users-->
									</div>
								</div>
							</div>
						</div>

						<!--end:: Widgets/Stats-->
					
						<div class="m-portlet m-portlet--mobile">
							<div class="m-portlet__body">

								<!--begin: Datatable -->
								<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_2">
									<thead>
										<tr>
											<th>No</th>
											<th>Type</th>
											<th>Charger Box ID</th>
											<th>Connector</th>
											<th>Date</th>
											<th>Status</th>
											<th>Error Code</th>
											<th>Vendor ID</th>
											<th>Vendor Error Code</th>
											<th>Message</th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 0; ?>
										@foreach($alert as $this_alert)
											<?php 
												$i++; 
											?>
											<tr>
												<td>{{ $i }}</td>
												<td><i class="fas fa-exclamation-triangle fa-fw text-warning text-5 va-middle"></i><span class="va-middle">Alert</span></td>
												<td>{{ $this_alert->CHARGE_BOX_ID }}</td>
												<td>{{ $this_alert->CONNECTOR_NAME }}</td>
												<td>{{ $this_alert->STATUS_TIMESTAMP_GMT7 }}</td>
												<td>{{ $this_alert->STATUS }}</td>
												<td>{{ $this_alert->ERROR_CODE }}</td>
												<td>{{ $this_alert->VENDOR_ID }}</td>
												<td>{{ $this_alert->VENDOR_ERROR_CODE }}</td>
												<td>{{ $this_alert->ERROR_INFO }}</td>
											</tr>

										@endforeach
									</tbody>
								</table>
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
			var DatatablesBasicScrollable = function() {
			
				var initTable2 = function() {
					var table = $('#m_table_2');
			
					// begin second table
					table.DataTable({
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
		
	</body>

	<!-- end::Body -->
</html>