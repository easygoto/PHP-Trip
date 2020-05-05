(function ($) {
    let defaults = {};

    let init = function (obj, options) {
        obj = $(obj);
        let svg = $("svg");
        let ctrlTool = obj.data("_control");
        let isDown = false;
        let objStartX = 0;
        let objStartY = 0;
        let pointStartX = 0;
        let pointStartY = 0;

        obj.on("mousedown", function (ev) {
            isDown = true;
            objStartX = parseInt(obj.attr("x"));
            objStartY = parseInt(obj.attr("y"));
            pointStartX = ev.screenX;
            pointStartY = ev.screenY;
        });

        svg.on("mousemove", function (ev) {
            if (isDown) {
                let currentX = objStartX + ev.screenX - pointStartX;
                let currentY = objStartY + ev.screenY - pointStartY;
                obj.attr("x", currentX);
                obj.attr("y", currentY);
                if (ctrlTool) {
                    ctrlTool.find("input[name=x]").val(currentX);
                    ctrlTool.find("input[name=y]").val(currentY);
                }
            }
        });

        svg.on("mouseup", function () {
            isDown = false;
        }).on("mouseleave", function () {
            isDown = false;
        });
    };

    $.fn.initMove = function (options) {
        options = $.extend(defaults, options);
        return this.each(function () {
            init(this, options);
        });
    };
})(jQuery);
