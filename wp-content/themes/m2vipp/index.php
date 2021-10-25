<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

<?php 
global $upadilha;
global $post; 
$banner = get_post_meta( 47, '_upadilha_blog_banner_shortcod', true );

?>

<!-- Título -->
<div class="fxtitulo">
	<div class="container pr">                    
		<div class="row mt-20 mb-20">
            <div class="col-md-12 cl-f">
                <?php				
				$titulo_ori = get_bloginfo( 'name', 'display' );	
				$titulo_des = get_bloginfo( 'description', 'display' );
										
				$title = wp_title( '|', false, 'right' );
				
				$titulo01 = " - " . $titulo_ori . " - " . $titulo_des;
				$titulo02 = " | " . $titulo_ori . " | " . $titulo_des;
				$titulo03 = " - " . $titulo_ori;
				$titulo04 = $titulo_ori . " | " . $titulo_des;
				$titulo05 = ' | '. $titulo_ori;
								
				$del_title = array($titulo01, $titulo02, $titulo03, $titulo04, $titulo05);
				$por_title = array("", "", "", "", "");				
				$novo_title = str_replace($del_title, $por_title, $title);				
				?>                
                <h1><?php echo $novo_title; ?></h1>
                <div class="linhatit"></div>
			</div>
		</div>
	</div>
</div>
<div class="quadrados-page"><div class="divisao"></div></div>
<!-- //Título -->

<?php if ($banner) : ?> 
<div class="banner-home pr visible-sm visible-md visible-lg mb-40" style="margin-top:-40px;">
	<div class="faixa-banner visible-xs visible-sm"></div>
    <div class=" pr">  
		<?php echo do_shortcode($banner); ?>   
    </div>
</div>
<?php endif; ?> 

<div class="clearfix"></div>

<div class="container clb">      		              
            
	<?php if ( have_posts() ) : ?>            
        
    <!-- Conteudo --> 			            
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
    <!-- /Conteudo -->
    
    <?php else : ?>    
        <article id="post-0" class="post no-results not-found">

        <?php if ( current_user_can( 'edit_posts' ) ) :
            // Show a different message to a logged-in user who can add posts.
        ?>
            <header class="entry-header">
                <h1 class="entry-title"><?php _e( 'No posts to display', 'upadilha' ); ?></h1>
            </header>

            <div class="entry-content">
                <p><?php printf( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'upadilha' ), admin_url( 'post-new.php' ) ); ?></p>
            </div><!-- .entry-content -->

        <?php else :
            // Show the default message to everyone else.
        ?>
            <header class="entry-header">
                <h1 class="entry-title"><?php _e( 'Nothing Found', 'upadilha' ); ?></h1>
            </header>

            <div class="entry-content">
                <p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'upadilha' ); ?></p>
                <?php get_search_form(); ?>
            </div><!-- .entry-content -->
        <?php endif; // end current_user_can() check ?>

        </article><!-- #post-0 -->    
    <?php endif; // end have_posts() check ?>   

</div><!--container-->

<?php get_footer(); ?>