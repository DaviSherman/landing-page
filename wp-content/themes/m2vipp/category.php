<?php
/**
 * The template for displaying Category pages
 *
 * Used to display archive-type pages for posts in a category.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

<?php if ( have_posts() ) : ?>
<!-- Título -->
<div class="fxtitulo">
	<div class="container pr">               
		<div class="row mt-20 mb-20">
            <div class="col-md-12 cl-f">            	              	
				<h1><?php printf( __( '%s', 'twentytwelve' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>
                <div class="linhatit"></div>                         
			</div>
		</div>
	</div>
</div>
<!-- //Título -->

<div class="clearfix"></div>

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
	<?php get_template_part( 'content', 'none' ); ?>
<?php endif; ?>


<?php get_footer(); ?>