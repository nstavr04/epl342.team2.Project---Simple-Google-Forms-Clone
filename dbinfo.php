<?php
$dbServername = "universitycsdbnstavr04.database.windows.net";
$dbUsername = "nstavr04";
$dbPassword = "admin1234!";
$dbName = "epl342ProjectTeam2";
//need to change
$conn = ($dbServername, $dbUsername, $dbPassword, $dbName);   // connection
$_SESSION['conn'] = $conn;
if ($_SESSION['conn']){
//    echo "MySql connected OK!";
}else{
    echo "There is a problem with my Sql";
}
?>