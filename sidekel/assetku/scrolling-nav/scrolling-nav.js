//jQuery to collapse the navbar on scroll
$(window).scroll(function() {
    if ($(".navbar").offset().top > 50) {
        $(".navbar-fixed-top").addClass("top-nav-collapse");
        //$(".navbar-brand").addClass(".navbar-brand1");
		$("#nav_brand").removeClass("navbar-brand");
		$("#nav_brand").addClass("navbar-brand1");
    } else {
        $(".navbar-fixed-top").removeClass("top-nav-collapse");
		$("#nav_brand").removeClass("navbar-brand1");
		$("#nav_brand").addClass("navbar-brand");
    }
});

//jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
});
