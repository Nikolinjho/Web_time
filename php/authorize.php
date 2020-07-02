<?

if (!empty($_POST["login"]) && !empty($_POST["password"])) {
    include_once "connection.php";
    $user = pdo()->prepare("SELECT * FROM user_table WHERE User_login = :lgn AND User_password = :pswrd ");
    $user->bindParam(':lgn', $_POST["login"]);
    $user->bindParam(':pswrd', $_POST["password"]);
    $user->execute();
 
    if ($user->rowCount()) {
        $user = $user->fetch();

        session_start();

        $_SESSION["login"] = $user["User_login"];
        if ($_SESSION["login"] == "admin"){
            $_SESSION["link"] = "dashboard.php";
            $_SESSION["class"] = "admin";
        } else {
            $_SESSION["link"] = "user-panel.php";
        }
        $_SESSION["name"] =  $user["User_name"];
        echo json_encode($_SESSION);
    }
}
