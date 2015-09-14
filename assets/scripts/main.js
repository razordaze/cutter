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
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages
        var waitForFinalEvent = (function () {
            var timers = {};
            return function (callback, ms, uniqueId) {
              if (!uniqueId) {
                uniqueId = "Don't call this twice without a uniqueId";
              }
              if (timers[uniqueId]) {
                clearTimeout (timers[uniqueId]);
              }
              timers[uniqueId] = setTimeout(callback, ms);
            };
          })();
        // slide toggle the thing after an .expansive element gets clicked
        $(document).ready(function(){
          $(".expansive").click(function(){
              $(this).next().slideToggle();
              $(this).toggleClass("open");
          });
        // nav mouseover -> header bottom border color switch + swap back otherwise
          $(".drawer").data("originalColor",$(this).css("background-color"));

          $("#top-nav-primary a").hover(function(){ // over
            $(".drawer").css("borderBottomColor",$(this).css("background-color"));
            $(".drawer").css("background-color",$(this).css("background-color"));
          }, function(){ // out
            $(".drawer").css("borderBottomColor",$(this).data("originalColor"));
            $(".drawer").css("background-color",$(this).data("originalColor"));
          });
        });
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
