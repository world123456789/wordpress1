/* -----------------------------------------------
/* How to use? : Check the GitHub README
/* ----------------------------------------------- */

/* To load a config file (particles.json) you need to host this demo (MAMP/WAMP/local)... */
/*
particlesJS.load('particles-js', 'particles.json', function() {
  console.log('particles.js loaded - callback');
});
*/

/* Otherwise just put the config content (json): */

jQuery(function ($) {
    obj = xs_partical_obj;



     var color1, color2, color1_value, color2_value;
        color1 = JSON.parse(xs_partical_obj.color1);
        color2 = JSON.parse(xs_partical_obj.color2);


    if (color1.length > 0 ) {

        color1_value =  color1;

    }else {
        color1_value =  ["#BD10E0", "#B8E986", "#50E3C2", "#FFD300", "#E86363"];
    }

    // color two
    if (color2.length > 0) {

        color2_value =  color2;

    }else {

        color2_value =  ["#d7daee", "#ced1ea", "#f7f9fb"];
    }


    $(window).on("load", function() {
        if($('#particles-js-sec').length > 0 ){
            var particl = $('.particles-js-1');
            particl.each(function(){
                var id = $(this).attr('id');

                $("#"+id).length && particlesJS(id , {
                    particles: {
                        number: {
                            value: 20
                        },
                        color: {
                            value: color2_value
                        },
                        shape: {
                            type: ["circle", "triangle", "polygon"]
                        },
                        opacity: {
                            value: 1,
                            random: !1,
                            anim: {
                                enable: !1
                            }
                        },
                        size: {
                            value: 3,
                            random: !0,
                            anim: {
                                enable: !1
                            }
                        },
                        line_linked: {
                            enable: !1
                        },
                        move: {
                            enable: !0,
                            speed: 2,
                            direction: "none",
                            random: !0,
                            straight: !1,
                            out_mode: "out"
                        }
                    },
                    interactivity: {
                        detect_on: "canvas",
                        events: {
                            onhover: {
                                enable: !1
                            },
                            onclick: {
                                enable: !1
                            },
                            resize: !0
                        }
                    },
                    retina_detect: !0
                })

            });
        }
if($('.particles-js-2').length > 0 ){
            var particl = $('.particles-js-2');
            particl.each(function(){
                var id = $(this).attr('id');
                $("#"+id).length && particlesJS(id , {
                    particles: {
                        number: {
                            value: 20
                        },
                        color: {
                            value: color2_value
                        },
                        shape: {
                            type: ["circle", "triangle", "polygon"]
                        },
                        opacity: {
                            value: 1,
                            random: !1,
                            anim: {
                                enable: !1
                            }
                        },
                        size: {
                            value: 3,
                            random: !0,
                            anim: {
                                enable: !1
                            }
                        },
                        line_linked: {
                            enable: !1
                        },
                        move: {
                            enable: !0,
                            speed: 2,
                            direction: "none",
                            random: !0,
                            straight: !1,
                            out_mode: "out"
                        }
                    },
                    interactivity: {
                        detect_on: "canvas",
                        events: {
                            onhover: {
                                enable: !1
                            },
                            onclick: {
                                enable: !1
                            },
                            resize: !0
                        }
                    },
                    retina_detect: !0
                })

            });
        }
    });

});

