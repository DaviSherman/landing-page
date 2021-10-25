(function() {
   tinymce.create('tinymce.plugins.carouselclientes', {
      init : function(ed, url) {
         ed.addButton('carouselclientes', {
            title : 'Carousel Clientes',
            image : url+'/recentpostsbutton.png',
            onclick : function() {
               var posts = prompt("Número de Clientes", "1");
               var text = prompt("Título para o Carousel", "Nossos Clientes");

               if (text != null && text != ''){
                  if (posts != null && posts != '')
                     ed.execCommand('mceInsertContent', false, '[carousel-clientes posts="'+posts+'"]'+text+'[/carousel-clientes]');
                  else
                     ed.execCommand('mceInsertContent', false, '[carousel-clientes]'+text+'[/carousel-clientes]');
               }
               else{
                  if (posts != null && posts != '')
                     ed.execCommand('mceInsertContent', false, '[carousel-clientes posts="'+posts+'"]');
                  else
                     ed.execCommand('mceInsertContent', false, '[carousel-clientes]');
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
   tinymce.PluginManager.add('carouselclientes', tinymce.plugins.carouselclientes);
})();