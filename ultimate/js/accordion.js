jQuery(document).ready(function() {
	function close_accordion_section() {
		jQuery('.accordion .accordion-section-title').removeClass('active');
		jQuery('.accordion .accordion-section-content').slideUp(300).removeClass('open');
		
		jQuery('.accordion1 .accordion-section-title').removeClass('active');
		jQuery('.accordion1 .accordion-section-content').slideUp(300).removeClass('open');
		
		jQuery('.accordion2 .accordion-section-title').removeClass('active');
		jQuery('.accordion2 .accordion-section-content').slideUp(300).removeClass('open');
	}
	
	jQuery('.accordion-maintab .accordion-section-title').click(function(e) {
		// Grab current anchor value
		var currentAttrValue = jQuery(this).attr('href');

		if(jQuery(e.target).is('.active')) {
			close_accordion_section();
		}else {
			close_accordion_section();

			// Add active class to section title
			jQuery(this).addClass('active');
			// Open up the hidden content panel
			jQuery('.accordion2 ' + currentAttrValue).slideDown(300).addClass('open'); 
		}

		e.preventDefault(); 
	});
	
	 
	
	jQuery('.accordion-footer .accordion-section-title').click(function(e) {
		// Grab current anchor value
		var currentAttrValue = jQuery(this).attr('href');

		if(jQuery(e.target).is('.active')) {
			close_accordion_section();
		}else {
			close_accordion_section();

			// Add active class to section title
			jQuery(this).addClass('active');
			// Open up the hidden content panel
			jQuery('.accordion ' + currentAttrValue).slideDown(300).addClass('open'); 
		}

		e.preventDefault(); 
	});
	
	
	jQuery('.accordion-column .accordion-section-title').click(function(e) {
		// Grab current anchor value
		var currentAttrValue = jQuery(this).attr('href');

		if(jQuery(e.target).is('.active')) {
			close_accordion_section();
		}else {
			close_accordion_section();

			// Add active class to section title
			jQuery(this).addClass('active');
			// Open up the hidden content panel
			jQuery('.accordion1 ' + currentAttrValue).slideDown(300).addClass('open'); 
		}

		e.preventDefault(); 
	});
	
});