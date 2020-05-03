let Fruit = function() {
    this.alive = [];
    this.x = [];
    this.y = [];
    this.l = [];
    this.spd = [];
    this.aneId = [];
    this.fruitType = [];
    this.orange = new Image();
    this.blue = new Image();
};
Fruit.prototype.num = 15;
Fruit.prototype.init = function() {
    for (let i = 0; i < this.num; i++) {
        this.alive[i] = false;
        this.x[i] = 0;
        this.y[i] = 0;
        this.aneId[i] = 0;
        this.spd[i] = 0.003 + 0.017 * Math.random();
        this.born(i);
    }
    this.orange.src = "/assets/images/lovely-fish/fruit.png";
    this.blue.src = "/assets/images/lovely-fish/blue.png";
};
Fruit.prototype.draw = function() {
    for (let i = 0; i < this.num; i++) {
        if (this.alive[i]) {
            if (this.l[i] <= 14) {
                let aneId = this.aneId[i];
                this.x[i] = ane.headX[aneId];
                this.y[i] = ane.headY[aneId];
                this.l[i] += this.spd[i] * deltaTime;
            } else {
                this.y[i] -= 4 * this.spd[i] * deltaTime;
            }
            let pic;
            switch (this.fruitType[i]) {
                default:
                case "orange":
                    pic = this.orange;
                    break;
                case "blue":
                    pic = this.blue;
                    break;
            }
            ctx2.drawImage(pic, this.x[i] - this.l[i] * 0.5, this.y[i] - this.l[i] * 0.5, this.l[i], this.l[i]);
            if (this.y[i] < 10) {
                this.alive[i] = false;
            }
        }
    }
};
Fruit.prototype.born = function(i) {
    this.aneId[i] = Math.floor(Math.random() * ane.num);
    let aneId = this.aneId[i];
    this.x[i] = ane.headX[aneId];
    this.y[i] = ane.headY[aneId];
    this.l[i] = 0;
    this.alive[i] = true;
    if (Math.random() < 0.2) {
        this.fruitType[i] = "blue";
    } else {
        this.fruitType[i] = "orange";
    }
};
Fruit.prototype.dead = function(i) {
    this.alive[i] = false;
};

function fruitMonitor() {
    let num = 0;
    for (let i = 0; i < fruit.num; i++) {
        if (fruit.alive[i]) {
            num += 1;
        }
    }
    if (num < 15) {
        sendFruit();
    }
}

function sendFruit() {
    for (let i = 0; i < fruit.num; i++) {
        if (!fruit.alive[i]) {
            fruit.born(i);
            break;
        }
    }
}
