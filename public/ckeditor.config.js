$(document).ready(() => {
  if(typeof CKEDITOR !== 'undefined') {

          CKEDITOR.on( 'instanceReady', function( ev ) {
            // Output paragraphs as <p>Text</p>.
            ev.editor.dataProcessor.writer.setRules( '*', {
              indent: false,
              breakBeforeOpen: true,
              breakAfterOpen: false,
              breakBeforeClose: false,
              breakAfterClose: true
            });
          });
        }else {
          console.log("CKEDITOR IS UNDEFINED!")
        }

CKEDITOR.replace('page_x2j1', {})
})