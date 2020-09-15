@foreach($customer as $this_customer)
	<?php 
		$this_customer = $this_customer; 
	?>
@endforeach
<!DOCTYPE html>
<html lang="en">

	@include('include.include_head')

	<style>
		.m-timeline-3 .m-timeline-3__item:before{
			left:12.1rem;
		}
		.m-timeline-3 .m-timeline-3__item .m-timeline-3__item-desc{
			padding-left:13rem;
		}
		.m-timeline-3 .m-timeline-3__item .m-timeline-3__item-time{
			font-size:1.2rem!important;
		}
	</style>

	<!-- begin::Body -->
	<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-light m-aside-left--fixed m-aside-left--offcanvas m-aside-left--minimize m-brand--minimize m-footer--push m-aside--offcanvas-default">

		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">

			@include('include.include_header')

			<!-- begin::Body -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

				@include('customer.include_left_aside')
				
				<div class="m-grid__item m-grid__item--fluid m-wrapper">
					
					<form action="../update_existing_customer" method="post" class="m-form m-form--fit m-form--label-align-right">
						{{ csrf_field() }}
						<!-- BEGIN: Subheader -->
						<div class="m-subheader ">
							<div class="d-flex align-items-center">
								<div class="mr-auto">
									<h3 class="m-subheader__title m-subheader__title--separator">Customer Management</h3>
									<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
										<li class="m-nav__item m-nav__item--home">
											<a class="m-nav__link m-nav__link--icon">
												<i class="m-nav__link-icon la la-home"></i>
											</a>
										</li>
										<li class="m-nav__separator">-</li>
										<li class="m-nav__item">
											<a class="m-nav__link">
												<span class="m-nav__link-text">Customer</span>
											</a>
										</li>
										<li class="m-nav__separator">-</li>
										<li class="m-nav__item">
											<a class="m-nav__link">
												<span class="m-nav__link-text">Customer Detail</span>
											</a>
										</li>
									</ul>
								</div>
								<div>
									<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" aria-expanded="true">

										@if( $current_status_tag == 1 )
											<a href="{{ $this_customer->ID }}/BlockIDTag/{{ $this_customer->ID_TAG }}" class="btn btn-danger" style="margin-right:15px;width:100px;">Block Tag</a>
										@endif
										@if( $current_status_tag == 0 )
											<a href="{{ $this_customer->ID }}/OpenIDTag/{{ $this_customer->ID_TAG }}" class="btn btn-success" style="margin-right:15px;width:100px;">Open Tag</a>
										@endif
										
										<input type="submit" value="Update" class="btn btn-primary" style="margin-right:15px;width:100px;" />
										
										<a href="../view" class="btn btn-secondary" style="width:100px;">Back</a>
										
									</div>
								</div>
							</div>
						</div>

						<!-- END: Subheader -->
						@foreach($customer as $this_customer)
						<div class="m-content">
							<div class="row">
								<div class="col-xl-3 col-lg-4">
									<div class="m-portlet m-portlet--full-height  ">
										<div class="m-portlet__body">
											<div class="m-card-profile">
												<div class="m-card-profile__title m--hide">
													Your Profile
												</div>
												<div class="m-card-profile__pic">
													<div class="m-card-profile__pic-wrapper">
														<img src="{{ asset('media/system/default_avatar.png') }}" alt="" />
													</div>
												</div>
												<div class="m-card-profile__details">
													<span class="m-card-profile__name">{{ $this_customer->NAME }}</span>
													<a href="" class="m-card-profile__email m-link">{{ $this_customer->EMAIL }}</a>
												</div>
											</div>
											<ul class="m-nav m-nav--hover-bg m-portlet-fit--sides" style="display:none;">
												<li class="m-nav__separator m-nav__separator--fit"></li>
												<li class="m-nav__section m--hide">
													<span class="m-nav__section-text">Section</span>
												</li>
												<li class="m-nav__item">
													<a href="#" class="m-nav__link">
														<i class="m-nav__link-icon flaticon-profile-1"></i>
														<span class="m-nav__link-title">My Profile</span>
													</a>
												</li>
												<li class="m-nav__item">
													<a href="#" class="m-nav__link">
														<i class="m-nav__link-icon flaticon-share"></i>
														<span class="m-nav__link-title">
															<span class="m-nav__link-wrap">
																<span class="m-nav__link-text">Activity</span>
																<span class="m-nav__link-badge"><span class="m-badge m-badge--success">3</span></span>
															</span>
														</span>
													</a>
												</li>
												<li class="m-nav__item">
													<a href="#" class="m-nav__link">
														<i class="m-nav__link-icon flaticon-graphic-2"></i>
														<span class="m-nav__link-title">
															<span class="m-nav__link-wrap">
																<span class="m-nav__link-text">Transaction</span>
																<span class="m-nav__link-badge"><span class="m-badge m-badge--success">1</span></span>
															</span>
														</span>
													</a>
												</li>
											</ul>
											<div class="m-portlet__body-separator"></div>
											<div class="m-widget1 m-widget1--paddingless">
												<div class="m-widget1__item">
													<div class="row m-row--no-padding align-items-center">
														<div class="col">
															<h3 class="m-widget1__title">Credit</h3>
															<span class="m-widget1__desc">Current available credit</span>
														</div>
														<div class="col m--align-right">
															<span class="m-widget1__number m--font-brand">IDR {{ number_format($this_customer->SALDO) }}</span>
														</div>
													</div>
												</div>
												<div class="m-widget1__item">
													<div class="row m-row--no-padding align-items-center">
														<div class="col">
															<h3 class="m-widget1__title">Energy Consumption</h3>
															<span class="m-widget1__desc">Total number energy consumption (kW)</span>
														</div>
														<div class="col m--align-right">
															<span class="m-widget1__number m--font-danger">{{ number_format(($total_energy_consumed/1000),2) }}</span>
														</div>
													</div>
												</div>
												<div class="m-widget1__item">
													<div class="row m-row--no-padding align-items-center">
														<div class="col">
															<h3 class="m-widget1__title">Charge</h3>
															<span class="m-widget1__desc">Total number of charging</span>
														</div>
														<div class="col m--align-right">
															<span class="m-widget1__number m--font-success">{{ number_format($number_of_transaction) }}</span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-9 col-lg-8">
									<div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
										<div class="m-portlet__head">
											<div class="m-portlet__head-tools">
												<ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
													<li class="nav-item m-tabs__item">
														<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_user_profile_tab_1" role="tab">
															<i class="flaticon-share m--hide"></i>
															Update Profile
														</a>
													</li>
													<li class="nav-item m-tabs__item">
														<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_2" role="tab">
															Activity Log
														</a>
													</li>
													<li class="nav-item m-tabs__item" style="display:none;">
														<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_3" role="tab">
															Transaction
														</a>
													</li>
												</ul>
											</div>
										</div>
										<div class="tab-content">
											<div class="tab-pane active" id="m_user_profile_tab_1">
												
												
												<div class="m-portlet__body">
													<div class="form-group m-form__group m--margin-top-10 m--hide">
														<div class="alert m-alert m-alert--default" role="alert">
															The example form below demonstrates common HTML form elements that receive updated styles from Bootstrap with additional classes.
														</div>
													</div>
													<div class="form-group m-form__group row">
														<div class="col-10 ml-auto">
															<h3 class="m-form__section">1. Personal Details</h3>
														</div>
													</div>
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-2 col-form-label">Full Name</label>
														<div class="col-7">
															<input class="form-control m-input" type="text" value="{{ $this_customer->NAME }}" name="name">
														</div>
													</div>
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-2 col-form-label">Email</label>
														<div class="col-7">
															<input class="form-control m-input" type="email" value="{{ $this_customer->EMAIL }}" name="email">
														</div>
													</div>
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-2 col-form-label">Phone No.</label>
														<div class="col-7">
															<input class="form-control m-input" type="text" value="{{ $this_customer->PHONE_NUMBER }}" name="phone_number">
														</div>
													</div>
													<div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
													<div class="form-group m-form__group row">
														<div class="col-10 ml-auto">
															<h3 class="m-form__section">2. Address</h3>
														</div>
													</div>
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-2 col-form-label">Address</label>
														<div class="col-7">
															<input class="form-control m-input" type="text" value="{{ $this_customer->ADDRESS }}" name="address">
														</div>
													</div>
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-2 col-form-label">City</label>
														<div class="col-7">
															<select class="form-control m-select2" id="m_select2_1" name="city" >
																<option value="">--Choose City--</option>
																@foreach( $city as $this_city )
																	<?php
																	if( $this_city->ID == $this_customer->CITY ){
																		$selected_city = ' selected ';
																	} else {
																		$selected_city = '';
																	}
																	?>
																	<option value="{{ $this_city->ID }}" {{ $selected_city }}>{{ $this_city->CITY }}</option>
																@endforeach
															</select>
														</div>
													</div>
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-2 col-form-label">Postcode</label>
														<div class="col-7">
															<input class="form-control m-input" type="text" value="{{ $this_customer->POSTAL_CODE }}" name="postal_code">
														</div>
													</div>
													<div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
													<div class="form-group m-form__group row">
														<div class="col-10 ml-auto">
															<h3 class="m-form__section">3. Access Privillege</h3>
														</div>
													</div>
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-2 col-form-label">ID Tag</label>
														<div class="col-7">
															<input class="form-control m-input" type="text" value="{{ $this_customer->ID_TAG }}" name="id_tag">
															<input type="hidden" name="current_id_tag" value="{{ $this_customer->ID_TAG }}" />
														</div>
													</div>
												</div>
	
											</div>
											<div class="tab-pane " id="m_user_profile_tab_2">
											
													
												<div class="m-portlet__body">
													<div class="m-scrollable">
			
														<div class="m-timeline-3">
															<div class="m-timeline-3__items">

																@foreach( $activity_list as $this_activity_list )
																	<div class="m-timeline-3__item m-timeline-3__item--info">
																		<span class="m-timeline-3__item-time" style="width:11.57rem!important;">{{ $this_activity_list->EVENT_TIMESTAMP_GMT7 }}</span>
																		<div class="m-timeline-3__item-desc">
																			<span class="m-timeline-3__item-text">
																				{{ $this_activity_list->NAME }} with ID TAG: {{ $this_activity_list->ID_TAG }}
																			</span><br>
																			<span class="m-timeline-3__item-user-name">
																				<a href="#" class="m-link m-link--metal m-timeline-3__item-link">
																					By System
																				</a>
																			</span>
																		</div>
																	</div>	
																@endforeach

																
															</div>
														</div>
		
	
	
	
													</div>
												</div>
	
											
											</div>
											<div class="tab-pane " id="m_user_profile_tab_3">
											
																							<div class="m-portlet__body">
													<div class="m-scrollable">
			
														<div class="m-timeline-3">
															<div class="m-timeline-3__items">
																<div class="m-timeline-3__item m-timeline-3__item--info">
																	<span class="m-timeline-3__item-time">09:00</span>
																	<div class="m-timeline-3__item-desc">
																		<span class="m-timeline-3__item-text">
																			Top up credit: IDR 950.000
																		</span><br>
																		<span class="m-timeline-3__item-user-name">
																			<a href="#" class="m-link m-link--metal m-timeline-3__item-link">
																				By Administrator
																			</a>
																		</span>
																	</div>
																</div>
																<div class="m-timeline-3__item m-timeline-3__item--warning">
																	<span class="m-timeline-3__item-time">10:00</span>
																	<div class="m-timeline-3__item-desc">
																		<span class="m-timeline-3__item-text">
																			Charging Fee (Transaction #1425): IDR 25.000
																		</span><br>
																		<span class="m-timeline-3__item-user-name">
																			<a href="#" class="m-link m-link--metal m-timeline-3__item-link">
																				By Administrator
																			</a>
																		</span>
																	</div>
																</div>
																<div class="m-timeline-3__item m-timeline-3__item--brand">
																	<span class="m-timeline-3__item-time">11:00</span>
																	<div class="m-timeline-3__item-desc">
																		<span class="m-timeline-3__item-text">
																			Lorem ipsum dolor sit amit eiusmdd tempor
																		</span><br>
																		<span class="m-timeline-3__item-user-name">
																			<a href="#" class="m-link m-link--metal m-timeline-3__item-link">
																				By Administrator
																			</a>
																		</span>
																	</div>
																</div>
																<div class="m-timeline-3__item m-timeline-3__item--success">
																	<span class="m-timeline-3__item-time">12:00</span>
																	<div class="m-timeline-3__item-desc">
																		<span class="m-timeline-3__item-text">
																			Lorem ipsum dolor
																		</span><br>
																		<span class="m-timeline-3__item-user-name">
																			<a href="#" class="m-link m-link--metal m-timeline-3__item-link">
																				By Administrator
																			</a>
																		</span>
																	</div>
																</div>
																<div class="m-timeline-3__item m-timeline-3__item--danger">
																	<span class="m-timeline-3__item-time">14:00</span>
																	<div class="m-timeline-3__item-desc">
																		<span class="m-timeline-3__item-text">
																			Lorem ipsum dolor sit amit,consectetur eiusmdd
																		</span><br>
																		<span class="m-timeline-3__item-user-name">
																			<a href="#" class="m-link m-link--metal m-timeline-3__item-link">
																				By Administrator
																			</a>
																		</span>
																	</div>
																</div>
																<div class="m-timeline-3__item m-timeline-3__item--info">
																	<span class="m-timeline-3__item-time">15:00</span>
																	<div class="m-timeline-3__item-desc">
																		<span class="m-timeline-3__item-text">
																			Lorem ipsum dolor sit amit,consectetur
																		</span><br>
																		<span class="m-timeline-3__item-user-name">
																			<a href="#" class="m-link m-link--metal m-timeline-3__item-link">
																				By Administrator
																			</a>
																		</span>
																	</div>
																</div>
																<div class="m-timeline-3__item m-timeline-3__item--brand">
																	<span class="m-timeline-3__item-time">17:00</span>
																	<div class="m-timeline-3__item-desc">
																		<span class="m-timeline-3__item-text">
																			Lorem ipsum dolor sit consectetur eiusmdd tempor
																		</span><br>
																		<span class="m-timeline-3__item-user-name">
																			<a href="#" class="m-link m-link--metal m-timeline-3__item-link">
																				By Administrator
																			</a>
																		</span>
																	</div>
																</div>
																<div class="m-timeline-3__item m-timeline-3__item--brand">
																	<span class="m-timeline-3__item-time">18:00</span>
																	<div class="m-timeline-3__item-desc">
																		<span class="m-timeline-3__item-text">
																			Lorem ipsum dolor sit consectetur eiusmdd tempor
																		</span><br>
																		<span class="m-timeline-3__item-user-name">
																			<a href="#" class="m-link m-link--metal m-timeline-3__item-link">
																				By Administrator
																			</a>
																		</span>
																	</div>
																</div>
																<div class="m-timeline-3__item m-timeline-3__item--brand">
																	<span class="m-timeline-3__item-time">19:00</span>
																	<div class="m-timeline-3__item-desc">
																		<span class="m-timeline-3__item-text">
																			Lorem ipsum dolor sit consectetur eiusmdd tempor
																		</span><br>
																		<span class="m-timeline-3__item-user-name">
																			<a href="#" class="m-link m-link--metal m-timeline-3__item-link">
																				By Administrator
																			</a>
																		</span>
																	</div>
																</div>
																<div class="m-timeline-3__item m-timeline-3__item--brand">
																	<span class="m-timeline-3__item-time">20:00</span>
																	<div class="m-timeline-3__item-desc">
																		<span class="m-timeline-3__item-text">
																			Lorem ipsum dolor sit consectetur eiusmdd tempor
																		</span><br>
																		<span class="m-timeline-3__item-user-name">
																			<a href="#" class="m-link m-link--metal m-timeline-3__item-link">
																				By Administrator
																			</a>
																		</span>
																	</div>
																</div>
																<div class="m-timeline-3__item m-timeline-3__item--brand">
																	<span class="m-timeline-3__item-time">21:00</span>
																	<div class="m-timeline-3__item-desc">
																		<span class="m-timeline-3__item-text">
																			Lorem ipsum dolor sit consectetur eiusmdd tempor
																		</span><br>
																		<span class="m-timeline-3__item-user-name">
																			<a href="#" class="m-link m-link--metal m-timeline-3__item-link">
																				By Administrator
																			</a>
																		</span>
																	</div>
																</div>
																<div class="m-timeline-3__item m-timeline-3__item--brand">
																	<span class="m-timeline-3__item-time">22:00</span>
																	<div class="m-timeline-3__item-desc">
																		<span class="m-timeline-3__item-text">
																			Lorem ipsum dolor sit consectetur eiusmdd tempor
																		</span><br>
																		<span class="m-timeline-3__item-user-name">
																			<a href="#" class="m-link m-link--metal m-timeline-3__item-link">
																				By Administrator
																			</a>
																		</span>
																	</div>
																</div>
																<div class="m-timeline-3__item m-timeline-3__item--brand">
																	<span class="m-timeline-3__item-time">23:00</span>
																	<div class="m-timeline-3__item-desc">
																		<span class="m-timeline-3__item-text">
																			Lorem ipsum dolor sit consectetur eiusmdd tempor
																		</span><br>
																		<span class="m-timeline-3__item-user-name">
																			<a href="#" class="m-link m-link--metal m-timeline-3__item-link">
																				By Administrator
																			</a>
																		</span>
																	</div>
																</div>
															</div>
														</div>
		
	
	
	
													</div>
												</div>
	
											
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<input type="hidden" name="currentID" value="{{ $this_customer->ID }}" />
					
						@endforeach
					</form>
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
			var Select2 = function() {
			    //== Private functions
			    var demos = function() {
			        // basic
			        $('#m_select2_1, #m_select2_1_validate').select2({
			            placeholder: "Please choose a city"
			        });

			        // nested
			        $('#m_select2_2, #m_select2_2_validate').select2({
			            placeholder: "Please choose a city"
			        });

			        // multi select
			        $('#m_select2_3, #m_select2_3_validate').select2({
			            placeholder: "Please choose a city",
			        });

			        // basic
			        $('#m_select2_4').select2({
			            placeholder: "Please choose a city",
			            allowClear: true
			        });

			        // loading data from array
			        var data = [{
			            id: 0,
			            text: 'Enhancement'
			        }, {
			            id: 1,
			            text: 'Bug'
			        }, {
			            id: 2,
			            text: 'Duplicate'
			        }, {
			            id: 3,
			            text: 'Invalid'
			        }, {
			            id: 4,
			            text: 'Wontfix'
			        }];

			        $('#m_select2_5').select2({
			            placeholder: "Select a value",
			            data: data
			        });

			        // loading remote data

			        function formatRepo(repo) {
			            if (repo.loading) return repo.text;
			            var markup = "<div class='select2-result-repository clearfix'>" +
			                "<div class='select2-result-repository__meta'>" +
			                "<div class='select2-result-repository__title'>" + repo.full_name + "</div>";
			            if (repo.description) {
			                markup += "<div class='select2-result-repository__description'>" + repo.description + "</div>";
			            }
			            markup += "<div class='select2-result-repository__statistics'>" +
			                "<div class='select2-result-repository__forks'><i class='fa fa-flash'></i> " + repo.forks_count + " Forks</div>" +
			                "<div class='select2-result-repository__stargazers'><i class='fa fa-star'></i> " + repo.stargazers_count + " Stars</div>" +
			                "<div class='select2-result-repository__watchers'><i class='fa fa-eye'></i> " + repo.watchers_count + " Watchers</div>" +
			                "</div>" +
			                "</div></div>";
			            return markup;
			        }

			        function formatRepoSelection(repo) {
			            return repo.full_name || repo.text;
			        }

			        $("#m_select2_6").select2({
			            placeholder: "Search for git repositories",
			            allowClear: true,
			            ajax: {
			                url: "https://api.github.com/search/repositories",
			                dataType: 'json',
			                delay: 250,
			                data: function(params) {
			                    return {
			                        q: params.term, // search term
			                        page: params.page
			                    };
			                },
			                processResults: function(data, params) {
			                    // parse the results into the format expected by Select2
			                    // since we are using custom formatting functions we do not need to
			                    // alter the remote JSON data, except to indicate that infinite
			                    // scrolling can be used
			                    params.page = params.page || 1;

			                    return {
			                        results: data.items,
			                        pagination: {
			                            more: (params.page * 30) < data.total_count
			                        }
			                    };
			                },
			                cache: true
			            },
			            escapeMarkup: function(markup) {
			                return markup;
			            }, // let our custom formatter work
			            minimumInputLength: 1,
			            templateResult: formatRepo, // omitted for brevity, see the source of this page
			            templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
			        });

			        // custom styles

			        // tagging support
			        $('#m_select2_12_1, #m_select2_12_2, #m_select2_12_3, #m_select2_12_4').select2({
			            placeholder: "Select an option",
			        });

			        // disabled mode
			        $('#m_select2_7').select2({
			            placeholder: "Select an option"
			        });

			        // disabled results
			        $('#m_select2_8').select2({
			            placeholder: "Select an option"
			        });

			        // limiting the number of selections
			        $('#m_select2_9').select2({
			            placeholder: "Select an option",
			            maximumSelectionLength: 2
			        });

			        // hiding the search box
			        $('#m_select2_10').select2({
			            placeholder: "Select an option",
			            minimumResultsForSearch: Infinity
			        });

			        // tagging support
			        $('#m_select2_11').select2({
			            placeholder: "Add a tag",
			            tags: true
			        });

			        // disabled results
			        $('.m-select2-general').select2({
			            placeholder: "Select an option"
			        });
			    }

			    var modalDemos = function() {
			        $('#m_select2_modal').on('shown.bs.modal', function () {
			            // basic
			            $('#m_select2_1_modal').select2({
			                placeholder: "Please choose a city"
			            });

			            // nested
			            $('#m_select2_2_modal').select2({
			                placeholder: "Please choose a city"
			            });

			            // multi select
			            $('#m_select2_3_modal').select2({
			                placeholder: "Please choose a city",
			            });

			            // basic
			            $('#m_select2_4_modal').select2({
			                placeholder: "Please choose a city",
			                allowClear: true
			            }); 
			        });
			    }

			    //== Public functions
			    return {
			        init: function() {
			            demos();
			            modalDemos();
			        }
			    };
			}();

			//== Initialization
			jQuery(document).ready(function() {
			    Select2.init();
			});
		</script>
		
	</body>

	<!-- end::Body -->
</html>