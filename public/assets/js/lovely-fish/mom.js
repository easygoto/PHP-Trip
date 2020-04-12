let Mom = function() {
  this.x = 0;
  this.y = 0;
  this.angle = 0;
  this.tailTimer = 0;
  this.tailCount = 0;
  this.eyeTimer = 0;
  this.eyeCount = 0;
  this.eyeInterval = 1000;
  this.bodyCount = 0;
};
Mom.prototype.init = function() {
  this.x = 0.5 * canWidth;
  this.y = 0.5 * canHeight;
  this.angle = 0;
};
Mom.prototype.draw = function() {
  this.x = lerpDistance(mx, this.x, 0.98);
  this.y = lerpDistance(my, this.y, 0.98);

  let deltaX = mx - this.x;
  let deltaY = my - this.y;
  let beta = Math.PI + Math.atan2(deltaY, deltaX);
  this.angle = lerpAngle(beta, this.angle, 0.9);
  this.tailTimer += deltaTime;
  if (this.tailTimer > 50) {
    this.tailCount = (this.tailCount + 1) % 8;
    this.tailTimer %= 50;
  }
  this.eyeTimer += deltaTime;
  if (this.eyeTimer > this.eyeInterval) {
    this.eyeCount = (this.eyeCount + 1) % 2;
    this.eyeTimer %= this.eyeInterval;
    if (this.eyeCount === 0) {
      this.eyeInterval = Math.random() * 1500 + 2000;
    } else {
      this.eyeInterval = 200;
    }
  }
  ctx1.save();
  ctx1.translate(this.x, this.y);
  ctx1.rotate(this.angle);
  let tailCount = this.tailCount;
  ctx1.drawImage(
    momTail[tailCount],
    30 - 0.5 * momTail[tailCount].width,
    -0.5 * momTail[tailCount].height
  );
  let bodyCount = this.bodyCount;
  if (data.double === 1) {
    ctx1.drawImage(
      momBodyOra[bodyCount],
      -0.5 * momBodyOra[bodyCount].width,
      -0.5 * momBodyOra[bodyCount].height
    );
  } else {
    ctx1.drawImage(
      momBodyBlue[bodyCount],
      -0.5 * momBodyBlue[bodyCount].width,
      -0.5 * momBodyBlue[bodyCount].height
    );
  }
  let eyeCount = this.eyeCount;
  ctx1.drawImage(
    momEye[eyeCount],
    -0.5 * momEye[eyeCount].width,
    -0.5 * momEye[eyeCount].height
  );
  ctx1.restore();
};
