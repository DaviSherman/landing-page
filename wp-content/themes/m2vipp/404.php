<?php
/**
 * The template for displaying 404 pages (Not Found)
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
            <div class="col-md-12">            	               	
				<h1><?php _e( 'Página não Existe!', 'twentytwelve' ); ?></h1>  
                <div class="linhatit"></div>             
			</div>
		</div>
	</div>
</div>
<!-- //Título -->

<!-- Página -->
<div id="pagina" class="pr">
    <div class="container clb5 mh pr"> 
        <div class="row mb-40">                
            <div class="col-md-12">
                <div class="wid-tot mh">
					<article id="post-0" class="post error404 no-results not-found">        
                        <div class="entry-content">
                            <p><?php _e( 'Parece que não foi possível encontrar o que você está buscando.', 'twentytwelve' ); ?></p>
                            
                            <p><a href="/">Ir para Página Inicial</a></p>
                            
                        </div><!-- .entry-content -->
                    </article><!-- #post-0 -->                     
                </div>
            </div>
            
        </div><!--row-->
    </div><!--container-->

</div>
<!-- //Página -->

<?php get_footer(); ?>