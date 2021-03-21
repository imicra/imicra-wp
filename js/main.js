(function( $ ) {
  "use strict";

  $( document ).ready(function() {

    // alert('Hi');

    /* ---------------------------------------------------------------------------
     * Masked Input Plugin
     * --------------------------------------------------------------------------- */
    if ( typeof $.mask !== 'undefined' ) {
      $.mask.definitions['~']='[+-]';
      $( '.form-group .tel' ).mask( '+7 (999) 999-99-99' );
    }
    
    /* ---------------------------------------------------------------------------
     * Cotact Form 7
     * --------------------------------------------------------------------------- */
    var content_wpcf7 = document.querySelector( '.entry-content .wpcf7' );
    
    var disableSubmit = false;
    $(document).on('click', 'input.wpcf7-submit[type="submit"]', function() {
      $(this).attr('value', "Отправка...").addClass('disabled');
      if (disableSubmit == true) {
          return false;
      }
      disableSubmit = true;
      return true;
    });

    if (typeof(content_wpcf7) != 'undefined' && content_wpcf7 != null) {
      content_wpcf7.addEventListener( 'wpcf7invalid', function( event ) {
        $(this).find(':input[type="submit"]').attr('value', "Отправить").removeClass('disabled');
        disableSubmit = false;
      }, false );
  
      content_wpcf7.addEventListener( 'wpcf7submit', function( event ) {
        $(this).find(':input[type="submit"]').attr('value', "Отправить").removeClass('disabled');
        disableSubmit = false;
      }, false );
    }
    
  });

}(jQuery));
