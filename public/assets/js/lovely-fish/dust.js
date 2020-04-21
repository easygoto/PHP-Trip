let Dust = function () {
    this.x = [];
    this.y = [];
    this.amp = [];
    this.ID = [];
    this.alpha = 0;
};
Dust.prototype.num = 30;
Dust.prototype.init = function () {
    for (let i = 0; i < this.num; i++) {
        this.x[i] = Math.random() * canWidth;
        this.y[i] = Math.random() * canHeight;
        this.amp[i] = 20 + Math.random() * 15;
        this.ID[i] = Math.floor(Math.random() * 7);
    }
    this.alpha = 0;
};
Dust.prototype.draw = function () {
    this.alpha += deltaTime * 0.0008;
    let l = Math.sin(this.alpha);
    for (let i = 0; i < this.num; i++) {
        let id = this.ID[i];
        ctx1.drawImage(dustPic[id], this.x[i] + this.amp[i] * l, this.y[i]);
    }
};
