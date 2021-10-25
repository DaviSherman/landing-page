(function() {
   tinymce.create('tinymce.plugins.slidedepoimentos', {
      init : function(ed, url) {
         ed.addButton('slidedepoimentos', {
            title : 'Slide Depoimentos',
            image : url+'/recentpostsbutton.png',
            onclick : function() {
               var posts = prompt("Número de Depoimentos", "1");
               var text = prompt("Título para o Slide", "Depoimentos");

               if (text != null && text != ''){
                  if (posts != null && posts != '')
                     ed.execCommand('mceInsertContent', false, '[slide-depoimentos posts="'+posts+'"]'+text+'[/slide-depoimentos]');
                  else
                     ed.execCommand('mceInsertContent', false, '[slide-depoimentos]'+text+'[/slide-depoimentos]');
               }
               else{
                  if (posts != null && posts != '')
                     ed.execCommand('mceInsertContent', false, '[slide-depoimentos posts="'+posts+'"]');
                  else
                     ed.execCommand('mceInsertContent', false, '[slide-depoimentos]');
               }
            }
         });
      },
      createControl : function(n, cm) {
         return null;
      },
      getInfo : function() {
         return {
            longname : "Slide Depoimentos",
            author : 'Gabriel Padilha',
            authorurl : 'http://www.upadilha.com',
            infourl : 'http://www.upadilha.com.br',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('slidedepoimentos', tinymce.plugins.slidedepoimentos);
})();