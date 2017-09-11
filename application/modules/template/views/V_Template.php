<?php date_default_timezone_set('Asia/Jakarta'); ?>
<!DOCTYPE html>
<html lang="en">
<head>        
	<!-- TAG HEAD -->
	<?=$tag_head?>

</head>
<body>
	<!-- START PAGE CONTAINER -->
	<div class="page-container">

		<!-- START PAGE SIDEBAR -->
		<div class="page-sidebar">
			<!-- START X-NAVIGATION -->
			<?=$sidebar_menu?>
			<!-- END X-NAVIGATION -->
		</div>
		<!-- END PAGE SIDEBAR -->

		<!-- PAGE CONTENT -->
		<div class="page-content">

			<!-- START X-NAVIGATION VERTICAL -->
			<ul class="x-navigation x-navigation-horizontal x-navigation-panel">
				<!-- TOGGLE NAVIGATION -->
				<li class="xn-icon-button">
					<a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
				</li>
				<!-- END TOGGLE NAVIGATION -->
				<?=$top_navigation?>
			</ul>
			<!-- END X-NAVIGATION VERTICAL -->                     

			<!-- START BREADCRUMB -->
			<ul class="breadcrumb">
				<li><a href="#">Home</a></li>                    
				<li class="active"><?=$title?></li>
			</ul>
			<!-- END BREADCRUMB -->                       

			<!-- PAGE CONTENT WRAPPER -->
			<div class="page-content-wrap">
				<div class="col-lg-12">
					<div class="alert alert-info alert-dismissable">
						<i class="fa fa-info-circle"></i>  <strong>Hari ini: <?php echo date("d M Y"); ?></strong> 
					</div>
				</div>

				<?=$content?>

				<!-- START DASHBOARD CHART -->
				<div class="chart-holder" id="dashboard-area-1" style="height: 200px;"></div>
				<div class="block-full-width">

				</div>                    
				<!-- END DASHBOARD CHART -->
			</div>
			<!-- END PAGE CONTENT WRAPPER -->                                
		</div>            
		<!-- END PAGE CONTENT -->
	</div>
	<!-- END PAGE CONTAINER -->

	<!-- MESSAGE BOX-->
	<div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
		<div class="mb-container">
			<div class="mb-middle">
				<div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
				<div class="mb-content">
					<p>Apakah Anda Yakin Akan Keluar?</p>                    
					<p>Tekan Tidak jika Anda ingin terus bekerja. Tekan Ya untuk logout pengguna saat ini.</p>
				</div>
				<div class="mb-footer">
					<div class="pull-right">
						<a href="<?=base_url().'logout'?>" class="btn btn-success btn-lg">Ya</a>
						<button class="btn btn-default btn-lg mb-control-close">Tidak</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END MESSAGE BOX-->
	<?=$javascript?>
	<?=$js_disable?>
</body>
</html>






