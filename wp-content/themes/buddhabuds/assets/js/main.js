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
		$('.login-register').html('My Account');
	} else {
		$('.login-register').html('<a href="/my-account">Log in / Register</a>');
	}
	
})(jQuery);