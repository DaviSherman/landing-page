$(document).ready(function() {	
	$('.fancybox').fancybox({	
		helpers : {
			overlay : {						    
				locked     : false   // if true, the content will be locked into overlay
			}
		}	
	});	
	$(".fancybox-elastic").fancybox({
		padding: 0,
		openEffect : 'elastic',
		openSpeed  : 150,
		closeEffect : 'elastic',
		closeSpeed  : 150,
		closeClick : true,
		helpers : {
			overlay : {						    
				locked     : false   // if true, the content will be locked into overlay
			}
		}
	});
	$('.fancybox-media').fancybox({
		openEffect  : 'none',
		closeEffect : 'none',
		helpers : {
			media : {}
		}
	});

});