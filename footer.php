<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Beans Theme
 * @subpackage Motors Theme
 * @since 1.0
 * @version 1.0
 */

?>

		





		<section class="page-section car-model-slider">
      <div class="owl-carousel owl-theme">
          <div class="item"><img src='<?php echo THEMEROOT;?>/assets/images/volvo.png'/></div>
          <div class="item"><img src='<?php echo THEMEROOT;?>/assets/images/mercedes.png'/></div>
          <div class="item"><img src='<?php echo THEMEROOT;?>/assets/images/bmw.png'></div>
          <div class="item"><img src='<?php echo THEMEROOT;?>/assets/images/ford.png'/></div>
          <div class="item"><img src='<?php echo THEMEROOT;?>/assets/images/mini.png'/></div>
          <div class="item"><img src='<?php echo THEMEROOT;?>/assets/images/fiat.png'/></div>
          <div class="item"><img src='<?php echo THEMEROOT;?>/assets/images/audi.png'/></div>
          <div class="item"><img src='<?php echo THEMEROOT;?>/assets/images/vw.png'/></div>
          <div class="item"><img src='<?php echo THEMEROOT;?>/assets/images/vauxhall.png'/></div>
      </div>
    </section>
    
    <!-- FOOTER -->
    <footer class="footer-section">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <address>              
              <img src="<?php echo THEMEROOT;?>/assets/images/motors-logo.svg"/>
              <h4>Jaddah Motors</h4>
              12 Conway Road, Plumstead, <br>
              London, <br>
              SE18 1AQ <br>
              <i class="fa fa-phone"></i><tel> 020 8317 4430</tel>
            </address>
            <ul class="list-inline social">
                <li><a href="#"><i class="fa fa-facebook-square"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus-square"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin-square"></i></a></li>
                <li><a href="#"><i class="fa fa-rss-square"></i></a></li>
                <li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
            </ul>
          </div>

          <div class="col-md-4">
            <h4 class='footer-heading'>Opening Times</h4>
            <ul class="opening-time">
              <li><strong>Mon:</strong> 8am - 6pm</li>
              <li><strong>Tue:</strong> 8am - 6pm</li>
              <li><strong>Wed:</strong> 8am - 6pm</li>
              <li><strong>Thu:</strong> 8am - 6pm</li>
              <li><strong>Fri:</strong> 8am - 6pm</li>
              <li><strong>Sat:</strong> 8am - 4pm</li>
              <li><strong>Sun:</strong> Closed</li>
            </ul>
          </div>          
          <div class="col-md-4">
            <h4 class="footer-heading">Menu</h4>
            <ul class="footer-menu">
              <li><a href="#">Contact Us</a></li>
              <li><a href="#">Privacy</a></li>
              <li><a href="#">Terms</a></li>
              <li><a href="#">Cookies</a></li>
            </ul>
          </div>

          
        </div>
      </div>
    </footer>
    <div class="copyright-section">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <p class="pull-right">
              <a href="#" class="back-to-top">
                <i class="fa fa-arrow-up"></i>
              </a>
            </p>
            <p>
              &copy; 2016 Jaddah Motors               
            </p>
          </div>
        </div>
      </div>
    </div>

    
  
		<!--TODO: Study and make footer customizable-->
		<!--<footer id="colophon" class="site-footer" role="contentinfo">-->
			<!--<div class="wrap">-->
				<?php
				//get_template_part( 'template-parts/footer/footer', 'widgets' );

				if ( has_nav_menu( 'social' ) ) : ?>
					<!--<nav class="social-navigation" role="navigation" aria-label="<?php _e( 'Footer Social Links Menu', 'twentyseventeen' ); ?>">-->
						<?php
							// wp_nav_menu( array(
							// 	'theme_location' => 'social',
							// 	'menu_class'     => 'social-links-menu',
							// 	'depth'          => 1,
							// 	'link_before'    => '<span class="screen-reader-text">',
							// 	'link_after'     => '</span>' . twentyseventeen_get_svg( array( 'icon' => 'chain' ) ),
							// ) );
						?>
					<!--</nav>-->
				<?php endif;

				// get_template_part( 'template-parts/footer/site', 'info' );
				?>
			<!--</div>-->
		<!--</footer>-->



	</div><!-- .site-content-contain -->
</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>
