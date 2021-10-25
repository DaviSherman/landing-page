<?php
/**
 * O modelo para exibir o cabeçalho
 *
 * Exibe todos os do elemento cabeçalho.
 *
 * @package WordPress
 * @subpackage Agencia_Upadilha
 * @since Agência Upadilha 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php // Cargas HTML5 arquivo JavaScript para adicionar suporte para elementos de HTML5 em versões mais antigas do IE. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/x-icon">
<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/x-icon">
<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,300,300italic,200italic,400italic,600,600italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.jpg">
<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/img/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/img/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/img/apple-touch-icon-114x114.png">

<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/js/lightbox/themes/default/jquery.lightbox.css" />
<!-- FlexSlider / Depoimento -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/flexslider/flexslider.css" type="text/css" media="screen" />

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>

<!-- FancyBox --> 
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/fancybox/jquery.fancybox.js?v=2.1.5"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/fancybox/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/fancybox/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/fancybox/js.js"></script>

<?php if ( is_page_template( 'page-/home.php') ) : ?>
 

<?php elseif (false) : ?>
<?php else : ?>
<?php endif; ?>

<script type="text/javascript">
jQuery(document).ready(function($) {
 	/* Menu */
 	if ($(window).width() > 767) {
		jQuery('ul.menu-prin li.dropdown').hover(function() {
		  jQuery(this).find('.dropdown-menu').stop(true, true).delay(50).fadeIn();
		}, function() {
		  jQuery(this).find('.dropdown-menu').stop(true, true).delay(50).fadeOut();
		});
	}	
	if ($(window).width() < 767) {	
		$(".dropdown-toggle").attr("data-toggle", "dropdown");	 		

	}
	/*accordion*/
	$('.accordion-toggle').click(function() {
	  $(this).addClass( "toggleativo" );
	});
	$('.collapsed').removeClass( "toggleativo" );  
	

	//p vazio
	$('p').each(function() {
		var $this = $(this);
		if($this.html().replace(/\s|&nbsp;/g, '').length == 0)
			$this.remove();
	});
	
	/*  Função de navegação suave através de links */
	if(screen.width > 221){
		$(".menu-hover a, .mlp a").click(function(evento){
			 evento.preventDefault();
			 variavel = $(this).attr("id");
			 variavelID = $(this).attr("href");
			 //Valor "-270" é contado a partir do id do objeto
			 $('html,body').animate({
				 scrollTop: $(variavelID).offset().top - 65
			}, 1000);        
		 });		 
		
	}
	
	
});
</script>


<?php wp_head(); ?>

</head>

<body id="home" <?php body_class(); ?>>

<?php 
global $post;
global $upadilha; 

$menu_pagina = get_post_meta($post->ID, '_upadilha_home_nmenu_menu', true);
$menu_texto = get_post_meta($post->ID, '_upadilha_home_nmenu_alt', true);

//$logo = wp_get_attachment_image( get_post_meta( get_the_ID(), 'logo_shortcode', 1 ), 'full' );

$logo2 = get_post_meta($post->ID, 'logo_shortcode', true);

$form_news = get_post_meta($post->ID, '_upadilha_home_form_news', true);
$form_contato = get_post_meta($post->ID, '_upadilha_home_form_contato', true);

$topo_telefone = get_post_meta($post->ID, '_upadilha_home_topo-telefone', true);
?>

<?php if ($menu_texto): ?>		

<?php else : ?>

<!-- Menu -->
<div class="menu-top navbar-fixed-topi visible-xs visible-sm" >
    <div class="container-gab">                 
        <nav class="navbar navbar-default" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand visible-xs" href="#">Menu</a>                
                </div>            
                <?php						
				if ( is_page_template('page-/home.php') ) :							
					
					if ($menu_texto){							
						echo '<div class="menu-texto">'.$menu_texto.'</div>';
						
					} else {
					
						wp_nav_menu( array(
							'menu'              => $menu_pagina,                                
							'depth'             => 2,
							'container'         => 'div',
                        	'container_class'   => 'collapse navbar-collapse navbar-ex1-collapse',
							'menu_id'           => 'menulp',
							'menu_class'        => 'menu-prin ff1 nav navbar-nav',
							'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
							'walker'            => new wp_bootstrap_navwalker())
						);
					}
					
					
				else :
				
					wp_nav_menu( array(
                        'menu'              => 'menu_principal',
                        'theme_location'    => 'menu_principal',
                        'depth'             => 2,
                        'container'         => 'div',
                        'container_class'   => 'collapse navbar-collapse navbar-ex1-collapse',
                        'menu_class'        => 'menu-prin nav navbar-nav',
                        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                        'walker'            => new wp_bootstrap_navwalker())
                    );
					
				endif;
				?>
            </div>
        </nav>
    </div>
</div>
<!-- /Menu -->

<?php endif; ?>	

