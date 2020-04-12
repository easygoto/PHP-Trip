let can1, can2;
let ctx1, ctx2;
let mx, my;
let canWidth;
let canHeight;
let lastTime;
let deltaTime;
let ane;
let fruit;
let mom;
let baby;
let wave;
let halo;
let data;
let dust;
let dustPic = [];
let babyEye = [];
let babyTail = [];
let babyBody = [];
let momEye = [];
let momTail = [];
let momBodyOra = [];
let momBodyBlue = [];
let bgPic = new Image();

function game() {
  init();
  lastTime = Date.now();
  deltaTime = 0;
  gameLoop();
}

function init() {
  can1 = document.getElementById("canvas1");
  ctx1 = can1.getContext("2d");
  can2 = document.getElementById("canvas2");
  ctx2 = can2.getContext("2d");
  can1.oncontextmenu = function(ev) {
    ev.stopPropagation();
    return false;
  };
  can1.addEventListener("mousemove", onMouseMove, false);
  bgPic.src = "images/lovely-fish/background.jpg";
  canWidth = can1.width;
  canHeight = can1.height;
  ane = new Ane();
  ane.init();
  fruit = new Fruit();
  fruit.init();
  mom = new Mom();
  mom.init();
  baby = new Baby();
  baby.init();
  halo = new Halo();
  halo.init();
  mx = canWidth * 0.5;
  my = canHeight * 0.5;

  for (let i = 0; i < 2; i++) {
    babyEye[i] = new Image();
    babyEye[i].src = "images/lovely-fish/baby/babyEye" + i + ".png";
  }
  for (let i = 0; i < 8; i++) {
    babyTail[i] = new Image();
    babyTail[i].src = "images/lovely-fish/baby/babyTail" + i + ".png";
  }
  for (let i = 0; i < 20; i++) {
    babyBody[i] = new Image();
    babyBody[i].src = "images/lovely-fish/baby/babyFade" + i + ".png";
  }
  for (let i = 0; i < 8; i++) {
    momTail[i] = new Image();
    momTail[i].src = "images/lovely-fish/mom/bigTail" + i + ".png";
  }
  for (let i = 0; i < 8; i++) {
    momBodyOra[i] = new Image();
    momBodyOra[i].src = "images/lovely-fish/mom/bigSwim" + i + ".png";
    momBodyBlue[i] = new Image();
    momBodyBlue[i].src = "images/lovely-fish/mom/bigSwimBlue" + i + ".png";
  }
  for (let i = 0; i < 2; i++) {
    momEye[i] = new Image();
    momEye[i].src = "images/lovely-fish/mom/bigEye" + i + ".png";
  }
  for (let i = 0; i < 7; i++) {
    dustPic[i] = new Image();
    dustPic[i].src = "images/lovely-fish/dust" + i + ".png";
  }
  data = new Data();
  ctx1.fillStyle = "white";
  ctx1.font = "20px Verdana";
  ctx1.textAlign = "center";
  wave = new Wave();
  wave.init();
  dust = new Dust();
  dust.init();
}

function gameLoop() {
  window.requestAnimFrame(gameLoop);
  let now = Date.now();
  deltaTime = Math.min(now - lastTime, 50);
  lastTime = now;
  background();
  ane.draw();
  fruit.draw();
  fruitMonitor();
  ctx1.clearRect(0, 0, canWidth, canHeight);
  baby.draw();
  mom.draw();
  data.draw();
  wave.draw();
  halo.draw();
  dust.draw();
  momFruitsCollision();
  momBabyCollision();
}

function onMouseMove(ev) {
  if (data.gameOver) {
    return;
  }
  if (ev.offsetX || ev.layerX) {
    mx = ev.offsetX || ev.layerX;
    my = ev.offsetY || ev.layerY;
  }
}

window.onload = game;
