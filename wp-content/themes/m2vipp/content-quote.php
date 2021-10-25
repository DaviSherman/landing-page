<?php
/**
 * The template for displaying posts in the Quote post format
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>		
		<?php if (  has_post_thumbnail() ) : ?>          	
        <div class="fl wid-tot mb-08">
            <span class="foto">
                <a href="<?php the_permalink(); ?>" title=""><?php the_post_thumbnail(); ?></a>
            </span>
        </div>  
        <?php endif;  ?>                      
        <div class="fl wid-tot">
            <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>            
            <br /><small>
                <?php the_date(d); ?>
                
                <?php 
					$post_month = mysql2date("F", $post->post_date_gmt); 
					$post_year = mysql2date("Y", $post->post_date_gmt); 

					echo $post_month.' de '.$post_year;
				?>
                
                 - por <span style=" text-transform:capitalize;"><?php the_author_posts_link(); ?></span>
                - <?php comments_popup_link('Seja o primeiro a comentar!', '1 Coment&aacute;rio', '% Coment&aacute;rios'); ?>
            </small>
            </h3>
            <p><?php echo get_excerpt(420, 'content'); ?></p>    
            <div class="wid-tot clb mt-20"></div>
            <span class="fl mb-10 visible-md visible-lg">
				<?php			
                foreach((get_the_category()) as $category) { 
                echo '<a href="'.get_category_link($category->term_id ).'" class="btn btn-primary btn-xs mr-04">'.$category->cat_name.'</a>';
                }
                ?>
            </span>
            <div class="visible-md visible-lg">
            	<a href="<?php the_permalink(); ?>" class="btn btn-default fr"><i class="fa fa-caret-right"></i> Continue Lendo</a>
            </div>
            <div class="visible-xs visible-sm">
            	<a href="<?php the_permalink(); ?>" class="btn btn-default btn-block"><i class="fa fa-caret-right"></i> Continue Lendo</a>
            </div>     
        </div>           
    </li>
