<?php
function add_head_styles() { ?>
<?php 
global $upadilha;

$cor_marca_01 = $upadilha['cor-marca-um'];
$cor_marca_02 = $upadilha['cor-marca-dois'];
$cor_marca_03 = $upadilha['cor-marca-tres'];

$cor_menu_01 = $upadilha['cor-menu-um'];
$cor_menu_02 = $upadilha['cor-menu-dois'];

$cor_extra_01 = $upadilha['cor-extra-um'];
$cor_extra_02 = $upadilha['cor-extra-dois'];
$cor_extra_03 = $upadilha['cor-extra-tres'];

$font_pagina = $upadilha['font-pagina'];
$font_titulo = $upadilha['font-titulo'];

?>

<style>
<?php if ($font_pagina): ?>		
	body, p, #topinho .container, .entry-content p, .entry-summary p, .comment-content p, .mu_register p, .widget-area .widget p, .lista-posts li p, .commentlist .vcard cite .fn, .widget-area ul li, .fxtitulo p, .lista-pro h5, body.custom-font-enabled { font-family:<?php echo $font_pagina['font-family']; ?>;}
	
	body, p, .entry-content p, .entry-summary p, .comment-content p, .mu_register p, .widget-area .widget p, .lista-posts li p, .commentlist .vcard cite .fn, .widget-area ul li, .fxtitulo p, .widget-area .widget a:hover, .widget-area .widget a:visited, .widget-area ul li, .widget-area .widget a, .entry-content h6, h6, .lista-pro h6 { color:<?php echo $font_pagina['color']; ?>;}
<?php endif ?>
<?php if ($font_titulo): ?>	
	h1, h2, h3, h4, h5, h6, .lista-posts li h3, .widget-title, .widget-area .widget h3, .entry-content h1, .entry-content h2, .entry-content h3, .entry-content h4, .entry-content h5, .entry-content h6, .fxtitulo h1, .menu-topo > .menu-prin > li { font-family:<?php echo $font_titulo['font-family']; ?>; }
	
	h1, h2, h3, h4, h5, .lista-posts li h3, .widget-title, .widget-area .widget h3, .entry-content h1, .entry-content h2, .entry-content h3, .entry-content h4, .entry-content h5, .fxtitulo h1 { color:<?php echo $font_titulo['color']; ?>; }
	
<?php endif ?>
<?php if ($cor_marca_01): /*Verde Escuro */?>	
	#topinho .container, .fxtitulo h1, .entry-content h1 a, .entry-content h2 a, .entry-content h3 a, .entry-content h4 a, .entry-content h5 a, .entry-content h6 a, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, .entry-content h2.oscitas-bootstrap-container, .lista-pro h4 { color:<?php echo $cor_marca_01; ?>;}
	
	.entry-content h1 a:hover, .entry-content h2 a:hover, .entry-content h3 a:hover, .entry-content h4 a:hover, .entry-content h5 a:hover, .entry-content h6 a:hover, h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover  { color:<?php echo $cor_marca_01; ?>;}
	.menu-top .navbar-default, .btn-default, .btn-default:hover, .btn-default:focus, .btn-default:active, .btn-default.active, .open .dropdown-toggle.btn-default { background:<?php echo $cor_marca_01; ?>;}
<?php endif ?>
<?php if ($cor_marca_02): /*Verde Claro */?>	
	
	
	.rodape .rsocial li a i.fa { color:<?php echo $cor_marca_02; ?>;}
	
	.rodape .rsocial li a:hover i.fa { color:<?php echo $cor_marca_02; ?>;} 
	
<?php endif ?>
<?php if ($cor_marca_03): /*Rosa */?>	
	a, .lista-posts li h3, .lista-posts li h3 a, .entry-content h2, .entry-content h5, .lista-pro h5, .entry-content li:before, .comment-content li:before, .mu_register li:before, .lista-aulas h2, .page-id-22 h6 { color:<?php echo $cor_marca_03; ?>;}
		
	a:hover, a:focus, .lista-posts li h3 a:hover { color:<?php echo $cor_marca_03; ?>;}
	
	.fxtitulo .linhatit, h2.oscitas-bootstrap-container span.glyphicon-minus { background:<?php echo $cor_marca_03; ?>;}
<?php endif ?>
<?php if ($cor_extra_01): /*Branco */ ?>	
	.container.rodape, 
	.rodape p, 
	.rodape a, 
	.menu-topo > .menu-prin > li:before  { color:<?php echo $cor_extra_01; ?>;}	
	
	.rodape .rsocial li a i.fa { background:<?php echo $cor_extra_01; ?>;}
<?php endif ?>
<?php if ($cor_menu_01 || $cor_menu_02): /*Chumbo */ ?>		
	.menu-topo > .menu-prin > li > a, 
	.menu-topo > .menu-prin > li:before  { color:<?php echo $cor_menu_01; ?>;}	
	.menu-topo > .menu-prin > li > a:hover, 
	.menu-topo > .menu-prin > li > a:focus, 
	.menu-topo > .menu-prin > li.current-menu-item > a { color:<?php echo $cor_menu_02; ?>;}
	
<?php endif ?>
@media (max-width: 767px) {
#topinho { background-color:<?php echo $cor_marca_02; ?>;}
#topinho span.infocon i.fa, .rsocial li a i.fa { color:<?php echo $cor_extra_01; ?>;}
	
}
</style>
<?php
}
add_action('wp_head','add_head_styles',100);