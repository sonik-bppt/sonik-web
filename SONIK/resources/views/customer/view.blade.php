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

					<!-- BEGIN: Subheader -->
					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-subheader__title">Customer Management</h3>
							</div>
							<div>
								<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
									<a href="add" class="btn btn-primary" style="margin-right:15px;">Register New Customer</a>

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

						<div class="row">
								<!--begin:: Widgets/Stats-->
								<div class="col-xl-4">
										<!--Number of usage-->
										<div class="m-portlet m-portlet--bordered-semi m-portlet--space m-portlet--full-height ">
												<div class="m-portlet__body">
														<div class="m-widget25">
																<span class="m-widget25__price m--font-brand"> {{ number_format($customer_lifetime) }}</span><br>
																<span class="m-widget25__desc">Registered Customer</span>
														</div>
												</div>
										</div>

										<!--end:: Widgets/Product Sales-->
								</div>

								<div class="col-xl-4">
										<!--Number of usage-->
										<div class="m-portlet m-portlet--bordered-semi m-portlet--space m-portlet--full-height ">
												<div class="m-portlet__body">
														<div class="m-widget25">
																<span class="m-widget25__price m--font-brand"> {{ number_format($customer_not_verified) }}</span><br>
																<span class="m-widget25__desc">Unverified Customer</span>
														</div>
												</div>
										</div>

										<!--end:: Widgets/Product Sales-->
								</div>

								<div class="col-xl-4">
										<!--Number of usage-->
										<div class="m-portlet m-portlet--bordered-semi m-portlet--space m-portlet--full-height ">
												<div class="m-portlet__body">
														<div class="m-widget25">
																<span class="m-widget25__price m--font-brand"> {{ number_format($customer_verified) }}</span><br>
																<span class="m-widget25__desc">Verified Customer</span>
														</div>
												</div>
										</div>

										<!--end:: Widgets/Product Sales-->
								</div>
						</div>
						<!--begin:: Widgets/Stats-->


						<!--end:: Widgets/Stats-->



						<div class="m-portlet m-portlet--mobile">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											Customer Master Data
										</h3>
									</div>
								</div>
							</div>
							<div class="m-portlet__body">

								<!--begin: Datatable -->
								<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_2">
									<thead>
										<tr>
											<th>System ID</th>
											<th>Name</th>
											<th>Email</th>
											<th>Phone Number</th>
											<th>ID TAG</th>
											<th>Date Registered</th>
											<th>Status</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
										@foreach($customer as $this_customer)
											<?php
											$this_status = rand(1,2);

											if( $this_status == 1 ){
												$display_badge = '<span style="width:100%;" class="m-badge  m-badge--success m-badge--wide">Active</span>';
											} else if( $this_status == 2 ){
												$display_badge = '<span style="width:100%;" class="m-badge  m-badge--danger m-badge--wide">Blacklist</span>';
											}

											if( $this_customer->LAST_LOGIN == null ){
												$display_last_login = 'Never';
											} else {
												$display_last_login = $this_customer->LAST_LOGIN;
											}

											if( $this_customer->IS_VERIFIED == 1 ){
												$verified_badge = '<span style="width:100%;" class="m-badge  m-badge--success m-badge--wide">VERIFIED</span>';
											} else {
												$verified_badge = '<span style="width:100%;" class="m-badge  m-badge--warning m-badge--wide">PENDING</span>';
											}

											?>
											<tr>
												<td>{{ $this_customer->ID }}</td>
												<td>{{ $this_customer->NAME }}</td>
												<td>{{ $this_customer->EMAIL }}</td>
												<td>{{ $this_customer->PHONE_NUMBER }}</td>
												<td>{{ $this_customer->ID_TAG }}</td>
												<td>{{ $this_customer->DATE_CREATED }}</td>
												<td>{!! $verified_badge !!}</td>
												<td nowrap><a href="detail/{{ $this_customer->ID }}" class="btn btn-warning btn-sm" style="width:100%;">Detail</a></td>
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

	</body>

	<!-- end::Body -->
</html>
