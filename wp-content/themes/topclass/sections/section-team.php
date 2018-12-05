<?php
global $jwtheme_topclass, $post;
$team = topclass_get_custom_posts("team", 20);

if ($jwtheme_topclass['section_team_display']) { ?>

    <section id="team">
        <div class="white-bg team-section">
            <div class="sec-head-container">
                <div class="sec-head-style">
                    <h2 class="section-title wow bounceInDown">
                        <?php if (isset($jwtheme_topclass['section_team_title'])) echo $jwtheme_topclass['section_team_title']; ?>
                    </h2><!-- /.section-title -->
                    <div class="section-description">
                        <?php if (isset($jwtheme_topclass['section_team_subtitle'])) echo $jwtheme_topclass['section_team_subtitle']; ?>
                    </div><!-- /.section-description -->
                </div><!-- /.sec-head-style -->
            </div><!-- /.sec-head-container -->
            <div class="container">
                <div id="team-member-slider" class="team-member-slider owl-carousel owl-theme">

					<?php 
					$i= 0.1;
                    foreach ($team as $key =>$post) {
                        setup_postdata($post);

                        $team_member_name = get_post_meta( $post->ID,'_jwtheme_team_member_name',true );
                        $team_member_designation = get_post_meta( $post->ID,'_jwtheme_team_member_designation',true );
                        $team_desc = get_post_meta( $post->ID,'_jwtheme_team_desc',true );
                        $team_animation = get_post_meta( $post->ID,'_jwtheme_team_animation',true );

                    ?>
                    <div class="col-md-3">
                        <div class="item">
                            <div class="member-container wow <?php echo $team_animation;?>" data-wow-delay="<?php echo "$i";?>s">
                                <div class="inner-container">
                                    
                                    <?php if ( has_post_thumbnail() ) { 
                                    	the_post_thumbnail('team-thumb');
                                    } ?>

                                    <div class="member-details">
                                        <h4 class="name">
                                            <?php echo $team_member_name; ?>
                                        </h4>
                                        <p class="designation">
                                            <?php echo $team_member_designation; ?>
                                        </p>
                                        <p>
                                            <?php echo $team_desc; ?>
                                        </p>
                                        <div class="member-social-link">
                                            <?php 
                                            $social_twitter = get_post_meta( $post->ID,'_jwtheme_social_twitter',true );
                                            $social_facebook = get_post_meta( $post->ID,'_jwtheme_social_facebook',true );
                                            $social_dribbble = get_post_meta( $post->ID,'_jwtheme_social_dribbble',true );
                                            $social_google_plus = get_post_meta( $post->ID,'_jwtheme_social_google_plus',true );
                                            $social_linkedin = get_post_meta( $post->ID,'_jwtheme_social_linkedin',true );

                                            if ( $social_twitter != '' ) {
                                            	echo '<a href="' . esc_url($social_twitter) . '" class="twitter-btn"><i class="fa fa-twitter"></i></a>';
                                            }

	                                        if ( $social_facebook != '' ) {
                                            	echo '<a href="' . esc_url($social_facebook) . '" class="facebook-btn"><i class="fa fa-facebook"></i></a>';
                                            }

                                            if ( $social_dribbble != '' ) {
                                            	echo '<a href="' . esc_url($social_dribbble) . '" class="dribbble-btn"><i class="fa fa-dribbble"></i></a>';
                                            }

                                            if ( $social_google_plus != '' ) {
                                            	echo '<a href="' . esc_url($social_google_plus) . '" class="google-plus-btn"><i class="fa fa-google-plus"></i></a>';
                                            	
                                            }  

                                            if ( $social_linkedin != '' ) {
                                            	echo '<a href="' . esc_url($social_linkedin) . '" class="linkedin-btn"><i class="fa fa-linkedin"></i></a>';
                                            }
                                            ?>
                                        </div>
                                    </div><!-- /.member-details -->
                                </div><!-- /.inner-container -->
                            </div><!-- /.member-container -->
                        </div><!-- /.item -->
                    </div>

                <?php 
                	$i = $i + 0.1;
                } ?>                   

                </div><!-- /.team-member-slider -->
            </div><!-- /.container -->
        </div><!-- /.team-section -->
    </section><!-- #team -->

<?php } ?>




