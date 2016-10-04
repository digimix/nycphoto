/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages

		  WebFontConfig = {
		    google: { families: [ 'Lato:400,700,300italic:latin', 'Homenaje::latin' ] }
		  };
		  (function() {
		    var wf = document.createElement('script');
		    wf.src = ('https:' === document.location.protocol ? 'https' : 'http') +
		      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
		    wf.type = 'text/javascript';
		    wf.async = 'true';
		    var s = document.getElementsByTagName('script')[0];
		    s.parentNode.insertBefore(wf, s);
		  })();

      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
		init: function() {
		// JavaScript to be fired on the home page


		},
		finalize: function() {
		// JavaScript to be fired on the home page, after the init JS

			$(document).ready(function(){

				/***************** Flickity ******************/
			    var flky = new Flickity( '.gallery.gallery-home', {
			        freeScroll: true,
			        //autoPlay: false,
				    contain: true,
				    //percentPosition: false,
				    //setGallerySize: true,
				    //imagesLoaded: true,
				    pageDots: false,
				    cellAlign: 'left',
			        //wrapAround: true,
				});
			});
		}
    },


    // Home page
    'page_template_template_about': {
		init: function() {
		// JavaScript to be fired on the home page

		},
		finalize: function() {
			// JavaScript to be fired on the home page, after the init JS


			$('.open-popup-link').magnificPopup({
			    type:'inline',
			    midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
			});

		}
    },



    // Home page
    'single_services': {
      init: function() {
        // JavaScript to be fired on the single services page

		$(document).ready(function() {

			$('.popup').magnificPopup({
				type: 'image',
				closeBtnInside: false,
			    closeOnContentClick: false,

			    callbacks: {
					open: function() {
						var self = this;
						self.wrap.on('click.pinhandler', 'img', function() {
							self.wrap.toggleClass('mfp-force-scrollbars');
						});
					},
					beforeClose: function() {
			            this.wrap.off('click.pinhandler');
						this.wrap.removeClass('mfp-force-scrollbars');
					}
			    },

			    image: {
					verticalFit: true
				}
			});


			$('.popup-gallery').magnificPopup({
				type: 'image',
				delegate: 'a',
				closeBtnInside: false,
			    closeOnContentClick: false,
				gallery:{enabled:true},
				callbacks: {
					open: function() {
						var self = this;
						self.wrap.on('click.pinhandler', 'img', function() {
							self.wrap.toggleClass('mfp-force-scrollbars');
						});
					},
					beforeClose: function() {
			            this.wrap.off('click.pinhandler');
						this.wrap.removeClass('mfp-force-scrollbars');
					},
				    buildControls: function() {
						// re-appends controls inside the main container
						this.contentContainer.append(this.arrowLeft.add(this.arrowRight));
				    }
				},

			    image: {
					verticalFit: true
				}
			});
		});


      },
      finalize: function() {
        // JavaScript to be fired on the single services page, after the init JS
      }
    },







    // Home page
    'single_post': {
      init: function() {
        // JavaScript to be fired on the single services page

		$(document).ready(function() {

			$('.popup').magnificPopup({
				type: 'image',
				closeBtnInside: false,
			    closeOnContentClick: false,

			    callbacks: {
					open: function() {
						var self = this;
						self.wrap.on('click.pinhandler', 'img', function() {
							self.wrap.toggleClass('mfp-force-scrollbars');
						});
					},
					beforeClose: function() {
			            this.wrap.off('click.pinhandler');
						this.wrap.removeClass('mfp-force-scrollbars');
					}
			    },

			    image: {
					verticalFit: true
				}
			});


			$('.popup-gallery').magnificPopup({
				type: 'image',
				delegate: 'a',
				closeBtnInside: false,
			    closeOnContentClick: false,
				gallery:{enabled:true},
				callbacks: {
					open: function() {
						var self = this;
						self.wrap.on('click.pinhandler', 'img', function() {
							self.wrap.toggleClass('mfp-force-scrollbars');
						});
					},
					beforeClose: function() {
			            this.wrap.off('click.pinhandler');
						this.wrap.removeClass('mfp-force-scrollbars');
					},
				    buildControls: function() {
						// re-appends controls inside the main container
						this.contentContainer.append(this.arrowLeft.add(this.arrowRight));
				    }
				},

			    image: {
					verticalFit: true
				}
			});
		});


      },
      finalize: function() {
        // JavaScript to be fired on the single services page, after the init JS
      }
    },





    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };



  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
