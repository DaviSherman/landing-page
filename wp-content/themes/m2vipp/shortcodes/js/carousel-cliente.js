(function() {
   tinymce.create('tinymce.plugins.carouselcliente', {
      init : function(ed, url) {
         ed.addButton('carouselcliente', {
            title : 'Carousel Clientes',
            image : url+'/recentpostsbutton.png',
            onclick : function() {
               var posts = prompt("Número de Clientes", "1");
               var text = prompt("Título para o Carousel", "Nossos Clientes");

               if (text != null && text != ''){
                  if (posts != null && posts != '')
                     ed.execCommand('mceInsertContent', false, '[carousel-cliente posts="'+posts+'"]'+text+'[/carousel-cliente]');
                  else
                     ed.execCommand('mceInsertContent', false, '[carousel-cliente]'+text+'[/carousel-cliente]');
               }
               else{
                  if (posts != null && posts != '')
                     ed.execCommand('mceInsertContent', false, '[carousel-cliente posts="'+posts+'"]');
                  else
                     ed.execCommand('mceInsertContent', false, '[carousel-cliente]');
               }
            }
         });
      },
      createControl : function(n, cm) {
         return null;
      },
      getInfo : function() {
         return {
            longname : "Carousel Clientes",
            author : 'Gabriel Padilha',
            authorurl : 'http://www.upadilha.com',
            infourl : 'http://www.upadilha.com.br',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('carouselcliente', tinymce.plugins.carouselcliente);
})();