<?php if ($jwtheme_topclass['section_show_team_skills']) { ?>

    <section id="top-skills">
        <div class="gray-bg top-skills">
            <h3 class="text-center top-skills-title">
            	<?php if (isset($jwtheme_topclass['section_team_skills_title'])) echo $jwtheme_topclass['section_team_skills_title']; ?>
            </h3>
            <div class="container">
                <div class="row">

                    <div class="col-md-6">
                        <?php 
                            if (isset($jwtheme_topclass['section_show_team_skills']) && count($jwtheme_topclass['section_team_skills'])) {
                            $i = 0;
                            $j= 0.1;
                            
                            foreach ($jwtheme_topclass['section_team_skills'] as $counter) {
                                $cparts = explode(",", $counter);
                                if (count($cparts) > 1) {
                                    $i++;
                            ?>

                                <div class="progress thin wow <?php echo $cparts[2]; ?>" data-wow-delay="<?php echo $cparts[3]; ?>s">
                                    <div class="progress-bar default-bar" role="progressbar" aria-valuenow="<?php echo $cparts[1]; ?>" aria-valuemin="0" data-progress-value="<?php echo $cparts[1]; ?>%" aria-valuemax="100">
                                        <span class="progress-text"><?php echo $cparts[0]; ?></span> 
                                        <span class="progress-percent"><?php echo $cparts[1]; ?>%</span>
                                    </div>
                                </div>

                            <?php
                                    }
                                }
                            }
                        ?>

                    </div><!-- /.col-md-6 -->

                    <div class="col-md-6">
                        <?php 
                            if (isset($jwtheme_topclass['section_show_team_skills']) && count($jwtheme_topclass['section_team_skills_right'])) {
                            $i = 0;
                            $j= 0.1;
                            
                            foreach ($jwtheme_topclass['section_team_skills_right'] as $counter) {
                                $cparts = explode(",", $counter);
                                if (count($cparts) > 1) {
                                    $i++;
                            ?>

                                <div class="progress thin wow <?php echo $cparts[2]; ?>" data-wow-delay="<?php echo $cparts[3]; ?>s">
                                    <div class="progress-bar default-bar" role="progressbar" aria-valuenow="<?php echo $cparts[1]; ?>" aria-valuemin="0" data-progress-value="<?php echo $cparts[1]; ?>%" aria-valuemax="100">
                                        <span class="progress-text"><?php echo $cparts[0]; ?></span> 
                                        <span class="progress-percent"><?php echo $cparts[1]; ?>%</span>
                                    </div>
                                </div>

                            <?php
                                    }
                                }
                            }
                        ?>

                    </div><!-- /.col-md-6 -->



                    
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.top-skills -->
    </section><!-- /#top-skills -->

<?php } ?>


<?php if ($jwtheme_topclass['section_show_team_parallax']) { ?>    
    <section id="quality" style="background: url('<?php echo $jwtheme_topclass['section_team_parallax_image']['url'];?>')  50% 0 no-repeat fixed;">
        <div class="quality-section parallax-style">
            <div class="pattern">
                <div class="container">
                    <h2 class="text-center plx-section-title">
                        <?php if (isset($jwtheme_topclass['section_team_parallax_title'])) echo $jwtheme_topclass['section_team_parallax_title']; ?>
                    </h2>
                    <p class="text-center quality-description">
                        <?php if (isset($jwtheme_topclass['section_team_parallax_desc'])) echo $jwtheme_topclass['section_team_parallax_desc']; ?>
                    </p>
                    <div class="button-container">  
                        <a class="btn btn-sm btn-default btn-effect" href="<?php echo $jwtheme_topclass['section_team_parallax_url'];?>">
                            <?php echo $jwtheme_topclass['section_team_parallax_btn'];?>
                        </a> 
                    </div>

                    <?php if($jwtheme_topclass['section_team_parallax_banner']['url']){ ?>
                        <div class="quality-product-img wow bounceInUp">
                            <img src="<?php echo $jwtheme_topclass['section_team_parallax_banner']['url'];?>" alt="Quality Products">
                        </div><!-- /.quality-product-img -->
                    <?php } ?>
                    
                </div><!-- /.container -->
            </div><!-- /.pattern  -->               
        </div><!-- /.quality-section -->
    </section><!-- #quality -->
<?php } ?>