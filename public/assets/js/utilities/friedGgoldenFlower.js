let pokerSet = [
    "!A",
    "!2",
    "!3",
    "!4",
    "!5",
    "!6",
    "!7",
    "!8",
    "!9",
    "!10",
    "!J",
    "!Q",
    "!K",
    "@A",
    "@2",
    "@3",
    "@4",
    "@5",
    "@6",
    "@7",
    "@8",
    "@9",
    "@10",
    "@J",
    "@Q",
    "@K",
    "#A",
    "#2",
    "#3",
    "#4",
    "#5",
    "#6",
    "#7",
    "#8",
    "#9",
    "#10",
    "#J",
    "#Q",
    "#K",
    "$A",
    "$2",
    "$3",
    "$4",
    "$5",
    "$6",
    "$7",
    "$8",
    "$9",
    "$10",
    "$J",
    "$Q",
    "$K",
];
let result = {
    total: 0,
    leopard: 0,
    flowerStraight: 0,
    flower: 0,
    straight: 0,
    pair: 0,
    other: 0,
};

function isStraight(i, j, k) {
    i %= 13;
    j %= 13;
    k %= 13;
    return (
        (i === 0 && j === 11 && k === 12) ||
        (i === 0 && k === 11 && j === 12) ||
        (j === 0 && i === 11 && k === 12) ||
        (j === 0 && k === 11 && i === 12) ||
        (k === 0 && j === 11 && i === 12) ||
        (k === 0 && i === 11 && j === 12) ||
        (i === j - 1 && i === k + 1) ||
        (i === k - 1 && i === j + 1) ||
        (j === i - 1 && j === k + 1) ||
        (j === k - 1 && j === i + 1) ||
        (k === j - 1 && k === i + 1) ||
        (k === i - 1 && k === j + 1)
    );
}

for (let i = 0; i < pokerSet.length; i++) {
    for (let j = i + 1; j < pokerSet.length; j++) {
        for (let k = j + 1; k < pokerSet.length; k++) {
            let pokeri = pokerSet[i];
            let pokerj = pokerSet[j];
            let pokerk = pokerSet[k];
            let pokeriType = pokeri.substr(0, 1);
            let pokerjType = pokerj.substr(0, 1);
            let pokerkType = pokerk.substr(0, 1);
            let pokeriNumber = pokeri.substr(1);
            let pokerjNumber = pokerj.substr(1);
            let pokerkNumber = pokerk.substr(1);
            result.total++;
            if (pokeriNumber === pokerjNumber && pokerjNumber === pokerkNumber) {
                result.leopard++;
            } else if (pokeriType === pokerjType && pokerkType === pokerjType && isStraight(i, j, k)) {
                result.flowerStraight++;
            } else if (pokeriType === pokerjType && pokerkType === pokerjType) {
                result.flower++;
            } else if (isStraight(i, j, k)) {
                result.straight++;
            } else if (
                pokeriNumber === pokerjNumber ||
                pokeriNumber === pokerkNumber ||
                pokerkNumber === pokerjNumber
            ) {
                result.pair++;
            } else {
                result.other++;
            }
        }
    }
}

result.leopardRate = (100 * result.leopard) / result.total + "%";
result.flowerStraightRate = (100 * result.flowerStraight) / result.total + "%";
result.flowerRate = (100 * result.flower) / result.total + "%";
result.straightRate = (100 * result.straight) / result.total + "%";
result.pairRate = (100 * result.pair) / result.total + "%";
result.otherRate = (100 * result.other) / result.total + "%";
console.log(result);
