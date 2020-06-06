<?php $movie = $movie_one[0];?>
<div id="content-sidebar-pro">

        <div id="content-sidebar-image">
            <img src="<?php echo base_url().'assets/images/movies/'.$movie->image?>" alt="Movie Poster">
        </div>

        <div class="content-sidebar-section">
            <h2 class="content-sidebar-sub-header"><?php echo $movie->title?></h2>
        </div><!-- close .content-sidebar-section -->

        <div class="content-sidebar-section">
            <h4 class="content-sidebar-sub-header">Release Date</h4>
            <div class="content-sidebar-short-description">2 October, 2017 (USA)</div>
        </div><!-- close .content-sidebar-section -->

        <div class="content-sidebar-section">
            <h4 class="content-sidebar-sub-header">Length</h4>
            <div class="content-sidebar-short-description">2 hr 43 min</div>
        </div><!-- close .content-sidebar-section -->

        <div class="content-sidebar-section">
            <h4 class="content-sidebar-sub-header">Director</h4>
            <div class="content-sidebar-short-description">James Wan</div>
        </div><!-- close .content-sidebar-section -->



        <div class="content-sidebar-section">
            <h2 class="content-sidebar-sub-header adjusted-recent-reviews">Recent Reviews</h2>
            <ul id="sidebar-reviews-pro">
                <?php for($i = 0; $i < 1; $i++){
                    $review = $reviews[count($reviews) - $i - 1];?>
                <li>
                    <h6><?php echo $review->author?></h6>
                    <div class="sidebar-review-time"><?php echo $review->created_at?></div>
                    <div class="spoiler-review">Contains Spoiler</div>
                    <?php echo $review->comments?>
                </li>
                <?php }?>
            </ul>
            <a href="#!" class="btn btn-green-pro btn-sm">See All Reviews</a>
            <hr>
            <a href="#!" class="btn btn-green-pro btn-sm" data-toggle="modal" data-target="#add_review"><i class="fas fa-plus"></i>Add Review</a>
        </div><!-- close .content-sidebar-section -->

    </div><!-- close #content-sidebar-pro -->


    <main id="col-main-with-sidebar">

        <div id="movie-detail-header-pro" style="background-image:url('<?php echo base_url().'assets/images/banners/'.$movie->banner_image?>')">

            <div class="progression-studios-slider-more-options" data-toggle="modal" data-target="#add_review" id="comment">
                <i class="fas fa-ellipsis-h"></i>
