<?php if($this->session->flashdata("alert_msg")){?>
  <div class="alert alert-danger">
    <?php echo $this->session->flashdata("alert_msg")?>
  </div>
<?php } ?>
<body>
<header class="header_area" id="header" style="position:fixed; margin:10px 20px 20px 20px">
    <a class="navbar-brand" href="https://campaign.afrixis.com">
        <img src="<?php echo base_url('assets/images/Afrixis1.png')?>">
    </a>
</header>
<div class="container">
    <div class="d-flex justify-content-center h-100">
        <div class="card">
            <div class="card-header">
                <h3>Register</h3>
            </div>
            <div class="card-body">
                <?php if($this->session->flashdata("messagePr")){?>
                    <div class="alert alert-info">
                        <?php echo $this->session->flashdata("messagePr")?>
                    </div>
                <?php } ?>
                <form method="POST" action="<?php echo base_url().'user/registration'; ?>">
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input name="name" type="text" class="form-control" placeholder="name" required/>

                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input name="email" type="email" class="form-control" placeholder="email" required/>

                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input name="password" type="password" class="form-control" placeholder="password" required/>
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-calculator"></i></span>
                        </div>
                        <input name="confirmpassword" type="password" class="form-control" placeholder="comfirm password" required/>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Register" class="btn float-right login_btn">
                    </div>
                </form>
            </div>
            <div class="text-center">
                <a href="<?php echo base_url().'login';?>" style="color:yellow">Already have an account?</a>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-center links">
                    Copyright 2019
                </div>
            </div>
        </div>
    </div>
</div>
</body>

<style>
    @import url('https://fonts.googleapis.com/css?family=Numans');

    html,body{
        background-image: url('<?php echo base_url('assets/images/login.jpg')?>');
        background-size: cover;
        background-repeat: no-repeat;
        height: 100%;
        font-family: 'Numans', sans-serif;
    }

    .container{
        height: 100%;
        align-content: center;
    }

    @media screen and (min-width: 500px){
        .card{
            width: 400px;
        }
    }
    @media screen and (max-width: 500px){
        .card{
            width: 300px;
        }
    }
    .card{
        height: 450px;
        margin-top: auto;
        margin-bottom: auto;
        background-color: rgba(0,0,0,0.5) !important;
    }

    .social_icon span{
        font-size: 60px;
        margin-left: 10px;
        color: #FFC312;
    }

    .social_icon span:hover{
        color: white;
        cursor: pointer;
    }

    .card-header h3{
        color: white;
    }

    .social_icon{
        position: absolute;
        right: 20px;
        top: -45px;
    }

    .input-group-prepend span{
        width: 50px;
        background-color: #FFC312;
        color: black;
        border:0 !important;
    }

    input:focus{
        outline: 0 0 0 0  !important;
        box-shadow: 0 0 0 0 !important;

    }

    .remember{
        color: white;
    }

    .remember input
    {
        width: 20px;
        height: 20px;
        margin-left: 15px;
        margin-right: 5px;
    }

    .login_btn{
        color: black;
        background-color: #FFC312;
        width: 100px;
    }

    .login_btn:hover{
        color: black;
        background-color: white;
    }

    .links{
        color: white;
    }

    .links a{
        margin-left: 4px;
    }
</style>