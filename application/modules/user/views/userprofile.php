<main id="col-main">

    <div class="dashboard-container">

        <ul class="dashboard-sub-menu">
            <li class="current"><a>Account Settings</a></li>
        </ul><!-- close .dashboard-sub-menu -->
        <form enctype="multipart/form-data" method="post" action="<?php echo base_url('user/saveprofile')?>">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12  col-lg-3">
<!--                    <div id="account-edit-photo">-->
<!--                        <div><img src="--><?php //echo base_url('assets/images/demo/').'/'.$this->session->userdata('user_details')[0]->profile_pic?><!--" alt="Account Image" width="400" height="400"></div>-->
<!--                        <p><a href="#!" class="btn btn-green-pro">Change Profile Picture</a></p>-->
<!--                        <p><a href="#!" class="btn">Delete Photo</a></p>-->
<!--                    </div>-->
                    <div class="pic_size" id="image-holder" style="margin-left:50px; margin-right: 50px">
                        <?php
                        if(file_exists('assets/images/demo/'.$this->session->userdata('user_details')[0]->profile_pic) && isset($this->session->userdata('user_details')[0]->profile_pic)){
                            $profile_pic = $this->session->userdata('user_details')[0]->profile_pic;
                        }else{
                            $profile_pic = 'download.png';}?>
                        <center> <img class="thumb-image setpropileam" id="profile_pic" width="400" height="400" style="border-radius: 5px" src="<?php echo base_url();?>/assets/images/demo/<?php echo isset($profile_pic)?$profile_pic:'download.png';?>" alt="User profile picture"></center>
                    </div>
                    <br>
                    <div class="fileUpload text-center">
                        <p style="color:white"><a class="btn btn-green-pro">Change Profile Picture</a></p>
                        <input id="fileUpload" class="upload" name="profile_pic" type="file" accept="image/*" /><br />
                        <input type="hidden" name="fileOld" value="<?php echo isset($this->session->userdata('user_details')[0]->profile_pic)?$this->session->userdata('user_details')[0]->profile_pic:'';?>" />
                    </div>
                </div><!-- close .col -->
                <div class="col">

                    <form class="account-settings-form">

                        <h5>General Information</h5>
                        <p class="small-paragraph-spacing">By letting us know your name, we can make our support experience much more personal.</p>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="first-name" class="col-form-label">Name:</label>
                                    <input type="text" name="name" class="form-control" id="first-name" value="<?php echo $this->session->userdata('user_details')[0]->name?>">
                                </div>
                            </div><!-- close .col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="country" class="col-form-label">Country:</label>
                                    <?php $country =  $this->session->userdata('user_details')[0]->country?>
                                    <select class="custom-select" id="country" name="country">
                                        <option <?php if($country == "NULL") echo "selected"?>>None</option>
                                        <option value="1" <?php if($country == "Argentina") echo "selected"?>>Argentina</option>
                                        <option value="2" <?php if($country == "Australia") echo "selected"?>>Australia</option>
                                        <option value="3" <?php if($country == "Bahamas") echo "selected"?>>Bahamas</option>
                                        <option value="4" <?php if($country == "Belgium") echo "selected"?>>Belgium</option>
                                        <option value="5" <?php if($country == "Brazil") echo "selected"?>>Brazil</option>
                                        <option value="6" <?php if($country == "Canada") echo "selected"?>>Canada</option>
                                        <option value="7" <?php if($country == "Chile") echo "selected"?>>Chile</option>
                                        <option value="8" <?php if($country == "China") echo "selected"?>>China</option>
                                        <option value="9" <?php if($country == "Denmark") echo "selected"?>>Denmark</option>
                                        <option value="10" <?php if($country == "Ecuador") echo "selected"?>>Ecuador</option>
                                        <option value="11" <?php if($country == "France") echo "selected"?>>France</option>
                                        <option value="12" <?php if($country == "Germany") echo "selected"?>>Germany</option>
                                        <option value="13" <?php if($country == "Greece") echo "selected"?>>Greece</option>
                                        <option value="14" <?php if($country == "Guatemala") echo "selected"?>>Guatemala</option>
                                        <option value="15" <?php if($country == "Italy") echo "selected"?>>Italy</option>
                                        <option value="16" <?php if($country == "Japan") echo "selected"?>>Japan</option>
                                        <option value="18" <?php if($country == "Korea") echo "selected"?>>Korea</option>
                                        <option value="19" <?php if($country == "Malaysia") echo "selected"?>>Malaysia</option>
                                        <option value="20" <?php if($country == "Monaco") echo "selected"?>>Monaco</option>
                                        <option value="21" <?php if($country == "Morocco") echo "selected"?>>Morocco</option>
                                        <option value="22" <?php if($country == "New Zealand") echo "selected"?>>New Zealand</option>
                                        <option value="23" <?php if($country == "Panama") echo "selected"?>>Panama</option>
                                        <option value="24" <?php if($country == "Portugal") echo "selected"?>>Portugal</option>
                                        <option value="25" <?php if($country == "Russia") echo "selected"?>>Russia</option>
                                        <option value="26" <?php if($country == "United Kingdom") echo "selected"?>>United Kingdom</option>
                                        <option value="27" <?php if($country == "United States") echo "selected"?>>United States</option>
                                    </select>
                                    <div class="dotted-dividers-pro"></div>
                                </div>
                            </div><!-- close .col -->
                        </div><!-- close .row -->
                        <hr>

                        <h5>Account Information</h5>
                        <p class="small-paragraph-spacing">You can change the email address you use here.</p>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="e-mail" class="col-form-label">E-mail</label>
                                    <input type="email" name="email" class="form-control" id="e-mail" value="<?php echo $this->session->userdata('user_details')[0]->email?>">
                                </div>
                            </div><!-- close .col -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="phone" class="col-form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control" id="phone" value="<?php echo $this->session->userdata('user_details')[0]->phone_number?>">
                                </div>
                            </div><!-- close .col -->
                        </div><!-- close .row -->

                        <hr>
                        <h5>Change Password</h5>
                        <p class="small-paragraph-spacing">You can change the password you use for your account here.</p>
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="password" class="col-form-label">Current Password:</label>
                                    <input type="password" class="form-control" id="password" value="<?php echo ($this->session->userdata('user_details')[0]->name)?>">
                                </div>
                            </div><!-- close .col -->
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="new-password" class="col-form-label">New Password:</label>
                                    <input type="password" name="password" class="form-control" id="new-password" placeholder="Minimum of 6 characters">
                                </div>
                            </div><!-- close .col -->
                            <div class="col-sm">
                                <div class="form-group">
                                    <div><label for="confirm-password" class="col-form-label">&nbsp; &nbsp;</label></div>
                                    <input type="password" name="confirmpassword" class="form-control" id="confirm-password" placeholder="Confirm New Password">
                                </div>
                            </div><!-- close .col -->
                        </div><!-- close .row -->

                        <hr>
                        <h5>Preferred Genres</h5>
                        <p class="small-paragraph-spacing">Pick your favorite genres for content.</p>

                        <div class="registration-genres-step">
                            <ul class="registration-genres-choice">
                                <li class="active">
                                    <i class="fas fa-check-circle"></i>
                                    <img src="<?php echo base_url('assets/images/genres/drama.png')?>" alt="Drama">
                                    <h6>Drama</h6>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <img src="<?php echo base_url('assets/images/genres/comedy.png')?>" alt="Comedy">
                                    <h6>Comedy</h6>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <img src="<?php echo base_url('assets/images/genres/action.png')?>" alt="Action">
                                    <h6>Action</h6>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <img src="<?php echo base_url('assets/images/genres/romance.png')?>" alt="Romance">
                                    <h6>Romance</h6>
                                </li>
                                <li class="active">
                                    <i class="fas fa-check-circle"></i>
                                    <img src="<?php echo base_url('assets/images/genres/horror.png')?>" alt="Horror">
                                    <h6>Horror</h6>
                                </li>
                                <li class="active">
                                    <i class="fas fa-check-circle"></i>
                                    <img src="<?php echo base_url('assets/images/genres/fantasy.png')?>" alt="Fantasy">
                                    <h6>Fantasy</h6>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <img src="<?php echo base_url('assets/images/genres/sci-fi.png')?>" alt="Sci-Fi">
                                    <h6>Sci-Fi</h6>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <img src="<?php echo base_url('assets/images/genres/thriller.png')?>" alt="Thriller">
                                    <h6>Thriller</h6>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <img src="<?php echo base_url('assets/images/genres/western.png')?>" alt="Western">
                                    <h6>Western</h6>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <img src="<?php echo base_url('assets/images/genres/adventure.png')?>" alt="Adventure">
                                    <h6>Adventure</h6>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <img src="<?php echo base_url('assets/images/genres/animation.png')?>" alt="Animation">
                                    <h6>Animation</h6>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <img src="<?php echo base_url('assets/images/genres/documentary.png')?>" alt="Documentary">
                                    <h6>Documentary</h6>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div><!-- close .registration-genres-step -->
                        <div class="clearfix"></div>
                        <hr>


                        <input type="submit" class="btn btn-green-pro" value="Save Changes"/>
                        <br>
                    </form>

                </div><!-- close .col -->

            </div><!-- close .row -->
        </div><!-- close .container-fluid -->
        </form>

    </div><!-- close .dashboard-container -->
</main>


</div><!-- close #sidebar-bg-->

</body>
