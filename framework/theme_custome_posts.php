<?php

require_once( 'CPT.php' );

$slides = new CPT(array(
	'post_type_name' => 'slides',
	'singuler' => 'Slide',
	'plural' => 'Slides',
	'slug' => 'slide'), array(
    'supports' => array('title', 'editor', 'thumbnail')
));