<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */

if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}

/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' cmb2_box parameter
 *
 * @param  CMB2 object $cmb CMB2 object
 *
 * @return bool             True if metabox should show
 */
function yourprefix_show_if_front_page( $cmb ) {
	// Don't show this metabox if it's not the front page template
	if ( $cmb->object_id !== get_option( 'page_on_front' ) ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field object $field Field object
 *
 * @return bool                     True if metabox should show
 */
function yourprefix_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a message if the $post_id is 2
 *
 * @param  array             $field_args Array of field parameters
 * @param  CMB2_Field object $field      Field object
 */
function yourprefix_before_row_if_2( $field_args, $field ) {
	if ( 2 == $field->object_id ) {
		echo '<p>Testing <b>"before_row"</b> parameter (on $post_id 2)</p>';
	} else {
		echo '<p>Testing <b>"before_row"</b> parameter (<b>NOT</b> on $post_id 2)</p>';
	}
}

/**
 * ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| *
 *  - Home
 * ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| *
 */
 
// check for a template type
$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
$template_file = get_post_meta($post_id,'_wp_page_template',TRUE);	

/* Home */	
if ($template_file == 'page-/home.php') {
		
	add_action( 'cmb2_admin_init', 'upadilha_page_home_metabox' );
	
	function upadilha_page_home_metabox() {
		
		/* Nome Menu */
		
		$menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
		global $menuArray;
		$menuArray = array( 'default' => 'Selecione');
		foreach ( $menus as $menu ) {
			$menuArray[ $menu->slug ] = $menu->name;
		}
	
		// Comece com um sublinhado para ocultar campos de lista de campos personalizados
		$prefix = '_upadilha_home_';
	
		/**
		 * METABOX exemplo para demonstrar cada tipo de campo incluído
		 */
		$cmb_upadilha = new_cmb2_box( array(
			'id'            => $prefix . 'metabox',
			'title'         => __( 'Configurações', 'cmb2' ),
			'object_types'  => array( 'page', ), // Post type
			// 'show_on_cb' => 'yourprefix_show_if_front_page', // função deve retornar um valor booleano
			// 'context'    => 'normal',
			// 'priority'   => 'high',
			'show_names' => false, // Mostrar nomes de campo à esquerda
			// 'cmb_styles' => false, // false para desativar a folha de estilo CMB
			// 'closed'     => true, // verdadeira para manter a METABOX fechado por padrão
		) );
		
		$cmb_upadilha->add_field( array(
			'name' => 'Logo Página',
			'desc' => 'Use o campo abaixo para inserir o logo da página.',
			'type' => 'title', 
			'id'   => 'home_tit_logo'
		) );
		
		$cmb_upadilha->add_field( array(
			'name'    => 'Logo',
			'desc'    => 'Faça upload ou coloque um link para o logo.',
			'id'      => 'logo_shortcode',
			'type'    => 'file',
			// Optional:
			'options' => array(
				'url' => true, // Hide the text input for the url
			),
			'text'    => array(
				'add_upload_file_text' => 'Adicionar' // Change upload button text. Default: "Add or Upload File"
			),
		) );
		
		/*$cmb_upadilha->add_field( array(			
			'name' 	=> __( 'Shortcode Banner', 'cmb2' ),
			'desc' 	=> __( 'coloque um shortcode para o banner', 'cmb2' ),			
			'id'	=> $prefix . 'teste1',
			'type' 	=> 'text',
		) );
	
		$cmb_upadilha->add_field( array(
			'name' => 'Banner',
			'desc' => 'A seguir as informações correspondento ao banner na home do site.',
			'type' => 'title', 
			'id'   => 'home_tit_banner'
		) );
		
		$cmb_upadilha->add_field( array(			
			'name' 	=> __( 'Shortcode Banner', 'cmb2' ),
			'desc' 	=> __( 'coloque um shortcode para o banner', 'cmb2' ),			
			'id'	=> $prefix . 'banner_shortcode',
			'type' 	=> 'text',
		) );
		
		$cmb_upadilha->add_field( array(			
			'name' 	=> __( 'Shortcode Banner Mobile', 'cmb2' ),
			'desc' 	=> __( 'coloque um shortcode para o banner Mobile', 'cmb2' ),			
			'id'	=> $prefix . 'banner_mobile',
			'type' 	=> 'text',
		) );*/
		
		$cmb_upadilha->add_field( array(
			'name' => 'Menu',
			'desc' => 'Escolha o Menu da landing page',
			'type' => 'title', 
			'id'   => 'home_tit_menu'
		) );
		
		$cmb_upadilha->add_field( array(	
			'name'             => 'Menus',
			'desc'             => 'Selecione um Menu',
			'id'				=> $prefix . 'nmenu_menu',
			'type'             => 'select',
			'show_option_none' => true,
			'default'          => 'custom',
			'options'          => $menuArray,
		) );
		
		
		$cmb_upadilha->add_field( array(			
			'name' 	=> __( 'Menu Livre', 'cmb2' ),
			'desc' 	=> __( 'Aqui você pode substituir o menu por uma frase ou dados de contato', 'cmb2' ),			
			'id'	=> $prefix . 'nmenu_alt',
			'type' 	=> 'text',
		) );
		
		$cmb_upadilha->add_field( array(
			'name' => 'Telefones',
			'desc' => 'Defina os telefones do topo',
			'type' => 'title', 
			'id'   => 'home_tit_telefone'
		) );
		
		$cmb_upadilha->add_field(array(
			'id'                => $prefix . 'topo-telefone',
			'type'              => 'text',
			'desc'              => __('Coloque os telefones para contato.', 'nomecliente'),
			'default'           => '(xx) x xxxx.xxxx / xxxx.xxxx'
        ));
		
		$cmb_upadilha->add_field( array(
			'name' => 'Cor Rodapé',
			'desc' => 'Escolha uma cor para o rodapé',
			'type' => 'title', 
			'id'   => 'home_tit_rodape'
		) );
		
		$cmb_upadilha->add_field( array(
			'name'    => 'Test Color Picker',
			'id'	=> $prefix . 'color_rodape',
			'type'    => 'colorpicker',
			'default' => '#03638f',
		) );
		
		
		$cmb_upadilha->add_field( array(
			'name' => 'Formulário Newsletter',
			'desc' => 'Coloque abaixo o shortcode para este formulário.',
			'type' => 'title', 
			'id'   => 'home_tit_f1'
		) );
		
		$cmb_upadilha->add_field( array(			
			'name' 	=> __( 'Shortcode Form Newsletter', 'cmb2' ),
			'desc' 	=> __( 'coloque um shortcode para o Form Newsletter', 'cmb2' ),			
			'id'	=> $prefix . 'form_news',
			'type' 	=> 'text',
		) );
		
		
		$cmb_upadilha->add_field( array(
			'name' => 'Formulário Contato',
			'desc' => 'Coloque abaixo o shortcode para este formulário.',
			'type' => 'title', 
			'id'   => 'home_tit_f2'
		) );
		
		$cmb_upadilha->add_field( array(			
			'name' 	=> __( 'Shortcode Form Contato', 'cmb2' ),
			'desc' 	=> __( 'coloque um shortcode para o Form Contato', 'cmb2' ),			
			'id'	=> $prefix . 'form_contato',
			'type' 	=> 'text',
		) );
		
		
		
	 
	} /*function*/

}/*if*/
 
/**
 * ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| *
 *  - .
 * ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| *
 */
 
 /**
 * ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| *
 *  - Serviços
 * ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| *
 */
 
 /* Página Serviços */

	add_action( 'cmb2_admin_init', 'upadilha_cpt_solucoes_metabox' );
	
	function upadilha_cpt_solucoes_metabox() {
	
		// Comece com um sublinhado para ocultar campos de lista de campos personalizados
		$prefix = '_upadilha_solucoes_';
	
		/**
		 * METABOX exemplo para demonstrar cada tipo de campo incluído
		 */
		$cmb_upadilha = new_cmb2_box( array(
			'id'            => $prefix . 'metabox',
			'title'         => __( 'Configurações', 'cmb2' ),
			'object_types'  => array( 'solucoes', ), // Post type
			// 'show_on_cb' => 'yourprefix_show_if_front_page', // função deve retornar um valor booleano
			// 'context'    => 'normal',
			// 'priority'   => 'high',
			'show_names' => false, // Mostrar nomes de campo à esquerda
			// 'cmb_styles' => false, // false para desativar a folha de estilo CMB
			// 'closed'     => true, // verdadeira para manter a METABOX fechado por padrão
		) );
		
		$cmb_upadilha->add_field( array(
			'name' => 'Descrição de Destaque',
			'desc' => '',
			'type' => 'title', 
			'id'   => 'solucoes_tit_01'
		) );
		
		$cmb_upadilha->add_field( array(			
			'name' 	=> __( 'Título Home', 'cmb2' ),
			'desc' 	=> __( 'coloque um Título para a soluçãom este título será exibido na home', 'cmb2' ),			
			'id'	=> $prefix . 'titulo',
			'type' 	=> 'text',
		) );
	
		$cmb_upadilha->add_field( array(
			'name' => __( 'Descrição de Destaque', 'cmb2' ),
			'desc' => __( 'Este é um campo para fazer uma Descrição de Destaque para esta solução.', 'cmb2' ),
			'id'   => $prefix . 'desc',
			'type' => 'textarea_small',
		) );
		
		$cmb_upadilha->add_field( array(
			'name' => 'Icone',
			'desc' => '',
			'type' => 'title', 
			'id'   => 'solucoes_tit_02'
		) );
		
		$cmb_upadilha->add_field( array(
			'name' => __( 'Icon', 'cmb2' ),
			'desc' => __( 'Faça upload de uma imagem ou coloque uma URL para usar como ícone desta solução ao lado do título.', 'cmb2' ),
			'id'   => $prefix . 'icon',
			'type' => 'file',
		) );
		
		$cmb_upadilha->add_field( array(
			'name' => 'Botão',
			'desc' => '',
			'type' => 'title', 
			'id'   => 'solucoes_tit_03'
		) );
		
		$cmb_upadilha->add_field( array(
			'name'    => __( 'Cor Botão', 'cmb2' ),
			'desc'    => __( 'Escolha a cor para o botão "Saiba mais" desta solução com base na cor do ícone.', 'cmb2' ),
			'id'      => $prefix . 'color',
			'type'    => 'colorpicker',
			'default' => '#343434',
		) );
		
	 
	} /*function*/
 
 
 
 /**
 * ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| *
 *  - .
 * ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| *
 */
 
 
 /**
 * ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| *
 *  - Clientes
 * ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| *
 */
 
 /* Clientes */

	add_action( 'cmb2_admin_init', 'upadilha_cpt_clientes_metabox' );
	
	function upadilha_cpt_clientes_metabox() {
	
		// Comece com um sublinhado para ocultar campos de lista de campos personalizados
		$prefix = '_upadilha_clientes_';
	
		/**
		 * METABOX exemplo para demonstrar cada tipo de campo incluído
		 */
		$cmb_upadilha = new_cmb2_box( array(
			'id'            => $prefix . 'metabox',
			'title'         => __( 'Logo do Cliente', 'cmb2' ),
			'object_types'  => array( 'clientes', ), // Post type
			// 'show_on_cb' => 'yourprefix_show_if_front_page', // função deve retornar um valor booleano
			// 'context'    => 'normal',
			// 'priority'   => 'high',
			'show_names' => false, // Mostrar nomes de campo à esquerda
			// 'cmb_styles' => false, // false para desativar a folha de estilo CMB
			// 'closed'     => true, // verdadeira para manter a METABOX fechado por padrão
		) );
		
		$cmb_upadilha->add_field( array(
			'name' => __( 'Imagem', 'cmb2' ),
			'desc' => __( 'Faça upload de uma imagem ou coloque uma URL para usar como logotipo deste cliente.', 'cmb2' ),
			'id'   => $prefix . 'icon',
			'type' => 'file',
		) );
		
		
		
	 
	} /*function*/
 
 
 
 /**
 * ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| *
 *  - .
 * ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| *
 */
 
 /**
 * ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| *
 *  - Depoimento
 * ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| *
 */
 
 /* Depoimento */

	add_action( 'cmb2_admin_init', 'upadilha_cpt_depoimentos_metabox' );
	
	function upadilha_cpt_depoimentos_metabox() {
	
		// Comece com um sublinhado para ocultar campos de lista de campos personalizados
		$prefix = '_upadilha_depoimentos_';
	
		/**
		 * METABOX exemplo para demonstrar cada tipo de campo incluído
		 */
		$cmb_upadilha = new_cmb2_box( array(
			'id'            => $prefix . 'metabox',
			'title'         => __( 'Informações', 'cmb2' ),
			'object_types'  => array( 'depoimentos', ), // Post type
			// 'show_on_cb' => 'yourprefix_show_if_front_page', // função deve retornar um valor booleano
			// 'context'    => 'normal',
			// 'priority'   => 'high',
			'show_names' => false, // Mostrar nomes de campo à esquerda
			// 'cmb_styles' => false, // false para desativar a folha de estilo CMB
			// 'closed'     => true, // verdadeira para manter a METABOX fechado por padrão
		) );
				
		$cmb_upadilha->add_field( array(
			'name' => __( 'Depoimento', 'cmb2' ),
			'desc' => __( 'Este é um campo para colocar o depoimento do cliente.', 'cmb2' ),
			'id'   => $prefix . 'dep',
			'type' => 'textarea',
		) );
		
		$cmb_upadilha->add_field( array(			
			'name' 	=> __( 'Cargo', 'cmb2' ),
			'desc' 	=> __( 'coloque o cargo ou representação do cliente na empresa.', 'cmb2' ),			
			'id'	=> $prefix . 'cli',
			'type' 	=> 'text',
		) );
		
		$cmb_upadilha->add_field( array(			
			'name' 	=> __( 'Empresa', 'cmb2' ),
			'desc' 	=> __( 'coloque o nome da empresa do cliente.', 'cmb2' ),			
			'id'	=> $prefix . 'emp',
			'type' 	=> 'text',
		) );
		
	 
	} /*function*/ 
 
 /**
 * ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| *
 *  - .
 * ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| *
 */
 
 

/**
 * ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| *
 *  - Página Blog
 * ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| *
 */
 

/* Blog */	
if (true) {
		
	add_action( 'cmb2_admin_init', 'upadilha_page_blog_metabox' );
	
	function upadilha_page_blog_metabox() {
	
		// Comece com um sublinhado para ocultar campos de lista de campos personalizados
		$prefix = '_upadilha_blog_';
	
		/**
		 * METABOX exemplo para demonstrar cada tipo de campo incluído
		 */
		$cmb_upadilha = new_cmb2_box( array(
			'id'            => $prefix . 'metabox',
			'title'         => __( 'Configurações', 'cmb2' ),
			'object_types'  => array( 'page', ), // Post type
			// 'show_on_cb' => 'yourprefix_show_if_front_page', // função deve retornar um valor booleano
			// 'context'    => 'normal',
			// 'priority'   => 'high',
			'show_names' => false, // Mostrar nomes de campo à esquerda
			// 'cmb_styles' => false, // false para desativar a folha de estilo CMB
			// 'closed'     => true, // verdadeira para manter a METABOX fechado por padrão
			'show_on'      => array( 'id' => array( 47, ) ), // Specific post IDs to display this metabox
		) );
	
		$cmb_upadilha->add_field( array(
			'name' => 'Banner',
			'desc' => 'A seguir as informações correspondento ao banner na home do site.',
			'type' => 'title', 
			'id'   => 'blog_tit_banner'
		) );
		
		$cmb_upadilha->add_field( array(			
			'name' 	=> __( 'Shortcode Banner', 'cmb2' ),
			'desc' 	=> __( 'coloque um shortcode para o banner', 'cmb2' ),			
			'id'	=> $prefix . 'banner_shortcod',
			'type' 	=> 'text',
		) );
		
		
		
	 
	} /*function*/

}/*if*/
 
/**
 * ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| *
 *  - .
 * ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| *
 */

