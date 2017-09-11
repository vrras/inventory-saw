<!-- START PRELOADS -->
<audio id="audio-alert" src="<?=asset_url();?>audio/alert.mp3" preload="auto"></audio>
<audio id="audio-fail" src="<?=asset_url();?>audio/fail.mp3" preload="auto"></audio>
<!-- END PRELOADS -->                  

<!-- START SCRIPTS -->
<!-- START PLUGINS -->
<script type="text/javascript" src="<?=asset_url();?>js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="<?=asset_url();?>js/plugins/jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?=asset_url();?>js/plugins/bootstrap/bootstrap.min.js"></script>        
<!-- END PLUGINS -->

<!-- START THIS PAGE PLUGINS-->        
<script type="text/javascript" src="<?=asset_url();?>js/plugins/icheck/icheck.min.js"></script>        
<script type="text/javascript" src="<?=asset_url();?>js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
<script type="text/javascript" src="<?=asset_url();?>js/plugins/scrolltotop/scrolltopcontrol.js"></script>

<!-- <script type="template/joli/text/javascript" src="js/plugins/morris/raphael-min.js"></script>
	<script type="text/javascript" src="<?=asset_url();?>js/plugins/morris/morris.min.js"></script> -->     
	<script type="text/javascript" src="<?=asset_url();?>js/plugins/rickshaw/d3.v3.js"></script>
	<script type="text/javascript" src="<?=asset_url();?>js/plugins/rickshaw/rickshaw.min.js"></script>
	<script type="text/javascript" src="<?=asset_url();?>js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
	<script type="text/javascript" src="<?=asset_url();?>js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>                
	<script type="text/javascript" src="<?=asset_url();?>js/plugins/bootstrap/bootstrap-datepicker.js"></script>                
	<script type="text/javascript" src="<?=asset_url();?>js/plugins/owl/owl.carousel.min.js"></script>                 

	<script type="text/javascript" src="<?=asset_url();?>js/plugins/moment.min.js"></script>
	<script type="text/javascript" src="<?=asset_url();?>js/plugins/daterangepicker/daterangepicker.js"></script>
	<!-- END THIS PAGE PLUGINS-->        

	<script type="text/javascript" src="<?=asset_url();?>js/plugins.js"></script>        
	<script type="text/javascript" src="<?=asset_url();?>js/actions.js"></script>

	<!-- <script type="text/javascript" src="<?=asset_url();?>js/demo_dashboard.js"></script> -->


	<!-- END PLUGINS -->                

	<!-- THIS PAGE PLUGINS -->


	<script type="text/javascript" src="<?=asset_url();?>js/plugins/datatables/jquery.dataTables.min.js"></script>    
	<!-- END PAGE PLUGINS -->

	<script>

		$(document).ready(function(){

			$('#data_3 .input-group.date').datepicker({
				startView: 3,
				todayBtn: "linked",
				keyboardNavigation: false,
				forceParse: false,
				autoclose: true,
				calendarWeeks: true,
				format: "yyyy-mm-dd"
			});

			$('#data_1 .input-group.date').datepicker({
				startView: 3,
				todayBtn: "linked",
				keyboardNavigation: false,
				forceParse: false,
				autoclose: true,
				calendarWeeks: true,
				format: "dd-mm-yyyy"
			});

		});

	</script>

	<script>
		$(document).ready(function(){

			$(".select2_year").select2({
				placeholder: "Year",
				allowClear: true
			});

			$(".select2_month").select2({
				placeholder: "Month",
				allowClear: true
			});

			$(".select2_city").select2({
				placeholder: "City",
				allowClear: true
			});

			$(".select2_region").select2({
				placeholder: "Region",
				allowClear: true
			});

			$(".select2_event").select2({
				placeholder: "Event",
				allowClear: true
			});
		});

	</script>
	<!-- END TEMPLATE -->

	<!-- END TEMPLATE -->
	<!-- END SCRIPTS -->         