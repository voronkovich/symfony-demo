(function($) {
    $.fn.instantSearch = function() {
        return this.each(function() {
            initInstantSearch(this);
        });
    };

    var initInstantSearch = function(el) {
        var $input = $(el);
        var $form = $input.parents('form').first();
        var $preview = $('<ul class="search-preview list-group"></ul>').appendTo($form);

        var setPreviewItems = function(items) {
            $preview.empty();

            $.each(items, function(index, item) {
                if (index > 10) {
                    return;
                }

                addItemToPreview(item)
            });
        }

        var addItemToPreview = function(item) {
            $preview.append('<li class="list-group-item"><a href="' + item.url + '">' + item.result + '</a></li>');
        }

        var updatePreview = function() {
            var q = $input.val();

            $.getJSON($form.attr('action') + '?' + $form.serialize(), setPreviewItems);
        }

        $input.focusout(function(e) {
            $preview.hide();
            updatePreview();
        });

        $input.focusin(function(e) {
            $preview.show();
        });

        $input.keyup(function(e) {
            updatePreview();
        });
    }
})(window.jQuery)
