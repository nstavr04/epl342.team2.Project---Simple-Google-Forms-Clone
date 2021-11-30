<?php

        $dbServerName = "universitycsdbnstavr04.database.windows.net";
        $connectionOptions = array("Database" => "epl342ProjectTeam2",
                    "UID" => "user342",
                    "PWD" => "AdminVaseis123");
        $conn = sqlsrv_connect($dbServerName, $connectionOptions);
        if($conn == false)
            echo "Connection was unsuccessful";

        $_SESSION['dbconnection'] = $conn;
?>