				<!-- BEGIN: Left Aside -->
				<button class="m-aside-left-close  m-aside-left-close--skin-light " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
				<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-light ">

					<!-- BEGIN: Aside Menu -->
					<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-light m-aside-menu--submenu-skin-light " data-menu-vertical="true" m-menu-scrollable="1" m-menu-dropdown-timeout="500">
						<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">

							<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
								<a href="{{ route('dashboard') }}" class="m-menu__link " title="Dashboard">
									<i class="m-menu__link-icon flaticon-dashboard"></i>
									<span class="m-menu__link-text">Dashboard</span>
								</a>
							</li>

							<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
								<a target="_blank" href="{{ route('view_all_cs') }}" class="m-menu__link " title="Charging Station">
									<i class="m-menu__link-icon flaticon-rocket"></i>
									<span class="m-menu__link-text">Charging Station</span>
								</a>
							</li>

							<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
								<a target="_blank" href="{{ route('view_all_customer') }}" class="m-menu__link " title="Customer">
									<i class="m-menu__link-icon flaticon-users"></i>
									<span class="m-menu__link-text">Customer</span>
								</a>
							</li>

              <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
                  <a target="_blank" href="{{ route('view_all_transaction') }}" class="m-menu__link " title="Transaction">
                      <i class="m-menu__link-icon flaticon-analytics"></i>
                      <span class="m-menu__link-text">Transaction</span>
                  </a>
              </li>

							<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
                  <a target="_blank" href="{{ route('monitor_connector') }}" class="m-menu__link " title="Realtime Status">
                      <i class="m-menu__link-icon flaticon-technology-2"></i>
                      <span class="m-menu__link-text">Realtime Status</span>
                  </a>
              </li>

						</ul>
					</div>

					<!-- END: Aside Menu -->
				</div>
				<!-- END: Left Aside -->
