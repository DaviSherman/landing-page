<?php

/* Posts Recentes 1 
function recent_posts_function() {
   query_posts(array('orderby' => 'date', 'order' => 'DESC' , 'showposts' => 1));
   if (have_posts()) :
      while (have_posts()) : the_post();
         $return_string = '<a href="'.get_permalink().'">'.get_the_title().'</a>';
      endwhile;
   endif;
   wp_reset_query();
   return $return_string;
}*/

/* Posts Recentes 2 
function recent_posts2_function($atts){
   extract(shortcode_atts(array(
      'posts' => 1,
   ), $atts));

   $return_string = '<ul>';
   query_posts(array('orderby' => 'date', 'order' => 'DESC' , 'showposts' => $posts));
   if (have_posts()) :
      while (have_posts()) : the_post();
         $return_string .= '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
      endwhile;
   endif;
   $return_string .= '</ul>';

   wp_reset_query();
   return $return_string;
}*/

/* Posts Recentes 3 
function recent_posts_function($atts, $content = null) {
   extract(shortcode_atts(array(
      'posts' => 1,
   ), $atts));

   $return_string = '<h3>'.$content.'</h3>';
   $return_string .= '<ul>';
   query_posts(array('orderby' => 'date', 'order' => 'DESC' , 'showposts' => $posts));
   if (have_posts()) :
      while (have_posts()) : the_post();
         $return_string .= '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
      endwhile;
   endif;
   $return_string .= '</ul>';

   wp_reset_query();
   return $return_string;
}*/


/* Posts Recentes */
function recent_posts_function($atts, $content = null) {
   extract(shortcode_atts(array(
      'posts' => 1,
   ), $atts));
   
   global $post;

   $return_string = '<h2 class="title-pagina">'.$content.'</h2>';
   $return_string .= '<!-- Lista -->';
   $return_string .= '<ul class="ult-posts row">';   
   
   $midia_query = new WP_Query(array('showposts' => $posts, 'post_type' => 'post', 'orderby' => 'date', 'order' => 'DESC'));						
   
   if ( $midia_query->have_posts() ) : while ( $midia_query->have_posts() ) : $midia_query->the_post();
	
	////////////////////////////////////////////////////////////////////////////////
	
	$return_string .= '<li class="col-md-4">';
		$return_string .= '<div class="media nbox">';
			if (has_post_thumbnail()) :
				$return_string .= '<a class="pull-left imagem" href="'. get_the_permalink() .'">'. get_the_post_thumbnail($post->ID, 'home-posts');					
					$return_string .= '<span class="filete"></span>';
					$return_string .= '<span class="bsmais">+</span>';
				$return_string .= '</a>';		
			endif;			
				$return_string .= '<div class="media-body">';
					$return_string .= '<h3 class="media-heading"><a href="'. get_the_permalink() .'" title="'. get_the_title() .'">'. get_the_title() .'</a></h3>';			
					$return_string .= '<p>'. strip_tags(get_excerpt(160, 'content'));								
					$return_string .= ' </p>';		
				$return_string .= '</div>';	
				$return_string .= '<div class="clearfix"></div>';
		$return_string .= '</div>';		
	$return_string .= '</li>';
	
	
	$return_string .= '';
	$return_string .= '';
	$return_string .= '';
	$return_string .= '';	
	
	////////////////////////////////////////////////////////////////////////////////		   
	endwhile;
	else :
		$return_string .= 'Não tem Posts';
	endif;
  
   $return_string .= '</ul>';
   $return_string .= '<!-- /Lista -->';

   wp_reset_query();
   return $return_string;
}

