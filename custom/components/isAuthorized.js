export default function () {
    return new Promise((success, error) => {
        $.post("/php/getSessions.php").then(user => {
            jQuery.parseJSON(user).name ? success(jQuery.parseJSON(user)) : error()
        })
    })
}