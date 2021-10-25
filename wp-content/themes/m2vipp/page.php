<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

<!-- Título -->
<div class="fxtitulo">
	<div class="container pr">               
		<div class="row mt-20 mb-20">
            <div class="col-md-12 cl-f"> 
            	<?php while ( have_posts() ) : the_post(); ?>                	
					<h1><?php the_title(); ?></h1>
                    <div class="linhatit"></div>               
                <?php endwhile; // end of the loop. ?>           
			</div>
		</div>
	</div>
</div>
<div class="quadrados-page"><div class="divisao"></div></div>
<!-- //Título -->

<!-- Página -->
<div id="pagina" class="pr">
    <div class="container clb5 mh pr"> 
        <div class="row mb-40">                
            <div class="col-md-12">
                <div class="wid-tot mh">
					<?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'content', 'page' ); ?>                        
                    <?php endwhile; // end of the loop. ?>                                        
                    <div class="clearfix"></div>                    
                </div>
            </div>
            
        </div><!--row-->
    </div><!--container-->

</div>
<!-- //Página -->

<?php get_footer(); ?>