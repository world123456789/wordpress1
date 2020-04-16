(function ($, elementor) {
    "use strict";

    var Seocify = {

        init: function () {

            var widgets = {
                'xs-maps.default': Seocify.Map,
                'xs-testimonial.default': Seocify.Testimonial,
                'xs-pricing-table.default': Seocify.Pricing,
                'xs-case-studies.default': Seocify.Case_Studies,
                'xs-funfact.default': Seocify.Funfact,
                'xs-doodle-parallax.default': Seocify.DoodleParallax,
                'xs-work-process.default': Seocify.WorkProcess,
            };
            $.each(widgets, function (widget, callback) {
                elementor.hooks.addAction('frontend/element_ready/' + widget, callback);
            });

        },
        Map: function ($scope) {

            var $container = $scope.find('.seocify-maps'),
                map,
                init,
                pins;
            if (!window.google) {
                return;
            }

            init = $container.data('init');
            pins = $container.data('pins');
            map = new google.maps.Map($container[0], init);

            if (pins) {
                $.each(pins, function (index, pin) {

                    var marker,
                        infowindow,
                        pinData = {
                            position: pin.position,
                            map: map
                        };

                    if ('' !== pin.image) {
                        pinData.icon = pin.image;
                    }

                    marker = new google.maps.Marker(pinData);

                    if ('' !== pin.desc) {
                        infowindow = new google.maps.InfoWindow({
                            content: pin.desc
                        });
                    }

                    marker.addListener('click', function () {
                        infowindow.open(map, marker);
                    });

                    if ('visible' === pin.state && '' !== pin.desc) {
                        infowindow.open(map, marker);
                    }

                });
            }
        },

        Funfact: function ($scope) {

            var $number_percentage = $scope.find('.number-percentage');
            $number_percentage.each(function () {
                $(this).animateNumbers($(this).attr("data-value"), true, parseInt($(this).attr("data-animation-duration"), 10));
            });
        },

        DoodleParallax: function ($scope) {
            var $doodle_parallax = $scope.find('.elementor-top-section');
            $doodle_parallax.each(function () {
                if ($(this).find('.doodle-parallax').hasClass('doodle-parallax')) {
                    $(this).attr('data-scrollax-parent', 'true');
                } else {
                    $(this).removeAttr('data-scrollax-parent');
                }
            });
            var a = {
                Android: function () {
                    return navigator.userAgent.match(/Android/i);
                },
                BlackBerry: function () {
                    return navigator.userAgent.match(/BlackBerry/i);
                },
                iOS: function () {
                    return navigator.userAgent.match(/iPhone|iPad|iPod/i);
                },
                Opera: function () {
                    return navigator.userAgent.match(/Opera Mini/i);
                },
                Windows: function () {
                    return navigator.userAgent.match(/IEMobile/i);
                },
                any: function () {
                    return a.Android() || a.BlackBerry() || a.iOS() || a.Opera() || a.Windows();
                }
            };
            var trueMobile = a.any();
            if (null == trueMobile) {
                var b = new Scrollax();
                b.reload();
                b.init();
            }
        },

        Case_Studies: function ($scope) {

            var $container = $scope.find('.case-study-slider');
            var dot = $container.data('dot') == 'yes' ? true : false;
            var nav = $container.data('nav') == 'yes' ? true : false;
            $container.myOwl({
                items: 3,
                dots: dot,
                navText: ['<i class="icon icon-arrow-left"></i>', '<i class="icon icon-arrow-right"></i>'],
                nav: nav,
                margin: 30,
                stagePadding: 15,
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 2
                    },
                    1024: {
                        items: 3
                    }
                }
            });
        },


        Testimonial: function ($scope) {

            if ($('.testimonial-slider').length > 0) {
                let sync1 = $scope.find(".testimonial-slider");
                sync1.myOwl({
                    dots: true
                });
            }

            if (($('#sync1') && $('#sync2')).length > 0) {
                let sync1 = $scope.find("#sync1");
                let sync2 = $scope.find("#sync2");
                let slidesPerPage = 3; //globaly define number of elements per page
                let syncedSecondary = true;

                sync1.owlCarousel({
                    items: 1,
                    slideSpeed: 2000,
                    nav: false,
                    autoplay: true,
                    dots: true,
                    loop: true,
                    responsiveRefreshRate: 200,
                }).on('changed.owl.carousel', syncPosition);

                sync2
                    .on('initialized.owl.carousel', function () {
                        sync2.find(".owl-item").eq(0).addClass("current");
                    })
                    .owlCarousel({
                        items: slidesPerPage,
                        dots: true,
                        nav: false,
                        autoplay: true,
                        smartSpeed: 200,
                        slideSpeed: 500,
                        slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
                        responsiveRefreshRate: 100,
                        responsive: {
                            0: {
                                items: 1
                            },
                            768: {
                                items: 2
                            },
                            1024: {
                                items: slidesPerPage
                            }
                        }
                    }).on('changed.owl.carousel', syncPosition2);

                function syncPosition(el) {
                    //if you set loop to false, you have to restore this next line
                    //let current = el.item.index;

                    //if you disable loop you have to comment this block
                    let count = el.item.count - 1;
                    let current = Math.round(el.item.index - (el.item.count / 2) - .5);

                    if (current < 0) {
                        current = count;
                    }
                    if (current > count) {
                        current = 0;
                    }

                    //end block

                    sync2
                        .find(".owl-item")
                        .removeClass("current")
                        .eq(current)
                        .addClass("current");
                    let onscreen = sync2.find('.owl-item.active').length - 1;
                    let start = sync2.find('.owl-item.active').first().index();
                    let end = sync2.find('.owl-item.active').last().index();

                    if (current > end) {
                        sync2.data('owl.carousel').to(current, 100, true);
                    }
                    if (current < start) {
                        sync2.data('owl.carousel').to(current - onscreen, 100, true);
                    }
                }

                function syncPosition2(el) {
                    if (syncedSecondary) {
                        let number = el.item.index;
                        sync1.data('owl.carousel').to(number, 100, true);
                    }
                }

                sync2.on("click", ".owl-item", function (e) {
                    e.preventDefault();
                    let number = $(this).index();
                    sync1.data('owl.carousel').to(number, 300, true);
                });
            }


            // Seocify Testimonial New
            var slider4 = $scope.find(".xs-seocify-testimonial-preview"),
                slider4_2 = $scope.find(".xs-seocify-testimonial"),
                navData = slider4.data("nagivation");

            if (slider4.length > 0 && slider4_2.length > 0 && 'yes' == navData) {
                var _seocifyTestimonialSync = function _seocifyTestimonialSync(el) {
                    //if you set loop to false, you have to restore this next line
                    //var current = el.item.index;

                    //if you disable loop you have to comment this block
                    var count = el.item.count - 1;
                    var current = Math.round(el.item.index - el.item.count / 2 - .5);

                    if (current < 0) {
                        current = count;
                    }
                    if (current > count) {
                        current = 0;
                    }
                    //end block

                    slider4_2.find(".owl-item").removeClass("current").eq(current).addClass("current");
                    var onscreen = slider4_2.find('.owl-item.active').length - 1;
                    var start = slider4_2.find('.owl-item.active').first().index();
                    var end = slider4_2.find('.owl-item.active').last().index();

                    if (current > end) {
                        slider4_2.data('owl.carousel').to(current, 100, true);
                    }
                    if (current < start) {
                        slider4_2.data('owl.carousel').to(current - onscreen, 100, true);
                    }
                };

                var _seocifyTestimonialSync2 = function _seocifyTestimonialSync2(el) {
                    if (syncedSecondary) {
                        var number = el.item.index;
                        slider4.data('owl.carousel').to(number, 100, true);
                    }
                };

                var seocifyTestimonialSync1 = $scope.find(".xs-seocify-testimonial-preview"),
                    seocifyTestimonialSync2 = $scope.find(".xs-seocify-testimonial"),
                    slidesPerPage = 5,
                    syncedSecondary = true;

                seocifyTestimonialSync1.owlCarousel({
                    items: 1,
                    slideSpeed: 2000,
                    nav: true,
                    autoplay: false,
                    dots: false,
                    loop: true,
                    mouseDrag: false,
                    touchDrag: false,
                    responsiveRefreshRate: 200,
                    responsive: {
                        0: {
                            touchDrag: true
                        },
                        768: {
                            touchDrag: true
                        },
                        1024: {
                            touchDrag: false
                        }
                    },
                    navText: [
                        '<i class="icon icon-arrow-left"></i>',
                        '<i class="icon icon-arrow-right"></i>'
                    ]
                }).on('changed.owl.carousel', _seocifyTestimonialSync);

                seocifyTestimonialSync2.on('initialized.owl.carousel', function () {
                    seocifyTestimonialSync2.find(".owl-item").eq(0).addClass("current");
                }).owlCarousel({
                    items: slidesPerPage,
                    dots: false,
                    nav: false,
                    smartSpeed: 200,
                    slideSpeed: 500,
                    autoWidth: false,
                    mouseDrag: false,
                    touchDrag: false,
                    slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
                    responsiveRefreshRate: 100
                }).on('changed.owl.carousel', _seocifyTestimonialSync2);

                seocifyTestimonialSync2.on("click", ".owl-item", function (e) {
                    e.preventDefault();
                    var number = $(this).index();
                    seocifyTestimonialSync1.data('owl.carousel').to(number, 300, true);
                });

                seocifyTestimonialSync1.on('changed.owl.carousel', function (event) {
                    if ($('.owl-item.active.current img').length > 0) {
                        var item_image_src = $('.owl-item.active.current img').attr('src');
                        $('.xs-seocify-testimonial-big-thumb img').attr('src', item_image_src);

                    }
                });

                if ($('.xs-seocify-testimonial-v2 img').length > 0) {
                    $(document).on('click', '.xs-seocify-testimonial-v2 img', function () {
                        var imgSrc = $(this).attr('src');
                        if ($('.xs-seocify-testimonial-big-thumb img').length > 0) {
                            $('.xs-seocify-testimonial-big-thumb img').attr('src', imgSrc);
                        }
                    });
                }
            } else if (slider4.length > 0) {
                slider4.owlCarousel({
                    items: 1,
                    slideSpeed: 2000,
                    nav: true,
                    autoplay: false,
                    dots: false,
                    loop: true,
                    mouseDrag: false,
                    touchDrag: false,
                    responsiveRefreshRate: 200,
                    responsive: {
                        0: {
                            touchDrag: true
                        },
                        768: {
                            touchDrag: true
                        },
                        1024: {
                            touchDrag: false
                        }
                    },
                    navText: [
                        '<i class="icon icon-arrow-left"></i>',
                        '<i class="icon icon-arrow-right"></i>'
                    ]
                });
            }
        },

        Pricing: function (e) {
            var xs_pricing_table = e.find('.pricing-matrix-slider');

            if (!xs_pricing_table) {
                return;
            }

            xs_pricing_table.on('initialized.owl.carousel translated.owl.carousel', function () {
                var $this = $(this);
                $this.find('.owl-item.last-child').each(function () {
                    $(this).removeClass('last-child');
                });
                $(this).find('.owl-item.active').last().addClass('last-child');
            });
            xs_pricing_table.myOwl({
                items: 3,
                mouseDrag: false,
                autoplay: false,
                nav: true,
                navText: ['<i class="icon icon-arrow-left"></i>', '<i class="icon icon-arrow-right"></i>'],
                responsive: {
                    0: {
                        items: 1,
                        mouseDrag: true,
                        loop: true,
                    },
                    768: {
                        items: 2,
                        mouseDrag: true
                    },
                    1024: {
                        items: 3,
                        mouseDrag: false,
                        loop: false
                    }
                }
            });
            equalHeight();
            function equalHeight() {

                let pricingImage = e.find('.pricing-image'),
                    pricingFeature = e.find('.pricing-feature-group');
                if ($(window).width() > 991) {
                    pricingImage.css('height', pricingFeature.outerHeight());
                } else {
                    pricingImage.css('height', 100 + '%');
                }
            }
        },
        WorkProcess: function ($scope) {

            var workprocessSlider = $scope.find(".workprocess-sync1");
            var workprocessPosts = $scope.find(".workprocess-sync2");
            var slidesPerPage = 3; //globaly define number of elements per page
            var syncedSecondary = true;


            workprocessSlider.owlCarousel({
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 2
                    },
                    992: {
                        items: 3
                    }
                },
                slideSpeed: 2000,
                nav: false,
                autoplay: false,
                dots: false,
                loop: true,
                mouseDrag: true,
                touchDrag: true,
                responsiveRefreshRate: 200,
            }).on('changed.owl.carousel', syncPosition);

            workprocessPosts
                .on('initialized.owl.carousel', function () {
                    workprocessPosts.find(".owl-item").eq(0).addClass("current");
                })
                .owlCarousel({
                    responsive: {
                        0: {
                            items: 1
                        },
                        768: {
                            items: 2
                        },
                        992: {
                            items: 3
                        }
                    },
                    dots: false,
                    nav: true,
                    smartSpeed: 100,
                    slideSpeed: 2000,
                    mouseDrag: true,
                    touchDrag: true,
                    slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
                    responsiveRefreshRate: 100,
                    navText: [
                        '<i class="icon icon-chevron-left"></i>',
                        '<i class="icon icon-chevron-right"></i>'
                    ],
                }).on('changed.owl.carousel', syncPosition2);

            function syncPosition(el) {
                //if you set loop to false, you have to restore this next line
                //var current = el.item.index;

                //if you disable loop you have to comment this block
                var count = el.item.count - 1;
                var current = Math.round(el.item.index - (el.item.count / 2) - .5);

                if (current < 0) {
                    current = count;
                }
                if (current > count) {
                    current = 0;
                }

                //end block

                workprocessPosts
                    .find(".owl-item")
                    .removeClass("current")
                    .eq(current)
                    .addClass("current");
                var onscreen = workprocessPosts.find('.owl-item.active').length - 1;
                var start = workprocessPosts.find('.owl-item.active').first().index();
                var end = workprocessPosts.find('.owl-item.active').last().index();

                if (current > end) {
                    workprocessPosts.data('owl.carousel').to(current, 100, true);
                }
                if (current < start) {
                    workprocessPosts.data('owl.carousel').to(current - onscreen, 100, true);
                }
            }

            function syncPosition2(el) {
                if (syncedSecondary) {
                    var number = el.item.index;
                    workprocessSlider.data('owl.carousel').to(number, 100, true);
                }
            }

            workprocessPosts.on("click", ".owl-item", function (e) {
                e.preventDefault();
                var number = $(this).index();
                workprocessSlider.data('owl.carousel').to(number, 100, true);
            });

            var activeLine = $('.workprocess-sync2 .owl-item .item p');

            $(document).on('click', '.workprocess-sync2 .owl-item .item p', function () {

                if ($(this).parents('.item').hasClass('xs-selected')) {
                    $(this).parents('.item').removeClass('xs-selected');
                    $(this).parents('.owl-item').nextAll().find('.item').removeClass('xs-selected')
                } else {
                    $(this).parents('.item').addClass('xs-selected');
                    $(this).parents('.owl-item').prevAll().find('.item').addClass('xs-selected');
                }
            });

        }
    };
    $(window).on('elementor/frontend/init', Seocify.init);
}(jQuery, window.elementorFrontend));




