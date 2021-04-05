<?php
function halen_page_metabox( $meta_boxes ) {

	$halen_prefix = '_halen_';
	$meta_boxes[] = array(
		'id'        => 'page_single_metaboxs',
		'title'     => esc_html__( 'Page Footer Options', 'halen-companion' ),
		'post_types'=> array( 'page' ),
		'priority'  => 'high',
		'autosave'  => 'false',
		'fields'    => array(
			array(
				'id'    => $halen_prefix . 'footer-background',
				'type'  => 'background',
				'name'  => esc_html__( 'Set The Footer Background', 'halen-companion' ),
			),
		),
	);


	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'halen_page_metabox' );