<?php  
  $query = new WP_Query(
    array (
      'post_type' => array('slides')
    )
  );   
?>

<div id="main-carousel" class="carousel slide page-banner-slider" data-ride="carousel">    
    <ol class="carousel-indicators">      
      <?php for($index = 0; $index < $query->post_count; $index++): ?>        
        <li data-target="#main-carousel" data-slide-to="<?php echo $index; ?>" class="<?php echo ($index==0)?'active': ''; ?>"></li>
      <?php endfor; ?>
    </ol>

    <div class="carousel-inner" role="listbox">
      <?php
      $index = 0;
      while ( $query->have_posts() ) : $query->the_post();
        if ( has_post_thumbnail() ) : $image_link = wp_get_attachment_url(get_post_thumbnail_id()); 
      ?>
        
        <div class="item<?php echo ($index==0)?' active': ''; ?>">				
				  <img src="<?php echo $image_link; ?>" alt="<?php the_title(); ?>">
				  <div class="carousel-caption">
			    	<h3><?php the_title(); ?></h3>
			    	<p><?php the_content(); ?></p>
			  	</div>
			  </div><?php
            $index++;
        endif;        
      endwhile;?>      
    </div>
    <a class="left carousel-control" href="#main-carousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#main-carousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>