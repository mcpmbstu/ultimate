// JavaScript Document 
// MEGA MENU
jQuery(function() {
	cbpHorizontalMenu.init();
});
			

function loop_for_accordion(classView,number,className,innerClass,classTitle) {
	 for(i = 0; i < number; i++) { 
		  var footerTitle =jQuery(className+i+' '+classTitle).text();
		   var footerBody =jQuery(className+i+' '+innerClass).html();
		  jQuery(classView).append('<div class="accordion-section col-xs-12"><a class="accordion-section-title" href="#accordion-'+i+'">'+footerTitle+'</a><div id="accordion-'+i+'" class="accordion-section-content">'+footerBody+'</div></div>');
		}
}


function loop_for_accordion1(classView,number,className,innerClass,classTitle) {
		//alert();
	 for(i = 0; i < number; i++) { 
		  var footerTitle =jQuery(className+i+' '+classTitle).text();
		   var footerBody =jQuery(innerClass+i).html();
		  jQuery(classView).append('<div class="accordion-section col-xs-12"><a class="accordion-section-title" href="#accordion-'+i+'">'+footerTitle+'</a><div id="accordion-'+i+'" class="accordion-section-content">'+footerBody+'</div></div>');
		}
}

 
				
jQuery(document).ready(function() {
	jQuery( 'ul.nav.nav-tabs  a' ).click( function ( e ) {
        e.preventDefault(); 
        jQuery( this ).tab( 'show' );
      } );

      ( function( jQuery ) {
          // Test for making sure event are maintained
          jQuery( '.js-alert-test' ).click( function () {
            alert( 'Button Clicked: Event was maintained' );
          } );
          fakewaffle.responsiveTabs( [ 'xs', 'sm' ] );
      } )( jQuery );
	   
	  
	  function toggleChevron(e) {
			jQuery(e.target)
				.prev('.panel-heading')
				.find("i.indicator")
				.toggleClass('fa-times fa-chevron-down');
		}
		jQuery('#collapse-nonResponsiveTabs').on('hidden.bs.collapse', toggleChevron);
		jQuery('#collapse-nonResponsiveTabs').on('shown.bs.collapse', toggleChevron);
	  
	  
	  jQuery( document ).on( "click", ".main-tab-div .panel-group a", function() {
		  //jQuery('.main-tab-div .panel-group').find('.active-main-tab-link').reoveClass('active-main-tab-link');
		  jQuery('.main-tab-div .panel-group').find('.active-main-tab-link').removeClass("active-main-tab-link");
		  jQuery( this ).parent().parent().addClass('active-main-tab-link'); 
		});
	  
	  
	  
	  //// CARASUAL SCROLLER
	  
	  //Sort random function
	  function random(owlSelector){
		owlSelector.children().sort(function(){
			return Math.round(Math.random()) - 0.5;
		}).each(function(){
		  jQuery(this).appendTo(owlSelector);
		});
	  }
  
	   
	  
	   
  
   
		
		jQuery( '.new-thumb' ).click( function ( e ) {
			jQuery('.form-div-block').find('.active-thumb').removeClass('active-thumb');
			jQuery(this).addClass('active-thumb'); 
			e.preventDefault(); 
		});
		
		
		
		
		
		
		
		equalheight = function(container){

		var currentTallest = 0,
			 currentRowStart = 0,
			 rowDivs = new Array(),
			 $el,
			 topPosition = 0;
		 jQuery(container).each(function() {
		
		   $el = jQuery(this);
		   jQuery($el).height('auto')
		   topPostion = $el.position().top;
		
		   if (currentRowStart != topPostion) {
			 for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
			   rowDivs[currentDiv].height(currentTallest);
			 }
			 rowDivs.length = 0; // empty the array
			 currentRowStart = topPostion;
			 currentTallest = $el.height();
			 rowDivs.push($el);
		   } else {
			 rowDivs.push($el);
			 currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
		  }
		   for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
			 rowDivs[currentDiv].height(currentTallest);
		   }
		 });
		}
		
		jQuery(window).load(function() {
		  equalheight('.form-selector thumb');
		});
		
		
		jQuery(window).resize(function(){
		  equalheight('.form-selector thumb');
		});



// Smart Wizard 	
  		jQuery('#wizard').smartWizard();
      
      function onFinishCallback(){
        jQuery('#wizard').smartWizard('showMessage','Finish Clicked');
        //alert('Finish Clicked');
      } 
	  
 

});




/**
 * Vertically center Bootstrap 3 modals so they aren't always stuck at the top
 */
(function (jQuery) {
    "use strict";
    function centerModal() {
        jQuery(this).css('display', 'block');
        var $dialog  = jQuery(this).find(".modal-dialog"),
        offset       = (jQuery(window).height() - $dialog.height()) / 2,
        bottomMargin = parseInt($dialog.css('marginBottom'), 10);

        // Make sure you don't hide the top part of the modal w/ a negative margin if it's longer than the screen height, and keep the margin equal to the bottom margin of the modal
        if(offset < bottomMargin) offset = bottomMargin;
        $dialog.css("margin-top", offset);
    }

    jQuery(document).on('show.bs.modal', '.modal', centerModal);
    jQuery(window).on("resize", function () {
        jQuery('.modal:visible').each(centerModal);
    });
}(jQuery));









