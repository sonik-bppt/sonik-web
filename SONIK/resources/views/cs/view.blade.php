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
                                <h1 class="m-subheader__title">Charging Station</h1>
							</div>
							<div>
								<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
									<a href="add" class="btn btn-primary" style="margin-right:15px;">Add New Charging Station</a>

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
                        <div class="row">
                            <!--begin:: Widgets/Stats-->
                            <div class="col-xl-4">
                                <!--Number of usage-->
                                <div class="m-portlet m-portlet--bordered-semi m-portlet--space m-portlet--full-height ">
                                    <div class="m-portlet__body">
                                        <div class="m-widget25">
                                            <span class="m-widget25__price m--font-brand"> {{ number_format($cs_lifetime) }}</span><br>
                                            <span class="m-widget25__desc">Registered EVCS</span>
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
                                            <span class="m-widget25__price m--font-brand"> {{ number_format($cs_connected) }}</span><br>
                                            <span class="m-widget25__desc">Connected EVCS</span>
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
                                            <span class="m-widget25__price m--font-brand"> {{ number_format($cs_operational) }}</span><br>
                                            <span class="m-widget25__desc">Fully Functional EVCS</span>
                                        </div>
                                    </div>
                                </div>

                                <!--end:: Widgets/Product Sales-->
                            </div>
                        </div>


						<!--end:: Widgets/Stats-->

						<div class="m-portlet m-portlet--mobile">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											Charging Station Master Data
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
											<th>Chargebox ID</th>
											<th>Endpoint Address</th>
											<th>City</th>
											<!-- <th>Location</th> -->
											<th>Fetch</th>
											<th>Last Heartbeat</th>
											<th>Overall Sensor Status</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
										@foreach($cs as $this_cs)
											<?php
											$this_status = $this_cs->OVERALL_STATUS;

											if( $this_status == 1 ){
												$display_badge = '<span style="width:100%;" class="m-badge  m-badge--success m-badge--wide">OK</span>';
											} else if( $this_status == 0 ){
												$display_badge = '<span style="width:100%;" class="m-badge  m-badge--danger m-badge--wide">Alert</span>';
											}

											if( $this_cs->CHARGE_POINT_MODEL == '' ){
												$fetching_badge = '<span style="width:100%;" class="m-badge  m-badge--warning m-badge--wide">Fetching</span>';
											} else{
												$fetching_badge = '<span style="width:100%;" class="m-badge  m-badge--success m-badge--wide">Connected</span>';
											}
											?>
											<tr>
												<td>{{ $this_cs->ID }}</td>
												<td>{{ $this_cs->NAME }}</td>
												<td>{{ $this_cs->CHARGE_BOX_ID }}</td>
												<td>{{ $this_cs->ENDPOINT_ADDRESS }}</td>
												<td>{{ $this_cs->CITY }}</td>
												<!-- <td>{{ $this_cs->LOCATION }}</td> -->
												<td>{!! $fetching_badge !!}</td>
												<td>{{ $this_cs->LAST_HEARTBEAT_TIMESTAMP_GMT7 }}</td>
												<td><?php echo $display_badge;?></td>
												<td nowrap><a href="detail/{{ $this_cs->ID }}" class="btn btn-warning btn-sm" style="width:100%;">Detail</a></td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>






						<div class="row">
							<div class="col-lg-6">

								<!--begin::Portlet-->
								<div class="m-portlet m-portlet--mobile m-portlet--body-progress-">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													EVCS Location in Jabodetabek
												</h3>
											</div>
										</div>
									</div>
									<div class="m-portlet__body" style="padding:0;">
										<iframe src="https://www.google.com/maps/d/u/0/embed?mid=13N0_X9lwp_XMDge4XpuPchsgWVy6nXbu" width="100%" height="480"></iframe>
									</div>
								</div>

								<!--end::Portlet-->



							</div>
							<div class="col-lg-6">

								<!--begin::Portlet-->
								<div class="m-portlet m-portlet--mobile m-portlet--body-progress-">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													EVCS Location in Bandung
												</h3>
											</div>
										</div>
									</div>
									<div class="m-portlet__body" style="padding:0;">
										<iframe src="https://www.google.com/maps/d/u/0/embed?mid=1ZbxePQN_ozSps6m9-Sca2ym1_7B74fkW" width="100%" height="480"></iframe>
									</div>
								</div>

								<!--end::Portlet-->


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
