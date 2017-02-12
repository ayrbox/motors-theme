<?php
$about_disabled = get_theme_mod('theme_section_about_disable') == 1?true:false;
$about_id = get_theme_mod('theme_section_about_id', __('about', 'theme'));
$about_title = get_theme_mod('theme_section_about_title', __('About Us', 'theme'));
$about_subtitle = get_theme_mod('theme_section_about_subtitle', __('SubTitle', 'theme'));
$about_description = get_theme_mod('theme_section_about_description');

$about_pages = get_theme_mod('theme_section_about_pages');
?>


<?php if(!$about_disabled): ?>
<section id="<?php echo $about_id; ?>" class="page-section">
  <div class="container">
    <h1>
      <?php echo $about_title; ?>
      <?php if($about_subtitle != ''): ?>
        <br/><small><?php echo $about_subtitle; ?></small>
      <?php endif; ?>
    </h1>
    <p class='lead'>
      <?php echo $about_description; ?>
    </p>

    <?php
      $page_count = count($about_pages);
      if($page_count == 1) {
        $col_class = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
      } else if($page_count == 2) {
        $col_class = 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
      } else if($page_count == 3) {
        $col_class = 'col-lg-4 col-md-4 col-sm-4 col-xs-12';
      } else {
        $col_class = 'col-lg-3 col-md-3 col-sm-3 col-xs-12';
      } ?>

      <div class='row'>
        <?php
        foreach($about_pages as $index => $settings) {
          $post = get_post($settings['page_id']);
          setup_postdata($post);?>        
          <div class='<?php echo $col_class; ?>'><?php
          if(!empty($settings['show_title'])) {
            if( !empty($settings['show_link']) ) { ?>            
              <a href='<?php the_permalink(); ?>' class='post-title'>
                <?php the_title(); ?>
              </a> <?php
            } else { ?>          
              <h4><?php the_title();?></h4><?php
            }          
          }
          the_excerpt();
          ?>
          </div><!--col--><?php
        }?>
      </div><!-- row -->        
  </div><!-- container -->
</section>
<?php endif; ?>