(function() {
   tinymce.create('tinymce.plugins.imagenscarousel', {
      init : function(ed, url) {
         ed.addButton('imagenscarousel', {
            title : 'Imagens do carousel',
            image : url+'/recentpostsbutton.png',
            onclick : function() {
               
				ed.execCommand('mceInsertContent', false, '[imagens-carousel][/imagens-carousel]');
               
            }
         });
      },
      createControl : function(n, cm) {
         return null;
      },
      getInfo : function() {
         return {
            longname : "Imagens do carousel",
            author : 'Gabriel Padilha',
            authorurl : 'http://www.upadilha.com',
            infourl : 'http://www.upadilha.com.br',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('imagenscarousel', tinymce.plugins.carouselsolucoes);
})();