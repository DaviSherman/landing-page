<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

<?php if(is_single()): ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
		<div class="featured-post">
			<?php _e( 'Featured post', 'twentytwelve' ); ?>
		</div>
		<?php endif; ?>
        <div class="clearfix"></div>
           
		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<?php endif; ?>
		
	</article><!-- #post -->
    
<?php else: ?>

	<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>		
		<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?> </a></h3>
		<?php if (  has_post_thumbnail() ) : ?>          	
        <div class="fl wid-tot mb-20">
            <span class="foto">
                <a href="<?php the_permalink(); ?>" title=""><?php the_post_thumbnail(); ?></a>
            </span>
        </div>  
        <?php endif;  ?>                      
        <div class="fl wid-tot">            
            <p><?php echo get_excerpt(420, 'content'); ?></p>    
            <div class="rodpost wid-tot clb mt-20">
            	<span class="datapost mr-20" style=" text-transform:capitalize;"><i class="fa fa-calendar mr-04 f14"></i> 
					<?php the_date(d); ?>/<?php 
						$post_month = mysql2date("F", $post->post_date_gmt); 
						$post_year = mysql2date("Y", $post->post_date_gmt); 
	
						echo $post_month.'/'.$post_year;
					?>
                </span>
                
                <span class="comentarpost mr-20"><i class="fa fa-comments-o mr-04 f16"></i> 
                	<?php comments_popup_link('Seja o primeiro a comentar!', '1 Coment&aacute;rio', '% Coment&aacute;rios'); ?>
                </span>
            
            
            </div>            
          
               
        </div>           
    </li>

<?php endif; ?>