/* Carousel Soluções */
function carousel_solucoes_function($atts, $content = null) {
   extract(shortcode_atts(array(
      'posts' => 1,
   ), $atts));
   
   global $post;

   
	$return_string .= '<div id="carousel-showb" class="showbiz-container bdm carousel-solucoes">';   
		$return_string .= '<div class="showbiz-navigation  sb-nav-light">';
			$return_string .= '<a id="showbiz_left_1" class="sb-navigation-left"></a>';
			$return_string .= '<a id="showbiz_right_1" class="sb-navigation-right"></a>';
		$return_string .= '</div>';		
		$return_string .= '<div class="showbiz" data-left="#showbiz_left_1" data-right="#showbiz_right_1" data-play="#showbiz_play_1">';
			$return_string .= '<div class="overflowholder">';
				$return_string .= '<ul>';
				$return_string .= '<!-- Lista -->';
				/////////////////////////////////////////////////////////////////////////////////////////////////
					
					$images2 = rwmb_meta( 'gallery-images-ex', 'type=thickbox_image&size=gallery-carousel' );
					$images2_thumb = rwmb_meta( 'gallery-images-ex', 'type=thickbox_image&size=thumb-carousel' );
					
					foreach ( $images2 as $image2 )
					{
									  
						$return_string .= '<li class="col-xs-4 col-sm-3 col-md-3"><a href="'.$image2['url'].'" class="thumbnail fancybox" data-fancybox-group="gallery" title="">';
					
							foreach ( $images2_thumb as $thumb2 )
							{
								if ($image2['ID'] == $thumb2['ID']) {		
									$return_string .= '<img src="'.$thumb2['url'].'" alt="'.$thumb2['title'].'">';
								}
							}
						$return_string .= '</a></li>';
						
					}
			
				/////////////////////////////////////////////////////////////////////////////////////////////////
				$return_string .= '<!-- /Lista -->  ';
				$return_string .= '</ul>';
				$return_string .= '<div class="sbclear"></div>';
			$return_string .= '</div>';
			$return_string .= '<div class="sbclear"></div>';
		$return_string .= '</div>';	
	$return_string .= '</div>';
	$return_string .= '<div class="clearfix"></div> ';
   

   wp_reset_query();
   return $return_string;
}

/* Carousel Clientes */
function carousel_cliente_function($atts, $content = null) {
   extract(shortcode_atts(array(
      'posts' => 1,
   ), $atts));
   
   global $post;

   $return_string = '<h2 class="title-home" style="margin-bottom:25px;">'.$content.'</h2>';
   
	$return_string .= '<div id="carousel-showb2" class="showbiz-container bdm carousel-cliente">';   
		$return_string .= '<div class="showbiz-navigation  sb-nav-light">';
			$return_string .= '<a id="showbiz_left_2" class="sb-navigation-left"></a>';
			$return_string .= '<a id="showbiz_right_2" class="sb-navigation-right"></a>';
		$return_string .= '</div>';		
		$return_string .= '<div class="showbiz" data-left="#showbiz_left_2" data-right="#showbiz_right_2" data-play="#showbiz_play_2">';
			$return_string .= '<div class="overflowholder">';
				$return_string .= '<ul>';
				$return_string .= '<!-- Lista -->';
				/////////////////////////////////////////////////////////////////////////////////////////////////
					$cliente_query = new WP_Query(array('showposts' => $posts, 'post_type' => 'clientes', 'orderby' => 'rand'));
					if ( $cliente_query->have_posts() ) : while ( $cliente_query->have_posts() ) : $cliente_query->the_post();
												
						
						$clientes_logo = get_post_meta( $post->ID, '_upadilha_clientes_icon', true );						
						
						$return_string .= '<li>';
							$return_string .= '<div class="mediaholder">';
								
								$return_string .= '<div class="media_titulo">';
																	
									if(!empty($clientes_logo)):
									$return_string .= '<div class="logo-cliente mr-10">';
										$return_string .= '<img src="'.$clientes_logo.'" alt="Logo - '.get_the_title().'">';
									$return_string .= '</div>';
									endif;
									
								$return_string .= '</div>';
								
								$return_string .= '<div class="clearfix"></div>';
						
							$return_string .= '</div>';
						$return_string .= '</li>';					
					
					endwhile;
					else :
						$return_string .= 'Não tem Posts';
					endif;
					
					
				
				/////////////////////////////////////////////////////////////////////////////////////////////////
				$return_string .= '<!-- /Lista -->  ';
				$return_string .= '</ul>';
				$return_string .= '<div class="sbclear"></div>';
			$return_string .= '</div>';
			$return_string .= '<div class="sbclear"></div>';
		$return_string .= '</div>';	
	$return_string .= '</div>';
	$return_string .= '<div class="clearfix"></div> ';
   
   wp_reset_query();
   return $return_string;
}


