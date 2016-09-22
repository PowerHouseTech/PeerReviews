jQuery(document).ready(function ($) {
      
   // Static Counter
   $('.counter').counterUp({
       delay: 20,
       time: 1000
   });   

    //Navigation toggle
    $("#toggle").click(function () {
        $(this).toggleClass("on");
        $("#menu").slideToggle();
    });

    $("a[rel^='prettyPhoto']").prettyPhoto({
                theme: 'light_rounded',
                slideshow: 5000,
                autoplay_slideshow: false,
                keyboard_shortcuts: true,
                deeplinking : false,
                default_width: 500,
                default_height: 344,
    });

    $("a[rel^='gallryLight']").prettyPhoto({
                theme: 'light_rounded',
                slideshow: 5000,
                autoplay_slideshow: false,
                keyboard_shortcuts: true,
                deeplinking : false,
                default_width: 500,
                default_height: 344,
    });
            
    $('.wpcf7-form').addClass("clearfix");


    $('.fg-sortable-gallery').imagesLoaded( function() {

        var $grid = $('#fg-grid-gallery-view').isotope({
            itemSelector: '.element-item'
        });

        // bind filter button click
        $('.filters-button-group').on('click', 'li', function () {
            var filterValue = $(this).attr('data-filter');
            $grid.isotope({filter: filterValue});
        });

        // change is-checked class on buttons
        $('.button-group').each(function (i, buttonGroup) {
            var $buttonGroup = $(buttonGroup);
            $buttonGroup.on('click', 'li', function () {
                $buttonGroup.find('.is-checked').removeClass('is-checked');
                $(this).addClass('is-checked');
            });
        });
    });

    $('.full-content-area').imagesLoaded( function() {

        var $grid1 = $('.fg-sortable-grid').isotope({
            itemSelector: '.element-item'
        });

        // bind filter button click
        $('.filters-button-group').on('click', 'li', function () {
            var filterValue = $(this).attr('data-filter');
            $grid1.isotope({filter: filterValue});
        });

        // change is-checked class on buttons
        $('.button-group').each(function (i, buttonGroup) {
            var $buttonGroup = $(buttonGroup);
            $buttonGroup.on('click', 'li', function () {
                $buttonGroup.find('.is-checked').removeClass('is-checked');
                $(this).addClass('is-checked');
            });
        });
    });


    if( $('#fg-masonary-gallery').length > 0 ){
        var $container = $('#fg-masonary-gallery').imagesLoaded( function() {
            GetMasonary();

            $container.isotope({
                itemSelector: '.item',
            });     
            
            $(window).on( 'resize', function () {
               GetMasonary();
            });
            
        });
    }

// Go to Top
    if ($('#back-to-top').length) {
        var scrollTrigger = 100, // px
                backToTop = function () {
                    var scrollTop = $(window).scrollTop();
                    if (scrollTop > scrollTrigger) {
                        $('#back-to-top').addClass('show');
                    } else {
                        $('#back-to-top').removeClass('show');
                    }
                };
        backToTop();
        $(window).on('scroll', function () {
            backToTop();
        });
        $('#back-to-top').on('click', function (e) {
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 700);
        });
    }
    
    $('.fg-toggle-nav').click(function(){
        $('.main-navigation').slideToggle();
    });

// Mosaic View Layout Javascript 
function initHoverEffectForThumbView() {
    jQuery('.thumb-elem, .grid-elem header').each(function () {
        var thisElem = jQuery(this);
        var getElemWidth = thisElem.width();
        var getElemHeight = thisElem.height();
        var centerX = getElemWidth / 2;
        var centerY = getElemHeight / 2;

        thisElem.mouseenter(function () {
            thisElem.on('mousemove', function (e) {
                var mouseX = e.pageX - thisElem.offset().left;
                var mouseY = e.pageY - thisElem.offset().top;
                var mouseDistX = (mouseX / centerX) * 100 - 100;
                var mouseDistY = (mouseY / centerY) * 100 - 100;
                thisElem.find('img.the-thumb').css({
                    'left': -(mouseDistX / 6.64) - 15 + "%",
                    'top': -(mouseDistY / 6.64) - 15 + "%"
                });
            });

            thisElem.find('.thumb-elem-section:not(.no-feat-img)').fadeIn('fast');
        }).mouseleave(function () {
            thisElem.find('.thumb-elem-section:not(.no-feat-img)').fadeOut('fast');
        });
    });
}

function initSimpleHoverEffectForThumbView() {
    jQuery('.thumb-elem, .grid-elem header').each(function () {
        var thisElem = jQuery(this);
        thisElem.mouseenter(function () {
            thisElem.find('.thumb-elem-section:not(.no-feat-img)').fadeIn('fast');
        }).mouseleave(function () {
            thisElem.find('.thumb-elem-section:not(.no-feat-img)').fadeOut('fast');
        });
    });
}

jQuery(window).load(function () {
    "use strict";

    if (!hoverEffect.disable_hover_effect && jQuery(window).width() > 768) {
        initHoverEffectForThumbView();
    } else {
        initSimpleHoverEffectForThumbView();
    }
});

var hoverEffect = {"disable_hover_effect": ""};

function GetMasonary(){
var winWidth = window.innerWidth;
    columnNumb = 1;         
    var attr_col = $('#fg-masonary-gallery').attr('data-col');
        
     if (winWidth >= 1466) {
        
        
        $('#fg_gallery_wrap').css( {width : $('#fg_gallery_wrap').parent().width() - 20 + 'px'});
        $('#fg_gallery_wrap.no-gutter').css( {width : $('#fg_gallery_wrap').parent().width() + 4 + 'px'});            
        var galleryWidth = $('#fg_gallery_wrap').width();
        
        if (typeof attr_col !== typeof undefined && attr_col !== false) {
            columnNumb = $('#fg-masonary-gallery').attr('data-col');
        } else columnNumb = 5;
        
        postHeight = window.innerHeight
        postWidth = Math.floor(galleryWidth / columnNumb)         
        $container.find('.item').each(function () { 
            $('.item').css( { 
                width : postWidth * 1 - 20 + 'px',
                height : postWidth * 1 - 20 + 'px',
                margin : 10 + 'px' 
            });
            $('.no-gutter .item').css( {
                width : postWidth + 'px',
                height : postWidth + 'px',
                margin : 0 + 'px' 
            });
            $('.item.wide').css( { 
                width : postWidth * 2 - 20 + 'px',
                height : postWidth * 2 - 20 + 'px'
            });
            $('.no-gutter .item.wide').css( { 
                width : postWidth * 2  + 'px',
                height : postWidth * 2  + 'px' 
            });
        });
        
        
    } else if (winWidth > 1024) {
        
        $('#fg_gallery_wrap').css( {width : $('#fg_gallery_wrap').parent().width() - 20 + 'px'});
        $('#fg_gallery_wrap.no-gutter').css( {width : $('#fg_gallery_wrap').parent().width() + 4 + 'px'});            
        var galleryWidth = $('#fg_gallery_wrap').width();
                    
        columnNumb = 6;
        
        postHeight = window.innerHeight
        postWidth = Math.floor(galleryWidth / columnNumb)         
        $container.find('.item').each(function () { 
            $('.item').css( { 
                width : postWidth - 20 + 'px',
                height : postWidth  - 20 + 'px',
                margin : 10 + 'px' 
            });
            $('.no-gutter .item').css( {
                width : postWidth + 'px',
                height : postWidth + 'px',
                margin : 0 + 'px' 
            });
            $('.item.wide').css( { 
                width : postWidth * 2 - 20 + 'px',
                height : postWidth * 2 - 20 + 'px'
            });
            $('.no-gutter .item.wide').css( { 
                width : postWidth * 2 + 'px',
                height : postWidth * 2 + 'px' 
            });
        });
        
        
    } else if (winWidth > 767) {
        
        $('#fg_gallery_wrap').css( {width : $('#fg_gallery_wrap').parent().width() - 20 + 'px'});
        $('#fg_gallery_wrap.no-gutter').css( {width : $('#fg_gallery_wrap').parent().width() + 4 + 'px'});            
        var galleryWidth = $('#fg_gallery_wrap').width();
        
        columnNumb = 4;
        postWidth = Math.floor(galleryWidth / columnNumb)         
        $container.find('.item').each(function () { 
            $('.item').css( { 
                width : postWidth - 20 + 'px',
                height : postWidth  - 20 + 'px',
                margin : 10 + 'px' 
            });
            $('.no-gutter .item').css( {
                width : postWidth + 'px',
                height : postWidth + 'px',
                margin : 0 + 'px' 
            });
            $('.item.wide').css( { 
                width : postWidth * 2 - 20 + 'px',
                height : postWidth * 2 - 20 + 'px'
            });
            $('.no-gutter .item.wide').css( { 
                width : postWidth * 2 + 'px',
                height : postWidth * 2 + 'px' 
            });                 
        });
        
        
    }   else if (winWidth > 479) {
        
        $('#fg_gallery_wrap').css( {width : $('#fg_gallery_wrap').parent().width() - 20 + 'px'});
        $('#fg_gallery_wrap.no-gutter').css( {width : $('#fg_gallery_wrap').parent().width() + 'px'});            
        var galleryWidth = $('#fg_gallery_wrap').width();
        
        columnNumb = 2;
        postWidth = Math.floor(galleryWidth / columnNumb)         
        $container.find('.item').each(function () { 
            $('.item').css( { 
                width : postWidth - 20 + 'px',
                height : postWidth  - 20 + 'px',
                margin : 10 + 'px' 
            });
            $('.no-gutter .item').css( {
                width : postWidth + 'px',
                height : postWidth + 'px',
                margin : 0 + 'px' 
            });
            $('.item.wide').css( { 
                width : postWidth  - 20 + 'px',
                height : postWidth  - 20 + 'px'
            });
            $('.no-gutter .item.wide').css( { 
                width : postWidth  + 'px',
                height : postWidth  + 'px' 
            });
        }); 
    }
    
    else if (winWidth <= 479) {
        
        $('#fg_gallery_wrap').css( {width : $('#fg_gallery_wrap').parent().width() - 10 + 'px'});
        $('#fg_gallery_wrap.no-gutter').css( {width : $('#fg_gallery_wrap').parent().width() + 'px'});            
        var galleryWidth = $('#fg_gallery_wrap').width();
        
        columnNumb = 1;
        postWidth = Math.floor(galleryWidth / columnNumb)         
        $container.find('.item').each(function () { 
            $('.item').css( { 
                width : postWidth - 10 + 'px',
                height : postWidth  - 10 + 'px',
                margin : 5 + 'px' 
            });
            $('.no-gutter .item').css( {
                width : postWidth + 'px',
                height : postWidth + 'px',
                margin : 0 + 'px' 
            });
            $('.item.wide').css( { 
                width : postWidth  - 10 + 'px',
                height : postWidth  - 10 + 'px'
            });
            $('.no-gutter .item.wide').css( { 
                width : postWidth  + 'px',
                height : postWidth  + 'px' 
            });
        });
        
        
    }       
    return columnNumb;
}

});