!function(e,t){"use strict";var a={init:function(){t.hooks.addAction("frontend/element_ready/section",a.elementorSection)},elementorSection:function(e){var a=e,n=null;Boolean(t.isEditMode());(n=new ElementsKitSectionParallaxPlugin(a)).init(n)}};e(window).on("elementor/frontend/init",a.init),window.ElementsKitSectionParallaxPlugin=function(a){var n=this,i=a.data("id"),l=Boolean(t.isEditMode()),o=e(window);e("body"),o.scrollTop(),o.height(),navigator.userAgent.match(/Version\/[\d\.]+.*Safari/),navigator.platform;n.init=function(){return n.setParallaxMulti(i),n.moveBg(i),!1},n.setParallaxMulti=function(t){var i,o={},r=[];if(o=n.getOptions(t,"ekit_section_parallax_multi_items"),"yes"==(i=n.getOptions(t,"ekit_section_parallax_multi"))){if(l){if(!o.hasOwnProperty("models")||0===Object.keys(o.models).length||"yes"!=i)return;o=o.models}if(a.addClass("elementskit-parallax-multi-container"),e.each(o,function(e,t){t.hasOwnProperty("attributes")&&(t=t.attributes),r.push(t),n.pushElement(t),n.getSVG()}),r.length<0)return r;a.on("mousemove",function(t){e.each(r,function(e,a){"mousemove"==a.parallax_style&&n.moveItem(a,t)})}),e.each(r,function(e,t){"tilt"==t.parallax_style&&n.tiltItem(t),"onscroll"==t.parallax_style&&n.walkItem(t)})}},n.moveBg=function(e){},n.walkItem=function(e){void 0!==e.parallax_transform&&void 0!==e.parallax_transform_value&&a.find(".elementor-repeater-item-"+e._id).magician({type:"scroll",offsetTop:parseInt(e.offsettop),offsetBottom:parseInt(e.offsetbottom),duration:parseInt(e.smoothness),animation:{[e.parallax_transform]:e.parallax_transform_value}})},n.moveItem=function(e,t){var n=t.pageX-a.offset().left,i=t.pageY-a.offset().top;TweenMax.to(a.find(".elementor-repeater-item-"+e._id),1,{x:(n-a.width()/2)/a.width()*e.parallax_speed,y:(i-a.height()/2)/a.height()*e.parallax_speed,ease:Power2.ease})},n.tiltItem=function(e){var t=a.find(".elementor-repeater-item-"+e._id);t.find("img");t.tilt({disableAxis:e.disableaxis,scale:e.scale,speed:e.parallax_speed,maxTilt:e.maxtilt,glare:!0,maxGlare:.5})},n.getOptions=function(t,a){var n=null,i={};return l?!!window.elementor.hasOwnProperty("elements")&&(!!(n=window.elementor.elements).models&&(e.each(n.models,function(e,a){t==a.id&&(i=a.attributes.settings.attributes)}),!!i.hasOwnProperty(a)&&i[a])):(t="section"+t,!(!window.elementskit_section_parallax_data||!window.elementskit_section_parallax_data.hasOwnProperty(t))&&(!!window.elementskit_section_parallax_data[t].hasOwnProperty(a)&&window.elementskit_section_parallax_data[t][a]))},n.pushElement=function(e){var t="ekit-section-parallax-mousemove ekit-section-parallax-layer elementor-repeater-item-"+e._id,n="";"shape"==e.item_source&&(e.image.url=window.elementskit_plugin_url+"assets/svg/"+e.shape+".svg",t+=" ekit-section-parallax-layer-shape",n="shape-"+e.shape.replace(".svg","")),0===a.find(".elementor-repeater-item-"+e._id).length&&""!=e.image.url&&a.prepend(`\n                        <div class="${t}" >\n                            <img class="elementskit-parallax-graphic ${n}" src="${e.image.url}"/>\n                        </div>\n                    `)},n.getSVG=function(){a.find(".ekit-section-parallax-layer-shape img").each(function(){var t=e(this),a=t.prop("attributes"),n=t.attr("src");e.get(n,function(n){var i=e(n).find("svg");i=i.removeAttr("xmlns:a"),e.each(a,function(){i.attr(this.name,this.value)}),t.replaceWith(i)})})}}}(jQuery,window.elementorFrontend);