/**
 * jquery.steps-0.1,js - Steps plugin for jQuery
 * ================================================
 * (C) 2011 José Ramón Díaz - jrdiazweb@gmail.com
 * 
 * Instantiation: $('.stepsDiv').steps()
 * 
 * Functions:
 *     $('.stepsDiv').steps('getStep') - Returns current step for stepDiv
 *     $('.stepsDiv').steps('start')   - Resets state to initial step
 *     $('.stepsDiv').steps('finish')  - Sets state to completed
 *     $('.stepsDiv').steps('next')    - Sets state to next state
 *     $('.stepsDiv').steps('prev')    - Sets state to previous state
 *     
 * Classes needed and meaning
 *     N/A              - Uncompleted step. Greyed by default
 *     end              - Last uncompleted step. Greyed and no "arrow"
 *     last             - Boundary class. Marks last completed step and last step
 *     current          - Current step
 *     completed        - Completed step
 *     completedLast    - Last completed step
 *     completedLastEnd - Last step when all steps are completed
 * 
 * Extending steps with representation
 *     You can also use the steps CSS. You can find it at
 *     http://3nibbles.blogspot.com/2011/06/pasos-de-wizard.html
 *     
 * Legal stuff
 *     You are free to use this CSS, but you must give credit or keep header intact.
 *     Please, tell me if you find it useful. An email will be enough.
 *     If you enhance this code or correct a bug, please, tell me.
 * 
 */
(function( jQuery ){

    jQuery.fn.steps = function( options ) {  
        
        var self = this;
        
        
        //////////////////////////////////////////////////////////////////////////////////
        // DEFAULT VALUES
        var defaults = {};

        //////////////////////////////////////////////////////////////////////////////////
        // PRIVATE FUNCTIONS
        var init = function( options ) {
            
            // If options exist, merge them with default settings
            if ( options ) jQuery.extend( defaults, options );
        
            var $this = jQuery(this);
            var data = $this.data('steps');
            
            return this.each(function() {
                
                var $this = jQuery(this);
                data      = $this.data('steps');
                
                // The plugin hasn't been initialized yet
                if ( ! data ) {
                    
                    // Initializes the plugin data
                    jQuery(this).data('steps', { 
                        target : $this,
                        step   : 0
                    });
    
                };
            });            
            
        };
        
        var destroy = function( ) { 
            return this.each(function() { self.removeData('steps'); })
        };

        //////////////////////////////////////////////////////////////////////////////////
        // PUBLIC FUNCTIONS
        var methods = {
                getStep: function( ) { return self.data('steps')['step']; },
                start:   function( ) { return methods.setStep(0); },
                finish:  function( ) { 
                    var l = self.find('ul li').length;
                    methods.setStep(l);
                    self.data('steps')['step'] = l; 
                    return l;
                },
                prev:    function( ) { 
                    var step = methods.getStep();
                    var l    = self.find('ul li').length;
                    if(step == l) step = step-1;
                    return methods.setStep(step - 1); 
                },
                next:    function( ) {  
				

					//// ADD CONTENT validation before send 				
				
				
                    return methods.setStep(methods.getStep() + 1);
                },
                setStep: function( stepNumber ) {  
                    // Sets the step number
                    var l = self.find('ul li').length;
                    if(stepNumber < 0) stepNumber = 0;
                    if(stepNumber > l) stepNumber = l;
                    
                    // Resets styles
                    self.find('ul li').removeClass('current completed completedLast last end completedLastEnd');

                    // Styles for intermediate steps
                    self.find('ul li:lt(' + ((stepNumber < l) ? stepNumber : l-1) + ')').addClass('completed');

                    if(stepNumber > 0 && stepNumber < l) 
                        self.find('ul li:nth(' + (stepNumber-1) + ')').addClass('completedLast');
                    if(stepNumber < l)
                        self.find('ul li:nth(' + stepNumber + ')').addClass('current');

                    // Last step style
                    if(stepNumber == l)  
                        self.find('ul li:last').addClass('completedLastEnd');
                    //if(stepNumber == l-1)  
                    //    self.find('ul li:last').addClass('currentEnd');
                    else 
                        self.find('ul li:last').addClass('end');
                    
                    self.data('steps')['step'] = stepNumber; 
                    return stepNumber;
                }
                
        };
        
        /////////////////////////////////////////////////////////////////////////////////////
        // Decides what to do
        if ( methods[options] ) {
            return methods[options].apply( self, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof options === 'object' || ! options ) {
            return init.apply( self, arguments );
        } else {
            //$.error( 'Method ' +  options + ' does not exist on jQuery.tooltip' );
            return init.apply( self, {} );
        }    
                
    };
    
    //var n = jQuery( "div.cf-item-list ul .cf-item-data" ).length; 
    //var nb = jQuery('div.cf-item-data').length;
	//alert(nb);
	
})( jQuery );

// Demo methods
jQuery(document).ready(function() { 

	
	var checkTemplate = jQuery('#page-template-name').val();
	
	if(checkTemplate != "templates/page-packages.php"){
		jQuery('.steps').steps('start');
		//jQuery(".nano").nanoScroller();
	}
	jQuery('.logo-list a').click(function() {
		var linkhome = jQuery('#link-home').val();
	   window.location = linkhome;
	   return false;
	});
	
	
	//jQuery(".nano-content1").niceScroll({cursorcolor:"#F00",cursoropacitymax:0.7,boxzoom:false,touchbehavior:false, cursorwidth:9, autohidemode:false,iframeautoresize: true});  // Second  

});

//// This is universal animated scrollbar
/*jQuery(function() {
  jQuery('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = jQuery(this.hash);
      target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        jQuery('html,body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });
});*/






jQuery(document).ready(function() {	 



    jQuery('.h-fadein, .paclages-button a, a.anchor-link').click(function() {
      if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
        var target = jQuery(this.hash);
        target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
        if (target.length) {
          jQuery('html, body').animate({
            scrollTop: target.offset().top
          }, 1000);
          return false;
        }
      }
    }); 
	
}); 