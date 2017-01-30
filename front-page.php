<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Beans
 * @subpackage Motors Theme
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>



<?php // Show the selected frontpage content.
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/page/content', 'front-page' );
			endwhile;
		else : // I'm not sure it's possible to have no posts when this page is shown, but WTH.
			get_template_part( 'template-parts/post/content', 'none' );
		endif; ?>




<!--TODO: Learn about front-page.php and add additional features-->
<!--<div id="primary" class="content-area">-->
	<!--<main id="main" class="site-main" role="main">-->

		<?php // Show the selected frontpage content.
		// if ( have_posts() ) :
		// 	while ( have_posts() ) : the_post();
		// 		get_template_part( 'template-parts/page/content', 'front-page' );
		// 	endwhile;
		// else : // I'm not sure it's possible to have no posts when this page is shown, but WTH.
		// 	get_template_part( 'template-parts/post/content', 'none' );
		// endif; ?>

		<?php
		// Get each of our panels and show the post data.
		// if ( 0 !== twentyseventeen_panel_count() || is_customize_preview() ) : // If we have pages to show.

			/**
			 * Filter number of front page sections in Twenty Seventeen.
			 *
			 * @since Twenty Seventeen 1.0
			 *
			 * @param $num_sections integer
			 */
	// 		$num_sections = apply_filters( 'twentyseventeen_front_page_sections', 4 );
	// 		global $twentyseventeencounter;

	// 		// Create a setting and control for each of the sections available in the theme.
	// 		for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
	// 			$twentyseventeencounter = $i;
	// 			twentyseventeen_front_page_section( null, $i );
	// 		}

	// endif; // The if ( 0 !== twentyseventeen_panel_count() ) ends here. ?>

	<!--</main> #main -->
<!--</div> #primary -->



<hr/>
    <section class="page-section home-services">
      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <img class="img-circle" src="<?php echo THEMEROOT;?>/assets/images/fix_it.jpg" alt="Generic placeholder image" width="140" height="140">
            <h2>Full Service from £99</h2>
            <!--<p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>-->
            <!--<p><a class="btn btn-default" href="#" role="button">View details »</a></p>-->
          </div><!-- /.col-lg-4 -->
          <div class="col-sm-4">
            <img class="img-circle" src="<?php echo THEMEROOT;?>/assets/images/intirim-service.jpg" alt="Generic placeholder image" width="140" height="140">
            <h2>Intrim Service from £77</h2>
            <!--<p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>-->
            <!--<p><a class="btn btn-default" href="#" role="button">View details »</a></p>-->
          </div><!-- /.col-lg-4 -->
          <div class="col-sm-4">
            <img class="img-circle" src="<?php echo THEMEROOT;?>/assets/images/mot-logo.png" alt="Generic placeholder image" width="140" height="140">
            <h2>MOT only £40</h2>
            <!--<p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>-->
            <!--<p><a class="btn btn-default" href="#" role="button">View details »</a></p>-->
          </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->
      </div>
    </section>
    <hr>
    
    <section class="page-section">
      <div class="container marketing">
        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading">
                MOT - <span class="text-muted"> Servicing</span> - 
                Repairs - <span class="text-muted">Diagnostics</span>
            </h2>
            <p class="lead">
              We provide full car service from £99. We also guarantee 100% 
              satisfaction.
            </p>
          </div>
          <div class="col-md-5">
            <img class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="500x500" 
							src="<?php echo THEMEROOT;?>/assets/images/full-service.jpg" data-holder-rendered="true">
          </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7 col-md-push-5">
            <h2 class="featurette-heading">Break Down <span class="text-muted">Recovery</span></h2>
            <p class="lead">
              If you are car is stuck somewhere we can recover and repair it and 
              can devliver it to you.
            </p>
          </div>
          <div class="col-md-5 col-md-pull-7">
            <img class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" 
							alt="500x500" src="<?php echo THEMEROOT;?>/assets/images/recovery-van.png" data-holder-rendered="true">
          </div>
        </div>

        <hr class="featurette-divider">
        
        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading">Pick &amp; <span class="text-muted">Fix</span></h2>
            <p class="lead">
              If you are not able to drop your car for repairing then can come 
              to pick up your car, repair it and drop it again. We call it
              <strong><em>Pick &amp; Fix</em></strong> service.
            </p>
          </div>
          <div class="col-md-5">
            <img class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" 
						alt="500x500" src="<?php echo THEMEROOT;?>/assets/images/pixnfix.jpg" data-holder-rendered="true">
          </div>
        </div>
        <hr class="featurette-divider">
        <div class="row featurette">
          <div class="col-md-7 col-md-push-5">
            <h2 class="featurettee-heading">Brand new Tyres</h2>
            <p class="lead">
              Get your tyres checked and replaced if required. We only replace old tyre with brand new
              tyres.
            </p>
          </div>
          <div class="col-md-5 col-md-pull-7">
            <img class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" 
						alt="500x500" src="<?php echo THEMEROOT;?>/assets/images/car-tyres.jpg" data-holder-rendered="true">
          </div>
        </div>
      </div>
    </section>

    <hr>

<?php get_footer();
