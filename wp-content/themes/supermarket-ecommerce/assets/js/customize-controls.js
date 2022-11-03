( function( api ) {

	// Extends our custom "supermarket-ecommerce" section.
	api.sectionConstructor['supermarket-ecommerce'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );