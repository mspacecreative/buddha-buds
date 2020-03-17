(function($) {

    // MOBILE NAVIGATION
    $('.mobile-nav li.menu-item-has-children').prepend('<span class="sub-toggle"><i class="fa fa-angle-down"></i></span>').removeClass('menu-item-has-children');
    $('span.sub-toggle').click(function (){
      $(this).siblings('.sub-menu').slideToggle();
      $(this).children().toggleClass('fa-angle-down fa-angle-up');
    });
    
    // HAMBURGER ICON ANIMATION
    $('.hamburger').click(function() {
    	$('.hamburger, body, #page-container').toggleClass('is-active');
    });
    
    $('.body-overlay').click(function() {
    	$('.hamburger, body, #page-container').toggleClass('is-active');
    });
	
	$('.mobile-nav .menu ul li > a').click(function () {
	   if (this.hash) {
	      $('.hamburger, body, #page-container').toggleClass('is-active');
	   }
	});
    
    // HAMBURGER VERTICAL ALIGN
    function hamburgerIcon() {
    	$('.hamburger').css('height', $('#logo-container').height());
    }
    
    $(document).ready(function () {
    	hamburgerIcon();
    });
    
    $(window).resize(function () {
    	hamburgerIcon();
    });
	
})(jQuery);