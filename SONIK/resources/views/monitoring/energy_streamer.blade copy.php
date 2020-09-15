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

							<div class="col-xl-12">
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
											<tbody>
												@foreach( $transaction as $this_transaction )
												<tr>
													<td>{{ $this_transaction->TRANSACTION_PK }}</td>
													<td>{{ $this_transaction->EVCS_NAME }}</td>
													<td>{{ $this_transaction->CONNECTOR_NAME }}</td>
													<td>{{ $this_transaction->START_TIMESTAMP_GMT7 }}</td>
													<td><a href="energy_streamer/detail/{{ $this_transaction->TRANSACTION_PK }}" class="btn btn-warning btn-sm" style="width:100%;">Detail</a></td>
												</tr>
												@endforeach
												
											</tbody>
										</table>
									</div>
								</div>
							</div>
							
							
							<!--Begin::Trends -->
							<div class="col-xl-6" style="float:left;display:none;">


								<!--begin:: Widgets/Top Products-->
								<div class="m-portlet m-portlet--bordered-semi m-portlet--full-height ">
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
													<span class="m-widget4__number m--font-danger">550</span>
												</span>
											</div>
											<div class="m-widget4__item">
												<div class="m-widget4__info">
													<span class="m-widget4__title">
														Duration
													</span><br>
													<span class="m-widget4__sub">
														Time duration
													</span>
												</div>
												<span class="m-widget4__ext">
													<span class="m-widget4__number m--font-danger">01:22</span>
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
													<span class="m-widget4__number m--font-danger">12000</span>
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
		

		
	</body>

	<!-- end::Body -->
</html>