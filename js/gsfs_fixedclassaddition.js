jQuery(document).ready(function(jQuery){
    
    // Declare variables.
    var fsb_top = jQuery('.widget-secondary-menu').offset().top;

    // Attach to the scroll event to determine when to load items.
    jQuery(window).scroll(function(){
        var y    = jQuery(this).scrollTop(),
            maxY = jQuery('.site-footer, .footer-widgets'), // Attempt to target as many comment systems as possible.
            nav  = jQuery('.widget-secondary-menu'),
            nofo = false; // Flag if no div is found in the maxY var.

		// If for some reason one of our divs does not exist or it's height is zero, use the parent div as a scroll helper and set the nofo var to true.
		if ( jQuery(maxY).eq(0).length === 0 || 0 === jQuery(maxY).height() ) {
			maxY = jQuery('.widget-secondary-menu').parent();
			nofo = true;
		}

        // If we should not float or the height of the maxY var is equal to zero, don't do anything.
        if ( jQuery('.widget-secondary-menu').hasClass('fsb-no-float') || 0 === jQuery(maxY).height() )
            return;

        // Get the offset of our respond helper.
        var offset = jQuery(maxY).eq(0).offset().top - jQuery(nav).height() - 45;

        // If we are below the bar but above comments, set a fixed position.
        if ( y > fsb_top && y < offset )
          jQuery('.widget-secondary-menu').addClass('fixed').fadeIn();
        
        else if ( y >= offset )
          jQuery('.widget-secondary-menu').removeClass('fixed').css('display', 'none');
        
        else if ( y < fsb_top )
          jQuery('.widget-secondary-menu').show().removeClass('fixed');
    });
});