// jQuery plugin for instant searching
(function($) {
    $.fn.instantSearch = function(config) {
        return this.each(function() {
            initInstantSearch(this, $.extend(true, defaultConfig, config || {}));
        });
    };

    var defaultConfig = {
        minQueryLength: 2,
        maxPreviewItems: 10,
        previewDelay: 500,
        noItemsFoundMessage: 'No items found'
    };

    var delay = (function(){
        var timer = 0;
        return function(callback, ms){
            clearTimeout (timer);
            timer = setTimeout(callback, ms);
        };
    })();

    var initInstantSearch = function(el, config) {
        var $input = $(el);
        var $form = $input.parents('form').first();
        var $preview = $('<ul class="search-preview list-group"></ul>').appendTo($form);

        var setPreviewItems = function(items) {
            $preview.empty();

            $.each(items, function(index, item) {
                if (index > config.maxPreviewItems) {
                    return;
                }

                addItemToPreview(item)
            });
        }

        var addItemToPreview = function(item) {
            $preview.append('<li class="list-group-item"><a href="' + item.url + '">' + item.result + '</a></li>');
        }

        var noItemsFound = function() {
            $preview.empty();
            $preview.append('<li class="list-group-item">' + config.noItemsFoundMessage + '</li>');
        }

        var updatePreview = function() {
            if ($input.val().length < config.minQueryLength) {
                $preview.empty();
                return;
            }

            $.getJSON($form.attr('action') + '?' + $form.serialize(), function(items) {
                if (items.length === 0) {
                    noItemsFound();
                    return;
                }

                setPreviewItems(items);
            });
        }

        $input.focusout(function(e) {
            $preview.fadeOut();
        });

        $input.focusin(function(e) {
            $preview.fadeIn();
            updatePreview();
        });

        $input.keyup(function(e) {
            delay(updatePreview, config.previewDelay);
        });
    }
})(window.jQuery)
