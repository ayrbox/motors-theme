<?php
/**
 * Template Name: Frontpage
 * 
 * @package Beans Theme
 * @subpackage Motor Theme
 *
 * Inspired by OnePress frontpage structure
 */

get_header(); ?>

<?php
  do_action('theme_frontpage_before_section_parts');

  if(!has_action('theme_frontpage_section_parts')) {

    $sections = apply_filters('theme_frontpage_section_order', array(
      'hero', 'features', 'about', 'services', 'videolight', 'gallery', 'counter', 'team', 'news', 'contact'
    ));

    foreach($sections as $section) {
      do_action('theme_before_section_'.$section);
      do_action('theme_before_section_part', $section);

      get_template_part('section-parts/section', $section);
      
      do_action('theme_after_section_part', $section);
      do_action('theme_after_section_'.$section);
    }


  } else {
    do_action('theme_frontpage_section_parts');
  }



  do_action('theme_frontpage_after_section_parts');
?>

<?php 
  get_footer(); 
?>