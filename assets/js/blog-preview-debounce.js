+function ($) { "use strict";

    // Source: https://davidwalsh.name/javascript-debounce-function
    var debounce = function (func, wait, immediate) {
        var timeout;
        return function() {
            var context = this, args = arguments;
            var later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    };

    $(document).render(function () {

        var old = $.fn.markdownEditor.Constructor.prototype.updatePreview;

        // Override the original updatePreview method
        $.fn.markdownEditor.Constructor.prototype.updatePreview = debounce(old, 250);

    });

}(window.jQuery);
