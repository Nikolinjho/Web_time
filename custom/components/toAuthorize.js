export default function () {
    return new Promise(function (success, error) {
        const userLogin = document.querySelector(".user-login"),
            userPassword = document.querySelector(".user-password")

            if (userLogin.value.trim().length === 0 || userPassword.value.trim().length === 0) {
                alert("Присутствуют пустые поля");
                return;
            }
            let user = {
                login: userLogin.value,
                password: userPassword.value
            }
            console.log(user)
            $.post("/php/authorize.php", user).then(function(user) {
                user ? success(jQuery.parseJSON(user)) : error()
            })
    })
}