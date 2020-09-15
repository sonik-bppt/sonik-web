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

				@include('transaction.include_left_aside')
				
				<div class="m-grid__item m-grid__item--fluid m-wrapper">
				
					<form action="save_new_cs" method="post">
				
						{{ csrf_field() }}

						<!-- BEGIN: Subheader -->
						<div class="m-subheader ">
							<div class="d-flex align-items-center">
								<div class="mr-auto">
									<h3 class="m-subheader__title m-subheader__title--separator">Transaction History</h3>
									<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
										<li class="m-nav__item m-nav__item--home">
											<a class="m-nav__link m-nav__link--icon">
												<i class="m-nav__link-icon la la-home"></i>
											</a>
										</li>
										<li class="m-nav__separator">-</li>
										<li class="m-nav__item">
											<a class="m-nav__link">
												<span class="m-nav__link-text">Transaction</span>
											</a>
										</li>
										<li class="m-nav__separator">-</li>
										<li class="m-nav__item">
											<a class="m-nav__link">
												<span class="m-nav__link-text">Detail Info</span>
											</a>
										</li>
									</ul>
								</div>
								<div>
									<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
										
										<a href="../view" class="btn btn-secondary" style="width:100px;">Back</a>
										
									</div>
								</div>
							</div>
						</div>
	

						@foreach($transaction as $this_transaction)
						<?php $this_transaction = $this_transaction; ?>
						@endforeach
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
														Transaction Detail (ID: {{ $this_transaction->TRANSACTION_PK }})
													</h3>
												</div>
											</div>
										</div>
			
										<!--begin::Form-->
									
										<div class="m-portlet__body">
											<div class="form-group m-form__group" style="padding-left:0;">
												<label for="exampleInputEmail1">Transaction Date</label>
												<input type="text" id="inputName" class="form-control m-input m-input--square" placeholder="Example: Charging Station 1 BPPT Thamrin" name="textName" disabled value="{{ $this_transaction->START_TIMESTAMP_GMT7 }}" >
											</div>
											<div class="form-group m-form__group" style="padding-left:0;">
												<label for="exampleInputEmail1">Energy Consumption (kWh)</label>
												<input type="text" id="inputUsername" class="form-control m-input m-input--square" placeholder="Example: 123-456-789" name="textChargeBoxID" disabled value="{{ number_format($this_transaction->ENERGY_CONSUMPTION,2) }}" >
											</div>
											<div class="form-group m-form__group" style="padding-left:0;">
												<label for="exampleInputEmail1">Duration (h:m:s)</label>
												<input type="text" id="inputUsername" class="form-control m-input m-input--square" placeholder="Example: 175.123.48.7"  name="textEndpointAddress" disabled value="{{ $this_transaction->DURATION }}" >
											</div>
											<div class="form-group m-form__group" style="padding-left:0;">
												<label for="exampleInputEmail1">Charging Cost (IDR)</label>
												<input type="text" id="inputUsername" class="form-control m-input m-input--square" placeholder="Example: 175.123.48.7"  name="textEndpointAddress" disabled value="{{ number_format($this_transaction->ENERGY_COST) }}" >
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
														Device Detail
													</h3>
												</div>
											</div>
										</div>
			
										<!--begin::Form-->
									
										<div class="m-portlet__body">
											<div class="form-group m-form__group" style="padding-left:0;">
												<label for="exampleInputEmail1">EVCS Name</label>
												<input type="text" id="inputName" class="form-control m-input m-input--square" placeholder="Example: 400" name="numberGeneralPrice" disabled value="{{ $this_transaction->NAME }}" >
											</div>
											<div class="form-group m-form__group" style="padding-left:0;">
												<label for="exampleInputEmail1">Connector</label>
												<input type="text" id="inputName" class="form-control m-input m-input--square" placeholder="Example: 400" name="numberGeneralPrice" disabled value="{{ $this_transaction->CONNECTOR_NAME }}" >
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
														Customer Detail
													</h3>
												</div>
											</div>
										</div>
			
										<!--begin::Form-->
									
										<div class="m-portlet__body">
											<div class="form-group m-form__group" style="padding-left:0;">
												<label for="exampleInputEmail1">Name</label>
												<input type="text" id="inputUsername" class="form-control m-input m-input--square" placeholder="Example: UOB Tower Parking Lot" name="textLocation" disabled value="{{ $this_transaction->CUSTOMER_NAME }}" >
											</div>
											<div class="form-group m-form__group" style="padding-left:0;">
												<label for="exampleInputEmail1">ID TAG</label>
												<input type="text" id="inputUsername" class="form-control m-input m-input--square" placeholder="Example: -6.654233" name="textLatitude" disabled value="{{ $this_transaction->CUSTOMER_ID_TAG }}" >
											</div>
											<div class="form-group m-form__group" style="padding-left:0;">
												<label for="exampleInputEmail1">Email</label>
												<input type="text" id="inputUsername" class="form-control m-input m-input--square" placeholder="Example: -6.654233" name="textLatitude" disabled value="{{ $this_transaction->CUSTOMER_EMAIL }}" >
											</div>
											<div class="form-group m-form__group" style="padding-left:0;">
												<label for="exampleInputEmail1">Phone Number</label>
												<input type="text" id="inputUsername" class="form-control m-input m-input--square" placeholder="Example: -6.654233" name="textLatitude" disabled value="{{ $this_transaction->CUSTOMER_PHONE_NUMBER }}" >
											</div>
											
										</div>
										
			
										<!--end::Form-->
									</div>
			
									<!--end::Portlet-->	
									
									
									
									
								</div>
								
								
							</div>
							
						</div>
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
