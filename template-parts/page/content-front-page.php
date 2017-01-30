<?php
/**
 * Displays content for front page
 *
 * @package Beans Theme
 * @subpackage Motors Theme
 * @since 1.0
 * @version 1.0
 */
?>


<section class="page-section home-welcome-message">
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'container ' ); ?> >

		<?php if ( has_post_thumbnail() ) :
			$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'twentyseventeen-featured-image' );

			$post_thumbnail_id = get_post_thumbnail_id( $post->ID );

			$thumbnail_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'twentyseventeen-featured-image' );

			// Calculate aspect ratio: h / w * 100%.
			$ratio = $thumbnail_attributes[2] / $thumbnail_attributes[1] * 100;
			?>

			<div class="panel-image" style="background-image: url(<?php echo esc_url( $thumbnail[0] ); ?>);">
				<div class="panel-image-prop" style="padding-top: <?php echo esc_attr( $ratio ); ?>%"></div>
			</div><!-- .panel-image -->

		<?php endif; ?>


		<header class="row">
			<div class="col-sm-12">
				<?php the_title( '<h1 class="page-section-heading">', '</h1>' ); ?>

				<?php twentyseventeen_edit_link( get_the_ID() ); ?>
			</div>
		</header>
		<div class="row">
			<div class="col-sm-12">
				<p class="lead">
					<?php the_content(); ?>
				</p>
			</div>
		</div>

	</article><!-- #post-## -->
</section>