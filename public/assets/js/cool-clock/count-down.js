let CANVAS_WIDTH = 1200;
let CANVAS_HEIGHT = 540;
let RADIUS = 8;
let MARGIN_TOP = 20;
let MARGIN_LEFT = 120;
let MIN_SPEED_X = 3;
let MAX_SPEED_X = 5;
let MIN_SPEED_Y = 3;
let MAX_SPEED_Y = 5;
let MIN_G = 1;
let MAX_G = 2;
let F = 0.8;
let COLOR = [
  "#FE9D01",
  "#049FF1",
  "#43A102",
  "#EF1063",
  "#F60",
  "#A73800",
  "#EF1063",
  "#4C4C4C"
];

let endTime = new Date(2017, 6, 26, 12, 0, 0);
let nowTime = getCurrentTime();
let balls = [];

window.onload = function() {
  let canvas = document.getElementById("canvas");
  let context = canvas.getContext("2d");

  canvas.width = CANVAS_WIDTH;
  canvas.height = CANVAS_HEIGHT;

  let timer = setInterval(function() {
    render(context);
    update();
    for (let i = 0, len = balls.length; i < len; i++) {
      if (
        balls[i] &&
        balls[i].x &&
        (balls[i].x >= CANVAS_WIDTH || balls[i].x <= 0)
      ) {
        balls.splice(i, 1);
      }
    }
  }, 30);
};

function getRandom(start, end) {
  return start + Math.random() * (end - start);
}

function update() {
  let nextTime = getNextSecondTime();
  let nextHour = nextTime.getHours();
  let nextMinute = nextTime.getMinutes();
  let nextSecond = nextTime.getSeconds();

  let curHour = nowTime.getHours();
  let curMinute = nowTime.getMinutes();
  let curSecond = nowTime.getSeconds();

  if (nextSecond !== curSecond) {
    if (parseInt(nextHour / 10) !== parseInt(curHour / 10)) {
      addBalls(MARGIN_LEFT, MARGIN_TOP, parseInt(curHour / 10));
    }
    if (parseInt(nextHour % 10) !== parseInt(curHour % 10)) {
      addBalls(
        MARGIN_LEFT + 16 * (RADIUS + 1),
        MARGIN_TOP,
        parseInt(curHour % 10)
      );
    }
    if (parseInt(nextMinute / 10) !== parseInt(curMinute / 10)) {
      addBalls(
        MARGIN_LEFT + 40 * (RADIUS + 1),
        MARGIN_TOP,
        parseInt(curMinute / 10)
      );
    }
    if (parseInt(nextMinute % 10) !== parseInt(curMinute % 10)) {
      addBalls(
        MARGIN_LEFT + 56 * (RADIUS + 1),
        MARGIN_TOP,
        parseInt(curMinute % 10)
      );
    }
    if (parseInt(nextSecond / 10) !== parseInt(curSecond / 10)) {
      addBalls(
        MARGIN_LEFT + 80 * (RADIUS + 1),
        MARGIN_TOP,
        parseInt(curSecond / 10)
      );
    }
    if (parseInt(nextSecond % 10) !== parseInt(curSecond % 10)) {
      addBalls(
        MARGIN_LEFT + 96 * (RADIUS + 1),
        MARGIN_TOP,
        parseInt(curSecond % 10)
      );
    }
  }
}

function getNextSecondTime() {
  let nextDate = new Date();
  nextDate.setTime(nextDate.getTime() + 30);
  return nextDate;
}

function getCurrentTime() {
  let current = new Date();
  let time = parseInt((endTime.getTime() - current.getTime()) / 1000);

  return new Date();
  //return time>0?time:0;
}

function addBalls(x, y, num) {
  for (let i = 0; i < digit[num].length; i++) {
    for (let j = 0; j < digit[num][i].length; j++) {
      if (digit[num][i][j] === 1) {
        let aBall = {
          x: (2 * RADIUS + 1) * j + x,
          y: (2 * RADIUS + 1) * i + y,
          vx:
            getRandom(0, 1) > 0.5
              ? getRandom(-MAX_SPEED_X, -MIN_SPEED_X)
              : getRandom(MIN_SPEED_X, MAX_SPEED_X),
          vy: getRandom(-MAX_SPEED_Y, -MIN_SPEED_Y),
          g: getRandom(MIN_G, MAX_G),
          color: COLOR[Math.round(getRandom(0, COLOR.length - 1))]
        };
        balls.push(aBall);
      }
    }
  }
}

function render(context) {
  context.clearRect(0, 0, CANVAS_WIDTH, CANVAS_HEIGHT);

  nowTime = getCurrentTime();
  let years = nowTime.getFullYear();
  let months = nowTime.getMonth() + 1;
  let days = nowTime.getDate();
  let hours = nowTime.getHours();
  let minutes = nowTime.getMinutes();
  let seconds = nowTime.getSeconds();

  renderDigit(context, 0, 0, parseInt(hours / 10));
  renderDigit(context, 16 * (RADIUS + 1), 0, parseInt(hours % 10));
  renderDigit(context, 32 * (RADIUS + 1), 0, 10);
  renderDigit(context, 40 * (RADIUS + 1), 0, parseInt(minutes / 10));
  renderDigit(context, 56 * (RADIUS + 1), 0, parseInt(minutes % 10));
  renderDigit(context, 72 * (RADIUS + 1), 0, 10);
  renderDigit(context, 80 * (RADIUS + 1), 0, parseInt(seconds / 10));
  renderDigit(context, 96 * (RADIUS + 1), 0, parseInt(seconds % 10));

  for (let i = 0, len = balls.length; i < len; i++) {
    context.fillStyle = balls[i].color;
    context.beginPath();

    balls[i].x += balls[i].vx;
    balls[i].y += balls[i].vy;

    if (balls[i].y > CANVAS_HEIGHT - RADIUS) {
      balls[i].y = CANVAS_HEIGHT - RADIUS;
      balls[i].vy = -balls[i].vy * F;
    }

    context.arc(balls[i].x, balls[i].y, RADIUS, 0, Math.PI * 2);

    balls[i].vy += balls[i].g;

    context.closePath();
    context.fill();
  }
}

function renderDigit(context, x, y, num) {
  context.fillStyle = "#069";
  for (let i = 0; i < digit[num].length; i++) {
    for (let j = 0; j < digit[num][i].length; j++) {
      if (1 === digit[num][i][j]) {
        context.beginPath();
        context.arc(
          MARGIN_LEFT + x + j * (2 * RADIUS + 1),
          MARGIN_TOP + y + i * (2 * RADIUS + 1),
          RADIUS,
          0,
          2 * Math.PI
        );
        context.closePath();
        context.fill();
      }
    }
  }
  context.stroke();
}