/* Carousel Depoimentos */
function slide_depoimentos_function($atts, $content = null) {
   extract(shortcode_atts(array(
      'posts' => 1,
   ), $atts));
   
   global $post;


	$return_string = '<h2 class="title-home" style="margin-bottom:25px;">'.$content.'</h2>';
   	$return_string .= '<div class="slide-depoimentos">';
	$return_string .= '<div class="depoimentos-clientes">';  				
		$return_string .= '<div class="slider">';
			$return_string .= '<div class="flexslider fl">';
				$return_string .= '<ul class="slides fl">';
				$return_string .= '<!-- Lista -->';
				/////////////////////////////////////////////////////////////////////////////////////////////////
					
					$depoimentos_query = new WP_Query(array('showposts' => $posts, 'post_type' => 'depoimentos', 'orderby' => 'rand'));
					if ( $depoimentos_query->have_posts() ) : while ( $depoimentos_query->have_posts() ) : $depoimentos_query->the_post();												
												
						$depoimento = get_post_meta( $post->ID, '_upadilha_depoimentos_dep', true );
						$cargo = get_post_meta( $post->ID, '_upadilha_depoimentos_cli', true );
						$empresa = get_post_meta( $post->ID, '_upadilha_depoimentos_emp', true );
												
						
						$return_string .= '<li>';
							$return_string .= '<div class="texto">';
								$return_string .= '<span class="aspa"></span>';
								$return_string .= $depoimento;							
							$return_string .= '</div>';
							
							$return_string .= '<div class="clearfix"></div>';
							
							$return_string .= '<p class="autor">'.get_the_title().'</p>';												
							
							if($cargo):
							$return_string .= '<p class="descri">'.$cargo.' - '.$empresa.'</p>';
							else:
							$return_string .= '<p class="descri">'.$empresa.'</p>';
							endif;
							
						$return_string .= '</li>';					
					
					endwhile;
					else :
						$return_string .= 'Não tem Posts';
					endif;
				
				/////////////////////////////////////////////////////////////////////////////////////////////////
				$return_string .= '<!-- /Lista -->  ';
				$return_string .= '</ul>';				
			$return_string .= '</div>';			
		$return_string .= '</div>';	
	$return_string .= '</div>';
	$return_string .= '</div>';
	$return_string .= '<div class="clearfix"></div> ';
   

   wp_reset_query();
   return $return_string;
}


function register_shortcodes(){
   add_shortcode('recent-posts', 'recent_posts_function');
   add_shortcode('imagens-carousel', 'carousel_solucoes_function');
   add_shortcode('carousel-cliente', 'carousel_cliente_function');
   add_shortcode('slide-depoimentos', 'slide_depoimentos_function');
   /*add_shortcode('recent-posts3', 'recent_posts3_function');*/
}

add_action( 'init', 'register_shortcodes');

add_filter('widget_text', 'do_shortcode');


/* Criando Botao Recentes Posts */

function register_button( $buttons ) {
   //array_push( $buttons, "|", "recentposts" );
   array_push( $buttons, "|", "imagenscarousel" );
   //array_push( $buttons, "|", "carouselcliente" );
   //array_push( $buttons, "|", "slidedepoimentos" );
   return $buttons;
}


function add_plugin( $plugin_array ) {
   //$plugin_array['recentposts'] = get_template_directory_uri() . '/shortcodes/js/recent-posts.js';
   $plugin_array['imagenscarousel'] = get_template_directory_uri() . '/shortcodes/js/imagens-carousel.js';
   //$plugin_array['carouselcliente'] = get_template_directory_uri() . '/shortcodes/js/carousel-cliente.js';
   //$plugin_array['slidedepoimentos'] = get_template_directory_uri() . '/shortcodes/js/slide-depoimentos.js';
   return $plugin_array;
}

function my_recent_posts_button() {

   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
      return;
   }

   if ( get_user_option('rich_editing') == 'true' ) {
      add_filter( 'mce_external_plugins', 'add_plugin' );
      add_filter( 'mce_buttons', 'register_button' );
   }

}
add_action ('init',  'my_recent_posts_button');

?>