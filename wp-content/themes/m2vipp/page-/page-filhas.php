<?php
/**
 * Template Name: Lateral - Pag Filhas
 *
 * Description: Twenty Twelve loves the no-sidebar look as much as
 * you do. Use this page template to remove the sidebar from any page.
 *
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
<?php
global $upadilha;
global $post;

?>
   
<!-- Título -->
<div class="fxtitulo">
	<div class="container pr">               
		<div class="row mt-20 mb-20">
            <div class="col-md-12 cl-f">             	
				<?php
                    $page_pai = array_reverse( get_post_ancestors( $post->ID ) );
                    $title_raiz = get_page( $page_pai[0] );
                    $title_pai = get_page( $page_pai[1] );
                    $title_filho = get_page( $page_pai[2] );				               
                 ?>                               	
                <h1><?php echo get_the_title($title_raiz); ?></h1>                         
			</div>
		</div>
	</div>
</div>
<!-- //Título -->

<!-- Página -->
<div id="pagina-filha" class="pr">
    <div class="container clb5 mh pr"> 
        <div class="row mb-40">                
            
            <div class="col-md-3">
            	<div class="sidebar-page-filhas">
				<?php $url_atual = get_the_ID($post->ID); ?>                
                
				<?php
                // Pega todos os ancestrais de forma reversa
                $parent = array_reverse( get_post_ancestors( $post->ID ) );
				                
                // Seleciona apenas o primeiro, que é o top-level parent
                $top_parent = get_page( $parent[0] );?> 
                
                <ul class="subpaginas">
					<?php
                    // Lista as páginas filhas desta página
                    wp_list_pages( array( 'child_of' => $top_parent->ID, 'title_li' => '', 'sort_column' => 'post_date'  ) );
                    ?>
                </ul>                    
                
                </div>
                <div class="clearfix"></div>
            </div><!--col-->
            
            <div class="col-md-9">
            	<h2 class="title-page"><?php the_title(); ?></h2>            	
                <div class="wid-tot mh">					
                        <?php get_template_part( 'content', 'page' ); ?>                                                            
                    <div class="clearfix"></div>                    
                </div>
            </div><!--col-->
            
        </div><!--row-->
    </div><!--container-->

</div>
<!-- //Página -->


<?php get_footer(); ?>