<!--                <ul>-->
<!--                    <li><a href="#!">Add to Favorites</a></li>-->
<!--                    <li><a href="#!">Add to Watchlist</a></li>-->
<!--                    <li><a href="#!">Add to Playlist</a></li>-->
<!--                    <li><a href="#!">Share...</a></li>-->
<!--                    <li><a href="#!">Write A Review</a></li>-->
<!--                </ul>-->
            </div>

            <a class="movie-detail-header-play-btn afterglow" href="#VideoLightbox-1"><i class="fas fa-play"></i></a>

            <video id="VideoLightbox-1"  poster="<?php echo base_url('assets/images/afrixis_banner.jpg')?>" width="960" height="540">
                <source src="<?php echo base_url('assets/video.mp4')?>" type="video/mp4">
            </video>

            <div id="movie-detail-header-media">
                <div class="dashboard-container">
                    <h5>Media</h5>
                    <div class="row">
                        <div class="col-6 col-md-4 col-lg-4">
                            <a class="movie-detail-media-link afterglow" href="#VideoLightbox-1">
                                <div class="movie-detail-media-image">
                                    <img src="http://via.placeholder.com/500x300">
                                    <span><i class="fas fa-play"></i></span>
                                    <h6>Trailer</h6>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-md-4 col-lg-4">
                            <a class="movie-detail-media-link afterglow" href="#VideoLightbox-1">
                                <div class="movie-detail-media-image">
                                    <img src="http://via.placeholder.com/500x300">
                                    <span><i class="fas fa-play"></i></span>
                                    <h6>Interview</h6>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-md-4 col-lg-4">
                            <a class="movie-detail-media-link" href="#!">
                                <div class="movie-detail-media-image">
                                    <img src="http://via.placeholder.com/500x300">
                                    <span><i class="fas fa-play"></i></span>
                                    <h6>Movie Stills</h6>
                                </div>
                            </a>
                        </div>
                    </div><!-- close .row -->
                </div><!-- close .dashboard-container -->
            </div><!-- close #movie-detail-header-media -->

            <div id="movie-detail-gradient-pro"></div>
        </div><!-- close #movie-detail-header-pro -->


        <div id="movie-detail-rating">
            <div class="dashboard-container">
                <div class="row">
                    <div class="col-sm">
                        <h5>Rate True Blood</h5>

                        <div class="rating-pro">
                            <label>
                                <input type="radio" name="rating-pro" value="10" title="10 stars"> 10
                            </label>
                            <label>
                                <input type="radio" name="rating-pro" value="9" title="9 stars"> 9
                            </label>
                            <label>
                                <input type="radio" name="rating-pro" value="8" title="8 stars"> 8
                            </label>
                            <label>
                                <input type="radio" name="rating-pro" value="7" title="7 stars"> 7
                            </label>
                            <label>
                                <input type="radio" name="rating-pro" value="6" title="6 stars"> 6
                            </label>
                            <label>
                                <input type="radio" name="rating-pro" value="5" title="5 stars"> 5
                            </label>
                            <label>
                                <input type="radio" name="rating-pro" value="4" title="4 stars"> 4
                            </label>
                            <label>
                                <input type="radio" name="rating-pro" value="3" title="3 stars"> 3
                            </label>
                            <label>
                                <input type="radio" name="rating-pro" value="2" title="2 stars"> 2
                            </label>
                            <label>
                                <input type="radio" name="rating-pro" value="1" title="1 star"> 1
                            </label>
                        </div>

                    </div>
                    <div class="col-sm">
                        <h6>User Rating</h6>
                        <div
                                class="circle-rating-pro"
                                data-value="<?php echo $movie->rating / 10?>"
                                data-animation-start-value="<?php echo $movie->rating / 10?>"
                                data-size="40"
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
                        <div class="clearfix"></div>
                    </div>
                </div><!-- close .row -->
            </div><!-- close .dashboard-container -->
        </div><!-- close #movie-detail-rating -->

        <div class="dashboard-container">


            <div class="movie-details-section">
                <h2>Storyline</h2>
                <p>Mae Holland (Emma Watson) seizes the opportunity of a lifetime when she lands a job with the world's most powerful technology and social media company. Encouraged by the company's founder (Tom Hanks), Mae joins a groundbreaking experiment that pushes the boundaries of privacy, ethics and personal freedom. Her participation in the experiment, and every decision she makes soon starts to affect the lives and futures of her friends, family and that of humanity.</p>
            </div><!-- close .movie-details-section -->


            <div class="movie-details-section">
                <h2>Similar Movies</h2>
                <div class="row">
                    <?php for($i=0; $i<3;$i++){
                        $movie1 = $movies[($movie->id+$i)%(count($movies))]?>
                        <div class="col-6 col-md-3 col-lg-3 col-xl-2">
                        <div class="item-listing-container-skrn" style="background-color: rgba(0, 0, 0, 0.9)">
                            <a href="<?php echo base_url().'user/movieprofile?id='.$movie1->id?>"><img src="<?php echo base_url('assets/images/movies/').'/'.$movie1->image?>" alt="Listing"></a>
                            <div class="item-listing-text-skrn" style="height:60px; padding:0 5px 0 10px">
                                <div class="item-listing-text-skrn-vertical-align"><h6><a href="<?php echo base_url().'user/movieprofile?id='.$movie1->id?>" style="color:white; font-weight: 600"><?php echo $movie1->title?></a></h6>
                                    <div
                                            class="circle-rating-pro"
                                            data-value="<?php echo $movie1->rating / 10?>"
                                            data-animation-start-value="<?php echo $movie1->rating / 10?>"
                                            data-size="32"
                                            data-thickness="3"
                                            data-fill="{
                                            <?php if ($movie1->rating > 6){?>
                                            &quot;color&quot;: &quot;#42b740&quot;
                                            <?php } else {?>
                                            &quot;color&quot;: &quot;#ff4141&quot;
                                            <?php }?>
								        }"
                                            data-empty-fill="#def6de"
                                            data-reverse="true"
                                    ><span style="color:#42b740;"><?php echo $movie1->rating?></span></div>
                                </div><!-- close .item-listing-text-skrn-vertical-align -->
                            </div><!-- close .item-listing-text-skrn -->
                        </div><!-- close .item-listing-container-skrn -->
                    </div><!-- close .col -->
                    <?php }?>

                </div><!-- close .row -->

            </div><!-- close .movie-details-section -->

        </div><!-- close .dashboard-container -->
    </main>


</div><!-- close #sidebar-bg-->

</body>
<div class="modal fade" id="add_review">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add your review</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="form" method="post" action="<?php echo base_url().'user/add_review'?>" class="form-horizontal">

            <!-- Modal body -->
            <div class="modal-body">
                <textarea name="comment" class="ckeditor" id="ckedtor" required="required"></textarea>
            </div>
            <input type="hidden" name="id" value="<?php echo $movie->id?>">

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Add</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
            </form>
        </div>
    </div>
</div>

