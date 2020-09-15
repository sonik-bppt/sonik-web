<!DOCTYPE html>
<html lang="en">

	<?php include('../include/include_head.php'); ?>

	<!-- begin::Body -->
	<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-light m-aside-left--fixed m-aside-left--offcanvas m-aside-left--minimize m-brand--minimize m-footer--push m-aside--offcanvas-default">

		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">

			<?php include('../include/include_header.php'); ?>

			<!-- begin::Body -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

				<?php include('../include/include_left_aside.php'); ?>
				
				<div class="m-grid__item m-grid__item--fluid m-wrapper">

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
											<span class="m-nav__link-text">View All</span>
										</a>
									</li>
								</ul>
							</div>
							<div>
								<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
									<a href="add.php" class="btn btn-primary" style="margin-right:15px;">Register New Customer</a>
									
									<a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
										<i class="la la-plus m--hide"></i>
										<i class="la la-download"></i>
									</a>
									
									
								</div>
							</div>
						</div>
					</div>

					<!-- END: Subheader -->
					<div class="m-content">
						
						<div class="m-portlet m-portlet--mobile">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											Customer Master Data
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
											<th>Card Number</th>
											<th>Email</th>
											<th>Phone Number</th>
											<th>Date Registered</th>
											<th>Last Logged In</th>
											<th>Status</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
										<?php
										for( $i=0;$i<100;$i++ ){
										
											$this_status = 1;
											
											if( $this_status == 1 ){
												$display_badge = '<span style="width:100%;" class="m-badge  m-badge--success m-badge--wide">Active</span>';
											} else if( $this_status == 2 ){
												$display_badge = '<span style="width:100%;" class="m-badge  m-badge--danger m-badge--wide">Blacklist</span>';
											}
										
											?>
											<tr>
												<td><?php echo $i+1;?></td>
												<td>Sample Customer Name <?php echo $i+1;?></td>
												<td><?php echo rand(1234,9876); ?>-<?php echo rand(1234,9876); ?>-<?php echo rand(1234,9876); ?></td>
												<td>sample.email.<?php echo $i+1;?>@gmail.com</td>
												<td>0812<?php echo rand(123456789,987654321);?></td>
												<td>2018-<?php echo rand(10,11);?>-<?php echo rand(10,25);?></td>
												<td>2018-12-<?php echo rand(10,25);?></td>
												<td><?php echo $display_badge;?></td>
												<td nowrap><a href="detail.php" class="btn btn-warning btn-sm" style="width:100%;">Detail</a></td>
											</tr>	
											<?php
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
						
					</div>
				</div>
			</div>

			<!-- end:: Body -->

			<?php include('../include/include_footer.php'); ?>
			
		</div>

		<!-- end:: Page -->

		<?php include('../include/include_quicksidebar.php'); ?>

		<?php include('../include/include_bottom_script.php'); ?>
		
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