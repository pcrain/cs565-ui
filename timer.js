/**
 * Created by asthasaxena on 19/04/2017.
 */
var time = document.getElementsByTagName('time')[0],
    start = document.getElementById('start'),
    stop = document.getElementById('stop'),
    clear = document.getElementById('clear'),
    seconds = 0, minutes = 0, hours = 0,
    totalSeconds = 0,
    t;

function add() {
    seconds++;
    totalSeconds++;
    if (seconds >= 60) {
        seconds = 0;
        minutes++;
        if (minutes >= 60) {
            minutes = 0;
            hours++;
        }
    }

    time.textContent = (hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds);

    timer();
}
function timer() {
    t = setTimeout(add, 1000);
}
timer();


/* Start button */
//start.onclick = timer;

/* Stop button */
//stop.onclick = function() {
//    clearTimeout(t);
//}

/* Clear button */
//clear.onclick = function() {
//    time.textContent = "00:00:00";
//    seconds = 0; minutes = 0; hours = 0;
//}
