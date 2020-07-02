

export default function SimpleCountup(selector, sessionSeconds, circleSeconds = 0, {
  onStart = ".arrive",
  onEnd = ".leave",
  updateEvery = sessionSeconds ? sessionSeconds : 0
} = {}) {


  let progressValue = document.querySelector('.progress__value'),
      leaveBtn = document.querySelector(".bem-leave");
      progressValue.style.stroke;

  let radius = 378,
    circumference = 2 * Math.PI * radius;
  progressValue.style.strokeDasharray = circumference;
  // progress bar value
 
  let prevTime, stopwatchInterval, elapsedTime = updateEvery * 1000,
     hours, minutes, seconds, milliseconds, time,
    el;


  try {
    if (!selector) throw Error("Неверные аргументы");
    el = document.querySelector(selector);
    init();
  } catch (error) {
    console.log(error)
  }



  function init() {
    stopwatchInterval = setInterval(function () {
      if (!prevTime) {
        prevTime = Date.now();
      }
      elapsedTime += Date.now() - prevTime;
      prevTime = Date.now();
      updateTime();
    }, 1000);

  }

  const updateTime = function () {
    let tempTime = elapsedTime;
    
    milliseconds = tempTime % 1000;
    tempTime = Math.floor(tempTime / 1000);
    seconds = tempTime % 60;
    tempTime = Math.floor(tempTime / 60);
    minutes = tempTime % 60;
    tempTime = Math.floor(tempTime / 60);
    hours = tempTime % 60;

    time = (minutes < 10 && minutes >= 0) ? `${hours}:0${minutes}` : `${hours}:${minutes}`;

    progressBar(circleSeconds++);
    console.log(circleSeconds);
    if (hours >= 0 && hours < 6  ) {
      progressValue.style.stroke = "#FF0000";
    } else
      if (hours >= 6 && hours < 9 ) {
        progressValue.style.stroke = "#F2C94C";
        leaveBtn.classList.remove("red");
        leaveBtn.classList.add("yellow");
      } else {
        progressValue.style.stroke = "#219653"
        leaveBtn.classList.remove("yellow");
        leaveBtn.classList.add("green");
      }
        
    if (el)
      el.innerHTML = time;
      
    console.log(hours + " : " + minutes + " : " + seconds + "." + milliseconds);

    if ( document.querySelector(onEnd) ){
      document.querySelector(onEnd).onclick = function () {
        clearInterval(stopwatchInterval);
        el.innerHTML = time;
      }
    }
  };



  function progressBar(value) {
    let progress = value / 32400; // 36000
    let dashoffset = circumference * (1 - progress);
    // console.log('progress:', value + '%', '|', 'offset:', dashoffset)
    progressValue.style.strokeDashoffset = dashoffset;
  }






}