<!-- Divtop -->
<div id="divtop">	
	<div class="container topo">                
		<div class="row">                      
            <div class="col-md-12 pr">  
            	<!-- Logo -->
                <?php //echo $logo; ?>
                <?php //echo $logo2; ?>
                <div class="logo">           
               
                
                	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">                        
                        <?php if ($upadilha['topo-logo']['url']): ?>		
                        <img src="<?php echo $upadilha['topo-logo']['url']; ?>" alt="Logo <?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
                        <?php else : ?>		
                        <img src="<?php echo $logo2; ?>" alt="Logo <?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
                        <?php endif; ?>	
                    </a>
                </div>
                <!-- \Logo -->
                
                <div class="fr lhinfo">                   
                    
                    <!-- Redes Sociais -->
                    <?php if($upadilha['topo-social']) { ?>
                    <ul class="rsocial">
                        <?php foreach ($upadilha['topo-social'] as $slide) {
                            echo '<li><a target="_blank" title="'.$slide['title'].'" href="'.$slide['url'].'"><i class="'.$slide['description'].'"></i></a>
                        </li>';
                        } ?>
                    </ul>
                    <?php } ?>
                    <!-- //Redes Sociais -->
                    
                    <!-- Telefone -->
                    <?php if($topo_telefone) { ?>
                    <span class="telefone">
                    <i class="fa fa-whatsapp"></i> 
					<?php echo $topo_telefone; ?>
                    </span>
                    <?php } ?>
                    <!-- //Telefone -->
                </div>
                
                                             
                <div class="fr clr marg-menu visible-md visible-lg">
                    <!-- Menu -->                 
                    <nav class="menu-topo fl" role="navigation">                        
                        <?php						
						if ( is_page_template('page-/home.php') ) :							
							
							if ($menu_texto){							
								echo '<div class="menu-texto">'.$menu_texto.'</div>';
								
							} else {
							
								wp_nav_menu( array(
									'menu'              => $menu_pagina,                                
									'depth'             => 2,
									'container'         => '',
									'container_class'   => '',
									'menu_id'           => 'menulp',
									'menu_class'        => 'menu-prin ff1 mlp',
									'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
									'walker'            => new wp_bootstrap_navwalker())
								);
							}
							
							
						else :
						
							wp_nav_menu( array(
								'theme_location'    => 'menu_principal',                                
								'depth'             => 2,
								'container'         => '',
								'container_class'   => '',
								'menu_id'           => 'menulp',
								'menu_class'        => 'menu-prin ff1 kkk',
								'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
								'walker'            => new wp_bootstrap_navwalker())
							);
							
						endif;
						?>
                    </nav>
                    <!-- /Menu -->
                   
                    <!-- float menu -->
                    <ul class="contato">
                            <li>
                                <a class="btn btn-default" href="javascript:void(window.open('http://m2vipp.com.br/livezila/chat.php?a=08b3c&intgroup=Y29ycmV0b3Jlcw__&intid=bTJ2aXBw&pref=dXNlcg__&hfk=MQ__&epc=I2E4Y2Y0NQ__&etc=IzI4NDM1ZQ__','','width=610,height=760,left=0,top=0,resizable=yes,menubar=no,location=no,status=yes,scrollbars=yes'))">
                                    <i class="fa fa-headphones"></i>
                                    <span class="text">Corretores On-line</span>                                     
                                </a>
                          </li>
                          <li>
                                <a class="btn btn-default" href="#" data-toggle="modal" data-target=".form-ligamos-modal">
                                    <i class="fa fa-list-ul"></i>
                                    <span class="text">Newsleter</span>
                                </a>
                          </li>
                          <li>
                                <a class="btn btn-default" href="http://www.m2vipp.com.br" target="_blank">
                                    <i class="fa fa-home"></i>
                                    <span class="text">M2VIPP</span>
                                </a>
                          </li>
                          <li>
                                <a class="btn btn-default" href="#" data-toggle="modal" data-target=".form-contato-modal">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="text">Envie uma mensagem</span>
                                </a>
                          </li>
                        </ul>
                        
                        <!-- Modal Newslatter -->
                        <div class="modal fade form-ligamos-modal" role="dialog" aria-labelledby="gridModalLigamos">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">              
                                    <form>
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">×</span></button>
                                            <h5 class="modal-title" id="gridModalLigamos">Newsletter</h5>
                                        </div><!-- /.modal-header -->
                                        <div class="modal-body">
                                            <div class="container-fluid">
                                                <!-- /.row -->
                                                <?php echo do_shortcode($form_news); ?> 
                                                <!-- /.row -->
                                            </div>
                                            <!-- /.container-fluid -->
                                        </div><!-- /.modal-body -->
                                    </form>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                        <!-- end Newslatter -->
    
                        <!-- Modal Envie uma Mensagem -->
                        <div class="modal fade form-contato-modal" role="dialog" aria-labelledby="gridModalContato">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">              
                                    <form>
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">×</span></button>
                                            <h5 class="modal-title" id="gridModalContato">Preencha seus dados para entrarmos em contato</h5>
                                        </div><!-- /.modal-header -->
                                        <div class="modal-body">
                                            <div class="container-fluid">
                                                <!-- /.row -->
                                                <?php echo do_shortcode($form_contato); ?>
                                                <!-- /.row -->
                                            </div>
                                            <!-- /.container-fluid -->
                                        </div><!-- /.modal-body -->
                                    </form>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                        <!-- end Envie Uma Mensagem -->
                        <!-- float menu fim -->
                </div> 
                             
			</div>                   
		</div>
	</div><!-- .topo -->    
</div>
<!-- /Divtop -->