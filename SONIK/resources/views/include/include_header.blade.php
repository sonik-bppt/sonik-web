<!-- BEGIN: Header -->
			<header id="m_header" class="m-grid__item    m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
				<div class="m-container m-container--fluid m-container--full-height">
					<div class="m-stack m-stack--ver m-stack--desktop">

						<!-- BEGIN: Brand -->
						<div class="m-stack__item m-brand  m-brand--skin-light ">
							<div class="m-stack m-stack--ver m-stack--general">
								<div class="m-stack__item m-stack__item--middle m-brand__logo">
									<a class="m-brand__logo-wrapper">
<!-- 										<img alt="" src="../../assets/demo/media/img/logo/logo.png" /> -->
										<img alt="" src="{{ asset('media/system/sonik.png') }}" style="max-height:60px;width:auto;" />
									</a>
									<h3 class="m-header__title">SONIK</h3>
								</div>
								<div class="m-stack__item m-stack__item--middle m-brand__tools">

									<!-- BEGIN: Responsive Aside Left Menu Toggler -->
									<a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
										<span></span>
									</a>

									<!-- END -->

									<!-- BEGIN: Responsive Header Menu Toggler -->
									<a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
										<span></span>
									</a>

									<!-- END -->

									<!-- BEGIN: Topbar Toggler -->
									<a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
										<i class="flaticon-more"></i>
									</a>

									<!-- BEGIN: Topbar Toggler -->
								</div>
							</div>
						</div>

						<!-- END: Brand -->
						<div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
							<div class="m-header__title">
								<h3 class="m-header__title-text">SONIK</h3>
							</div>

							<!-- BEGIN: Horizontal Menu -->
							<button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-light " id="m_aside_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
							<div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-light m-aside-header-menu-mobile--submenu-skin-light ">
								<ul class="m-menu__nav  m-menu__nav--submenu-arrow ">


									<li class="m-menu__item  <?php //if( strpos($actual_link, '/dashboard/') > 0 ){ echo '  m-menu__item--active';} ?>  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" aria-haspopup="true">
										<a href="{{ route('dashboard') }}" class="m-menu__link" >
											<span class="m-menu__item-here"></span>
											<span class="m-menu__link-text">Dashboard</span>
										</a>
									</li>


									<li class="m-menu__item <?php //if( strpos($actual_link, '/charger/') > 0 ){ echo '  m-menu__item--active';} ?>  m-menu__item--submenu m-menu__item--rel m-menu__item--more m-menu__item--icon-only" m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
										<a href="{{ route('view_all_cs') }}" class="m-menu__link" >
											<span class="m-menu__item-here"></span>
											<span class="m-menu__link-text">Charging Station</span>
										</a>
									</li>



									<li class="m-menu__item <?php //if( strpos($actual_link, '/charger/') > 0 ){ echo '  m-menu__item--active';} ?>  m-menu__item--submenu m-menu__item--rel m-menu__item--more m-menu__item--icon-only" m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
										<a href="{{ route('view_all_customer') }}" class="m-menu__link" >
											<span class="m-menu__item-here"></span>
											<span class="m-menu__link-text">Customer</span>
										</a>
									</li>


                                    <li class="m-menu__item <?php //if( strpos($actual_link, '/charger/') > 0 ){ echo '  m-menu__item--active';} ?>  m-menu__item--submenu m-menu__item--rel m-menu__item--more m-menu__item--icon-only" m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
                                        <a href="{{ route('view_all_alert') }}" class="m-menu__link" >
                                            <span class="m-menu__item-here"></span>
                                            <span class="m-menu__link-text">Alert</span>
                                        </a>
                                    </li>

                                    <li class="m-menu__item <?php //if( strpos($actual_link, '/charger/') > 0 ){ echo '  m-menu__item--active';} ?>  m-menu__item--submenu m-menu__item--rel m-menu__item--more m-menu__item--icon-only" m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
                                        <a href="{{ route('view_all_activity') }}" class="m-menu__link" >
                                            <span class="m-menu__item-here"></span>
                                            <span class="m-menu__link-text">Activity</span>
                                        </a>
                                    </li>



									<li class="m-menu__item <?php //if( strpos($actual_link, '/activity/') > 0 ){ echo '  m-menu__item--active';} ?>  m-menu__item--submenu m-menu__item--rel m-menu__item--more m-menu__item--icon-only" m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
										<a href="{{ route('view_all_transaction') }}" class="m-menu__link" >
											<span class="m-menu__item-here"></span>
											<span class="m-menu__link-text">Transaction</span>
										</a>
									</li>

                                    <li class="m-menu__item <?php //if( strpos($actual_link, '/activity/') > 0 ){ echo '  m-menu__item--active';} ?>  m-menu__item--submenu m-menu__item--rel m-menu__item--more m-menu__item--icon-only" m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
                                        <a href="{{ route('report_evcs_yearly') }}" class="m-menu__link" >
                                            <span class="m-menu__item-here"></span>
                                            <span class="m-menu__link-text">Report</span>
                                        </a>
                                    </li>

                                    <li class="m-menu__item <?php //if( strpos($actual_link, '/activity/') > 0 ){ echo '  m-menu__item--active';} ?>  m-menu__item--submenu m-menu__item--rel m-menu__item--more m-menu__item--icon-only" m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
                                        <a href="{{ route('view_all_admin') }}" class="m-menu__link" >
                                            <span class="m-menu__item-here"></span>
                                            <span class="m-menu__link-text">Administrator</span>
                                        </a>
                                    </li>
								</ul>
							</div>

							<!-- END: Horizontal Menu -->


							<!-- BEGIN: Topbar -->
							<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
								<div class="m-stack__item m-stack__item--middle m-dropdown m-dropdown--arrow m-dropdown--large m-dropdown--mobile-full-width m-dropdown--align-right m-dropdown--skin-light m-header-search m-header-search--expandable m-header-search--skin-light"
								 id="m_quicksearch" m-quicksearch-mode="default">



									<!--BEGIN: Search Results -->
									<div class="m-dropdown__wrapper">
										<div class="m-dropdown__arrow m-dropdown__arrow--center"></div>
										<div class="m-dropdown__inner">
											<div class="m-dropdown__body">
												<div class="m-dropdown__scrollable m-scrollable" data-scrollable="true" data-height="300" data-mobile-height="200">
													<div class="m-dropdown__content m-list-search m-list-search--skin-light">
													</div>
												</div>
											</div>
										</div>
									</div>

									<!--BEGIN: END Results -->
								</div>
								<div class="m-stack__item m-topbar__nav-wrapper">
									<ul class="m-topbar__nav m-nav m-nav--inline">
										<li class="m-nav__item m-topbar__quick-actions m-dropdown m-dropdown--skin-light m-dropdown--large m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
											<a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-nav__link-badge m-badge m-badge--dot m-badge--info m--hide"></span>
												<span class="m-nav__link-icon"><span class="m-nav__link-icon-wrapper"><i class="flaticon-share"></i></span></span>
											</a>

										</li>
										<li class="m-nav__item m-topbar__user-profile  m-dropdown m-dropdown--medium m-dropdown--arrow  m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
											<a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-topbar__userpic m--hide">
													<img src="{{ asset('media/system/default_avatar.png') }}" class="m--img-rounded m--marginless m--img-centered" alt="" />
												</span>
												<span class="m-nav__link-icon m-topbar__usericon">
													<span class="m-nav__link-icon-wrapper"><i class="flaticon-user-ok"></i></span>
												</span>
												<span class="m-topbar__username m--hide">Sample User Name</span>
											</a>
											<div class="m-dropdown__wrapper">
												<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
												<div class="m-dropdown__inner">
													<div class="m-dropdown__header m--align-center">
														<div class="m-card-user m-card-user--skin-light">
															<div class="m-card-user__pic">
																<img src="{{ asset('media/system/default_avatar.png') }}" class="m--img-rounded m--marginless" alt="" />
															</div>
															<div class="m-card-user__details">
																<span class="m-card-user__name m--font-weight-500">{{ Session::get('NAME') }}</span>
																<a href="" class="m-card-user__email m--font-weight-300 m-link">{{ Session::get('EMAIL') }}</a>
										 					</div>
														</div>
													</div>
													<div class="m-dropdown__body">
														<div class="m-dropdown__content">
															<ul class="m-nav m-nav--skin-light">
																<li class="m-nav__section m--hide">
																	<span class="m-nav__section-text">Section</span>
																</li>
																<li class="m-nav__item">
																	<a href="{{ route('my_profile') }}" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-profile-1"></i>
																		<span class="m-nav__link-title">
																			<span class="m-nav__link-wrap">
																				<span class="m-nav__link-text">My Profile</span>
																			</span>
																		</span>
																	</a>
																</li>
																<li class="m-nav__item">
																	<a href="{{ route('my_password') }}" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-share"></i>
																		<span class="m-nav__link-text">Change Password</span>
																	</a>
																</li>
																<li class="m-nav__separator m-nav__separator--fit">
																</li>
																<li class="m-nav__item">
																	<a href="{{ route('logout') }}" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">Logout</a>
																</li>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</li>
									</ul>
								</div>
							</div>

							<!-- END: Topbar -->
						</div>
					</div>
				</div>
			</header>

			<!-- END: Header -->
