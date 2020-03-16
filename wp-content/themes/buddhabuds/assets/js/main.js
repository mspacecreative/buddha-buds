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
	} else {
		$('.login-register').html('<a href="/my-account">Log in / Register</a>');
	}
	
})(jQuery);