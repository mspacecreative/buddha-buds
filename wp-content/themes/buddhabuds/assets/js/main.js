(function($) {
	
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