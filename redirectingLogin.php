<?php
    session_start();
    include 'dbsqlconnection.php';

    if(isset($_POST['LoginUserName']) && 
    isset($_POST['LoginPswd'])){

        $LoginUserName = $_POST['LoginUserName'];
        $LoginPswd = $_POST['LoginPswd'];
    
        $conn = $_SESSION['dbconnection'];

        $LoginQuery = "SELECT UserName,Pass,EmployeeID,PersonType,CompanyID FROM PERSON WHERE UserName='$LoginUserName'
        AND Pass='$LoginPswd'";
    
        $LoginResult = sqlsrv_query($conn,$LoginQuery,array(),array("Scrollable"=>'keyset'));
        $row = sqlsrv_num_rows($LoginResult);
        
        if($row == 1){
            //echo "<h5>Redirecting... </h5>";
            CheckResult($LoginResult);
            // 1 for Observer, 2 for Company Manager, 3 for Simple User
            if($_SESSION['PersonType'] == 2){     
                
                echo "<script type='text/javascript'>";
                echo "window.location.href = 'ObserverHomePage.php'";
                echo "</script>";
            }
            else if($_SESSION['PersonType'] == 1){
                echo "<script type='text/javascript'>";
                echo "window.location.href = 'CompanyManagerHomePage.php'";
                echo "</script>";
            }
            else if($_SESSION['PersonType'] == 0){
                echo "<script type='text/javascript'>";
                echo "window.location.href = 'SimpleUserHomePage.php'";
                echo "</script>";
            }
            else{
                echo "Person Type is NULL";
                echo "<script type='text/javascript'>";
                echo "window.location.href = 'index.php'";
                echo "</script>";
                echo 'SHOULD NEVER BE HERE. redirectingLogin line 44';
            }
        }
        else{
          print_r(sqlsrv_errors());
          echo "<h3>Wrong Credentials... Going back to Login Page.</h3>";
        

          die('<meta http-equiv="refresh" content="3; url=index.php" />');
        }
    
    }

    function PrintResultSet($resultSet)
{
  echo ("<table><tr >");

  foreach (sqlsrv_field_metadata($resultSet) as $fieldMetadata) {
    echo ("<th>");
    echo $fieldMetadata["Name"];
    echo ("</th>");
  }
  echo ("</tr>");

  while ($row = sqlsrv_fetch_array($resultSet, SQLSRV_FETCH_ASSOC)) {
    echo ("<tr>");
    foreach ($row as $col) {
      echo ("<td>");
      echo (is_null($col) ? "Null" : $col);
      echo ("</td>");
    }
    echo ("</tr>");
  }
  echo ("</table>");
}

//Assigning values into session variables
function CheckResult($resultSet)
{
    $cnt = 0;
  while ($row = sqlsrv_fetch_array($resultSet, SQLSRV_FETCH_ASSOC)) {
    foreach ($row as $col) {
                    $cnt++;
                  // numbers are based on the query above
                if($cnt==3)
                  $_SESSION['EmployeeID'] = $col;
                if($cnt==5)
                  $_SESSION['CompanyID'] = $col;
                if($cnt==4)
                  $_SESSION['PersonType'] = $col;  
      //echo (is_null($col) ? "Null" : $col);
    }
    $cnt = 0;
  }
}

function PrintResultCol($resultSet,$column)
{
    $cnt =0;
  while ($row = sqlsrv_fetch_array($resultSet, SQLSRV_FETCH_ASSOC)) {
    foreach ($row as $col) {
        $cnt++;
        if($cnt == $column)
            return (is_null($col) ? "Null" : $col);
    }
    $cnt=0;
  }
}


?>