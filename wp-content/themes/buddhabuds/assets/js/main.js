(function($) {
	
	/*// OUT OF STOCK TAG
	$('.summary').each(function() {
		$(this).find('.out-of-stock').html('Sold Out');
	});
	
	$('.products').find('.outofstock a').each(function() {
		$(this).append('<p class="stock out-of-stock">Sold Out</p>');
	});
	
	$('.single-product .outofstock').find('.variations-table').each(function() {
		$(this).prepend('<p class="stock out-of-stock">Sold Out</p>');
	});*/
	
	// TOGGLE CONTACT PANEL
	$('.contact-panel-toggle, .contact-panel').click(function(e) {
		e.preventDefault();
		$('.contact-panel, .contact-panel-inner').fadeToggle();
	});
	
	// HIDE $100 OUNCES IF THERE ARE NONE AVAILABLE
	var hundredDollarOunces = $('.hundred_dollar_ounces > div > .columns-4');
	if ( hundredDollarOunces.contents().length == 0 ) {
		hundredDollarOunces.parent().parent().parent().parent().parent().css('display', 'none');
	} else {
		hundredDollarOunces.parent().parent().parent().parent().parent().css('display', 'block');
	}
	
	// OPEN SOCIAL MEDIA CHANNELS IN NEW TAB
	$(".et-social-icon a").attr('target', 'blank');
	
	$('select').change(function(){
      // this function runs when a user selects an option from a <select> element
    	$(this).find(':selected').val();
	});
	
	function splashHeight() {
		$('#splash').height($(window).height());
	}
	
	$(window).load(function() {
		splashHeight();
	});
	
	$(window).resize(function() {
		splashHeight();
	});
	
	if ( $('.logged-in').length ) {
		$('.login-register').html('<a href="/my-account">My Account</a>');
		$('.home_login-register').html('Go to dashboard');
	} else {
		$('.login-register').html('<a href="/my-account">Log in / Register</a>');
		$('.home_login-register').html('Log in / Register');
	}
	
	$('#variations .amount').each(function() {
		$(this).html($(this).html().replace(' / gram', ''));
	});
	
	// HIDE/SHOW HEADER ON SCROLL
	var didScroll;
	var lastScrollTop = 0;
	var delta = 5;
	var navbarHeight = $('header').outerHeight();
	
	$(window).scroll(function(event){
	    didScroll = true;
	});
	
	setInterval(function() {
	    if (didScroll) {
	        hasScrolled();
	        didScroll = false;
	    }
	}, 250);
	
	function hasScrolled() {
	    var st = $(this).scrollTop();
	    
	    // Make sure they scroll more than delta
	    if(Math.abs(lastScrollTop - st) <= delta)
	        return;
	    
	    // If they scrolled down and are past the navbar, add class .nav-up.
	    // This is necessary so you never see what is "behind" the navbar.
	    if (st > lastScrollTop && st > navbarHeight){
	        // Scroll Down
	        $('header, .hamburger').removeClass('nav-down').addClass('nav-up');
	    } else {
	        // Scroll Up
	        if(st + $(window).height() < $(document).height()) {
	            $('header, .hamburger').removeClass('nav-up').addClass('nav-down');
	        }
	    }
	    
	    lastScrollTop = st;
	}
	
})(jQuery);