<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <?php $setting = setting_all();?>

    <link rel="icon" href="<?php echo base_url((setting_all('favicon'))?'assets/images/'.setting_all('favicon'):'assets/images/favicon.ico');?>">
    <title><?php echo (setting_all('website'))?setting_all('website'):'Dasboard';?></title>

    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/css/bootstrap.min.css');?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/css/ionicons.min.css'); ?>">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/css/dataTables.bootstrap.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/css/magnific-popup.css');?>">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/css/AdminLTE.min.css');?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/css/skins/skin-black-light.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/css/skins/skin-black-light.css');?>">
    <!--  <link rel="stylesheet" href="<?php echo base_url('assets/css/css/blue.css');?>">-->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/css/custom.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/css/buttons.dataTables.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/css/daterangepicker.css'); ?>" />
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo base_url('assets/js/js/jquery.min.js'); ?>"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo base_url('assets/js/js/jquery-ui.min.js'); ?>"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        @media screen and (min-width: 768px){
            .logo-lg img{
                display: block;
            }
        }
        @media screen and (max-width: 768px){
            .logo-lg img{
                display: none;
            }
            .example1{
                display: block;
            }
        }

    </style>
</head>
<body class="hold-transition skin-black-light sidebar-mini" data-base-url="<?php echo base_url(); ?>">
<div class="wrapper">

    <header class="main-header">
        <a href="<?php echo base_url().'user/adminprofile'; ?>" class="logo">
            <?php $logo =  (setting_all('logo'))?setting_all('logo'):'logo.png'; ?>
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><img src="<?php echo base_url().'assets/images/'.$logo; ?>" id="logo"></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><img src="<?php echo base_url().'assets/images/'.$logo; ?>" id="logo"></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Control Sidebar Toggle Button -->
                    <!-- <li>
                      <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li> -->
                    <!-- User Account: style can be found in dropdown.less -->

                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?php
                            $profile_pic = 'user.png';
                            if (isset($this->session->userdata('user_details')[0]->profile_pic) && file_exists('assets/images/demo/' . $this->session->userdata('user_details')[0]->profile_pic)) {
                                $profile_pic = $this->session->userdata('user_details')[0]->profile_pic;
                            } ?>
                            <img src="<?php echo base_url().'assets/images/demo/'.$profile_pic;?>"  class="user-image" alt="User Image">
                            <span class="hidden-xs"><?php echo isset($this->session->userdata('user_details')[0]->name)?$this->session->userdata('user_details')[0]->name:'';?></span>
                        </a>
                        <ul class="dropdown-menu" role="menu" style="width: 164px;">
                            <li><a href="<?php echo base_url('user/adminprofile');?>"><i class="fa fa-user mr10"></i>My Account</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo base_url('user/logout');?>"><i class="fa fa-power-off mr10"></i> Sign Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <ul class="sidebar-menu">
                <li class="header"><!-- MAIN NAVIGATION --></li>
                <?php //echo '<pre>';print_r($this->router); die; ?>
                <li class="<?=($this->router->method==="adminprofile")?"active":"not-active"?>">
                    <a href="<?php echo base_url('user/adminprofile');?>"> <i class="fa fa-user"></i> <span>My Account</span></a>
                </li>
                <?php $this->load->view("include/menu");?>


                <?php if(CheckPermission("user", "own_read")){ ?>
                    <li class="<?=($this->router->method==="adminuserTable")?"active":"not-active"?>">
                        <a href="<?php echo base_url();?>user/adminuserTable"> <i class="fa fa-users"></i> <span>Users</span></a>
                    </li>
                <?php }  if(isset($this->session->userdata('user_details')[0]->user_type) && $this->session->userdata('user_details')[0]->user_type == 'admin'){ ?>
                    <li class="<?=($this->router->method==="adminmoviesTable")?"active":"not-active"?>">
                        <a href="<?php echo base_url("user/adminmoviesTable"); ?>"><i class="fa fa-video-camera"></i> <span>Movies</span></a>
                    </li>

                    <li class="<?=($this->router->method==="admincoverVideo")?"active":"not-active"?>">
                        <a href="<?php echo base_url("user/admincoverVideo"); ?>"><i class="fa fa-video-camera"></i> <span>Cover Video</span></a>
                    </li>

                    <li class="<?=($this->router->method==="admincoverimages")?"active":"not-active"?>">
                        <a href="<?php echo base_url("user/admincoverimages"); ?>"><i class="fa fa-image"></i> <span>Cover Images</span></a>
                    </li>

                    <!-- <li class="<?php //echo ($this->router->class==="Templates")?"active":"not-active"?>">
                        <a href="<?php //echo base_url("Templates"); ?>"><i class="fa fa-cubes"></i> <span>Templates</span></a>
                    </li> -->
                <?php }  /*if(CheckPermission("invoice", "own_read")){ ?>
                    <li class="<?=($this->router->class==="invoice")?"active":"not-active"?>">
                        <a href="<?php echo base_url("invoice/view"); ?>"><i class="fa fa-list-alt"></i> <span>Invoice</span></a>
                    </li>

               <?php  }*/ ?>


            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">
            <?php if ($this->session->flashdata("messagePr")) { ?>
                <div class="alert alert-info">
                    <?php echo $this->session->flashdata("messagePr") ?>
                </div>
            <?php } ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Cover Video</h3>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-body">
                            <div class="col-md-3">
                                <label style="font-size: 20px">Logo</label>
                                <div class="form-group imsize">
                                    <?php $logo = ''?>
                                    <?php if (isset($logo_image) && file_exists('assets/images/' . $logo_image)) {
                                        $logo = $logo_image;
                                    } ?>
                                    <img class="img-responsive" src="<?php echo base_url()."assets/images/".$logo?>" style="background: dodgerblue" id="logo">
                                    <input type="file" name="logo" id="exampleInputFile_logo">
                                </div>
                            </div>

                            <div class="col-md-8">
                                <label style="font-size: 20px">Landing Page Banner Image</label>
                                <div class="form-group imsize">
                                    <?php $banner = ''?>
                                    <?php if (isset($banner_image) && file_exists('assets/images/banners/' . $banner_image)) {
                                        $banner = $banner_image;
                                    } ?>
                                    <img class="img-responsive" src="<?php echo base_url()."assets/images/banners/".$banner?>" style="background: dodgerblue" id="banner">
                                    <input type="file" name="banner" id="exampleInputFile_banner">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- Modal Crud Start-->
    <footer class="main-footer">Thanks for using our video site dashboard</footer>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- DataTables -->
