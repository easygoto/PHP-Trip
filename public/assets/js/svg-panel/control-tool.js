(function($) {
    let defaults = {
        name: "宽度",
        proto: "width",
        value: 50,
        ctrlType: "range",
        txtType: "number"
    };

    let attrPositiveList = ["width", "height", "rx", "ry", "stroke-width"];

    let _bindNumberControlEvent = function(selector, rangeInput, valueInput, options) {
        let isMouseDown = false;
        let timer = null;
        let currentSpacing;
        let currentSpeed;
        let attrname = options.proto;
        rangeInput.on("mousedown", function() {
            isMouseDown = true;
        });
        rangeInput.on("input", function() {
            if (isMouseDown) {
                let rangeInputCurrent = rangeInput.val();
                let rangeInputMax = rangeInput.attr("max") || 100;
                let rangeInputScale = (rangeInputCurrent / rangeInputMax) * 100;
                let rangeInputScaleDiff = rangeInputScale - 50;
                let rangeInputScaleDiffAbs = Math.abs(rangeInputScaleDiff);
                let spacing = 100;
                let speed = rangeInputScaleDiff !== 0 ? (rangeInputScaleDiff > 0 ? 1 : -1) : 0;
                if (rangeInputScaleDiffAbs <= 10) {
                    spacing *= 2;
                    if (!timer || currentSpacing !== spacing || currentSpeed !== speed) {
                        clearInterval(timer);
                        timer = setInterval(function() {
                            let currentValue = parseInt(valueInput.val()) + speed;
                            if (currentValue >= 0 || attrPositiveList.indexOf(attrname) === -1) {
                                valueInput.val(currentValue);
                                selector.attr(attrname, currentValue);
                            }
                        }, spacing);
                        currentSpeed = speed;
                        currentSpacing = spacing;
                    }
                } else if (rangeInputScaleDiffAbs <= 20) {
                    spacing *= 1;
                    if (!timer || currentSpacing !== spacing || currentSpeed !== speed) {
                        clearInterval(timer);
                        timer = setInterval(function() {
                            let currentValue = parseInt(valueInput.val()) + speed;
                            if (currentValue >= 0 || attrPositiveList.indexOf(attrname) === -1) {
                                valueInput.val(currentValue);
                                selector.attr(attrname, currentValue);
                            }
                        }, spacing);
                        currentSpeed = speed;
                        currentSpacing = spacing;
                    }
                } else if (rangeInputScaleDiffAbs <= 30) {
                    spacing /= 3;
                    if (!timer || currentSpacing !== spacing || currentSpeed !== speed) {
                        clearInterval(timer);
                        timer = setInterval(function() {
                            let currentValue = parseInt(valueInput.val()) + speed;
                            if (currentValue >= 0 || attrPositiveList.indexOf(attrname) === -1) {
                                valueInput.val(currentValue);
                                selector.attr(attrname, currentValue);
                            }
                        }, spacing);
                        currentSpeed = speed;
                        currentSpacing = spacing;
                    }
                } else if (rangeInputScaleDiffAbs <= 40) {
                    spacing /= 8;
                    if (!timer || currentSpacing !== spacing || currentSpeed !== speed) {
                        clearInterval(timer);
                        timer = setInterval(function() {
                            let currentValue = parseInt(valueInput.val()) + speed;
                            if (currentValue >= 0 || attrPositiveList.indexOf(attrname) === -1) {
                                valueInput.val(currentValue);
                                selector.attr(attrname, currentValue);
                            }
                        }, spacing);
                        currentSpeed = speed;
                        currentSpacing = spacing;
                    }
                } else {
                    spacing /= 20;
                    if (!timer || currentSpacing !== spacing || currentSpeed !== speed) {
                        clearInterval(timer);
                        timer = setInterval(function() {
                            let currentValue = parseInt(valueInput.val()) + speed;
                            if (currentValue >= 0 || attrPositiveList.indexOf(attrname) === -1) {
                                valueInput.val(currentValue);
                                selector.attr(attrname, currentValue);
                            }
                        }, spacing);
                        currentSpeed = speed;
                        currentSpacing = spacing;
                    }
                }
            }
        });
        rangeInput.on("mouseup", function() {
            isMouseDown = false;
            clearInterval(timer);
            timer = null;
            rangeInput.val("50%");
        });
        valueInput.on("input", function() {
            let currentValue = parseInt(valueInput.val());
            if (currentValue >= 0 || attrPositiveList.indexOf(attrname) === -1) {
                valueInput.val(currentValue);
                selector.attr(attrname, currentValue);
            }
            if (attrPositiveList.indexOf(attrname) !== -1 && currentValue < 0) {
                valueInput.val(0);
            }
        });
    };

    let _bindColorControlEvent = function(selector, rangeInput, valueInput, options) {
        let attrname = options.proto;
        rangeInput.on("input", function() {
            let currentValue = rangeInput.val();
            valueInput.val(currentValue);
            selector.attr(attrname, currentValue);
        });
        valueInput.on("input", function() {
            let currentValue = valueInput.val();
            rangeInput.val(currentValue);
            selector.attr(attrname, currentValue);
        });
    };

    let bindControlEvent = function(selector, rangeInput, valueInput, options) {
        let ctrlType = options.ctrlType;
        switch (ctrlType) {
            default:
            case "range":
                _bindNumberControlEvent(selector, rangeInput, valueInput, options);
                break;
            case "color":
                _bindColorControlEvent(selector, rangeInput, valueInput, options);
                break;
        }
    };

    let createComponent = function(obj, selector, options) {
        let baseContainer = $("<div>").addClass("form-group setting-control");
        let labelPrimary = $("<label>")
            .addClass("col-sm-3 control-label")
            .html(options.name);
        let divPrimary = $("<div>").addClass("col-sm-9");
        let divRange = $("<div>").addClass("range-control pull-left");
        let divRangeValue = $("<div>").addClass("range-value pull-left");
        let inputRange = $("<input>")
            .attr({
                type: options.ctrlType,
                title: options.name,
                value: options.ctrlType === "color" ? options.value : "50%"
            })
            .addClass("form-control");
        let inputRangeValue = $("<input>")
            .attr({
                type: options.txtType,
                title: options.name,
                value: options.value,
                name: options.proto
            })
            .addClass("form-control");

        bindControlEvent(selector, inputRange, inputRangeValue, options);

        inputRange.appendTo(divRange);
        inputRangeValue.appendTo(divRangeValue);
        divPrimary.append(divRange);
        divPrimary.append(divRangeValue);
        baseContainer.append(labelPrimary);
        baseContainer.append(divPrimary);
        $(obj).append(baseContainer);
    };

    let init = function(obj, selector, options) {
        selector.attr(options.proto, options.value);
        createComponent(obj, selector, options);
    };

    $.fn.addStyleControl = function(selector, options) {
        options = $.extend(defaults, options);
        return this.each(function() {
            $(selector).data("_control", $(this));
            init(this, selector, options);
        });
    };
})(jQuery);
