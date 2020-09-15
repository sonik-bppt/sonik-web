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
											<tbody id="stream_table_row">
											</tbody>
										</table>
									</div>
								</div>
							</div>
							
							
							

							
							
						</div>
						
					</form>
					
				</div>
			</div>

			<!-- end:: Body -->

			
		</div>

		<!-- end:: Page -->

		@include('include.include_bottom_script_monitor')
		
		<script>

			StreamTableRow();
			function StreamTableRow(){

				var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var jsonData = JSON.parse(this.responseText);
                        
                        document.getElementById('stream_table_row').innerHTML = jsonData.ONGOING_TRANSACTION_TABLE_ROW;
                        
                    } 
                    // else {
                    //  alert("Could not connect to server. Please restart the app and try again.");
                    // }
                };
               // xhttp.open("POST", "http://10.10.12.40:81/monitorapi/index.php", true);
                xhttp.open("POST", "<?php echo url('monitorapi/index.php');?>", true);
                xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhttp.send("module=GetOngoingChargingData&page=normal");


			}

			const interval = setInterval(function() {
			   StreamTableRow()
			 }, 5000);

		</script>
		
	</body>

	<!-- end::Body -->
</html>
