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
								<h3 class="m-subheader__title">Transaction History</h3>

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
						<div class="row">
								<!--begin:: Widgets/Stats-->
								<div class="col-xl-3">
										<!--Number of usage-->
										<div class="m-portlet m-portlet--bordered-semi m-portlet--space m-portlet--full-height ">
												<div class="m-portlet__body">
														<div class="m-widget25">
																<span class="m-widget25__price m--font-brand"> {{ number_format($this_transaction_lifetime) }}</span><br>
																<span class="m-widget25__desc">Total Transaction</span>
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
																<span class="m-widget25__price m--font-brand"> {{ number_format($this_transaction_this_year) }}</span><br>
																<span class="m-widget25__desc">Transaction This Year</span>
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
																<span class="m-widget25__price m--font-brand"> {{ number_format($this_transaction_this_month) }}</span><br>
																<span class="m-widget25__desc">Transaction This Month</span>
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
																<span class="m-widget25__price m--font-brand"> {{ number_format($this_transaction_today) }}</span><br>
																<span class="m-widget25__desc">Transaction Today</span>
														</div>
												</div>
										</div>

										<!--end:: Widgets/Product Sales-->
								</div>
						</div>
						<!--begin:: Widgets/Stats-->
						

						<!--end:: Widgets/Stats-->

						<div class="m-portlet m-portlet--mobile">
							<div class="m-portlet__body">

								<!--begin: Datatable -->
								<table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_2">
									<thead>
										<tr>
											<th>No</th>
											<th>EVCS</th>
											<th>Connector</th>
											<th>Time</th>
											<th>Consumption (kWh)</th>
											<th>Duration</th>
											<th>Charging Cost (IDR)</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 0; ?>
										@foreach($transaction as $this_transaction)
											<?php
												$i++;
											?>
											<tr>
												<td>{{ $i }}</td>
												<td>{{ $this_transaction->NAME }}</td>
												<td>{{ $this_transaction->CONNECTOR_NAME }}</td>
												<td>{{ $this_transaction->START_TIMESTAMP_GMT7 }}</td>
												<td>{{ number_format($this_transaction->ENERGY_CONSUMPTION,2) }}</td>
												<td>{{ $this_transaction->DURATION }}</td>
												<td>{{ number_format($this_transaction->ENERGY_COST) }}</td>
												<td nowrap><a href="detail/{{ $this_transaction->TRANSACTION_PK }}" class="btn btn-warning btn-sm" style="width:100%;">Detail</a></td>
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
