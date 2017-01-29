<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Beans
 * @subpackage Motors Theme
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentyseventeen' ); ?></a>

	<div class="navbar-wrapper" data-spy="affix" data-offset-top="127">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<nav class="navbar">              
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
								<?php if(get_header_image()) : ?>
									<img src= '<?php echo THEMEROOT; ?>/assets/images/motors-logo.svg' class='svg brand-logo' alt='Motors Logo'/>
								<?php else: ?>
								<?php endif; ?>
							</a>                              
						</div>
						<?php if(has_nav_menu('primary')):
							get_template_part('/template-parts/navigation/navigation', 'primary');
						endif; ?>
					</nav>
				</div>
			</div>
		</div>
	</div>
	
	<?php get_template_part('/template-parts/slider/slider', ''); ?>	



	<?php
	// If a regular post or page, and not the front page, show the featured image.
	// if ( has_post_thumbnail() && ( is_single() || ( is_page() && ! twentyseventeen_is_frontpage() ) ) ) :
	// 	echo '<div class="single-featured-image-header">';
	// 	the_post_thumbnail( 'twentyseventeen-featured-image' );
	// 	echo '</div><!-- .single-featured-image-header -->';
	// endif;
	?>


	
	