<script src="<?php echo base_url('assets/js/js/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/js/dataTables.bootstrap.min.js');?>"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>


<script type="text/javascript" src="<?php echo base_url('assets/js/js/moment.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/js/daterangepicker.js'); ?>"></script>

<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url('assets/js/js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/js/jquery.form-validator.min.js');?>"></script>

<!-- SlimScroll -->
<script src="<?php echo base_url('assets/js/js/jquery.slimscroll.min.js');?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/js/js/fastclick.js');?>"></script>

<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/js/js/app.min.js');?>"></script>
<!-- iCheck -->
<script src="<?php echo base_url('assets/js/js/icheck.min.js');?>"></script>
<script src="<?php echo base_url('assets/ckeditor/ckeditor.js');?>"></script>
<script src="<?php echo base_url('assets/ckeditor/adapters/jquery.js');?>"></script>
<!-- AdminLTE for demo purposes -->

<script src="<?php echo base_url('assets/js/js/custom.js');?>"></script>
<script>
    function validate_fileType(fileName,Nameid,arrayValu)
    {
        var string = arrayValu;
        var tempArray = new Array();
        var tempArray = string.split(',');
        var allowed_extensions =tempArray;
        var file_extension = fileName.split(".").pop();
        for(var i = 0; i <= allowed_extensions.length; i++)
        {
            if(allowed_extensions[i]==file_extension)
            {
                $("#error_"+Nameid).html("");
                return true; // valid file extension
            }
        }
        $("#"+Nameid).val("");
        $("#error_"+Nameid).css("color","red").html("File format not support to upload");
        return false;
    }
</script>
</body>
</html>
<!-- modal -->
<div id="cnfrm_delete" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content col-md-6">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Do you really want to delete </p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-small  yes-btn btn-danger" href="">yes</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">no</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#exampleInputFile_logo").change(function () {
            var file_data = $('#exampleInputFile_logo').prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            $.ajax({
                url: '<?php echo base_url();?>user/logoupload', // point to server-side PHP script
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(php_script_response){
                    var path = "<?php echo base_url(); ?>" + "assets/images/" + php_script_response;
                    // alert(php_script_response); // display response from the PHP script, if any
                    $("#logo").attr("src", path);
                }
            });
        });

        $("#exampleInputFile_banner").change(function () {
            var file_data = $('#exampleInputFile_banner').prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            $.ajax({
                url: '<?php echo base_url();?>user/bannerupload', // point to server-side PHP script
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(php_script_response){
                    var path = "<?php echo base_url(); ?>" + "assets/images/banners/" + php_script_response;
                    // alert(php_script_response); // display response from the PHP script, if any
                    $("#banner").attr("src", path);
                }
            });
        });
    });
</script>