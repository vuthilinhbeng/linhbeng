<?php
/**
 * Sirat Customizer Custom Controls
 *
 */

if ( class_exists( 'WP_Customize_Control' ) ) {
	/**
	 * Toggle Switch Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	class Sirat_Toggle_Switch_Custom_Control extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'toogle_switch';
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue(){
			wp_enqueue_style( 'sirat_custom_controls_css', trailingslashit( esc_url(get_template_directory_uri()) ) . 'assets/css/customizer.css', array(), '1.0', 'all' );
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content(){
		?>
			<div class="toggle-switch-control">
				<div class="toggle-switch">
					<input type="checkbox" id="<?php echo esc_attr($this->id); ?>" name="<?php echo esc_attr($this->id); ?>" class="toggle-switch-checkbox" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); checked( $this->value() ); ?>>
					<label class="toggle-switch-label" for="<?php echo esc_attr( $this->id ); ?>">
						<span class="toggle-switch-inner"></span>
						<span class="toggle-switch-switch"></span>
					</label>
				</div>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if( !empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
			</div>
		<?php
		}
	}

	// Image Toggle Radio Buttpon
	class Sirat_Image_Radio_Control extends WP_Customize_Control {

	    public function render_content() {
	 
	        if (empty($this->choices))
	            return;
	 
	        $name = '_customize-radio-' . $this->id;
	        ?>
	        <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
	        <ul class="controls" id='sirat-img-container'>
	            <?php
	            foreach ($this->choices as $value => $label) :
	                $class = ($this->value() == $value) ? 'sirat-radio-img-selected sirat-radio-img-img' : 'sirat-radio-img-img';
	                ?>
	                <li style="display: inline;">
	                    <label>
	                        <input <?php $this->link(); ?>style = 'display:none' type="radio" value="<?php echo esc_attr($value); ?>" name="<?php echo esc_attr($name); ?>" <?php
	                          	$this->link();
	                          	checked($this->value(), $value);
	                          	?> />
	                        <img src='<?php echo esc_url($label); ?>' class='<?php echo esc_attr($class); ?>' />
	                    </label>
	                </li>
	                <?php
	            endforeach;
	            ?>
	        </ul>
	        <?php
	    }
	}

	/**
	 * Switch sanitization
	 *
	 * @param  string		Switch value
	 * @return integer	Sanitized value
	 */
	if ( ! function_exists( 'sirat_switch_sanitization' ) ) {
		function sirat_switch_sanitization( $input ) {
			if ( true === $input ) {
				return 1;
			} else {
				return 0;
			}
		}
	}

	class Sirat_Reset_Custom_Control extends WP_Customize_Control {
    public $type = 'reset_control';
    public function render_content() {
    ?>
      <div class="reset-custom-control">
      	<span class="customize-reset-title"><?php echo esc_html( $this->label ); ?></span>
         <span class="reset-button"><?php echo esc_html_e('Reset', 'sirat'); ?></span>
      </div>
      <div id="myModal" class="modal kt-modal">
        <div class="modal-content">
          <span class="close">X</span>
          <h3><?php esc_html_e('Are you sure to reset the Changes ? ', 'sirat') ?></h3>
          <p><?php esc_html_e('After click on the reset button, it will reset the default settings and previous changes that you have done and the data will be lost.', 'sirat') ?></p>
          <p><?php esc_html_e('Please Refresh the customizer after reset the settings.', 'sirat') ?></p>
          <a href="javascript:location.reload();" class="refresh-btn" data-value="<?php echo esc_attr( $this->description ); ?>"><?php echo esc_html_e('RESET', 'sirat'); ?></a>
        </div>
      </div>
  		<?php
    }
  }	
}