// Single Gallery Page script

(function () {
    var initPhotoSwipeFromDOM = function (gallerySelector) {
        var parseThumbnailElements = function (el) {
            var thumbElements = el.childNodes,
                    numNodes = thumbElements.length,
                    items = [],
                    el,
                    childElements,
                    thumbnailEl,
                    size,
                    item;

            for (var i = 0; i < numNodes; i++) {
                el = thumbElements[i];

                // include only element nodes 
                if (el.nodeType !== 1) {
                    continue;
                }

                childElements = el.children;

                size = el.getAttribute('data-size').split('x');

                // create slide object
                item = {
                    src: el.getAttribute('href'),
                    w: parseInt(size[0], 10),
                    h: parseInt(size[1], 10),
                    author: el.getAttribute('data-author')
                };

                item.el = el; // save link to element for getThumbBoundsFn

                if (childElements.length > 0) {
                    item.msrc = childElements[0].getAttribute('src'); // thumbnail url
                    if (childElements.length > 1) {
                        item.title = childElements[1].innerHTML; // caption (contents of figure)
                    }
                }


                var mediumSrc = el.getAttribute('data-med');
                if (mediumSrc) {
                    size = el.getAttribute('data-med-size').split('x');
                    // "medium-sized" image
                    item.m = {
                        src: mediumSrc,
                        w: parseInt(size[0], 10),
                        h: parseInt(size[1], 10)
                    };
                }
                // original image
                item.o = {
                    src: item.src,
                    w: item.w,
                    h: item.h
                };

                items.push(item);
            }

            return items;
        };

        // find nearest parent element
        var closest = function closest(el, fn) {
            return el && (fn(el) ? el : closest(el.parentNode, fn));
        };

        var onThumbnailsClick = function (e) {
            e = e || window.event;
            e.preventDefault ? e.preventDefault() : e.returnValue = false;

            var eTarget = e.target || e.srcElement;

            var clickedListItem = closest(eTarget, function (el) {
                return el.tagName === 'A';
            });

            if (!clickedListItem) {
                return;
            }

            var clickedGallery = clickedListItem.parentNode;

            var childNodes = clickedListItem.parentNode.childNodes,
                    numChildNodes = childNodes.length,
                    nodeIndex = 0,
                    index;

            for (var i = 0; i < numChildNodes; i++) {
                if (childNodes[i].nodeType !== 1) {
                    continue;
                }

                if (childNodes[i] === clickedListItem) {
                    index = nodeIndex;
                    break;
                }
                nodeIndex++;
            }

            if (index >= 0) {
                openPhotoSwipe(index, clickedGallery);
            }
            return false;
        };

        var photoswipeParseHash = function () {
            var hash = window.location.hash.substring(1),
                    params = {};

            if (hash.length < 5) { // pid=1
                return params;
            }

            var vars = hash.split('&');
            for (var i = 0; i < vars.length; i++) {
                if (!vars[i]) {
                    continue;
                }
                var pair = vars[i].split('=');
                if (pair.length < 2) {
                    continue;
                }
                params[pair[0]] = pair[1];
            }

            if (params.gid) {
                params.gid = parseInt(params.gid, 10);
            }

            return params;
        };

        var openPhotoSwipe = function (index, galleryElement, disableAnimation, fromURL) {
            var pswpElement = document.querySelectorAll('.pswp')[0],
                    gallery,
                    options,
                    items;

            items = parseThumbnailElements(galleryElement);

            // define options (if needed)
            options = {
                galleryUID: galleryElement.getAttribute('data-pswp-uid'),
                getThumbBoundsFn: function (index) {
                    // See Options->getThumbBoundsFn section of docs for more info
                    var thumbnail = items[index].el.children[0],
                            pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                            rect = thumbnail.getBoundingClientRect();

                    return {x: rect.left, y: rect.top + pageYScroll, w: rect.width};
                },
                addCaptionHTMLFn: function (item, captionEl, isFake) {
                    if (!item.title) {
                        captionEl.children[0].innerText = '';
                        return false;
                    }
                    captionEl.children[0].innerHTML = item.title + '<br/><small>Photo: ' + item.author + '</small>';
                    return true;
                }

            };


            if (fromURL) {
                if (options.galleryPIDs) {
                    // parse real index when custom PIDs are used 
                    // http://photoswipe.com/documentation/faq.html#custom-pid-in-url
                    for (var j = 0; j < items.length; j++) {
                        if (items[j].pid == index) {
                            options.index = j;
                            break;
                        }
                    }
                } else {
                    options.index = parseInt(index, 10) - 1;
                }
            } else {
                options.index = parseInt(index, 10);
            }

            // exit if index not found
            if (isNaN(options.index)) {
                return;
            }



            var radios = document.getElementsByName('gallery-style');
            for (var i = 0, length = radios.length; i < length; i++) {
                if (radios[i].checked) {
                    if (radios[i].id == 'radio-all-controls') {

                    } else if (radios[i].id == 'radio-minimal-black') {
                        options.mainClass = 'pswp--minimal--dark';
                        options.barsSize = {top: 0, bottom: 0};
                        options.captionEl = false;
                        options.fullscreenEl = false;
                        options.shareEl = false;
                        options.bgOpacity = 0.85;
                        options.tapToClose = true;
                        options.tapToToggleControls = false;
                    }
                    break;
                }
            }

            if (disableAnimation) {
                options.showAnimationDuration = 0;
            }

            // Pass data to PhotoSwipe and initialize it
            gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);

            // see: http://photoswipe.com/documentation/responsive-images.html
            var realViewportWidth,
                    useLargeImages = false,
                    firstResize = true,
                    imageSrcWillChange;

            gallery.listen('beforeResize', function () {

                var dpiRatio = window.devicePixelRatio ? window.devicePixelRatio : 1;
                dpiRatio = Math.min(dpiRatio, 2.5);
                realViewportWidth = gallery.viewportSize.x * dpiRatio;


                if (realViewportWidth >= 1200 || (!gallery.likelyTouchDevice && realViewportWidth > 800) || screen.width > 1200) {
                    if (!useLargeImages) {
                        useLargeImages = true;
                        imageSrcWillChange = true;
                    }

                } else {
                    if (useLargeImages) {
                        useLargeImages = false;
                        imageSrcWillChange = true;
                    }
                }

                if (imageSrcWillChange && !firstResize) {
                    gallery.invalidateCurrItems();
                }

                if (firstResize) {
                    firstResize = false;
                }

                imageSrcWillChange = false;

            });

            gallery.listen('gettingData', function (index, item) {
                if (useLargeImages) {
                    item.src = item.o.src;
                    item.w = item.o.w;
                    item.h = item.o.h;
                } else {
                    item.src = item.m.src;
                    item.w = item.m.w;
                    item.h = item.m.h;
                }
            });

            gallery.init();
        };

        // select all gallery elements
        var galleryElements = document.querySelectorAll(gallerySelector);
        for (var i = 0, l = galleryElements.length; i < l; i++) {
            galleryElements[i].setAttribute('data-pswp-uid', i + 1);
            galleryElements[i].onclick = onThumbnailsClick;
        }

        // Parse URL and open gallery if it contains #&pid=3&gid=1
        var hashData = photoswipeParseHash();
        if (hashData.pid && hashData.gid) {
            openPhotoSwipe(hashData.pid, galleryElements[ hashData.gid - 1 ], true, true);
        }
    };

    initPhotoSwipeFromDOM('.classic-gallery');

})();