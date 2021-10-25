<?php
/**
 * The template for displaying Search Results pages
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
					<h1><?php printf( __( 'Resultado para: %s', 'twentytwelve' ), '<span>' . get_search_query() . '</span>' ); ?></h1>                       
			</div>
		</div>
	</div>
</div>
<!-- //Título -->

<div class="clearfix"></div>

<?php if ( have_posts() ) : ?>
<!-- Página -->
<div class="container clb mt-10">	            
    <div class="row">
        <div class="col-md-8">
              
            <!-- Conteudo -->
            <div class="clearfix"></div> 
            <ul class="lista-posts">
            <?php
            /* Start the Loop */
            while ( have_posts() ) : the_post();

                /* Include the post format-specific template for the content. If you want to
                 * this in a child theme then include a file called called content-___.php
                 * (where ___ is the post format) and that will be used instead.
                 */
                get_template_part( 'content', get_post_format() );

            endwhile;

            
            ?>
            </ul>
            <div class="clearfix"></div> 
<div class="nav-previous fl"><?php previous_posts_link( '<button class="btn btn-primary btn-sm"><i class="fa fa-angle-double-left mr-02 f14"></i> Anterior </button>' ); ?></div>
<div class="nav-next alignright"><?php next_posts_link( '<button class="btn btn-primary btn-sm">Próximo <i class="fa fa-angle-double-right mr-02 f14"></i> </button>' ); ?></div>
            <!-- /Conteudo -->               
        </div>
        
        <div class="col-md-4 sidebar-single visible-md visible-lg">
            <div class="clearfix"></div>        	
            <?php get_sidebar(); ?>        
        </div>	
                          
    </div>                      
</div>
<!-- //Página -->

<?php else : ?>

<!-- Página -->
<div class="container clb mt-10">	            
    <div class="row">
        <div class="col-md-8">
			<article id="post-0" class="post no-results not-found">
                <header class="entry-header">
                    <h1 class="entry-title"><?php _e( 'Nothing Found', 'twentytwelve' ); ?></h1>
                </header>

                <div class="entry-content">
                    <p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentytwelve' ); ?></p>
                    <?php get_search_form(); ?>
                </div><!-- .entry-content -->
            </article><!-- #post-0 -->         
        </div>        
        <div class="col-md-4 sidebar-single visible-md visible-lg">
            <div class="clearfix"></div>        	
            <?php get_sidebar(); ?>        
        </div>                          
    </div>                      
</div>
<!-- //Página -->

<?php endif; ?>

            
<?php get_footer(); ?>