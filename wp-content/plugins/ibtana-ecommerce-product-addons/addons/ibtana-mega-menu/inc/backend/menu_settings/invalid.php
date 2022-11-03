<?php defined( 'ABSPATH' ) or die( "No script kiddies please!" ); ?>
<div class="iepa_main_container" id="imma_menu_<?php echo esc_attr( $menu_item_id ); ?>" data-depth="depth_<?php echo esc_attr( $menu_item_depth ); ?>">
  <div class="iepa_main_header">
    <div class="settings_megamenu">
      <i class="fa fa-wrench" aria-hidden="true"></i>
      <?php echo esc_html( IEPA_MM_TITLE ); ?> <?php echo esc_html_e( '( Not Activated )', IEPA_TEXT_DOMAIN ); ?>
    </div>

	  <p class="description imma_note">
      <?php esc_html_e( 'Please Activate your Mega Menu License.', IEPA_TEXT_DOMAIN ); ?>
    </p>
	  <div class="save_ajax_data" style="display:none;">
      <img src="<?php echo esc_url( IEPA_MM_IMG_DIR . '/ajax-loader.svg' ); ?>" />
      <span class="saving_message"></span>
    </div>
	</div>

  <div class="imma_secondary_content">
    <div class="tabs_left_section" style="display:none;"></div>
    <div class="iepa_content_rtsection">
      <a target="_blank" href="<?php echo esc_url( admin_url( 'admin.php?page=ibtana-visual-editor-addons' ) ); ?>" class="button button-primary">
        <?php esc_html_e( 'Buy Now', IEPA_TEXT_DOMAIN );?>
      </a>
      <a target="_blank" href="<?php echo esc_url( admin_url( 'admin.php?page=ibtana-visual-editor-license' ) ); ?>" class="button button-primary">
        <?php esc_html_e( 'Activate License', IEPA_TEXT_DOMAIN );?>
      </a>
    </div>
  </div>

</div>
