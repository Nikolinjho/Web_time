import isAuthorized from "./components/isAuthorized.js";
import unAuthorized from "./components/unAuthorized.js";
import authorized from "./components/Authorized.js";
import toAuthorize from "./components/toAuthorize.js";
import togglePassword from "./components/togglePassword.js";
import exit from "./components/exit.js";
// import sendTime from "./components/sendTime.js"; 
import { setCookie, getCookie, eraseCookie } from "./components/cookies.js";
import SimpleCountup from "./components/SimpleCountup.js";
import { simpleClock, clock } from "./components/simpleClock.js";
import { insertAfter } from "./components/functions.js";


$(document).ready(function () {

    // const mts = document.querySelector(".mts");

    isAuthorized()
        .then(function (user) {
            if (user.class === "admin")
                new adminApp(user).load()
            else
                new userApp(user).load()
            console.log(user)
        })
        .catch(function () {
            unAuthorized()
                .then(function () {
                    new togglePassword(".toggle-password");
                    document.querySelector(".login-btn").onclick = function (e) {
                        toAuthorize()
                            .then(function (user) {
                                if (user.class === "admin")
                                    new adminApp(user).load()
                                else
                                    new userApp(user).load()
                            })
                            .catch(function () {
                                alert("Не верный логин/пароль")
                            })
                    }
                })
        })


    class adminApp {
        constructor(user) {
            this.load = function () {
                authorized(user)
                    .then(function () {
                        exit()
                    })

            }
        }
    }


    class userApp {
        constructor(user) {
            this.load = function () {
                authorized(user)
                    .then(function () {
                        exit()
                    })
                    .then(function () {
                        $.post("/php/getSessions.php").then(function (data) {
                            const session = JSON.parse(data);
                            console.log(session)
                            if (session.seconds) {
                                new SimpleCountup(".timer__time", session.seconds, session.seconds);
                            } else {
                                new simpleClock(".timer__time");
                            }
                        })
                    })
                    .then(function () {
                        $(".arrive").click(function () {
                            // let self = this;
                            clearInterval(clock);
                            this.remove();
                            new SimpleCountup(".timer__time");
                            document.querySelector(".leave").style.display = "flex";
                            $.post("/php/insertAndCheck.php").then(function (date) {
                                console.log(JSON.parse(date));

                            })

                        })
                    })
                    .then(function () {
                        $(".bem-leave").on("click", function () {
                            let self = this;
                            $.post("/php/sendTime.php").then(function (msg) {
                                console.log(JSON.parse(msg))
                                self.remove();
                            })


                        })
                    })
            }
        }
    }
})

