<?php
/**
 * Typography control class.
 *
 * @since  1.0.0
 * @access public
 */

class Sirat_Control_Typography extends WP_Customize_Control {

	/**
	 * The type of customize control being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'typography';

	/**
	 * Array 
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $l10n = array();

	/**
	 * Set up our control.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @param  string  $id
	 * @param  array   $args
	 * @return void
	 */
	public function __construct( $manager, $id, $args = array() ) {

		// Let the parent class do its thing.
		parent::__construct( $manager, $id, $args );

		// Make sure we have labels.
		$this->l10n = wp_parse_args(
			$this->l10n,
			array(
				'color'       => esc_html__( 'Font Color', 'sirat' ),
				'family'      => esc_html__( 'Font Family', 'sirat' ),
				'size'        => esc_html__( 'Font Size',   'sirat' ),
				'weight'      => esc_html__( 'Font Weight', 'sirat' ),
				'style'       => esc_html__( 'Font Style',  'sirat' ),
				'line_height' => esc_html__( 'Line Height', 'sirat' ),
				'letter_spacing' => esc_html__( 'Letter Spacing', 'sirat' ),
			)
		);
	}

	/**
	 * Enqueue scripts/styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue() {
		wp_enqueue_script( 'sirat-ctypo-customize-controls' );
		wp_enqueue_style(  'sirat-ctypo-customize-controls' );
	}

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		// Loop through each of the settings and set up the data for it.
		foreach ( $this->settings as $setting_key => $setting_id ) {

			$this->json[ $setting_key ] = array(
				'link'  => $this->get_link( $setting_key ),
				'value' => $this->value( $setting_key ),
				'label' => isset( $this->l10n[ $setting_key ] ) ? $this->l10n[ $setting_key ] : ''
			);

			if ( 'family' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_families();

			elseif ( 'weight' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_weight_choices();

			elseif ( 'style' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_style_choices();
		}
	}

	/**
	 * Underscore JS template to handle the control's output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function content_template() { ?>

		<# if ( data.label ) { #>
			<span class="customize-control-title">{{ data.label }}</span>
		<# } #>

		<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
		<# } #>

		<ul>

		<# if ( data.family && data.family.choices ) { #>

			<li class="typography-font-family">

				<# if ( data.family.label ) { #>
					<span class="customize-control-title">{{ data.family.label }}</span>
				<# } #>

				<select {{{ data.family.link }}}>

					<# _.each( data.family.choices, function( label, choice ) { #>
						<option value="{{ choice }}" <# if ( choice === data.family.value ) { #> selected="selected" <# } #>>{{ label }}</option>
					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.weight && data.weight.choices ) { #>

			<li class="typography-font-weight">

				<# if ( data.weight.label ) { #>
					<span class="customize-control-title">{{ data.weight.label }}</span>
				<# } #>

				<select {{{ data.weight.link }}}>

					<# _.each( data.weight.choices, function( label, choice ) { #>

						<option value="{{ choice }}" <# if ( choice === data.weight.value ) { #> selected="selected" <# } #>>{{ label }}</option>

					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.style && data.style.choices ) { #>

			<li class="typography-font-style">

				<# if ( data.style.label ) { #>
					<span class="customize-control-title">{{ data.style.label }}</span>
				<# } #>

				<select {{{ data.style.link }}}>

					<# _.each( data.style.choices, function( label, choice ) { #>

						<option value="{{ choice }}" <# if ( choice === data.style.value ) { #> selected="selected" <# } #>>{{ label }}</option>

					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.size ) { #>

			<li class="typography-font-size">

				<# if ( data.size.label ) { #>
					<span class="customize-control-title">{{ data.size.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.size.link }}} value="{{ data.size.value }}" />

			</li>
		<# } #>

		<# if ( data.line_height ) { #>

			<li class="typography-line-height">

				<# if ( data.line_height.label ) { #>
					<span class="customize-control-title">{{ data.line_height.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.line_height.link }}} value="{{ data.line_height.value }}" />

			</li>
		<# } #>

		<# if ( data.letter_spacing ) { #>

			<li class="typography-letter-spacing">

				<# if ( data.letter_spacing.label ) { #>
					<span class="customize-control-title">{{ data.letter_spacing.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.letter_spacing.link }}} value="{{ data.letter_spacing.value }}" />

			</li>
		<# } #>

		</ul>
	<?php }

	/**
	 * Returns the available fonts.  Fonts should have available weights, styles, and subsets.
	 *
	 * @todo Integrate with Google fonts.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_fonts() { return array(); }

	/**
	 * Returns the available font families.
	 *
	 * @todo Pull families from `get_fonts()`.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	function get_font_families() {

		return array(
			'' => __( 'No Fonts', 'sirat' ),
        'Abril Fatface' => __( 'Abril Fatface', 'sirat' ),
        'Acme' => __( 'Acme', 'sirat' ),
        'Anton' => __( 'Anton', 'sirat' ),
        'Architects Daughter' => __( 'Architects Daughter', 'sirat' ),
        'Arimo' => __( 'Arimo', 'sirat' ),
        'Arsenal' => __( 'Arsenal', 'sirat' ),
        'Arvo' => __( 'Arvo', 'sirat' ),
        'Alegreya' => __( 'Alegreya', 'sirat' ),
        'Alfa Slab One' => __( 'Alfa Slab One', 'sirat' ),
        'Averia Serif Libre' => __( 'Averia Serif Libre', 'sirat' ),
        'Bangers' => __( 'Bangers', 'sirat' ),
        'Boogaloo' => __( 'Boogaloo', 'sirat' ),
        'Bad Script' => __( 'Bad Script', 'sirat' ),
        'Bitter' => __( 'Bitter', 'sirat' ),
        'Bree Serif' => __( 'Bree Serif', 'sirat' ),
        'BenchNine' => __( 'BenchNine', 'sirat' ),
        'Cabin' => __( 'Cabin', 'sirat' ),
        'Cardo' => __( 'Cardo', 'sirat' ),
        'Courgette' => __( 'Courgette', 'sirat' ),
        'Cherry Swash' => __( 'Cherry Swash', 'sirat' ),
        'Cormorant Garamond' => __( 'Cormorant Garamond', 'sirat' ),
        'Crimson Text' => __( 'Crimson Text', 'sirat' ),
        'Cuprum' => __( 'Cuprum', 'sirat' ),
        'Cookie' => __( 'Cookie', 'sirat' ),
        'Chewy' => __( 'Chewy', 'sirat' ),
        'Days One' => __( 'Days One', 'sirat' ),
        'Dosis' => __( 'Dosis', 'sirat' ),
        'Droid Sans' => __( 'Droid Sans', 'sirat' ),
        'Economica' => __( 'Economica', 'sirat' ),
        'Fredoka One' => __( 'Fredoka One', 'sirat' ),
        'Fjalla One' => __( 'Fjalla One', 'sirat' ),
        'Francois One' => __( 'Francois One', 'sirat' ),
        'Frank Ruhl Libre' => __( 'Frank Ruhl Libre', 'sirat' ),
        'Gloria Hallelujah' => __( 'Gloria Hallelujah', 'sirat' ),
        'Great Vibes' => __( 'Great Vibes', 'sirat' ),
        'Handlee' => __( 'Handlee', 'sirat' ),
        'Hammersmith One' => __( 'Hammersmith One', 'sirat' ),
        'Inconsolata' => __( 'Inconsolata', 'sirat' ),
        'Indie Flower' => __( 'Indie Flower', 'sirat' ),
        'IM Fell English SC' => __( 'IM Fell English SC', 'sirat' ),
        'Julius Sans One' => __( 'Julius Sans One', 'sirat' ),
        'Josefin Slab' => __( 'Josefin Slab', 'sirat' ),
        'Josefin Sans' => __( 'Josefin Sans', 'sirat' ),
        'Kanit' => __( 'Kanit', 'sirat' ),
        'Lobster' => __( 'Lobster', 'sirat' ),
        'Lato' => __( 'Lato', 'sirat' ),
        'Lora' => __( 'Lora', 'sirat' ),
        'Libre Baskerville' => __( 'Libre Baskerville', 'sirat' ),
        'Lobster Two' => __( 'Lobster Two', 'sirat' ),
        'Merriweather' => __( 'Merriweather', 'sirat' ),
        'Monda' => __( 'Monda', 'sirat' ),
        'Montserrat' => __( 'Montserrat', 'sirat' ),
        'Muli' => __( 'Muli', 'sirat' ),
        'Marck Script' => __( 'Marck Script', 'sirat' ),
        'Noto Serif' => __( 'Noto Serif', 'sirat' ),
        'Open Sans' => __( 'Open Sans', 'sirat' ),
        'Overpass' => __( 'Overpass', 'sirat' ),
        'Overpass Mono' => __( 'Overpass Mono', 'sirat' ),
        'Oxygen' => __( 'Oxygen', 'sirat' ),
        'Orbitron' => __( 'Orbitron', 'sirat' ),
        'Patua One' => __( 'Patua One', 'sirat' ),
        'Pacifico' => __( 'Pacifico', 'sirat' ),
        'Padauk' => __( 'Padauk', 'sirat' ),
        'Playball' => __( 'Playball', 'sirat' ),
        'Playfair Display' => __( 'Playfair Display', 'sirat' ),
        'PT Sans' => __( 'PT Sans', 'sirat' ),
        'Philosopher' => __( 'Philosopher', 'sirat' ),
        'Permanent Marker' => __( 'Permanent Marker', 'sirat' ),
        'Poiret One' => __( 'Poiret One', 'sirat' ),
        'Quicksand' => __( 'Quicksand', 'sirat' ),
        'Quattrocento Sans' => __( 'Quattrocento Sans', 'sirat' ),
        'Raleway' => __( 'Raleway', 'sirat' ),
        'Rubik' => __( 'Rubik', 'sirat' ),
        'Rokkitt' => __( 'Rokkitt', 'sirat' ),
        'Russo One' => __( 'Russo One', 'sirat' ),
        'Righteous' => __( 'Righteous', 'sirat' ),
        'Slabo' => __( 'Slabo', 'sirat' ),
        'Source Sans Pro' => __( 'Source Sans Pro', 'sirat' ),
        'Shadows Into Light Two' => __( 'Shadows Into Light Two', 'sirat'),
        'Shadows Into Light' => __( 'Shadows Into Light', 'sirat' ),
        'Sacramento' => __( 'Sacramento', 'sirat' ),
        'Shrikhand' => __( 'Shrikhand', 'sirat' ),
        'Tangerine' => __( 'Tangerine', 'sirat' ),
        'Ubuntu' => __( 'Ubuntu', 'sirat' ),
        'VT323' => __( 'VT323', 'sirat' ),
        'Varela Round' => __( 'Varela Round', 'sirat' ),
        'Vampiro One' => __( 'Vampiro One', 'sirat' ),
        'Vollkorn' => __( 'Vollkorn', 'sirat' ),
        'Volkhov' => __( 'Volkhov', 'sirat' ),
        'Yanone Kaffeesatz' => __( 'Yanone Kaffeesatz', 'sirat' )
		);
	}

	/**
	 * Returns the available font weights.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_weight_choices() {

		return array(
			'' => esc_html__( 'No Fonts weight', 'sirat' ),
			'100' => esc_html__( 'Thin',       'sirat' ),
			'300' => esc_html__( 'Light',      'sirat' ),
			'400' => esc_html__( 'Normal',     'sirat' ),
			'500' => esc_html__( 'Medium',     'sirat' ),
			'700' => esc_html__( 'Bold',       'sirat' ),
			'900' => esc_html__( 'Ultra Bold', 'sirat' ),
		);
	}

	/**
	 * Returns the available font styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_style_choices() {

		return array(
			'' => esc_html__( 'No Fonts Style', 'sirat' ),
			'normal'  => esc_html__( 'Normal', 'sirat' ),
			'italic'  => esc_html__( 'Italic', 'sirat' ),
			'oblique' => esc_html__( 'Oblique', 'sirat' )
		);
	}
}
