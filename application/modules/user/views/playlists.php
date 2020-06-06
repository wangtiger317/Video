    <main id="col-main">

        <div class="flexslider progression-studios-dashboard-slider">
            <ul class="slides">
                <li class="progression_studios_animate_in">
                    <div class="progression-studios-slider-dashboard-image-background" style="background-image:url('<?php echo base_url('assets/images/banners/4.jpg')?>');">
                        <div class="progression-studios-slider-display-table">
                            <div class="progression-studios-slider-vertical-align">

                                <div class="container">

                                    <div class="progression-studios-slider-dashboard-caption-width">
                                        <div class="progression-studios-slider-caption-align">
<!--                                            <h6 class="light-fonts-pro">Playlist of the Day</h6>-->
<!--                                            <h2 class="light-fonts-pro"><a href="#!">Best Movies of Quentin Tarantino</a></h2>-->
                                            <br><br><br><br><br><br><br><br><br><br>
                                            <a class="btn btn-green-pro btn-slider-pro" href="#!"><i class="fas fa-plus"></i> Subscribe</a>
                                            <div class="progression-studios-slider-more-options">
                                                <i class="fas fa-ellipsis-h"></i>
                                                <ul>
                                                    <li><a href="#!">Add to Favorites</a></li>
                                                    <li><a href="#!">Add to Watchlist</a></li>
                                                    <li><a href="#!">Add to Playlist</a></li>
                                                    <li><a href="#!">Share...</a></li>
                                                    <li><a href="#!">Write A Review</a></li>
                                                </ul>
                                            </div>
                                            <div class="clearfix"></div>
                                            <br>
                                            <img src="<?php echo base_url('assets/images/demo/user-5.jpg')?>" alt="Starring" class="created-by-avatar">
                                            <h5 class="light-fonts-pro created-by-heading-pro">Created by: Richard S. Castellano</h5>
                                            <h6 class="light-fonts-pro created-by-heading-pro">8 Movies, 18 hrs and 24 mins</h6>


                                        </div><!-- close .progression-studios-slider-caption-align -->
                                    </div><!-- close .progression-studios-slider-caption-width -->

                                </div><!-- close .container -->

                            </div><!-- close .progression-studios-slider-vertical-align -->
                        </div><!-- close .progression-studios-slider-display-table -->

                        <div class="progression-studios-slider-mobile-background-cover-dark"></div>
                    </div><!-- close .progression-studios-slider-image-background -->
                </li>
            </ul>
        </div><!-- close .progression-studios-slider - See /js/script.js file for options -->



        <div class="dashboard-container">

            <ul class="dashboard-sub-menu">
                <li class="current"><a href="#!">Most Popular</a></li>
                <li><a href="#!">Recommended</a></li>
                <li><a href="#!">Recently Added</a></li>
                <li><a href="#!">My Playlists</a></li>
            </ul><!-- close .dashboard-sub-menu -->

            <div class="row">
                <?php foreach ($movies as $movie):?>
                    <div class="col-6 col-md-3 col-lg-3 col-xl-2">
                        <div class="item-listing-container-skrn" style="background-color: rgba(0, 0, 0, 0.9)">
                            <a href="<?php echo base_url().'user/movieprofile?id='.$movie->id?>"><img src="<?php echo base_url('assets/images/movies/').'/'.$movie->image?>" alt="Listing"></a>
                            <div class="item-listing-text-skrn" style="height:60px; padding:0 5px 0 10px">
                                <div class="item-listing-text-skrn-vertical-align"><h6><a href="<?php echo base_url().'user/movieprofile?id='.$movie->id?>" style="color:white; font-weight: 600"><?php echo $movie->title?></a></h6>
                                    <div
                                            style="float:right"
                                            class="circle-rating-pro"
                                            data-value="<?php echo $movie->rating / 10?>"
                                            data-animation-start-value="<?php echo $movie->rating / 10?>"
                                            data-size="32"
                                            data-thickness="3"
                                            data-fill="{
                                    <?php if ($movie->rating > 6){?>
                                    &quot;color&quot;: &quot;#42b740&quot;
                                    <?php } else {?>
                                    &quot;color&quot;: &quot;#ff4141&quot;
                                    <?php }?>
                                    }"
                                            data-empty-fill="#def6de"
                                            data-reverse="true"
                                    ><span style="color:#42b740;"><?php echo $movie->rating?></span></div>
                                </div><!-- close .item-listing-text-skrn-vertical-align -->
                            </div><!-- close .item-listing-text-skrn -->
                        </div><!-- close .item-listing-container-skrn -->
                    </div><!-- close .col -->
                <?php endforeach;?>

            </div><!-- close .row -->

<!--            <ul class="page-numbers">-->
<!--                <li><a class="previous page-numbers" href="#!"><i class="fas fa-chevron-left"></i></a></li>-->
<!--                <li><span class="page-numbers current">1</span></li>-->
<!--                <li><a class="page-numbers" href="#!">2</a></li>-->
<!--                <li><a class="page-numbers" href="#!">3</a></li>-->
<!--                <li><a class="page-numbers" href="#!">4</a></li>-->
<!--                <li><a class="next page-numbers" href="#!"><i class="fas fa-chevron-right"></i></a></li>-->
<!--            </ul>-->


        </div><!-- close .dashboard-container -->
    </main>


</div><!-- close #sidebar-bg-->

</body>
