<?php
/**
 * Agência Upadilha - funções e definições
 *
 * Configure o tema e fornece algumas funções auxiliares, que são usados no tema como tags de template personalizado. 
 * Outros estão ligados a ação de filtro e ganchos em WordPress para alterar a funcionalidade do núcleo.
 *
 * Ao usar um tema criança você pode substituir certas funções (aqueles envolto em uma chamada function_exists()), 
 * definindo-os pela primeira vez no arquivo functions.php do seu tema criança. Arquivo functions.php do tema criança está incluído antes de arquivos do tema pai, 
 * então as funções tema criança seria usado.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Funções que não são conectáveis (não envoltos em function_exists()) em vez disso estão ligados a um filtro ou ação gancho.
 *
 * Para mais informações sobre os ganchos, ações e filtros,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Agencia_Upadilha
 * @since Agência Upadilha 1.0
 */

/**
 * Defina a largura do conteúdo baseado no projeto do tema e estilo.
 *
 * @since Agência Upadilha 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 750;
}

/**
 * Agência Upadilha só funciona em WordPress 4.1 ou posterior.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'upadilha_setup' ) ) :
/**
 * Configura predefinições do tema e registra suporte para várias características do WordPress.
 *
 * Note que esta função seja enganchado na gancho after_setup_theme, que
 * é executado antes do gancho de inicialização. O gancho de init é tarde demais para algumas funcionalidades, tais
 * como indicando suporte para pós miniaturas.
 *
 * @since Agência Upadilha 1.0
 */
function upadilha_setup() {

	/*
	 * Faça tema disponível para tradução.
	 * As traduções podem ser arquivados no diretório /languages/ diretório.
	 * Se você está construindo um tema baseado em upadilha, use um localizar e substituir
	 * para mudar 'upadilha' para o nome de seu tema em todos os arquivos de modelo
	 */
	load_theme_textdomain( 'upadilha', get_template_directory() . '/languages' );

	// Adicionar mensagens padrão e comentários ligações feed RSS para cabeça.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Vamos WordPress gerenciar o título do documento.
	 * Ao adicionar suporte a temas, declaramos que este tema não usa um
	 * codificados <title> tag no cabeçalho do documento, e esperar para WordPress
	 * fornecê-lo para nós.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Habilitar o suporte para Publicar Miniaturas em posts e páginas.
	 *
	 * Veja: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );	
	set_post_thumbnail_size( 750, 9999 ); // Altura ilimitada, corte suave
	add_image_size('blog-posts', 750, 360, true);
	add_image_size('home-post', 300, 240, true);
	add_image_size('home-posts', 360, 240, true);
	add_image_size('thumb-carousel', 400, 260, true);
	add_image_size('gallery-carousel', 800, 600, true);

	// Este tema usa wp_nav_menu () em dois locais.
	register_nav_menus( array(
		'menu_nav1'  => __( 'Rodape - Menu 01', 'upadilha' ),
		'menu_nav2'  => __( 'Rodape - Menu 02', 'upadilha' ),
		'menu_nav3'  => __( 'Rodape - Menu 03', 'upadilha' ),
		'menu_nav4'  => __( 'Rodape - Menu 04', 'upadilha' ),
		'menu_nav5'  => __( 'Rodape - Menu/Texto', 'upadilha' ),
	) );

	/*
	 * Marcação núcleo interruptor padrão para formulário de busca, o formulário de comentários, e comentários
	 * a saída HTML5 válido.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Habilitar o suporte para formatos de Post.
	 *
	 * Veja: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	) );

	//$color_scheme  = upadilha_get_color_scheme();
	//$default_color = trim( $color_scheme[0], '#' );

	// Setup o núcleo recurso de fundo personalizado WordPress.
	
	/*add_theme_support( 'custom-background', apply_filters( 'upadilha_custom_background_args', array(
		'default-color'      => $default_color,
		'default-attachment' => 'fixed',
	) ) );*/

	/*
	 * Estilos Este tema o editor visual para se assemelhar ao estilo de tema,
	 * especificamente fonte, cores, ícones e largura da coluna.
	 */
	add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', upadilha_fonts_url() ) );
}
endif; // upadilha_setup
add_action( 'after_setup_theme', 'upadilha_setup' );

