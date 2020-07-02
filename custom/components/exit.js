export default function () {
    return new Promise(function(success, error){
        document.querySelector(".bem-modal__params-left").onclick = function(){
            $.post("/php/exit").then(function() {
                location.reload()
            })                 
        }
        success()
    })
}