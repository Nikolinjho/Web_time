export default function sendTime(user){
    return new Promise(function(success, error){
            $.post("/php/sendTime.php").then(function(answer){
                console.log(JSON.parse( answer))
            })
    })
}