<?

function pdo()
{
    $dbHost = "localhost"; 
    $dbName = "storage_db";
    $dbUser = "root";
    $dbPassword = "toor";
    
    return new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPassword, [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
}
