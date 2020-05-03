let Wave = function() {
    this.x = [];
    this.y = [];
    this.r = [];
    this.alive = [];
};

Wave.prototype.num = 10;
Wave.prototype.init = function() {
    for (let i = 0; i < this.num; i++) {
        this.r[i] = 0;
        this.alive[i] = false;
    }
};

Wave.prototype.draw = function() {
    ctx1.save();
    ctx1.lineWidth = 2;
    ctx1.shadowBlur = 10;
    ctx1.shadowColor = "white";
    for (let i = 0; i < this.num; i++) {
        if (this.alive[i]) {
            this.r[i] += deltaTime * 0.04;
            if (this.r[i] > 50) {
                this.alive[i] = false;
                break;
            }
            let alpha = 1 - this.r[i] / 50;
            ctx1.beginPath();
            ctx1.arc(this.x[i], this.y[i], this.r[i], 0, 2 * Math.PI);
            ctx1.closePath();
            ctx1.strokeStyle = "rgba(255, 255, 255, " + alpha + ")";
            ctx1.stroke();
        }
    }
    ctx1.restore();
};

Wave.prototype.born = function(x, y) {
    for (let i = 0; i < this.num; i++) {
        if (!this.alive[i]) {
            this.x[i] = x;
            this.y[i] = y;
            this.r[i] = 20;
            this.alive[i] = true;
            return;
        } else {
            this.alive[i] = false;
        }
    }
};
