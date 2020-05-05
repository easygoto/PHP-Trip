let Halo = function () {
    this.x = [];
    this.y = [];
    this.r = [];
    this.alive = [];
};

Halo.prototype.num = 10;
Halo.prototype.init = function () {
    for (let i = 0; i < this.num; i++) {
        this.x[i] = 0;
        this.y[i] = 0;
        this.r[i] = 0;
        this.alive[i] = false;
    }
};

Halo.prototype.draw = function () {
    ctx1.save();
    ctx1.lineWidth = 3;
    ctx1.shadowBlur = 10;
    ctx1.shadowColor = "rgba(203, 91, 0, 1)";
    for (let i = 0; i < this.num; i++) {
        if (this.alive[i]) {
            this.r[i] += deltaTime * 0.05;
            if (this.r[i] > 100) {
                this.alive[i] = false;
            }
            let alpha = 1 - this.r[i] / 100;

            ctx1.beginPath();
            ctx1.arc(this.x[i], this.y[i], this.r[i], 0, 2 * Math.PI);
            ctx1.closePath();
            ctx1.strokeStyle = "rgba(203, 91, 0, " + alpha + ")";
            ctx1.stroke();
        }
    }
    ctx1.restore();
};

Halo.prototype.born = function (x, y) {
    for (let i = 0; i < this.num; i++) {
        if (!this.alive[i]) {
            this.x[i] = x;
            this.y[i] = y;
            this.r[i] = 10;
            this.alive[i] = true;
            return;
        }
    }
};
