(function($) {
  if ( typeof ibmm_verify_script_obj == "undefined" ) {
    var mega_menu_model = `<div class="iepa-menu-model">
        <div class="iepa-menu-body">
          <span class="dashicons dashicons-no"></span>
          <p>Activate Ibtana - Ecommerce Product Addons License To Add Mega Menu</p>
          <img src="` + iepa_upsell_obj.upsell_image + `">
          <a target="_blank" href="https://www.vwthemes.com/plugins/woocommerce-product-add-ons/">Buy Now</a>
        </div>
      </div>`;
    jQuery('#wpwrap').append( mega_menu_model );
    jQuery('#menu-to-edit li.menu-item .item-title').each( function() {
      var button = $("<span>").addClass("iepa-activation-notice").html("Ibtana Mega Menu").on('click', function(e) {
        e.preventDefault();
        jQuery( '.iepa-menu-model' ).fadeIn();
      });
      $( this ).append( button );
    } );

    jQuery( '.iepa-menu-model .iepa-menu-body .dashicons.dashicons-no' ).click(function() {
      jQuery( '.iepa-menu-model' ).fadeOut();
    });
  }
})(jQuery);
