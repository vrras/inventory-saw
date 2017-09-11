<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ASP</title>
    <link rel="icon" type="image/png" href="<?=asset_url();?>images/favicon.png">

    <link href="<?=asset_url();?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=asset_url();?>font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?=asset_url();?>css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="<?=asset_url();?>css/animate.css" rel="stylesheet">
    <link href="<?=asset_url();?>css/style.css" rel="stylesheet">

    <link href="<?=asset_url();?>css/plugins/select2/select2.min.css" rel="stylesheet">

</head>

<body style="background-color: #e6e6fa">

    <div class="middle-box text-center loginscreen animated fadeInDown">

        <div>

            <div>
                <h1 class="logo-name"> <img src="<?=asset_url();?>images/Logo_Mandiri_Dashboard.png" height="100%" width="100%" align=""></h1>
            </div>

            <form class="m-t" role="form" method="POST" action="<?=base_url()?>logout_all">

                <div class="form-group">

                    <div class="input-group">

                        <input type="text" name="form_search" class="form-control" maxlength="20" minlength="10" required autocomplete="off" placeholder="Search NIP ..." onkeypress="return number_only(event)"> 

                        <span class="input-group-btn"> 
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                            </button> 
                        </span>

                    </div>

                </div>

            </form>

            

            <?php

            if ($nip != '')
            {
                foreach ($nip as $field_nip) 
                {

                    ?>

                    <form class="m-t" role="form" method="POST" action="<?=base_url()?>do_logout_all">

                        <input type="text" name="form_change_nip" readonly value="<?=$field_nip->NIP?>" hidden>

                        <div class="form-group text-left">
                            <label class="">NIP </label>
                            <label class="">: <?=$field_nip->NIP?></label>
                        </div>

                        <div class="form-group text-left">
                            <label class="">Full Name</label>
                            <label class="">: <?=$field_nip->FULL_NAME?></label>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary block full-width m-b">Sign Out From All Computer</button>

                    </form>

                    <?php
                }
            }

            ?>

            <a href="<?=base_url()?>">
                <button type="button" class="btn btn-sm btn-danger block full-width m-b"><i class="fa fa-arrow-circle-left"></i> Back</button>
            </a>

            <p class="m-t"> 
                <small>All Rights Reserved. Afdhal Afrilliyansyah.<br>IT Application Support Group.<br>PT. Bank Mandiri Tbk. <br>©2016-<?=date("Y")?></small> 
            </p>

        </div>

    </div>

    <!-- Mainly scripts -->
    <script src="<?=asset_url();?>js/jquery-2.1.1.js"></script>
    <script src="<?=asset_url();?>js/bootstrap.min.js"></script>

    <script src="<?=asset_url();?>js/form.js"></script>

</body>

</html>
