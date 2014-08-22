/**
 * Created by Damian on 24/05/14.
 */

yii.scrollingblocks = (function ($) {
    var pub = {
        tiles: null,
        handler: null,
        window: $(window),
        document: $(document),
        data: null,
        offset: 0,
        limit: 0,
        locked: false,
        init: function() {},
        setup: function(data) {
            pub.tiles = $('#'+data.id);
            pub.handler = $('.item', pub.tiles);
            pub.data = data;
            var $tiles = pub.tiles;
            pub.tiles.imagesLoaded(function() {
                pub.handler.wookmark(data.wallOptions);
                pub.data.page ++;
                pub.window.bind('scroll.wookmark', pub.onScroll);
                pub.window.resize(function() {
                    var windowWidth = $(this).width(),
                        newOptions = { flexibleWidth: data.wallOptions.flexibleWidth };
                    $.each(pub.data.responsiveWidths, function(key, value) {
                        if (Modernizr.mq(key)) {
                            data.wallOptions.flexibleWidth = value;
                            newOptions.flexibleWidth = value;
                            pub.handler.wookmark(newOptions);
                        }
                    });
                });
                pub.window.trigger('resize');
            });

        },
        applyLayout: function() {
            var $tiles = pub.tiles;

            $tiles.imagesLoaded(function() {
                // Create a new layout handler.
                pub.handler = $('.item', $tiles);
                pub.handler.wookmark(pub.data.wallOptions);
            });
        },
        onScroll: function() {
            // Check if we're within 100 pixels of the bottom edge of the browser window.
            var winHeight = window.innerHeight ? window.innerHeight : pub.window.height(), // iphone fix
                closeToBottom = (pub.window.scrollTop() + winHeight > pub.document.height() - 100);

            if (closeToBottom && !pub.locked) {
                var $tiles = pub.tiles;
                var data = {ajax: true};
                pub.data.page ++;
                data[pub.data.pageNumLabel] = pub.data.page;
                data[pub.data.pageSizelabel] = pub.data.size;
                pub.locked = true;
                var opts = {
                    lines: 9, // The number of lines to draw
                    length: 0, // The length of each line
                    width: 7, // The line thickness
                    radius: 10, // The radius of the inner circle
                    corners: 1, // Corner roundness (0..1)
                    rotate: 0, // The rotation offset
                    direction: 1, // 1: clockwise, -1: counterclockwise
                    color: '#000', // #rgb or #rrggbb or array of colors
                    speed: 1, // Rounds per second
                    trail: 60, // Afterglow percentage
                    shadow: false, // Whether to render a shadow
                    hwaccel: false, // Whether to use hardware acceleration
                    className: 'spinner', // The CSS class to assign to the spinner
                    zIndex: 2e9, // The z-index (defaults to 2000000000)
                    top: '50%', // Top position relative to parent
                    left: '50%' // Left position relative to parent
                };
                var spinner = $('<div class="spinner-wrapper"></div>');
                $tiles.after(spinner);
                spinner.spin(opts);
                $.ajax({
                    url: location.href,
                    data: data,
                    success: function(html) {
                        var $new_tiles = $('#'+pub.data.id, html);
                        var $items = $('.item', $new_tiles);
                        $tiles.append($items);
                        pub.applyLayout();
                        pub.locked = false;
                        spinner.remove();
                        pub.window = $(window);
                    }
                });
            }
        }
    }
    return pub;
})(jQuery);
jQuery(document).ready(function () {
    yii.initModule(yii.scrollingblocks);
});