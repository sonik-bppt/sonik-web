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
							
														<div class="m-portlet"><iframe src="https://www.google.com/maps/d/u/0/embed?mid=1k_wpHBrgTbZ3fT5C6xWkKEJ0H-7EkloN" width="100%" height="480"></iframe></div>

							
							@foreach( $cs as $this_cs )
								<div class="m-portlet" style="padding:10px;text-align:center;margin-bottom:0!important;"><h3>{{ $this_cs->NAME }}</h3></div>
								<div id="dipslay_all_connector_status_evcs_id_{{ $this_cs->ID }}" class="text-center">Loading...</div>
								<?php $array_id_cs[] = $this_cs->ID; ?>
							@endforeach

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
							
						</div>
						
					</form>
					
				</div>
			</div>

			<!-- end:: Body -->

			
		</div>

		<!-- end:: Page -->

		@include('include.include_bottom_script_monitor')
		
		<script>
			
			const interval = setInterval(function() {
			   LoadConnectorStatus(5)
			 }, 5000);
			
		</script>
		
	</body>

	<!-- end::Body -->
</html>
