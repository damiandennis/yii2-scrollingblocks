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
            this.tiles = $('#'+data.id);
            this.handler = $('.item', this.tiles);
            this.data = data;
            var $tiles = this.tiles,
                $handler = this.handler;
            $(data.input).wookmark(data.wallOptions);
            this.applyLayout();
            pub.data.page ++;
            this.window.bind('scroll.wookmark', this.onScroll);
        },
        applyLayout: function() {
            var $tiles = pub.tiles,
                $handler = pub.handler;

            $tiles.imagesLoaded(function() {
                // Destroy the old handler
                if ($handler.wookmarkInstance) {
                    $handler.wookmarkInstance.clear();
                }

                // Create a new layout handler.
                $handler = $('.item', $tiles);
                $handler.wookmark(pub.data.wallOptions);
            });
        },
        onScroll: function() {
            // Check if we're within 100 pixels of the bottom edge of the broser window.
            var winHeight = window.innerHeight ? window.innerHeight : pub.window.height(), // iphone fix
                closeToBottom = (pub.window.scrollTop() + winHeight > pub.document.height() - 100);

            if (closeToBottom && !pub.locked) {
                var $tiles = pub.tiles;
                var data = {};
                pub.data.page ++;
                data[pub.data.pageNumLabel] = pub.data.page;
                data[pub.data.pageSizelabel] = pub.data.size;
                pub.locked = true;
                $.ajax({
                    url: location.href,
                    data: data,
                    success: function(html) {
                        var $new_tiles = $('#'+pub.data.id, html);
                        var $items = $('.item', $new_tiles);
                        $tiles.append($items);
                        pub.applyLayout();
                        pub.locked = false;
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