/**
 * Registre-se área de Widget.
 *
 * @since Agência Upadilha 1.0
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function upadilha_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Widget Area', 'upadilha' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Adicionar widgets aqui para aparecer em sua barra lateral.', 'upadilha' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'upadilha_widgets_init' );

if ( ! function_exists( 'upadilha_fonts_url' ) ) :
/**
 * Registre-se fontes do Google para Fifteen Twenty.
 *
 * @since Agência Upadilha 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function upadilha_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';
	
	/*
	 * Translators: Se não houver caracteres em seu idioma que não são suportadas
	 * por Open Sans Condensed, traduzir isso para 'off'. Não se traduzem em seu próprio idioma.
	 */
	if ( 'off' !== _x( 'on', 'Open Sans Condensed font: on or off', 'upadilha' ) ) {
		$fonts[] = 'Open+Sans+Condensed:300,300italic,700';
	}
	
	/*
	 * Translators: Se não houver caracteres em seu idioma que não são suportadas
	 * por Source Sans Pro, traduzir isso para 'off'. Não se traduzem em seu próprio idioma.
	 */
	if ( 'off' !== _x( 'on', 'Source Sans Pro font: on or off', 'upadilha' ) ) {
		$fonts[] = 'Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900italic,900';
	}

	/*
	 * Translators: Se não houver caracteres em seu idioma que não são suportadas
	 * por Raleway, traduzir isso para 'off'. Não se traduzem em seu próprio idioma.
	 */
	if ( 'off' !== _x( 'on', 'Raleway font: on or off', 'upadilha' ) ) {
		$fonts[] = 'Raleway:400,300,500,600,700';
	}
	
	/*
	 * Translators: Se não houver caracteres em seu idioma que não são suportadas
	 * por Alegreya, traduzir isso para 'off'. Não se traduzem em seu próprio idioma.
	 */
	if ( 'off' !== _x( 'on', 'Alegreya font: on or off', 'upadilha' ) ) {
		$fonts[] = 'Alegreya:400,400italic,700,700italic,900,900italic';
	}

	/*
	 * Translators: Para adicionar um subconjunto de caracteres adicionais específicas para o seu idioma,
	 * traduzir isso para 'greek', 'cyrillic', 'devanagari "ou" vietnamese ". Não se traduzem em seu próprio idioma.
	 */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'upadilha' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * JavaScript Detecção.
 *
 * Adiciona uma classe 'js' à raiz '<html>' elemento quando é detectado JavaScript.
 *
 * @since Agência Upadilha 1.1
 */
function upadilha_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'upadilha_javascript_detection', 0 );

/**
 * Scripts e estilos de enfileiramento.
 *
 * @since Agência Upadilha 1.0
 */
function upadilha_scripts() {
	// Adicionar fontes personalizadas, usado na folha de estilo principal.
	wp_enqueue_style( 'upadilha-fonts', upadilha_fonts_url(), array(), null );

	// Adicionar Genericons, utilizado na folha de estilo principal.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.2' );

	// Coloque a página de estilo.
	wp_enqueue_style( 'upadilha-style', get_stylesheet_uri() );

	// Coloque a folha de estilo específica Internet Explorer.
	wp_enqueue_style( 'upadilha-ie', get_template_directory_uri() . '/css/ie.css', array( 'upadilha-style' ), '20141010' );
	wp_style_add_data( 'upadilha-ie', 'conditional', 'lt IE 9' );

	// Coloque a folha de estilo específica Internet Explorer 7.
	wp_enqueue_style( 'upadilha-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'upadilha-style' ), '20141010' );
	wp_style_add_data( 'upadilha-ie7', 'conditional', 'lt IE 8' );

	wp_enqueue_script( 'upadilha-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20141010', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'upadilha-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20141010' );
	}

	wp_enqueue_script( 'upadilha-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150330', true );
	wp_localize_script( 'upadilha-script', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'upadilha' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'upadilha' ) . '</span>',
	) );
}
add_action( 'wp_enqueue_scripts', 'upadilha_scripts' );

/**
 * Adicionar imagem caracterizada como imagem de fundo para postar elementos de navegação.
 *
 * @since Agência Upadilha 1.0
 *
 * @see wp_add_inline_style()
 */
