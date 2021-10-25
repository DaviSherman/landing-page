<?php 
global $post;
$url_atual = get_the_ID($post->ID);	

?>  

   
<!-- Widgets -->
<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>

<div id="secondary" class="sidebar-container" role="complementary">
    <div class="widget-area">
        <?php dynamic_sidebar( 'sidebar-2' ); ?>
    </div><!-- .widget-area -->
</div><!-- #secondary -->
<?php endif; ?>
<!-- Widgets -->


