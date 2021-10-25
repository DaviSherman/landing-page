<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Twelve already
 * has tag.php for Tag archives, category.php for Category archives, and
 * author.php for Author archives.
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
					<h1><?php
						if ( is_day() ) :
							printf( __( 'Daily Archives: %s', 'twentytwelve' ), '<span> ' . get_the_date() . '</span>' );
						elseif ( is_month() ) :
							printf( __( 'Monthly Archives: %s', 'twentytwelve' ), '<span> ' . get_the_date( _x( 'F Y', 'monthly archives date format', 'twentytwelve' ) ) . '</span>' );
						elseif ( is_year() ) :
							printf( __( 'Yearly Archives: %s', 'twentytwelve' ), '<span> ' . get_the_date( _x( 'Y', 'yearly archives date format', 'twentytwelve' ) ) . '</span>' );
						else :
							_e( 'Serviços', 'twentytwelve' );
						endif;
					?></h1>
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
        <div class="col-md-12">
              
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
                get_template_part( 'content', 'solucoes');

            endwhile;

            
            ?>
            </ul>
            <div class="clearfix"></div>
<div class="nav-previous fl"><?php previous_posts_link( '<button class="btn btn-primary btn-sm"><i class="fa fa-angle-double-left mr-02 f14"></i> Anterior </button>' ); ?></div>
<div class="nav-next alignright"><?php next_posts_link( '<button class="btn btn-primary btn-sm">Próximo <i class="fa fa-angle-double-right mr-02 f14"></i> </button>' ); ?></div>                                       
            <!-- /Conteudo -->               
        </div>
   
                          
    </div>                      
</div>
<!-- //Página -->

<?php else : ?>
	<?php get_template_part( 'content', 'none' ); ?>
<?php endif; ?>


<?php get_footer(); ?>