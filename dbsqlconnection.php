<?php

        $dbServerName = "";
        $connectionOptions = array("Database" => "",
                    "UID" => "",
                    "PWD" => "");
        $conn = sqlsrv_connect($dbServerName, $connectionOptions);
        if($conn == false)
            echo "Connection was unsuccessful";

        $_SESSION['dbconnection'] = $conn;
?>
