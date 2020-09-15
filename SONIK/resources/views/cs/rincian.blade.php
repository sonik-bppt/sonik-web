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

				@include('cs.include_left_aside')

				<div class="m-grid__item m-grid__item--fluid m-wrapper">

					@foreach($cs as $this_cs)
					<form action="../update_existing_cs" method="post">

						{{ csrf_field() }}

						<!-- BEGIN: Subheader -->
						<div class="m-subheader ">
							<div class="d-flex align-items-center">
								<div class="mr-auto">
									<h3 class="m-subheader__title">{{ $this_cs->NAME }}</h3>
								</div>
								<div>
									<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
										<a href="#" class="btn btn-danger" style="margin-right:15px;width:100px;" data-toggle="modal" data-target="#modal_delete">Delete</a>

                                        <a href="../view" class="btn btn-primary" style="width:100px;">Reset</a>

                                        <div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLongTitle">Delete confirmation</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<p>Are you sure to delete this data? Please note that this action <strong>can not be undone</strong>.</p>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
														<a class="btn btn-danger" href="../delete/{{ $this_cs->ID }}">Yes, delete this data</a>
													</div>
												</div>
											</div>
										</div>



										<input type="submit" value="Save" class="btn btn-primary" style="margin-right:15px;width:100px;" />



									</div>
								</div>
							</div>
						</div>

						<!-- END: Subheader -->
						<div class="m-content">

							<div class="row">
								<div class="col-md-6">
									<!--begin::Portlet-->
									<div class="m-portlet m-portlet--tab">
										<div class="m-portlet__head">
											<div class="m-portlet__head-caption">
												<div class="m-portlet__head-title">
													<span class="m-portlet__head-icon m--hide">
														<i class="la la-gear"></i>
													</span>
													<h3 class="m-portlet__head-text">
														Device Detail
													</h3>
												</div>
											</div>
										</div>

										<!--begin::Form-->

										<div class="m-portlet__body">
											<div class="form-group m-form__group" style="padding-left:0;">
												<label for="exampleInputEmail1">Name</label>
												<input type="text" id="inputName" class="form-control m-input m-input--square" placeholder="Example: Charging Station 1 BPPT Thamrin" name="textName" value="{{ $this_cs->NAME }}" required >
											</div>
											<div class="form-group m-form__group" style="padding-left:0;">
												<label for="exampleInputEmail1">Charge Box ID</label>
												<input type="text" id="inputUsername" class="form-control m-input m-input--square" placeholder="Example: 123-456-789" name="textDeviceID" value="{{ $this_cs->CHARGE_BOX_ID }}" disabled >
											</div>
											<div class="form-group m-form__group" style="padding-left:0;">
												<label for="exampleInputEmail1">Endpoint Address</label>
												<input type="text" id="inputUsername" class="form-control m-input m-input--square" placeholder="Example: 175.123.48.7"  name="textIP" value="{{ $this_cs->ENDPOINT_ADDRESS }}" disabled >
											</div>
											<div class="form-group m-form__group" style="padding-left:0;">
												<label for="exampleInputEmail1">Heartbeat Timestamp</label>
												<input type="text" id="inputUsername" class="form-control m-input m-input--square" placeholder="Example: 175.123.48.7"  name="textIP" value="{{ $this_get_evcs_detail_info->last_heartbeat_timestamp }}" disabled >
											</div>

										</div>


										<!--end::Form-->
									</div>

									<!--end::Portlet-->

									<div class="m-portlet m-portlet--tab">
										<div class="m-portlet__head">
											<div class="m-portlet__head-caption">
												<div class="m-portlet__head-title">
													<span class="m-portlet__head-icon m--hide">
														<i class="la la-gear"></i>
													</span>
													<h3 class="m-portlet__head-text">
														Charging Cost (IDR)
													</h3>
												</div>
											</div>
										</div>

										<!--begin::Form-->

										<div class="m-portlet__body">
											<div class="form-group m-form__group" style="padding-left:0;">
												<label for="exampleInputEmail1">Price per kWh</label>
												<input type="number" id="inputName" class="form-control m-input m-input--square" placeholder="Example: 400" min="0" name="numberGeneralPrice" value="{{ $this_cs->GENERAL_PRICE }}" required >
											</div>

										</div>


										<!--end::Form-->
									</div>







								</div>
								<div class="col-md-6">

									<!--begin::Portlet-->
									<div class="m-portlet m-portlet--tab">
										<div class="m-portlet__head">
											<div class="m-portlet__head-caption">
												<div class="m-portlet__head-title">
													<span class="m-portlet__head-icon m--hide">
														<i class="la la-gear"></i>
													</span>
													<h3 class="m-portlet__head-text">
														Location
													</h3>
												</div>
											</div>
										</div>

										<!--begin::Form-->

										<div class="m-portlet__body">
											<div class="form-group m-form__group" style="padding-left:0;">
												<label>Basic Example</label>

												<select class="form-control m-select2" id="m_select2_1" name="textCity" >
													<option value="">--Choose City--</option>
													@foreach( $city as $this_city )
														@if( $this_cs->CITY == $this_city->ID )
															<?php $selected_city = 'selected'; ?>
														@endif
														@if( $this_cs->CITY != $this_city->ID )
															<?php $selected_city = ''; ?>
														@endif
														<option value="{{ $this_city->ID }}" {{ $selected_city }} >{{ $this_city->CITY }}</option>
													@endforeach
												</select>

											</div>
											<div class="form-group m-form__group" style="padding-left:0;">
												<label for="exampleInputEmail1">Location Detail</label>
												<input type="text" id="inputUsername" class="form-control m-input m-input--square" placeholder="Example: UOB Tower Parking Lot" name="textLocation" value="{{ $this_cs->LOCATION }}" required >
											</div>
											<div class="form-group m-form__group" style="padding-left:0;">
												<label for="exampleInputEmail1">Latitude</label>
												<input type="text" id="inputUsername" class="form-control m-input m-input--square" placeholder="Example: -6.654233" name="textLatitude" value="{{ $this_cs->LATITUDE }}" required >
											</div>
											<div class="form-group m-form__group" style="padding-left:0;">
												<label for="exampleInputEmail1">Longitude</label>
												<input type="text" id="inputUsername" class="form-control m-input m-input--square" placeholder="Example: 106.8753393" name="textLongitude" value="{{ $this_cs->LONGITUDE }}" required >
											</div>
											<div class="form-group m-form__group" style="padding-left:0;">
												<label for="exampleInputEmail1">Google map link</label>
												<input type="text" id="inputUsername" class="form-control m-input m-input--square" placeholder="Example: https://goo.gl/maps/xy6G3L2q7at9naZq6" value="{{ $this_cs->GOOGLE_MAP_LINK }}" name="textGoogleMapLink" required >
											</div>
											<div class="form-group m-form__group" style="padding-left:0;">
												<label for="exampleInputEmail1">Google Map Embed URL</label>
												<textarea class="form-control" placeholder="Paste Google Maps URL here" name="textareaGoogleMapEmbed" style="height:100px;width:100%;">{{ $this_cs->GOOGLE_EMBED_CODE }}</textarea>
											</div>

										</div>


										<!--end::Form-->
									</div>

									<!--end::Portlet-->




								</div>


							</div>



							<div class="row" style="display:none;">
								<div class="col-md-12">
									<!--begin::Portlet-->
									<div class="m-portlet m-portlet--tab">
										<div class="m-portlet__head">
											<div class="m-portlet__head-caption">
												<div class="m-portlet__head-title">
													<span class="m-portlet__head-icon m--hide">
														<i class="la la-gear"></i>
													</span>
													<h3 class="m-portlet__head-text">
														Current Connector Status
													</h3>
												</div>
											</div>
										</div>

										<!--begin::Form-->

										<div class="m-portlet__body">

											<table class="table m-table">
												<thead>
													<tr style="background:#333;color:#fff;font-weight:bold;">
														<td>Connector Name</td>
														<td>Status</td>
														<td>Error Code</td>
														<td>Error Info</td>
														<td>Status Timestamp</td>
													</tr>
												</thead>
												<tbody>
													<script>

														LoadConnectorStatus(<?php echo $this_cs->ID; ?>);

														function LoadConnectorStatus(id_cs){

															var xhttp = new XMLHttpRequest();
										                    xhttp.onreadystatechange = function() {
										                        if (this.readyState == 4 && this.status == 200) {
										                            var jsonData = JSON.parse(this.responseText);

										                            document.getElementById('dipslay_all_connector_status_evcs_id_'+id_cs).innerHTML = jsonData.CONNECTOR_INNER_DIV;

										                        }
										                        // else {
										                        //  alert("Could not connect to server. Please restart the app and try again.");
										                        // }
										                    };
										                    //xhttp.open("POST", "http://10.10.12.40:81/monitorapi/index.php", true);
										                    xhttp.open("POST", "<?php echo url('monitorapi/index.php');?>", true);
										                    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
										                    xhttp.send("module=LoadConnectorStatusByIDCS&idcs="+id_cs);


														}
													</script>
												<?php
												if( count($array_latest_status) > 1 ){
													for( $i=1;$i<count($array_latest_status);$i++ ){

														$this_connector_data = $array_latest_status[$i];

														if( $this_connector_data->status == "Available" ){
															$this_tr_class = "m-table__row--success";
														} else if( $this_connector_data->status == "Unavailable" || $this_connector_data->status == "SuspendedEV" ){
															$this_tr_class = "m-table__row--danger";
														} else {
															$this_tr_class = "m-table__row--warning";
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
														<tr class="{{ $this_tr_class }}">
															<td>{{ $connector_name }}</td>
															<td>{{ $this_connector_data->status }}</td>
															<td>{{ $this_connector_data->error_code }}</td>
															<td>{{ $this_connector_data->error_info }}</td>
															<td>{{ $this_connector_data->status_timestamp }}</td>
														</tr>
														<?php
													}
												}

												?>
												</tbody>
											</table>
										</div>


										<!--end::Form-->
									</div>

									<!--end::Portlet-->









								</div>



							</div>





							<!--Begin::Section-->
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
														<div class="m-widget1__item">
															<div class="row m-row--no-padding align-items-center">
																<div class="col">
																	<h3 class="m-widget1__title">Last Stand Meter Value</h3>
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
																	<h3 class="m-widget1__title">Current Consumption</h3>
																	<span class="m-widget1__desc">in Wh</span>
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
																	<h3 class="m-widget1__title">Status</h3>
																	<span class="m-widget1__desc">Current Status of Connector</span>
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
																	<h3 class="m-widget1__title">Status Timestamp</h3>
																	<span class="m-widget1__desc">Latest status timestamp</span>
																</div>
																<div class="col m--align-right">
																	<span class="m-widget1__number m--font-primary">
																		{{ $this_connector_data->STATUS_TIMESTAMP_GMT7 }}
																	</span>
																</div>
															</div>
														</div>
														<div class="m-widget1__item">
															<div class="row m-row--no-padding align-items-center">
																<div class="col">
																	<h3 class="m-widget1__title">Socket</h3>
																	<span class="m-widget1__desc">Alert sensor</span>
																</div>
																<div class="col m--align-right">
																	<?php
																	if( $array_socket_status[$i] == 0 ){
																		echo '<span class="m-widget1__number m--font-danger">ALERT</span>';
																	} else if( $array_socket_status[$i] == 1 ){
																		echo '<span class="m-widget1__number m--font-success">OK</span>';
																	}
																	?>
																</div>
															</div>
														</div>
														<div class="m-widget1__item">
															<div class="row m-row--no-padding align-items-center">
																<div class="col">
																	<h3 class="m-widget1__title">Leakage Sensor</h3>
																	<span class="m-widget1__desc">Alert sensor</span>
																</div>
																<div class="col m--align-right">
																	<?php
																	if( $array_leackage_status[$i] == 0 ){
																		echo '<span class="m-widget1__number m--font-danger">ALERT</span>';
																	} else if( $array_leackage_status[$i] == 1 ){
																		echo '<span class="m-widget1__number m--font-success">OK</span>';
																	}
																	?>
																</div>
															</div>
														</div>
														<div class="m-widget1__item">
															<div class="row m-row--no-padding align-items-center">
																<div class="col">
																	<h3 class="m-widget1__title">MCB Protection</h3>
																	<span class="m-widget1__desc">Alert sensor</span>
																</div>
																<div class="col m--align-right">
																	<?php
																	if( $array_mcb_status[$i] == 0 ){
																		echo '<span class="m-widget1__number m--font-danger">ALERT</span>';
																	} else if( $array_mcb_status[$i] == 1 ){
																		echo '<span class="m-widget1__number m--font-success">OK</span>';
																	}
																	?>
																</div>
															</div>
														</div>
														<div class="m-widget1__item">
															<div class="row m-row--no-padding align-items-center">
																<div class="col">
																	<h3 class="m-widget1__title">Grounding System</h3>
																	<span class="m-widget1__desc">Alert sensor</span>
																</div>
																<div class="col m--align-right">
																	<?php
																	if( $array_grounding_status[$i] == 0 ){
																		echo '<span class="m-widget1__number m--font-danger">ALERT</span>';
																	} else if( $array_grounding_status[$i] == 1 ){
																		echo '<span class="m-widget1__number m--font-success">OK</span>';
																	}
																	?>
																</div>
															</div>
														</div>
														<div class="m-widget1__item">
															<div class="row m-row--no-padding align-items-center">
																<div class="col">
																	<h3 class="m-widget1__title">Tempered Door Protection</h3>
																	<span class="m-widget1__desc">Alert sensor</span>
																</div>
																<div class="col m--align-right">
																	<?php
																	if( $array_tempered_door_status[$i] == 0 ){
																		echo '<span class="m-widget1__number m--font-danger">ALERT</span>';
																	} else if( $array_tempered_door_status[$i] == 1 ){
																		echo '<span class="m-widget1__number m--font-success">OK</span>';
																	}
																	?>
																</div>
															</div>
														</div>
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









							<div class="row" style="display:none;">
								<div class="col-md-12">

									<!--begin:: Widgets/Sale Reports-->
									<div class="m-portlet m-portlet--full-height ">
										<div class="m-portlet__head">
											<div class="m-portlet__head-caption">
												<div class="m-portlet__head-title">
													<h3 class="m-portlet__head-text">
														Alert History
													</h3>
												</div>
											</div>
											<div class="m-portlet__head-tools">
												<ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">

													<li class="nav-item m-tabs__item">
														<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_widget11_tab1_content" role="tab">
															connector 1
														</a>
													</li>
													<li class="nav-item m-tabs__item">
														<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget11_tab2_content" role="tab">
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
																		<td class="m-widget11__label">#</td>
																		<td class="m-widget11__app">Application</td>
																		<td class="m-widget11__sales">Sales</td>
																		<td class="m-widget11__price">Avg Price</td>
																		<td class="m-widget11__total m--align-right">Total</td>
																	</tr>
																</thead>

																<!--end::Thead-->

																<!--begin::Tbody-->
																<tbody>
																	<tr>
																		<td>
																			<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
																				<input type="checkbox"><span></span>
																			</label>
																		</td>
																		<td>
																			<span class="m-widget11__title">Vertex 2.0</span>
																			<span class="m-widget11__sub">Vertex To By Again</span>
																		</td>
																		<td>19,200</td>
																		<td>$63</td>
																		<td class="m--align-right m--font-brand">$14,740</td>
																	</tr>
																	<tr>
																		<td>
																			<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand"><input type="checkbox"><span></span></label>
																		</td>
																		<td>
																			<span class="m-widget11__title">Metronic</span>
																			<span class="m-widget11__sub">Powerful Admin Theme</span>
																		</td>
																		<td>24,310</td>
																		<td>$39</td>
																		<td class="m--align-right m--font-brand">$16,010</td>
																	</tr>
																	<tr>
																		<td>
																			<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand"><input type="checkbox"><span></span></label>
																		</td>
																		<td>
																			<span class="m-widget11__title">Apex</span>
																			<span class="m-widget11__sub">The Best Selling App</span>
																		</td>
																		<td>9,076</td>
																		<td>$105</td>
																		<td class="m--align-right m--font-brand">$37,200</td>
																	</tr>
																	<tr>
																		<td>
																			<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand"><input type="checkbox"><span></span></label>
																		</td>
																		<td>
																			<span class="m-widget11__title">Cascades</span>
																			<span class="m-widget11__sub">Design Tool</span>
																		</td>
																		<td>11,094</td>
																		<td>$16</td>
																		<td class="m--align-right m--font-brand">$8,520</td>
																	</tr>
																</tbody>

																<!--end::Tbody-->
															</table>

															<!--end::Table-->
														</div>
														<div class="m-widget11__action m--align-right">
															<button type="button" class="btn m-btn--pill btn-outline-brand m-btn m-btn--custom">Import Report</button>
														</div>
													</div>

													<!--end::Widget 11-->
												</div>

												<!--end::tab 1 content-->

												<!--begin::tab 2 content-->
												<div class="tab-pane" id="m_widget11_tab2_content">

													<!--begin::Widget 11-->
													<div class="m-widget11">
														<div class="table-responsive">

															<!--begin::Table-->
															<table class="table">

																<!--begin::Thead-->
																<thead>
																	<tr>
																		<td class="m-widget11__label">#</td>
																		<td class="m-widget11__app">Application</td>
																		<td class="m-widget11__sales">Sales</td>
																		<td class="m-widget11__change">Change</td>
																		<td class="m-widget11__price">Avg Price</td>
																		<td class="m-widget11__total m--align-right">Total</td>
																	</tr>
																</thead>

																<!--end::Thead-->

																<!--begin::Tbody-->
																<tbody>
																	<tr>
																		<td>
																			<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
																				<input type="checkbox"><span></span>
																			</label>
																		</td>
																		<td>
																			<span class="m-widget11__title">Loop</span>
																			<span class="m-widget11__sub">CRM System</span>
																		</td>
																		<td>19,200</td>
																		<td>$63</td>
																		<td>$11,300</td>
																		<td class="m--align-right m--font-brand">$34,740</td>
																	</tr>
																	<tr>
																		<td>
																			<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand"><input type="checkbox"><span></span></label>
																		</td>
																		<td>
																			<span class="m-widget11__title">Selto</span>
																			<span class="m-widget11__sub">Powerful Website Builder</span>
																		</td>
																		<td>24,310</td>
																		<td>$39</td>
																		<td>$14,700</td>
																		<td class="m--align-right m--font-brand">$46,010</td>
																	</tr>
																	<tr>
																		<td>
																			<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand"><input type="checkbox"><span></span></label>
																		</td>
																		<td>
																			<span class="m-widget11__title">Jippo</span>
																			<span class="m-widget11__sub">The Best Selling App</span>
																		</td>
																		<td>9,076</td>
																		<td>$105</td>
																		<td>$8,400</td>
																		<td class="m--align-right m--font-brand">$67,800</td>
																	</tr>
																	<tr>
																		<td>
																			<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand"><input type="checkbox"><span></span></label>
																		</td>
																		<td>
																			<span class="m-widget11__title">Verto</span>
																			<span class="m-widget11__sub">Web Development Tool</span>
																		</td>
																		<td>11,094</td>
																		<td>$16</td>
																		<td>$12,500</td>
																		<td class="m--align-right m--font-brand">$18,520</td>
																	</tr>
																</tbody>

																<!--end::Tbody-->
															</table>

															<!--end::Table-->
														</div>
														<div class="m-widget11__action m--align-right">
															<button type="button" class="btn m-btn--pill btn-outline-brand m-btn m-btn--custom">Generate Report</button>
														</div>
													</div>

													<!--end::Widget 11-->
												</div>

												<!--end::tab 2 content-->

												<!--begin::tab 3 content-->
												<div class="tab-pane" id="m_widget11_tab3_content">
												</div>

												<!--end::tab 3 content-->
											</div>

											<!--End::Tab Content-->
										</div>
									</div>

									<!--end:: Widgets/Sale Reports-->
								</div>




							</div>






						</div>
						<input type="hidden" name="currentID" value="{{ $this_cs->ID }}" />
					</form>
					@endforeach
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
