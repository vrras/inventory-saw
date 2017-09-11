<!DOCTYPE html>
<html lang="en" class="body-full-height">
<head>        
    <!-- META SECTION -->
    <title>Kurnia Jaya Elektronik</title>            
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="<?=asset_url();?>favicon.ico" type="image/x-icon" />
    <!-- END META SECTION -->

    <!-- CSS INCLUDE -->        
    <link rel="stylesheet" type="text/css" id="theme" href="<?=asset_url();?>css/theme-default.css"/>
    <!-- EOF CSS INCLUDE -->                                     
</head>
<body>

    <div class="login-container lightmode">
        <div class="login-box animated fadeInDown">
          <center><h2>KURNIA JAYA ELEKTRONIK</h2></center>
          <div class="login-body">
            <div class="login-title"><strong>Log In</strong> ke akun Anda</div>
            <div>
            </div>

            <form action="<?=base_url().'login'?>" class="form-horizontal" method="post">
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="text" name="form_signin_username" class="form-control" autofocus="" placeholder="Username"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="password" name="form_signin_password" class="form-control" placeholder="Password"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <input class="btn btn-info btn-block" type="submit" name="submit" value="LOGIN">
                    </div>
                </div>



            </form>
        </div>
        <div class="login-footer">
            <div class="pull-left">
                &copy; 2017 Mohamad Andriansyah
            </div>

        </div>
    </div>

</div>

<script type="text/javascript">
    <?php 
    if($this->session->flashdata('text')) 
    {
        ?>
        notification(<?=$this->session->flashdata('text')?>, "<?=$this->session->flashdata('type')?>"); 
        <?php
    }
    ?>
</script>

</body>
</html>






