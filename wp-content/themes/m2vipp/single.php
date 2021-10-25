<?php
/**
 * The Template for displaying all single posts
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
					<h2><?php  echo get_the_title(47); ?></h2>
                    <div class="linhatit"></div>                           
			</div>
		</div>
	</div>
</div>
<div class="quadrados-page"><div class="divisao"></div></div>
<!-- //Título -->

<!-- Single -->
<div id="single-post" class="single-cursos pr">

    <div class="container clb mt-60 mh pr"> 
        <div class="row">            
            <div class="col-md-8">
				<div class="single-title">
                	<h1><?php the_title(); ?></h1>                    
                </div>
                
                <div class="wid-tot mt-10 mh">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'content', get_post_format() ); ?>     
                        
                        <?php comments_template(); ?>              
                    <?php endwhile; // end of the loop. ?>                                        
                    <div class="clearfix"></div>                    
                </div>
                
            </div>
            
            <div class="col-md-4 sidebar-single visible-md visible-lg">
                <div class="clearfix"></div>        	
                <?php get_sidebar(); ?>         
            </div><!--col--> 
                       
        </div><!--row-->
    </div><!--container-->
         
</div>
<!-- //Single -->


<?php get_footer(); ?>