<!DOCTYPE html>
<html lang="en">

	<!-- begin::Head -->
	@include('include.include_head')

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="m-quick-panel--right m-demo-panel--right m-offcanvas-pane_-fixed m-subheader--solid m-aside--enabled m-aside--fixed">

		<!-- begin:: Page -->
        <div class="m-grid m-grid--ver m-grid--root">
			<div class="m-grid m-grid--hor m-grid--root m-login m-login--2 m-login--signin">
				<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor">
					<div class="m-grid__item m-grid__item--fluid m-login__wrapper">
							<div class="m-login__container">
								<div class="m-login__logo">
									<a href="#">
										<img src="{{ asset('media/system/sonik.png') }}" style="max-height:100px;width:auto;">
									</a>
								</div>
								<div class="m-login__signin">
									<div class="m-login__head">
										<h3 class="m-login__title">Sign In to SONIK</h3>
									</div>
									<?php
									if( base64_decode(Session::pull('show_popup')) == 1 ){
										?>
										<p style="text-align:center;color:red;"><?php echo base64_decode(Session::pull('popup_message'));?></p>
										<?php
									}
									?>
									<form class="m-form" action="PerformLogin" method="post">
										{{ csrf_field() }}
										<div class="form-group m-form__group">
											<input class="form-control m-input" type="text" placeholder="Email" name="email" autocomplete="off">
										</div>
										<div class="form-group m-form__group">
											<input class="form-control m-input m-login__form-input--last" type="password" placeholder="Password" name="password">
										</div>
										<div class="row m-login__extra">
											<div class="col m-align-left">
												<label class="m-checkbox">
													<input type="checkbox" name="remember"> Remember me
													<span></span>
												</label>
											</div>
											<div class="col m-align-right">
												<a href="javascript:;" id="m_login_forget_password" class="m-link">Forget Password ?</a>
											</div>
										</div>
										<div class="m-login__form-action">
											<button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air" style="width:100%;">Sign In</button>
										</div>
									</form>
								</div>
								<div class="m-login__forget-password">
									<div class="m-login__head">
										<h3 class="m-login__title">Forgotten Password ?</h3>
										<div class="m-login__desc">Enter your email to reset your password:</div>
									</div>
									<form class="m-login__form m-form" action="">
										<div class="form-group m-form__group">
											<input class="form-control m-input" type="text" placeholder="Email" name="email" id="m_email" autocomplete="off">
										</div>
										<div class="m-login__form-action">
											<button id="m_login_forget_password_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">Request</button>
											<button id="m_login_forget_password_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom">Cancel</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>

		<!-- end:: Page -->



	</body>

	<!-- end::Body -->
</html>
