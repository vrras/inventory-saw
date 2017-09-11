<!-- SIGN OUT -->
<li class="xn-icon-button pull-right">
	<?php
	if($this->session->userdata("level")=='Pemilik'){
		?>
		<a href="<?=base_url().'account'?>"><span class="fa fa-user"></span></a>   
		<a href="<?=base_url().'logout'?>" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>  
		<?php 
	}
	else
	{
		?>
		<a href="<?=base_url().'logout'?>" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>
		<?php
	}
	?>             
</li> 
<!-- END SIGN OUT -->