function upadilha_post_nav_background() {
	if ( ! is_single() ) {
		return;
	}

	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	$css      = '';

	if ( is_attachment() && 'attachment' == $previous->post_type ) {
		return;
	}

	if ( $previous &&  has_post_thumbnail( $previous->ID ) ) {
		$prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-previous { background-image: url(' . esc_url( $prevthumb[0] ) . '); }
			.post-navigation .nav-previous .post-title, .post-navigation .nav-previous a:hover .post-title, .post-navigation .nav-previous .meta-nav { color: #fff; }
			.post-navigation .nav-previous a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	if ( $next && has_post_thumbnail( $next->ID ) ) {
		$nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-next { background-image: url(' . esc_url( $nextthumb[0] ) . '); border-top: 0; }
			.post-navigation .nav-next .post-title, .post-navigation .nav-next a:hover .post-title, .post-navigation .nav-next .meta-nav { color: #fff; }
			.post-navigation .nav-next a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	wp_add_inline_style( 'upadilha-style', $css );
}
add_action( 'wp_enqueue_scripts', 'upadilha_post_nav_background' );

/**
 * Descrições de exibição em navegação principal.
 *
 * @since Agência Upadilha 1.0
 *
 * @param string  $item_output A saída de item de menu.
 * @param WP_Post $item        Objeto de item de menu.
 * @param int     $depth       Profundidade do menu.
 * @param array   $args        wp_nav_menu() argumentos.
 * @return string Item de menu com uma possível descrição.
 */
function upadilha_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' == $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'upadilha_nav_description', 10, 4 );

/**
 * Adicionar uma classe `screen-reader-text` ao botão do formulário de busca apresentar.
 *
 * @since Agência Upadilha 1.0
 *
 * @param string $html Formulário de pesquisa HTML.
 * @return string Modificado formulário de pesquisa HTML.
 */
function upadilha_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'upadilha_search_form_modify' );

/**
 * Implementar o recurso de cabeçalho personalizado.
 *
 * @since Agência Upadilha 1.0
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Template tags personalizados para este tema.
 *
 * @since Agência Upadilha 1.0
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Adições Customizer.
 *
 * @since Agência Upadilha 1.0
 */
//require get_template_directory() . '/inc/customizer.php';

/**
 * ------------------------------------------------------------------------------------------------------
 * GABRIEL PADILHA *************************************************************************************|
 * Acrescentando funções *******************************************************************************|
 * ------------------------------------------------------------------------------------------------------
 */
 
// Theme Options ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/theme-options/ReduxCore/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/theme-options/ReduxCore/framework.php' );
}
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/theme-options/sample/options.php' ) ) {
    require_once( dirname( __FILE__ ) . '/theme-options/sample/options.php' );
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

 /** Load Custom Post types file. */
require get_template_directory() . '/inc/post-types.php';
require get_template_directory() . '/inc/meta-fields.php';

/** Load Meta Fields File. 
if ( file_exists(  __DIR__ . '/inc/metaboxes/init.php' ) ) {
  require_once  __DIR__ . '/inc/metaboxes/init.php';
} elseif ( file_exists(  __DIR__ . '/inc/metaboxes/init.php' ) ) {
  require_once  __DIR__ . '/inc/metaboxes/init.php';
}*/

require get_template_directory() . '/inc/metaboxes/init.php';

require get_template_directory() . '/inc/metaboxes/metaboxes.php';

require get_template_directory() . '/shortcodes/shortcodes.php';




// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

// Menu Principal +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/* Chamando Arquivo que vai customizar o menu "Walker" */
require get_template_directory() . '/modulos/menu/index.php';

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

// Função para limitar o texto do The Content +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function get_excerpt($limit, $source = null){

    if($source == "content" ? ($excerpt = get_the_content()) : ($excerpt = get_the_excerpt()));
    $excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace( '`\[[^\]]*\]`','', $excerpt));
    $excerpt = $excerpt.' <a href="'.get_permalink($post->ID).'">...</a>';
	
    return $excerpt;
}
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

// CSS Dinâmico +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/* Chamando os Styles */
//require get_template_directory() . '/inc/header-styles.php';

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


