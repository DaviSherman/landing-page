<?php
/**
 * Template Name: Home
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

$banner = get_post_meta( get_the_ID(), '_upadilha_home_banner_shortcode', true );

$banner_mob = get_post_meta( get_the_ID(), '_upadilha_home_banner_mobile', true );
?>

<?php if ($banner) : ?> 
<div class="banner-home pr visible-sm visible-md visible-lg">
	<div class="faixa-banner visible-xs visible-sm"></div>
    <div class=" pr">  
		<?php echo do_shortcode($banner); ?>   
    </div>
</div>
<?php endif; ?> 

<?php if ($banner_mob) : ?> 
<div class="banner-home pr visible-xs">
	<div class="faixa-banner visible-xs visible-sm"></div>
    <div class=" pr">  
		<?php echo do_shortcode($banner_mob); ?>   
    </div>
</div>
<?php endif; ?> 

   
<!-- Content -->
<div class="pr">	
    <div class="container clb pr">    
        <div class="row mmob">
                                        
            <div class="col-md-12">               
                <?php while ( have_posts() ) : the_post(); ?>                	
                    <?php the_content(); ?>                 
                <?php endwhile; // end of the loop. ?>
                <?php wp_reset_query(); ?>
                                
                <div class="clearfix"></div> 
            </div>               
                               
        </div><!--row-->
    </div><!--container-->
</div>
<!-- //Content -->

<!-- Lightbox -->
<div id="formlight-777" class="visible-md visible-lg"> 
	<?php echo do_shortcode(wpautop($upadilha['geral-lightbox']));	?>
</div>
<!-- //Lightbox -->

<?php get_footer(); ?>