( function( $ ) {

	wp.customize.bind( 'ready', function() {
	 
	    var customize = this;

		// Header Premasthead
		customize( 'theme-nutmeg-display-premasthead', function( value ) {

			var settingControls = [
				'ilovewp_theme-nutmeg-string-header'
			];

			$.each( settingControls, function( index, id ) {
				customize.control( id, function( control ) {
					var toggle = function( to ) {
						control.toggle( to );
					};
					
					toggle( value.get() );
					value.bind( toggle );

				} );
			} );

		} );

		// Post Archives Thumbnail
		customize( 'theme-nutmeg-archives-display-thumbnail', function( value ) {

			var settingControls = [
				'ilovewp_theme-nutmeg-archives-thumbnail-size'
			];

			$.each( settingControls, function( index, id ) {
				customize.control( id, function( control ) {
					var toggle = function( to ) {
						control.toggle( to );
					};
					
					toggle( value.get() );
					value.bind( toggle );

				} );
			} );

		} );

		// Post Archives Author & Date
		customize( 'theme-nutmeg-archives-display-author', function( value ) {

			var settingControls = [
				'ilovewp_theme-nutmeg-archives-display-author_withdate'
			];

			$.each( settingControls, function( index, id ) {
				customize.control( id, function( control ) {
					var toggle = function( to ) {
						control.toggle( to );
					};
					
					toggle( value.get() );
					value.bind( toggle );

				} );
			} );

		} );

		// Single Posts: Author Box
		customize( 'theme-nutmeg-single-display-author-bio', function( value ) {

			var settingControls = [
				'ilovewp_theme-nutmeg-single-display-author-social'
			];

			$.each( settingControls, function( index, id ) {
				customize.control( id, function( control ) {
					var toggle = function( to ) {
						control.toggle( to );
					};
					
					toggle( value.get() );
					value.bind( toggle );

				} );
			} );

		} );

		// Post Navigation Thumbnails
		customize( 'theme-nutmeg-single-display-post-navigation', function( value ) {

			var settingControls = [
				'ilovewp_theme-nutmeg-single-display-post-navigation-thumbnails'
			];

			$.each( settingControls, function( index, id ) {
				customize.control( id, function( control ) {
					var toggle = function( to ) {
						control.toggle( to );
					};
					
					toggle( value.get() );
					value.bind( toggle );

				} );
			} );

		} );

		// Blog Link
		customize( 'theme-nutmeg-display-homepage-bloglink', function( value ) {

			var settingControls = [
				'ilovewp_theme-nutmeg-string-bloglink'
			];

			$.each( settingControls, function( index, id ) {
				customize.control( id, function( control ) {
					var toggle = function( to ) {
						control.toggle( to );
					};
					
					toggle( value.get() );
					value.bind( toggle );

				} );
			} );

		} );

		// View Recipe Link
		customize( 'theme-nutmeg-archives-display-readmore', function( value ) {

			var settingControls = [
				'ilovewp_theme-nutmeg-string-readmore'
			];

			$.each( settingControls, function( index, id ) {
				customize.control( id, function( control ) {
					var toggle = function( to ) {
						control.toggle( to );
					};
					
					toggle( value.get() );
					value.bind( toggle );

				} );
			} );

		} );

	} );

} )( jQuery );