// Função para remover menus no Admin +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function remove_menus() {	
	
    global $menu;
	
	remove_menu_page( 'ebs-settings.php.php' );
	
    $restricted = array(__('Dashboard')/*, __('Tools'), __('Plugins')*/);
    end($menu);
 
    while (prev($menu)) {
        $value = explode(' ', $menu[key($menu)][0]);
 
        if (in_array($value[0] != NULL ? $value[0] : "", $restricted)) {
            unset($menu[key($menu)]);
        }
    }
} 
add_action('admin_menu', 'remove_menus');

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


//Link na tela de login para a página inicial +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

function my_login_logo() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/logo-wp.png);
            padding-bottom: 0px;
			background-size:auto;
			width: 100%;
        }
		
		/*body.login {
			background: -webkit-gradient(linear, left top, right top, from(#444444), to(#000000));
			background: -webkit-linear-gradient(top, #444444, #000000);
			background: -moz-linear-gradient(top, #444444, #000000);
			background: -o-linear-gradient(top, #444444, #000000);
			background: -ms-linear-gradient(top, #444444, #000000);
			background: linear-gradient(top, #444444, #000000);
			background-color: #444444;
	
		}*/
		
		body.login input[type="checkbox"]:focus, 
		body.login input[type="color"]:focus, 
		body.login input[type="date"]:focus, 
		body.login input[type="datetime-local"]:focus, 
		body.login input[type="datetime"]:focus, 
		body.login input[type="email"]:focus, 
		body.login input[type="month"]:focus, 
		body.login input[type="number"]:focus, 
		body.login input[type="password"]:focus, 
		body.login input[type="radio"]:focus, 
		body.login input[type="search"]:focus, 
		body.login input[type="tel"]:focus, 
		body.login input[type="text"]:focus, 
		body.login input[type="time"]:focus, 
		body.login input[type="url"]:focus, 
		body.login input[type="week"]:focus, 
		body.login select:focus, 
		body.login textarea:focus {
			border-color: #ff8f72;
			box-shadow: 0 0 2px rgba(226, 121, 88, 0.8);
		}
		
		.wp-core-ui .button-primary {
			background: none repeat scroll 0 0 #cc5333;
			border-color: #aa3000;
			box-shadow: 0 1px 0 rgba(230, 148, 120, 0.5) inset, 0 1px 0 rgba(0, 0, 0, 0.15);
			color: #fff;
			text-decoration: none;
		}
		
		.wp-core-ui .button-primary.focus, .wp-core-ui .button-primary.hover, .wp-core-ui .button-primary:focus, .wp-core-ui .button-primary:hover {
			background: none repeat scroll 0 0 #bd4c24;
			border-color: #aa3000;
			box-shadow: 0 1px 0 rgba(230, 148, 120, 0.6) inset;
			color: #fff;
		}
		
		.login #backtoblog a:hover, .login #nav a:hover, .login h1 a:hover {
			color: #cc5b33;
		}
		
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

function my_login_logo_url() {
return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );
 
function my_login_logo_url_title() {
return 'Your Site Name and Info';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );



function my_css_admin() {
  echo '<style>
    #wpb-js-composer-settings.vc_settings h2.nav-tab-wrapper a.nav-tab:nth-child(4) { display:none !important;}
	.updated.vc_license-activation-notice { display:none !important;}
	#toplevel_page_vc-general .wp-submenu.wp-submenu-wrap li:nth-child(5) { display:none !important;}
  </style>';
}
add_action('admin_head', 'my_css_admin');

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

