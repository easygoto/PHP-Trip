let Baby = function() {
    this.x = 0;
    this.y = 0;
    this.angle = 0;
    this.tailTimer = 0;
    this.tailCount = 0;
    this.eyeTimer = 0;
    this.eyeCount = 0;
    this.eyeInterval = 200;
    this.bodyTimer = 0;
    this.bodyCount = 0;
};
Baby.prototype.init = function() {
    this.x = -50 + 0.5 * canWidth;
    this.y = 50 + 0.5 * canHeight;
    this.angle = 0;
};
Baby.prototype.draw = function() {
    this.x = lerpDistance(mom.x, this.x, 0.99);
    this.y = lerpDistance(mom.y, this.y, 0.99);
    let deltaX = mom.x - this.x;
    let deltaY = mom.y - this.y;
    let beta = Math.PI + Math.atan2(deltaY, deltaX);
    this.angle = lerpAngle(beta, this.angle, 0.6);
    this.tailTimer += deltaTime;
    if (this.tailTimer > 50) {
        this.tailCount = (this.tailCount + 1) % 8;
        this.tailTimer %= 50;
    }
    this.bodyTimer += deltaTime;
    if (this.bodyTimer > 300) {
        this.bodyCount = this.bodyCount + 1;
        this.bodyTimer %= 300;
        if (this.bodyCount > 19) {
            this.bodyCount = 19;
            data.gameOver = true;
        }
    }
    this.eyeTimer += deltaTime;
    if (this.eyeTimer > this.eyeInterval) {
        this.eyeCount = (this.eyeCount + 1) % 2;
        this.eyeTimer %= this.eyeInterval;
        if (this.eyeCount == 0) {
            this.eyeInterval = Math.random() * 1500 + 2000;
        } else {
            this.eyeInterval = 200;
        }
    }
    ctx1.save();
    ctx1.translate(this.x, this.y);
    ctx1.rotate(this.angle);
    let tailCount = this.tailCount;
    ctx1.drawImage(babyTail[tailCount], 23 - 0.5 * babyTail[tailCount].width, -0.5 * babyTail[tailCount].height);
    let bodyCount = this.bodyCount;
    ctx1.drawImage(babyBody[bodyCount], -0.5 * babyBody[bodyCount].width, -0.5 * babyBody[bodyCount].height);
    let eyeCount = this.eyeCount;
    ctx1.drawImage(babyEye[eyeCount], -0.5 * babyEye[eyeCount].width, -0.5 * babyEye[eyeCount].height);
    ctx1.restore();
};
