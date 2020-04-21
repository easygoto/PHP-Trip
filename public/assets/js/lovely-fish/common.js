window.requestAnimFrame = (function () {
    return (
        window.requestAnimationFrame ||
        window.webkitRequestAnimationFrame ||
        window.mozRequestAnimationFrame ||
        window.oRequestAnimationFrame ||
        window.msRequestAnimationFrame ||
        function (/* function FrameRequestCallback */ callback, /* DOMElement Element */ element) {
            return window.setTimeout(callback, 1000 / 60);
        }
    );
})();

function calLength2(x1, y1, x2, y2) {
    return Math.pow(x1 - x2, 2) + Math.pow(y1 - y2, 2);
}

function randomColor() {
    let col = [0, 1, 2];
    col[0] = Math.random() * 100 + 155;
    col[0] = col[0].toFixed();
    col[1] = Math.random() * 100 + 155;
    col[1] = col[1].toFixed();
    col[2] = Math.random() * 100 + 155;
    col[2] = col[2].toFixed();
    let num = Math.floor(Math.random() * 3);
    col[num] = 0;
    return "rgba(" + col[0] + "," + col[1] + "," + col[2] + ",";
}

function lerpAngle(a, b, t) {
    let d = b - a;
    if (d > Math.PI) d = d - 2 * Math.PI;
    if (d < -Math.PI) d = d + 2 * Math.PI;
    return a + d * t;
}

function lerpDistance(aim, cur, ratio) {
    let delta = cur - aim;
    return aim + delta * ratio;
}

function inOboundary(arrX, arrY, l, r, t, b) {
    //在l r t b范围内的检测
    return arrX > l && arrX < r && arrY > t && arrY < b;
}

function rgbColor(r, g, b) {
    r = Math.round(r * 256);
    g = Math.round(g * 256);
    b = Math.round(b * 256);
    return "rgba(" + r + "," + g + "," + b + ",1)";
}

function rgbNum(r, g, b) {
    r = Math.round(r * 256);
    g = Math.round(g * 256);
    b = Math.round(b * 256);
    return "rgba(" + r + "," + g + "," + b;
}

function rnd(m) {
    let n = m || 1;
    return Math.random() * n;
}

function rateRandom(m, n) {
    let sum = 0;
    for (let i = 1; i < n - m; i++) {
        sum += i;
    }

    let ran = Math.random() * sum;

    for (let i = 1; i < n - m; i++) {
        ran -= i;
        if (ran < 0) {
            return i - 1 + m;
        }
    }
}

function distance(x1, y1, x2, y2, l) {
    let x = Math.abs(x1 - x2);
    let y = Math.abs(y1 - y2);
    return x < l && y < l;
}

/**
 * @return {boolean}
 */
function AABBbox(object1, w1, h1, object2, w2, h2, overlap) {
    let A1 = object1.x + overlap;
    let B1 = object1.x + w1 - overlap;
    let C1 = object1.y + overlap;
    let D1 = object1.y + h1 - overlap;

    let A2 = object2.x + overlap;
    let B2 = object2.x + w2 - overlap;
    let C2 = object2.y + overlap;
    let D2 = object2.y + h2 - overlap;

    return !(A1 > B2 || B1 < A2 || C1 > D2 || D1 < C2);
}

function dis2(x, y, x0, y0) {
    let dx = x - x0;
    let dy = y - y0;
    return dx * dx + dy * dy;
}

function rndi2(m, n) {
    let a = Math.random() * (n - m) + m;
    return Math.floor(a);
}
