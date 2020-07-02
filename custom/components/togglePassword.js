export default function togglePassword(selector, {
    show = ".show-password",
    hide = "hide-password"
}={}){
    const toggle = document.querySelector(selector),
          passwordInput = document.querySelector(".user-password")
    toggle.onclick = () => {
        console.log(2)
        console.log(passwordInput.type)
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggle.className = toggle.className.replace(" show-password", " hide-password") 
        } else {
            passwordInput.type = "password";
            toggle.className = toggle.className.replace(" hide-password", " show-password")
        }
    }
}    