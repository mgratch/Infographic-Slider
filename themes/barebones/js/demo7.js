(function() {
	var container = document.getElementById( 'theirStory' ),
		triggerBttn = document.querySelector( '#herStory .more-link' ),
		overlay = document.querySelector( '#herFullStoryRow.overlay' ),
		closeBttn = document.getElementById( 'herStoryGoBack' );

		transEndEventNames = {
			'WebkitTransition': 'webkitTransitionEnd',
			'MozTransition': 'transitionend',
			'OTransition': 'oTransitionEnd',
			'msTransition': 'MSTransitionEnd',
			'transition': 'transitionend'
		},
		transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
		support = { transitions : Modernizr.csstransitions };

	function toggleOverlay() {
		if( classie.has( overlay, 'open' ) ) {
			classie.remove( overlay, 'open' );
			classie.remove( container, 'overlay-open' );
			classie.add( overlay, 'close' );
			var onEndTransitionFn = function( ev ) {
				if( support.transitions ) {
					if( ev.propertyName !== 'visibility' ) return;
					this.removeEventListener( transEndEventName, onEndTransitionFn );
				}
				classie.remove( overlay, 'close' );
			};
			if( support.transitions ) {
				overlay.addEventListener( transEndEventName, onEndTransitionFn );
			}
			else {
				onEndTransitionFn();
			}
		}
		else if( !classie.has( overlay, 'close' ) ) {
			classie.add( overlay, 'open' );
			classie.add( container, 'overlay-open' );
		}
	}

	triggerBttn.addEventListener( 'click', function(e){
        e.preventDefault();
        document.body.style.overflow = "hidden";
        toggleOverlay();
    } );
	closeBttn.addEventListener( 'click', function(e){
        e.preventDefault();
        document.body.style.overflow = "auto";
        toggleOverlay();
        document.getElementById("herFullStory-data").remove();
    } );
})();

(function() {
    var container = document.getElementById( 'theirStory' ),
        triggerBttn = document.querySelector( '#hisStory .more-link' ),
        overlay = document.querySelector( '#hisFullStoryRow.overlay' ),
        closeBttn = overlay.querySelector( '#hisFullStory .go-back' );

    transEndEventNames = {
        'WebkitTransition': 'webkitTransitionEnd',
        'MozTransition': 'transitionend',
        'OTransition': 'oTransitionEnd',
        'msTransition': 'MSTransitionEnd',
        'transition': 'transitionend'
    },
        transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
        support = { transitions : Modernizr.csstransitions };

    function toggleOverlay() {
        if( classie.has( overlay, 'open' ) ) {
            classie.remove( overlay, 'open' );
            classie.remove( container, 'his-overlay-open' );
            classie.add( overlay, 'close' );
            var onEndTransitionFn = function( ev ) {
                if( support.transitions ) {
                    if( ev.propertyName !== 'visibility' ) return;
                    this.removeEventListener( transEndEventName, onEndTransitionFn );
                }
                classie.remove( overlay, 'close' );
            };
            if( support.transitions ) {
                overlay.addEventListener( transEndEventName, onEndTransitionFn );
            }
            else {
                onEndTransitionFn();
            }
        }
        else if( !classie.has( overlay, 'close' ) ) {
            classie.add( overlay, 'open' );
            classie.add( container, 'his-overlay-open' );
        }
    }

    triggerBttn.addEventListener( 'click', function(e){
        e.preventDefault();
        document.body.style.overflow = "hidden";
        toggleOverlay();
    } );
    closeBttn.addEventListener( 'click', function(e){
        e.preventDefault();
        document.body.style.overflow = "auto";
        toggleOverlay();
        document.getElementById("hisFullStory-data").remove();
    } );
})();
(function() {
    var container = document.getElementById( 'venueSlider' ),
        triggerBttn = document.querySelector( '#venueSlider .more-link' ),
        overlay = document.querySelector( '.venue-overlay-contentpush' ),
        closeBttn = overlay.querySelector( '#ourVenueStory .go-back' );

    transEndEventNames = {
        'WebkitTransition': 'webkitTransitionEnd',
        'MozTransition': 'transitionend',
        'OTransition': 'oTransitionEnd',
        'msTransition': 'MSTransitionEnd',
        'transition': 'transitionend'
    },
        transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
        support = { transitions : Modernizr.csstransitions };

    function toggleOverlay() {
        if( classie.has( overlay, 'open' ) ) {
            classie.remove( overlay, 'open' );
            classie.remove( container, 'his-overlay-open' );
            classie.add( overlay, 'close' );
            var onEndTransitionFn = function( ev ) {
                if( support.transitions ) {
                    if( ev.propertyName !== 'visibility' ) return;
                    this.removeEventListener( transEndEventName, onEndTransitionFn );
                }
                classie.remove( overlay, 'close' );
            };
            if( support.transitions ) {
                overlay.addEventListener( transEndEventName, onEndTransitionFn );
            }
            else {
                onEndTransitionFn();
            }
        }
        else if( !classie.has( overlay, 'close' ) ) {
            classie.add( overlay, 'open' );
            classie.add( container, 'his-overlay-open' );
        }
    }

    triggerBttn.addEventListener( 'click', function(e){
        e.preventDefault();
        document.body.style.overflow = "hidden";
        toggleOverlay();
    } );
    closeBttn.addEventListener( 'click', function(e){
        e.preventDefault();
        document.body.style.overflow = "auto";
        toggleOverlay();
        //document.getElementById("hisFullStory-data").remove();
    } );
})();

/**
 * main.js
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 *
 * Copyright 2014, Codrops
 * http://www.codrops.com
 */
(function() {

    var bodyEl = document.body,
        content = document.querySelector( '.content-wrap' ),
        openbtn = document.getElementById( 'open-button' ),
        closebtn = document.getElementById( 'close-button' ),
        menuEl = document.querySelector( '.icon-list a' ),
        isOpen = false;

    function init() {
        initEvents();
    }

    function initEvents() {
        openbtn.addEventListener( 'click', toggleMenu );
        if( closebtn ) {
            closebtn.addEventListener( 'click', toggleMenu );
        }

        // close the menu element if the target it´s not the menu element or one of its descendants..
        content.addEventListener( 'click', function(ev) {
            var target = ev.target;
            if( isOpen && target !== openbtn ) {
                toggleMenu();
            }
        } );
        menuEl.addEventListener( 'click', function(ev) {
            var target = ev.target;
            if( isOpen && target !== openbtn ) {
                toggleMenu();
            }
        } );

    }

    function toggleMenu() {
        if( isOpen ) {
            classie.remove( bodyEl, 'show-menu' );
            classie.remove(content, 'block-content')
        }
        else {
            classie.add( bodyEl, 'show-menu' );
            classie.add(content, 'block-content')
        }
        isOpen = !isOpen;
    }

    init();

})();