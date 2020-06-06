<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css');?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

</head>
<body style="background-image: url('<?php echo base_url().'assets/images/background.jpg'; ?>'); background-size: cover">
<header>
    <div class="row" style="border-bottom:2px solid #00c0ef; margin:0;background: #ECF1FA;">
        <div class="col-md-8">
            <a href="<?php echo base_url(); ?>" class="logo" style="margin-left: 20px">
                <?php $logo =  (setting_all('logo'))?setting_all('logo'):'logo.png'; ?>
                <img src="<?php echo base_url().'assets/images/'.$logo; ?>" id="logo" style="width:169px; height:auto">
            </a>
        </div>
        <div class="col-md-4">
            <a href="<?php echo base_url('user/profile'); ?>">
                <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary btn-lg" style="height: 50px; margin-top: 10px; width:30%; margin-right:50px">Login</button>
            </a>
            <a href="<?php echo base_url('user/signup'); ?>">
                <button type="button" class="mb-xs mt-xs mr-xs btn btn-warning btn-lg" style="height: 50px; margin-top: 10px; width:30%; margin-right:50px">SignUp</button>
            </a>
        </div>
    </div>


</header>

<!--<div>-->
<!--    <img src="--><?php //echo base_url().'assets/images/background.jpg'; ?><!--" class="img-responsive" style="width:100%; height: 100%">-->
<!--</div>-->
</body>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
</html>
