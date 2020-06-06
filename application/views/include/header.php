<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css')?>">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Lato:400,700%7CMontserrat:300,400,600,700">

    <link rel="stylesheet" href="<?php echo base_url('assets/icons/fontawesome/css/fontawesome-all.min.css')?>"><!-- FontAwesome Icons -->
    <link rel="stylesheet" href="<?php echo base_url('assets/icons/Iconsmind__Ultimate_Pack/Line%20icons/styles.min.css')?>"><!-- iconsmind.com Icons -->

    <title>Afrixis</title>
</head>

<!-- favicon img -->
<link rel="shortcut icon" type="image/icn" href="<?php echo base_url('assets/images/title.png')?>"/>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

<?php if($this->session->flashdata("messagePr")){?>
    <div class="alert alert-info">
        <?php echo $this->session->flashdata("messagePr")?>
    </div>
<?php } ?>
<body>
<div id="sidebar-bg">

    <header id="videohead-pro" class="sticky-header" style="background-color: #1D2127; border-bottom: 4px solid #0088cc">
        <div id="video-logo-background"><a href=""><img src="<?php echo base_url('assets/images/Afrixis1.png')?>" style="width:160px; height:auto" alt="Logo"></a></div>



        <div id="mobile-bars-icon-pro" class="noselect" style="color:white"><i class="fas fa-bars"></i></div>


        <div id="header-user-profile">
            <div id="header-user-profile-click" class="noselect">
                <img src="<?php echo base_url('assets/images/demo/').'/'.$this->session->userdata('user_details')[0]->profile_pic?>" alt="User">
                <div id="header-username" style="color:white"><?php echo $this->session->userdata('user_details')[0]->name?></div><i class="fas fa-angle-down"></i>
            </div><!-- close #header-user-profile-click -->
            <div id="header-user-profile-menu">
                <ul>
                    <li><a href="<?php echo base_url('user/userprofile')?>"><span class="icon-User"></span>My Profile</a></li>
                    <li><a href="<?php echo base_url('user/logout')?>"><span class="icon-Power-3"></span>Log Out</a></li>
                </ul>
            </div><!-- close #header-user-profile-menu -->
        </div><!-- close #header-user-profile -->

        <div id="header-user-notification">
            <div id="header-user-notification-click" class="noselect">
                <i class="far fa-bell"></i>
                <span class="user-notification-count">3</span>
            </div><!-- close #header-user-profile-click -->
            <div id="header-user-notification-menu">
                <h3>Notifications</h3>
                <div id="header-notification-menu-padding">
                    <ul id="header-user-notification-list">
                        <li><a href=""><img src="<?php echo base_url('assets/images/demo/user-profile-2.jpg')?>" alt="Profile">Lorem ipsum dolor sit amet, consec tetur adipiscing elit. <div class="header-user-notify-time">21 hours ago</div></a></li>
                        <li><a href=""><img src="<?php echo base_url('assets/images/demo/user-profile-3.jpg')?>" alt="Profile">Donec vitae lacus id arcu molestie mollis. <div class="header-user-notify-time">3 days ago</div></a></li>
                        <li><a href=""><img src="<?php echo base_url('assets/images/demo/user-profile-4.jpg')?>" alt="Profile">Aenean vitae lectus non purus facilisis imperdiet. <div class="header-user-notify-time">5 days ago</div></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div><!-- close #header-user-profile-menu -->
            </div>
        </div><!-- close #header-user-notification -->

        <div class="clearfix"></div>

        <nav id="mobile-navigation-pro" style="background-color: #1D2127">

            <ul id="mobile-menu-pro">
                <li class="<?=($this->router->method==="profile")?"current-menu-item":""?>">
                    <a href="<?php echo base_url('user/profile')?>" style="color:white">
                        <span class="icon-Old-TV"></span>
                        TV Series
                    </a>
                </li>
                <li class="<?=($this->router->method==="movies")?"current-menu-item":""?>">
                    <a href="<?php echo base_url('user/movies')?>" style="color:white">
                        <span class="icon-Reel"></span>
                        Movies
                    </a>
                </li>
                <li class="<?=($this->router->method==="playlists")?"current-menu-item":""?>">
                    <a href="<?php echo base_url('user/playlists')?>" style="color:white">
                        <span class="icon-Movie"></span>
                        Playlists
                    </a>
                </li>
                <li class="<?=($this->router->method==="newarrivals")?"current-menu-item":""?>">
                    <a href="<?php echo base_url('user/newarrivals')?>" style="color:white">
                        <span class="icon-Movie-Ticket"></span>
                        New Arrivals
                    </a>
                </li>
                <li class="<?=($this->router->method==="comingsoon")?"current-menu-item":""?>">
                    <a href="<?php echo base_url('user/comingsoon')?>" style="color:white">
                        <span class="icon-Clock"></span>
                        Coming Soon
                    </a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </nav>

    </header>



    <nav id="sidebar-nav" style="background-color: #1D2127"><!-- Add class="sticky-sidebar-js" for auto-height sidebar -->
        <ul id="vertical-sidebar-nav" class="sf-menu" style="background-color: #1D2127">
            <li class="normal-item-pro <?=($this->router->method==="profile")?"current-menu-item":""?>">
                <a href="<?php echo base_url('user/profile')?>" style="font-size: 16px">
                    <span class="icon-Old-TV"></span>
                    TV Series
                </a>
            </li>
            <li class="normal-item-pro <?=($this->router->method==="movies")?"current-menu-item":""?>">
                <a href="<?php echo base_url('user/movies')?>" style="font-size: 16px">
                    <span class="icon-Reel"></span>
                    Movies
                </a>
            </li>
            <li class="normal-item-pro <?=($this->router->method==="playlists")?"current-menu-item":""?>">
                <a href="<?php echo base_url('user/playlists')?>" style="font-size: 16px">
                    <span class="icon-Movie"></span>
                    Playlists
                </a>
            </li>
            <li class="normal-item-pro <?=($this->router->method==="newarrivals")?"current-menu-item":""?>">
                <a href="<?php echo base_url('user/newarrivals')?>" style="font-size: 16px">
                    <span class="icon-Movie-Ticket"></span>
                    New Arrivals
                </a>
            </li>
            <li class="normal-item-pro <?=($this->router->method==="comingsoon")?"current-menu-item":""?>">
                <a href="<?php echo base_url('user/comingsoon')?>" style="font-size: 16px">
                    <span class="icon-Eye"></span>
                    Sneak Peeks
                </a>
            </li>
            <li class="normal-item-pro">
                <a style="height: 500px"></a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </nav>
