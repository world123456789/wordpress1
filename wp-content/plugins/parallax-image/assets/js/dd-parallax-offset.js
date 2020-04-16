jQuery(document).ready(function($) {
    var pxcontentOffset = $('.parallax-section, .parallax-mobile').offset().left;
    $('.parallax-content').css('left', '-' + pxcontentOffset + 'px');
	$(".px-mobile-container").each(function() {
        var i = $(this).attr("data-factor") * $(window).width();
        $(this).css("height", i + "px")
    })
});