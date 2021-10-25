<?php

add_filter( 'rwmb_meta_boxes', 'upadilha_register_meta_boxes' );
function upadilha_register_meta_boxes( $meta_boxes )
{

    /* 1st meta box
    $meta_boxes[] = array(
        'id'       => 'single-gal',
        'title'    => 'Full Width Gallery Slider Images',
        'pages'    => array( 'post', 'portfolio' ),
        'context'  => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'name'  => 'Images Gallery',
                'desc'  => 'Upload your images here',
                'id'    => 'gallery-images',
                'type'  => 'image_advanced',
                'std'   => '',
            ),
        )
    );*/

/* check for a template type 
$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
$template_file = get_post_meta($post_id,'_wp_page_template',TRUE);	

/* Home 	
if ($template_file == 'page-/home.php') {*/

	
	// 2st meta box
    $meta_boxes[] = array(
        'id'       => 'single-gal-ex',
        'title'    => 'Imagens do Carrosel',
        'pages'    => array( 'page' ),
        'context'  => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'name'  => 'Imagens',
                'desc'  => 'Faça o upload das imagens aqui',
                'id'    => 'gallery-images-ex',
                'type'  => 'image_advanced',
                'std'   => '',
            ),
        )
    );
	
	
/*}*//*if*/	
	

    return $meta_boxes;
}