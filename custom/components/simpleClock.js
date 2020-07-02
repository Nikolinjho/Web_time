let clock;
function simpleClock(selector) {
    
    try {
        if (!selector) throw Error("Неверные аргументы");        
        init();
    } catch (error) {
        console.log(error);
    }

    function init() {
        startTime();
        clock = setInterval(function () {
            startTime()
        }, 1000);
    }

    function startTime() {
        let hours = new Date().getHours();
        let min = new Date().getMinutes() >= 0 && new Date().getMinutes() < 10 ? `0${new Date().getMinutes()}` : new Date().getMinutes();
        document.querySelector(selector).innerHTML = `${hours}:${min}`;     
        console.log("time")   
    }
}

export {simpleClock, clock}
