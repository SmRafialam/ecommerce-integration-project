( function( api ) {

	// Extends our custom "wp-fashion-storefront" section.
	api.sectionConstructor['wp-fashion-storefront'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );