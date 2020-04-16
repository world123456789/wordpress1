jQuery(function($){
    'use strict';
    var selectAnimation = $('.xs-grid-line-parallax-animation .elementor-top-section');

    if(selectAnimation.length > 0){
            selectAnimation.each(function(){
                //$(this).attr('data-scrollax-parent', 'true');
                $(this).prepend(
                    '<div class="xs-grid-parallax-anim-wraper">'
                        +'<span class="xs-grid-line-parallax xs-grid-line-parallax-350 xs-grid-line-parallax-left">'
                            +`<span class="xs-grid-line-parallax-inner">`
                            +'</span>'
                        +'</span>'
                        +'<span class="xs-grid-line-parallax xs-grid-line-parallax-450 xs-grid-line-parallax-center-left">'
                            +`<span class="xs-grid-line-parallax-inner">`
                            +'</span>'
                        +'</span>'
                        +'<span class="xs-grid-line-parallax xs-grid-line-parallax-250 xs-grid-line-parallax-center-right">'
                            +`<span class="xs-grid-line-parallax-inner">`
                            +'</span>'
                        +'</span>'
                        +'<span class="xs-grid-line-parallax xs-grid-line-parallax-150 xs-grid-line-parallax-right">'
                            +`<span class="xs-grid-line-parallax-inner">`
                            +'</span>'
                        +'</span>'
                    +'</div>'
                );
            });
       }
});


jQuery(document).ready(function($) {
    $('.xs-grid-line-parallax-350 span').each(function(){
        $(this).magician({
            type: 'scroll',
            animation:{
                translateY: 350,
            }
        });
    });

    $('.xs-grid-line-parallax-150 span').each(function(){
        $(this).magician({
            type: 'scroll',
            animation:{
                translateY: 400,
            }
        });
    });

    $('.xs-grid-line-parallax-250 span').each(function(){
        $(this).magician({
            type: 'scroll',
            animation:{
                translateY: 300,
            }
        });
    });

    $('.xs-grid-line-parallax-450 span').each(function(){
        $(this).magician({
            type: 'scroll',
            animation:{
                translateY: 450,
            }
        });
    });

});
    