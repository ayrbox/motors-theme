<?php
/**
 * Display Top primary navigation
 *
 * @package Beans Theme
 * @subpackage Motors Theme
 * @since 1.0
 * @version 1.0
 */
?>
<div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
<?php 
  wp_nav_menu(
    array(
      'primary' => 'primary-menu',
      'depth' => 2,
      'container' => false,
      'menu_class' => 'nav navbar-nav navbar-right',
      'walker' => new wp_bootstrap_navwalker()));
?>
</div>