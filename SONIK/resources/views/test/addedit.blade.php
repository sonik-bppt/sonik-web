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

				@include('customer.include_left_aside')

				<div class="m-grid__item m-grid__item--fluid m-wrapper">

					<form action="save_new_customer" method="post">

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
												<span class="m-nav__link-text">Register New Customer</span>
											</a>
										</li>
									</ul>
								</div>
								<div>
									<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
										<input type="submit" value="Save" class="btn btn-primary" style="margin-right:15px;width:100px;" />

										<a href="view" class="btn btn-secondary" style="width:100px;">Back</a>

									</div>
								</div>
							</div>
						</div>

                        <div class="m-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="m-portlet m-portlet--tab">
                                        <div class="m-portlet__head">
                                            <div class="m-portlet__head-caption">
                                                <div class="m-portlet__head-title">
                                                    <span class="m-portlet__head-icon m--hide">
                                                        <i class="la la-gear"></i>
                                                    </span>
                                                    <h3 class="m-portlet__head-text">Customer Detail</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m-portlet__body">
                                            <div class="form-group m-form__group" style="padding-left:0;">
                                                <label for="exampleInputEmail1">RFID Tag</label>
                                                <input type="text" id="inputUsername" class="form-control m-input m-input--square" placeholder="Example: INI TES" name="textIDTag" required >
                                            </div>
                                            <div class="form-group m-form__group" style="padding-left:0;">
                                                <label for="exampleInputEmail1">Full Name</label>
                                                <input type="text" id="inputName" class="form-control m-input m-input--square" placeholder="Your full name as stated in your government ID"  name="textName" required >
                                            </div>
                                            <div class="form-group m-form__group" style="padding-left:0;">
                                                <label for="exampleInputEmail1">E-mail</label>
                                                <input type="email" id="inputUsername" class="form-control m-input m-input--square" placeholder="Example: sample.email@mail.com"  name="textEmail" required >
                                            </div>
                                            <div class="form-group m-form__group" style="padding-left:0;">
                                                <label for="exampleInputEmail1">Phone Number</label>
                                                <input type="tel" id="inputUsername" class="form-control m-input m-input--square" placeholder="Example: 08123456789"  name="textPhoneNumber" required >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="m-portlet m-portlet--tab">
                                        <div class="m-portlet__head">
                                            <div class="m-portlet__head-caption">
                                                <div class="m-portlet__head-title">
                                                    <span class="m-portlet__head-icon m--hide">
                                                        <i class="la la-gear"></i>
                                                    </span>
                                                    <h3 class="m-portlet__head-text">Vehicle Detail</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m-portlet__body">
                                            <div class="form-group m-form__group" style="padding-left:0;">
                                                <label for="exampleInputEmail1">Vehicle Model</label>
                                                <input type="text" id="inputName" class="form-control m-input m-input--square" placeholder="Example: Nissan Leaf" name="textVehicle" >
                                            </div>
                                            <div class="form-group m-form__group" style="padding-left:0;">
                                                <label for="exampleInputEmail1">Plug Type</label>
                                                <select class="form-control form-control--fixed selectpicker" data-toggle="dropdown" role="combobox" aria-haspopup="listbox" aria-expanded="false" title="None">
                                                    <optgroup label="DC Charging">
                                                        <option>CCS 2</option>
                                                        <option>CHAdeMO</option>
                                                    </optgroup>
                                                    <optgroup label="AC CHarging">
                                                        <option>Type 2</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                            <div class="form-group m-form__group" style="padding-left:0;">
                                                <label for="exampleInputEmail1">Additional Plug Type</label>
                                                <select class="form-control form-control--fixed selectpicker" data-toggle="dropdown" role="combobox" aria-haspopup="listbox" aria-expanded="false" title="None">
                                                    <optgroup label="DC Charging">
                                                        <option>CCS 2</option>
                                                        <option>CHAdeMO</option>
                                                    </optgroup>
                                                    <optgroup label="AC CHarging">
                                                        <option>Type 2</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
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

	</body>

	<!-- end::Body -->
</html>
