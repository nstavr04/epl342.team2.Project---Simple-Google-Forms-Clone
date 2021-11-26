<?php

// $test = phpinfo();
// echo $test;

// function OpenConnection()
//     {
        $dbServerName = "universitycsdbnstavr04.database.windows.net";
        $connectionOptions = array("Database" => "epl342ProjectTeam2",
                    "UID" => "nstavr04",
                    "PWD" => "Administrator!");
        $conn = sqlsrv_connect($dbServerName, $connectionOptions);
        if($conn == false)
            echo "Connection was unsuccessful";

        $_SESSION['dbconnection'] = $conn;

    //     return $conn;
    // };

//     function ReadData()
//     {
//         try
//         {
//             $conn = OpenConnection();
//             $tsql = "SELECT [testCol2] FROM dbo.testTable";
//             $getProducts = sqlsrv_query($conn, $tsql);
//             if ($getProducts == FALSE)
//                 echo "Error getting data";
//             $productCount = 0;
//             while($row = sqlsrv_fetch_array($getProducts, SQLSRV_FETCH_ASSOC))
//             {
//                 echo($row['testCol2']);
//                 echo("<br/>");
//                 $productCount++;
//             }
//             sqlsrv_free_stmt($getProducts);
//             sqlsrv_close($conn);
//         }
//         catch(Exception $e)
//         {
//             echo("Error!");
//         }
//     }

// ReadData()


?>
