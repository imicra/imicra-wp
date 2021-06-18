(function( $ ) {
  "use strict";

  $( document ).ready(function() {

    // alert('Hi');

    /* ---------------------------------------------------------------------------
     * Masked Input Plugin
     * --------------------------------------------------------------------------- */
    if ( typeof $.mask !== 'undefined' ) {
      $.mask.definitions['~']='[+-]';
      $( '[type="tel"]' ).mask( '+7 (999) 999-99-99' );
    }

    /* ---------------------------------------------------------------------------
     * Ajax add to cart for single product
     * --------------------------------------------------------------------------- */
    $(document).on('click', '.single_add_to_cart_button', function(e) {
      e.preventDefault();

      var $thisbutton = $(this),
          $form = $thisbutton.closest('form.cart'),
          id = $thisbutton.val(),
          product_qty = $form.find('input[name=quantity]').val() || 1,
          product_id = $form.find('input[name=product_id]').val() || id,
          variation_id = $form.find('input[name=variation_id]').val() || 0;

      var data = {
        action: 'imicra_ajax_add_to_cart',
        product_id: product_id,
        quantity: product_qty,
        variation_id: variation_id,
      };

      $( document.body ).trigger( 'adding_to_cart', [ $thisbutton, data ] );

      $.ajax({
        type: 'post',
        url: wc_add_to_cart_params.ajax_url,
        data: data,
        beforeSend: function(response) {
          $thisbutton.removeClass('added').addClass('loading');
        },
        complete: function(response) {
          $thisbutton.addClass('added').removeClass('loading');
        },
        success: function(response) {
          if (response.error && response.product_url) {
            window.location = response.product_url;
            return;
          } else {
            $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
          }
        }
      });

      return false;
    });
    
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
