/*
 * jquery.scrollIntoView
 *
 * Version: 0.1.20150317
 *
 * Copyright (c) 2015 Darkseal/Ryadel
 * based on the work of Andrey Sidorov
 * licensed under MIT license.
 *
 * Project Home Page:
 * http://darkseal.github.io/jquery.scrolling/
 * 
 * GitHub repository:
 * https://github.com/darkseal/jquery.scrolling/
 *
 * Project Home Page on Ryadel.com:
 * http://www.ryadel.com/
 *
 */
(function ($) {
  var selectors = [];

  var checkBound = false;
  var checkLock = false;

  var extraOffsetTop = 0;
  var extraOffsetLeft = 0;

  var optionsAttribute = 'scrolling-options';

  var defaults = {
    interval: 250,
    checkScrolling: false,		// set it to "true" to perform an element "scroll-in" check immediately after startup
    offsetTop: 0,
    offsetLeft: 0,
    offsetTopAttribute: 'offset-top',
    offsetLeftAttribute: 'offset-left',
    window: null    // set a custom window object or leave it null to use current window.
                    // pass "top" to use the topmost frame.
  }
  var $window;
  var $wasInView;

  function process() {
    checkLock = false;
    for (var index in selectors) {
      var $inView = $(selectors.join(", ")).filter(function() {
        return $(this).is(':scrollin');
      });
    }
    $inView.trigger('scrollin', [$inView]);
    if ($wasInView) {
      var $notInView = $wasInView.not($inView);
      $notInView.trigger('scrollout', [$notInView]);
    }
    $wasInView = $inView;
  }

  // "scrollin" custom filter
  $.expr[':']['scrollin'] = function(element) {
    var $element = $(element);
	/* make it work with hidden pagination
    if (!$element.is(':visible')) {
      return false;
    }
	*/
	if (!$element) {
    	return false;
    }
    var opts = $element.data(optionsAttribute);
	if (typeof opts === 'undefined') {
    	return false;
    }
    var windowTop = $window.scrollTop();
    var windowLeft = $window.scrollLeft();
    var offset = $element.offset();
    var top = offset.top + extraOffsetTop;
    var left = offset.left + extraOffsetLeft;

    if (top + $element.height() >= windowTop &&
        top - ($element.data(opts.offsetTopAttribute) || opts.offsetTop) <= windowTop + $window.height() &&
        left + $element.width() >= windowLeft &&
        left - ($element.data(opts.offsetLeftAttribute) || opts.offsetLeft) <= windowLeft + $window.width()) {
      return true;
    } else {
      return false;
    }
  }
  
  $.fn.extend({
    // watching for element's presence in browser viewport
    scrolling: function(options) {
      var opts = $.extend({}, defaults, options || {});
      var selector = this.selector || this;
      if (!checkBound) {
        checkBound = true;
        var onCheck = function() {
          if (checkLock) {
            return;
          }
          checkLock = true;
          setTimeout(process, opts.interval);
        };
        $window = $(opts.window || window);
		
        if ($window.get(0) != top) {
            var $b = $($window.get(0).document.body);
            if ($b) {
                extraOffsetTop = $b.scrollTop();
                extraOffsetLeft = $b.scrollLeft();
            }
        }
		
        $window.scroll(onCheck).resize(onCheck);
      }

	  var $el = $(selector);
	  $el.data(optionsAttribute, opts);
	  
      if (opts.checkScrolling) {
        setTimeout(process, opts.interval);
      }
      selectors.push(selector);
      return $el;
    }
  });

  $.extend({
    // force "scroll-in" check for the given element
    checkScrolling: function() {
        if (checkBound) {
        process();
        return true;
      };
      return false;
    }
  });
})(jQuery);
