let number = document.getElementById('number');
let counter = 0;
let duration = 2000;
let endPercentage = 100; //percentage ng nakalagay sa id=
let intervalTime = duration / endPercentage;

let interval = setInterval(() => {
    if (counter >= endPercentage) {
        clearInterval(interval);
    } else {
        counter += 1;
        number.innerHTML = `${counter}%`;
    }
}, intervalTime);