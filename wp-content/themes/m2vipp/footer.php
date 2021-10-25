<?php
/**
 * O modelo para exibir o rodapé
 *
 * Contém o encerramento do conteúdo.
 *
 * @package WordPress
 * @subpackage Agencia_Upadilha
 * @since Agência Upadilha 1.0
 */
?>

<?php 
global $post;
global $upadilha; 

$cor_rodape = get_post_meta($post->ID, '_upadilha_home_color_rodape', true);

?>


<div id="divsrod" <?php if($cor_rodape){echo 'style="background-color:'.$cor_rodape.';"'; } ?> >
    
    <div class="container subrodape">
    	<div class="row pt-10 pb-08">
        	<div class="col-md-12 ">
                <div class="cont-basic fl">
					<?php echo do_shortcode(wpautop($upadilha['rodape-copyright']));	?> 
                </div>
                <!-- Redes Sociais -->
                    <?php if($upadilha['topo-social']) { ?>
                    <ul class="rsocial fr">
                        <?php foreach ($upadilha['topo-social'] as $slide) {
                            echo '<li><a target="_blank" title="'.$slide['title'].'" href="'.$slide['url'].'"><i class="'.$slide['description'].'" style="color:'.$cor_rodape.';"></i></a>
                        </li>';
                        } ?>
                    </ul>
                    <?php } ?>
                    <!-- //Redes Sociais -->
            </div>
		</div>
    </div>

</div><!-- #divsrod -->

<!-- SHOWBIZ  -->
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/showbizpro/jquery.themepunch.showbizpro.min.js"></script>
<script>
jQuery(document).ready(function($) {
			
	/* marcas */	
	jQuery('.carousel-solucoes').showbizpro({						
		visibleElementsArray:[4,4,2,1], 
		autoPlay:"on",					
		carousel:"on",
		rewindFromEnd:"on",
		entrySizeOffset:0,
		allEntryAtOnce:"off",												
		dragAndScroll:"off",					
		speed:300,						
		delay:4000
	});
	
	/* marcas */	
	jQuery('.carousel-cliente').showbizpro({						
		visibleElementsArray:[5,4,2,1], 
		autoPlay:"on",					
		carousel:"on",
		rewindFromEnd:"on",
		entrySizeOffset:0,
		allEntryAtOnce:"off",												
		dragAndScroll:"off",					
		speed:300,						
		delay:4000
	});
	
	
});
</script>

<!-- Depoimento  -->
<script defer src="<?php echo get_template_directory_uri(); ?>/js/flexslider/jquery.flexslider.js"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
	$('.depoimentos-clientes .flexslider').flexslider({
		animation: "fade",
		directionNav: false,
		slideshow: true,
		slideshowSpeed: 10000
	});
 
});
</script>




<?php 
if ( is_page_template( 'page-/home.php') || is_page_template( 'page-/home_teste.php') ) : ?>



<?php elseif ( is_page_template( 'page-/page-filhas.php') ) : ?>

<script>
$(document).ready(function() {			
	/* Menu Lateral */		
	$('.subpaginas > li > ul').hide();
	$('.subpaginas > li.current_page_parent > ul').show();
	$('.subpaginas > li.page_item_has_children > a').click(function(){
		$('.subpaginas > li > ul').slideUp();								
		$(this).siblings().each(function(){
			if ($(this).css("display") == "none") {
				$(this).slideToggle();									
			}
		});						
		return false;
	});

});
</script> 
<?php endif; ?>


<script type="text/javascript">
<?php echo $upadilha['geral-analytics']; ?>
</script>


<?php wp_footer(); ?>


</body>
</html>