// Ativar Plugins +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.4.0
 * @author     Thomas Griffin <thomasgriffinmedia.com>
 * @author     Gary Jones <gamajo.com>
 * @copyright  Copyright (c) 2014, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function my_theme_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

    	array(
            'name'               => 'Anti-spam', // O nome do plugin.
            'slug'               => 'anti-spam', // O slug do plugin (normalmente o nome do arquivo).
            'source'             => get_stylesheet_directory() . '/plugins/anti-spam.zip', // O arquivo do plugin.
            'required'           => true, // Se for falso, o plug-in só é "recomendado" em vez de necessária.
            'version'            => '', // E.g. 1.0.0. Se for definido, o plugin ativo deve ser esta versão ou superior.
            'force_activation'   => false, // Se for verdade, plug-in é ativado após a ativação tema e não pode ser desativado até que o interruptor tema.
            'force_deactivation' => false, // Se for verdade, plugin é desativado após interruptor tema, útil para plugins específicos do tema.
            'external_url'       => '', // Se for definido, substitui URL API padrão e aponta para uma URL externa.
        ),
		
		array(
            'name'               => 'Revolution Slider', // O nome do plugin.
            'slug'               => 'revslider', // O slug do plugin (normalmente o nome do arquivo).
            'source'             => get_stylesheet_directory() . '/plugins/revslider.zip', // O arquivo do plugin.
            'required'           => false, // Se for falso, o plug-in só é "recomendado" em vez de necessária.
            'version'            => '', // E.g. 1.0.0. Se for definido, o plugin ativo deve ser esta versão ou superior.
            'force_activation'   => false, // Se for verdade, plug-in é ativado após a ativação tema e não pode ser desativado até que o interruptor tema.
            'force_deactivation' => false, // Se for verdade, plugin é desativado após interruptor tema, útil para plugins específicos do tema.
            'external_url'       => '', // Se for definido, substitui URL API padrão e aponta para uma URL externa.
        ),
		
		array(
            'name'               => 'WordPress SEO', // O nome do plugin.
            'slug'               => 'wordpress-seo', // O slug do plugin (normalmente o nome do arquivo).
            'source'             => get_stylesheet_directory() . '/plugins/wordpress-seo.zip', // O arquivo do plugin.
            'required'           => false, // Se for falso, o plug-in só é "recomendado" em vez de necessária.
            'version'            => '', // E.g. 1.0.0. Se for definido, o plugin ativo deve ser esta versão ou superior.
            'force_activation'   => false, // Se for verdade, plug-in é ativado após a ativação tema e não pode ser desativado até que o interruptor tema.
            'force_deactivation' => false, // Se for verdade, plugin é desativado após interruptor tema, útil para plugins específicos do tema.
            'external_url'       => '', // Se for definido, substitui URL API padrão e aponta para uma URL externa.
        ),

        // Este é um exemplo de como incluir um plugin do WordPress Plugin Repository.
        array(
            'name'      => 'Configure SMTP',
            'slug'      => 'configure-smtp',
            'required'  => true,
        ),
		
		array(
            'name'      => 'Contact Form 7',
            'slug'      => 'contact-form-7',
            'required'  => true,
        ),
		
		array(
            'name'      => 'Easy Bootstrap Shortcode',
            'slug'      => 'easy-bootstrap-shortcodes',
            'required'  => true,
        ),
		
		array(
            'name'      => 'Meta Box',
            'slug'      => 'meta-box',
            'required'  => true,
        ),
		
		array(
            'name'      => 'Multiple Post Thumbnails',
            'slug'      => 'multiple-post-thumbnails',
            'required'  => true,
        ),
		
		/*array(
            'name'      => 'Redirection',
            'slug'      => 'redirection',
            'required'  => false,
        ),*/
		
		array(
            'name'      => 'TinyMCE Advanced',
            'slug'      => 'tinymce-advanced',
            'required'  => true,
        )
        

    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Instale os Plugins Obrigatório', 'tgmpa' ),
            'menu_title'                      => __( 'Instale Plugins', 'tgmpa' ),
            'installing'                      => __( 'Instalando o Plugin: %s', 'tgmpa' ), // %s = plugin name.
            'oops'                            => __( 'Algo deu errado com a API do plugin.', 'tgmpa' ),
            'notice_can_install_required'     => _n_noop( 'Este tema requer o seguinte plug-in: %1$s.', 'Este tema exige os seguintes plugins: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'Este tema recomenda o seguinte plug-in: %1$s.', 'Este tema recomenda os seguintes plugins: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Desculpe, mas você não tem as permissões corretas para instalar o %s plugin. Contato com o administrador do site para obter ajuda sobre como tirar o plugin instalado.', 'Desculpe, mas você não tem as permissões corretas para instalar o %s plugins. Contato com o administrador do site para obter ajuda em obter os plugins instalados.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'O seguinte plugin necessário é atualmente inativo: %1$s.', 'Os seguintes plugins necessários são atualmente inativa: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'O seguinte plug-in recomendado é atualmente inativo: %1$s.', 'Os seguintes plugins recomendadas são atualmente inativa: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Desculpe, mas você não tem as permissões corretas para ativar o %s plugin. Contato com o administrador do site para obter ajuda em obter o plugin ativado.', 'Desculpe, mas você não tem as permissões corretas para ativar o %s plugins. Contato com o administrador do site para obter ajuda em obter os plugins ativados.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'O seguinte plugin precisa ser atualizado para a versão mais recente para garantir o máximo de compatibilidade com este tema: %1$s.', 'Os seguintes plugins precisam ser atualizados para a sua versão mais recente para garantir a máxima compatibilidade com este tema: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Desculpe, mas você não tem as permissões corretas para atualizar o %s plugin. Contato com o administrador do site para obter ajuda em obter a atualização do plugin.', 'Desculpe, mas você não tem as permissões corretas para atualizar o %s plugins. Contato com o administrador do site para obter ajuda em obter os plugins atualizados.', 'tgmpa' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Comece a instalação de plug-in', 'Begin installing plugins', 'tgmpa' ),
            'activate_link'                   => _n_noop( 'Comece a ativação do plugin', 'Begin activating plugins', 'tgmpa' ),
            'return'                          => __( 'Retornar para Required Plugins Installer', 'tgmpa' ),
            'plugin_activated'                => __( 'Plugin ativado com sucesso.', 'tgmpa' ),
            'complete'                        => __( 'Todos os plugins instalado e ativado com sucesso. %s', 'tgmpa' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );

}
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


