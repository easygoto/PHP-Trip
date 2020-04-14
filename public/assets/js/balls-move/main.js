let CANVAS_HEIGHT = 800;
let CANVAS_WIDTH = 1600;
let RADIUS = 10;
let FRICTION = 0.75;
let ACCELERATION = 1;
let MIN_SPEED_X = 4;
let MAX_SPEED_X = 8;
let MIN_SPEED_Y = 2;
let MAX_SPEED_Y = 8;
let COLOR = [
  "#FE9D01",
  "#049FF1",
  "#43A102",
  "#EF1063",
  "#F60",
  "#A73800",
  "#EF1063",
  "#4C4C4C",
];

let getRandom = function (start, end) {
  return Math.round(start + Math.random() * (end - start));
};

let update = function (objects, context) {
  context.clearRect(0, 0, CANVAS_WIDTH, CANVAS_HEIGHT);

  for (let i = 0, len = objects.length; i < len; i++) {
    context.fillStyle = objects[i].color;
    context.beginPath();

    objects[i].px += objects[i].vx;
    objects[i].py += objects[i].vy;

    if (objects[i].py > CANVAS_HEIGHT - RADIUS) {
      objects[i].py = CANVAS_HEIGHT - RADIUS;
      objects[i].vy = -objects[i].vy * FRICTION;
    }

    context.arc(objects[i].px, objects[i].py, RADIUS, 0, Math.PI * 2);

    objects[i].vy += ACCELERATION;

    context.closePath();
    context.fill();
  }
};

window.onload = function () {
  let canvas = document.getElementById("canvas");
  let context = canvas.getContext("2d");

  let currentX = null;
  let currentY = null;
  let balls = [];
  let pushTimer = null;

  canvas.width = CANVAS_WIDTH;
  canvas.height = CANVAS_HEIGHT;

  canvas.onmousemove = function (ev) {
    clearInterval(pushTimer);
    pushTimer = null;
    let oEvent = ev || event;
    currentX = oEvent.offsetX;
    currentY = oEvent.offsetY;
    balls.push({
      px: oEvent.offsetX,
      py: oEvent.offsetY,
      vx:
        getRandom(0, 1) === 0
          ? getRandom(-MAX_SPEED_X, -MIN_SPEED_X)
          : getRandom(MIN_SPEED_X, MAX_SPEED_X),
      vy:
        getRandom(0, 1) === 0
          ? getRandom(-MAX_SPEED_Y, -MIN_SPEED_Y)
          : getRandom(MAX_SPEED_Y, MIN_SPEED_Y),
      color: COLOR[getRandom(0, COLOR.length - 1)],
    });
  };

  canvas.onmouseout = function () {
    clearInterval(pushTimer);
    currentX = null;
    currentY = null;
  };

  let ctrlTimer = setInterval(function () {
    if (pushTimer == null && currentX && currentY) {
      pushTimer = setInterval(function () {
        balls.push({
          px: currentX,
          py: currentY,
          vx:
            getRandom(0, 1) === 0
              ? getRandom(-MAX_SPEED_X, -MIN_SPEED_X)
              : getRandom(MIN_SPEED_X, MAX_SPEED_X),
          vy:
            getRandom(0, 1) === 0
              ? getRandom(-MAX_SPEED_Y, -MIN_SPEED_Y)
              : getRandom(MAX_SPEED_Y, MIN_SPEED_Y),
          color: COLOR[getRandom(0, COLOR.length - 1)],
        });
      }, 20);
    }
  }, 30);

  let drawTimer = setInterval(function () {
    update(balls, context);
  }, 30);

  context.stroke();
};
