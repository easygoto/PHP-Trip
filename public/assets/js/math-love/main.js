window.onload = function () {
    const MARGIN_WIDTH = 50;
    const CONTAINER_WIDTH = 1200;
    const CONTAINER_HEIGHT = 300;
    const CANVAS_WIDTH = CONTAINER_WIDTH + 2 * MARGIN_WIDTH;
    const CANVAS_HEIGHT = CONTAINER_HEIGHT + 2 * MARGIN_WIDTH;
    const BORDER_WIDTH = 10;
    const BORDER_RADIUS = BORDER_WIDTH / 2;
    const BORDER_COLOR = "#E034DD";

    let mathL = (x) => 1 / x;
    let mathO = (x) => Math.sqrt(1 - x * x);
    let mathV = (x) => Math.abs(x);
    let mathE = (x) => (2 * Math.acos(x)) / Math.PI;

    let drawL = function (context, i) {
        context.beginPath();
        context.arc(MARGIN_WIDTH + 300 * mathL(i), MARGIN_WIDTH + 300 - i, BORDER_RADIUS, 0, 2 * Math.PI);
        context.arc(MARGIN_WIDTH + i, MARGIN_WIDTH + 300 * (1 - mathL(i)), BORDER_RADIUS, 0, 2 * Math.PI);
        context.closePath();
        context.fill();
    };

    let drawO = function (context, i) {
        context.beginPath();
        context.arc(MARGIN_WIDTH + i, MARGIN_WIDTH + 150 * (1 - mathO((i - 450) / 150)), BORDER_RADIUS, 0, 2 * Math.PI);
        context.closePath();
        context.fill();

        context.beginPath();
        context.arc(
            MARGIN_WIDTH + i,
            MARGIN_WIDTH + 300 - 150 * (1 - mathO((i - 450) / 150)),
            BORDER_RADIUS,
            0,
            2 * Math.PI
        );
        context.closePath();
        context.fill();

        context.beginPath();
        context.arc(
            MARGIN_WIDTH + 300 + 150 * (1 - mathO((i - 450) / 150)),
            MARGIN_WIDTH + 600 - i,
            BORDER_RADIUS,
            0,
            2 * Math.PI
        );
        context.closePath();
        context.fill();

        context.beginPath();
        context.arc(
            MARGIN_WIDTH + 600 - 150 * (1 - mathO((i - 450) / 150)),
            MARGIN_WIDTH + 600 - i,
            BORDER_RADIUS,
            0,
            2 * Math.PI
        );
        context.closePath();
        context.fill();
    };

    let drawV = function (context, i) {
        context.beginPath();
        context.arc(MARGIN_WIDTH + i, MARGIN_WIDTH + 300 - 2 * mathV(i - 750), BORDER_RADIUS, 0, 2 * Math.PI);
        context.closePath();
        context.fill();
    };

    let drawE = function (context, i) {
        context.beginPath();
        context.arc(MARGIN_WIDTH + i, MARGIN_WIDTH + 75 - 75 * mathE((1200 - i) / 300), BORDER_RADIUS, 0, 2 * Math.PI);
        context.arc(MARGIN_WIDTH + i, MARGIN_WIDTH + 75 + 75 * mathE((1200 - i) / 300), BORDER_RADIUS, 0, 2 * Math.PI);
        context.arc(MARGIN_WIDTH + i, MARGIN_WIDTH + 225 - 75 * mathE((1200 - i) / 300), BORDER_RADIUS, 0, 2 * Math.PI);
        context.arc(MARGIN_WIDTH + i, MARGIN_WIDTH + 225 + 75 * mathE((1200 - i) / 300), BORDER_RADIUS, 0, 2 * Math.PI);
        context.closePath();
        context.fill();
    };

    (function () {
        let canvas = document.querySelector("canvas#canvas");
        let context = canvas.getContext("2d");
        canvas.width = CANVAS_WIDTH;
        canvas.height = CANVAS_HEIGHT;
        context.fillStyle = BORDER_COLOR;
        context.clearRect(0, 0, CANVAS_WIDTH, CANVAS_HEIGHT);

        let i = 0;
        let timer = setInterval(function () {
            if (i >= 0 && i <= 300) {
                drawL(context, i);
            } else if (i >= 300 && i <= 600) {
                drawO(context, i);
            } else if (i >= 600 && i <= 900) {
                drawV(context, i);
            } else if (i >= 900 && i <= 1200) {
                drawE(context, i);
            } else {
                clearInterval(timer);
            }
            i++;
        }, 1);
    })();
};