/**
 * RD Station - Integrações
 * addLeadConversionToRdstationCrm()
 * Envio de dados para a API de leads do RD Station
 *
 * Parâmetros:
 *     ($rdstation_token) - token da sua conta RD Station ( encontrado em https://www.rdstation.com.br/docs/api )
 *     ($identifier) - identificador da página ou evento ( por exemplo, 'pagina-contato' )
 *     ($data_array) - um Array com campos do formulário ( por exemplo, array('email' => 'teste@rdstation.com.br', 'name' =>'Fulano') )
 */
function addLeadConversionToRdstationCrm( $rdstation_token, $identifier, $data_array ) {
  $api_url = "http://www.rdstation.com.br/api/1.2/conversions";

  try {
    if (empty($data_array["token_rdstation"]) && !empty($rdstation_token)) { $data_array["token_rdstation"] = $rdstation_token; }
    if (empty($data_array["identificador"]) && !empty($identifier)) { $data_array["identificador"] = $identifier; }
    if (empty($data_array["email"])) { $data_array["email"] = $data_array["your-email"]; }
    if (empty($data_array["c_utmz"])) { $data_array["c_utmz"] = $_COOKIE["__utmz"]; }
    unset($data_array["password"], $data_array["password_confirmation"], $data_array["senha"], 
          $data_array["confirme_senha"], $data_array["captcha"], $data_array["_wpcf7"], 
          $data_array["_wpcf7_version"], $data_array["_wpcf7_unit_tag"], $data_array["_wpnonce"], 
          $data_array["_wpcf7_is_ajax_call"], $data_array["_wpcf7_locale"], $data_array["your-email"]);

    if ( !empty($data_array["token_rdstation"]) && !( empty($data_array["email"]) && empty($data_array["email_lead"]) ) ) {
      $data_query = http_build_query($data_array);
      if (in_array ('curl', get_loaded_extensions())) {
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_query);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_exec($ch);
        curl_close($ch);
      } else {
        $params = array('http' => array('method' => 'POST', 'content' => $data_query, 'ignore_errors' => true));
        $ctx = stream_context_create($params); 
        $fp = @fopen($api_url, 'rb', false, $ctx);
      }
    }
  } catch (Exception $e) { }
}
function addLeadConversionToRdstationCrmViaWpCf7( $cf7 ) {
  $token_rdstation = "TOKEN_CLIENTE";
  $submission = WPCF7_Submission::get_instance();

  if ( $submission ) {
      $form_data = $submission->get_posted_data();
    }
  addLeadConversionToRdstationCrm($token_rdstation, null, $form_data);
}
add_action('wpcf7_mail_sent', 'addLeadConversionToRdstationCrmViaWpCf7');

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


// Utilizando CSS no Admin WordPress ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

add_action('admin_head', 'my_custom_style');

function my_custom_style() {
  echo '<style>  	
	#adminmenu li#toplevel_page_w3tc_dashboard { display:none !important;}
  </style>';
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


