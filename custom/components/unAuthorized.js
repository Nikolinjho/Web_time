// import togglePassword from "./togglePassword";

export default function () {
    return new Promise((success, error) => {
        // window.location.href = "http://webtime.fryzit/";
        $(".site-carcass__container").empty()
        $(".site-carcass__container").load("/authorize.php", function(){
            return success()
        })

        // console.log(new Date())
        // success()
    })
}