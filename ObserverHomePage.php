<?php
session_start();
include 'dbsqlconnection.php';
// Prevent someone with no access to enter via URL
if (!isset($_SESSION['PersonType']) || $_SESSION['PersonType'] != 2) {
    echo '<h2 style="color:red">Access Denied</h2>';
    session_unset();
    session_destroy();
    die('<meta http-equiv="refresh" content="2; url=index.php" />');
}


// assuming that Q1Fname Wont be NULL on submit, and ALSO it wont have the value of Q1FnameDONE
// This is the Q1
if (isset($_POST['CreateCompanyAndManager']) && isset($_POST['Q1FName']) && $_POST['Q1FName'] != 'Q1FnameDONE') {

    //Read Stored proc with param
    $tsql = "{call insertCompanyAndDE(?, ?, ?, ?, ?, ?, ? ,? ,? ,?, ?, ?)}";
    // echo "Executing query: " . $tsql . ") with parameter " . $_GET["city"] . "<br/>";

    // Getting parameter from the http call and setting it for the SQL call
    $params = array(
        array((int)$_SESSION['NextComID'], SQLSRV_PARAM_IN),
        array($_POST["Q1CName"], SQLSRV_PARAM_IN),
        array((int)$_POST["Q1RegNum"], SQLSRV_PARAM_IN),
        array($_POST["Q1FName"], SQLSRV_PARAM_IN),
        array((int)$_SESSION['NextEmpID'], SQLSRV_PARAM_IN),
        array($_POST["Q1BirthDate"], SQLSRV_PARAM_IN),
        array((int)$_POST["Q1Sex"], SQLSRV_PARAM_IN),
        array($_POST["Q1UserName"], SQLSRV_PARAM_IN),
        array($_POST["Q1Pass"], SQLSRV_PARAM_IN),
        array((int)$_SESSION['NextEmpID'], SQLSRV_PARAM_IN),
        array($_POST["Q1LName"], SQLSRV_PARAM_IN),
        array((int)$_POST["Q1IDCard"], SQLSRV_PARAM_IN)
    );

    $time_start = microtime(true);
    $getResults = sqlsrv_query($conn, $tsql, $params);
    $time_end = microtime(true);
    echo ("Results:<br/>");
    if ($getResults == FALSE)
        die(FormatErrors(sqlsrv_errors()));

    PrintResultSet($getResults);
    // Free query  resources. 
    sqlsrv_free_stmt($getResults);

    $execution_time = round((($time_end - $time_start) * 1000), 2);
    echo 'QueryTime: ' . $execution_time . ' ms';



    $_POST['Q1FName'] = 'Q1FnameDONE';
}

$conn = $_SESSION['dbconnection'];

$query = "SELECT TOP (1) CompanyID FROM COMPANY ORDER BY (CompanyID)DESC";

$result = sqlsrv_query($conn, $query);
$_SESSION['NextComID'] = PrintResultCol($result, 1);
$_SESSION['NextComID']++;
// echo $_SESSION['NextComID'];



$query = "SELECT TOP (1) EmployeeID FROM PERSON ORDER BY (EmployeeID)DESC";

$result = sqlsrv_query($conn, $query);
$_SESSION['NextEmpID'] = PrintResultCol($result, 1);
$_SESSION['NextEmpID']++;
// echo $_SESSION['NextEmpID'];





// $time_start = microtime(true);

// //Read Stored proc with param
// $tsql = "{call insertCompanyAndDE2(?, ?, ?)}";  
// // echo "Executing query: " . $tsql . ") with parameter " . $_GET["city"] . "<br/>";
// $t1=8;
// $t2='test1234';
// $t3=8;
// // Getting parameter from the http call and setting it for the SQL call
// $params = array(  
//                 array($t1, SQLSRV_PARAM_IN),
//                 array($t2, SQLSRV_PARAM_IN),
//                 array($t3, SQLSRV_PARAM_IN)
//                 );  

// $getResults= sqlsrv_query($conn, $tsql, $params);
// echo ("Results:<br/>");
// if ($getResults == FALSE)
//     die(FormatErrors(sqlsrv_errors()));

// PrintResultSet($getResults);
// // Free query  resources. 
// sqlsrv_free_stmt($getResults);

// $time_end = microtime(true);
// $execution_time = round((($time_end - $time_start)*1000),2);
// echo 'QueryTime: '.$execution_time.' ms';

// print a certain column (1i i 2i i 3i...)
function PrintResultCol($resultSet, $column)
{
    $cnt = 0;
    while ($row = sqlsrv_fetch_array($resultSet, SQLSRV_FETCH_ASSOC)) {
        foreach ($row as $col) {
            $cnt++;
            if ($cnt == $column)
                return (is_null($col) ? "Null" : $col);
        }
        $cnt = 0;
    }
}

// print single result (1 pliada 1 col)
function PrintResultSet($resultSet)
{
    echo '<div class="table-responsive">';
    echo ('<table class="table" style="text-align: center; vertical-align:middle">');
    echo '<thead><tr>';
    foreach (sqlsrv_field_metadata($resultSet) as $fieldMetadata) {
        echo ('<th scope="col">');
        echo $fieldMetadata["Name"];
        echo ("</th>");
    }
    echo ("</tr></thead><tbody>");

    while ($row = sqlsrv_fetch_array($resultSet, SQLSRV_FETCH_ASSOC)) {
        echo ("<tr>");
        foreach ($row as $col) {
            echo ("<td>");
            echo (is_null($col) ? "Null" : $col);
            echo ("</td>");
        }
        echo ("</tr>");
    }
    echo ("</tbody></table>");
    echo '</div>';
}

// Print sql errors
function FormatErrors($errors)
{
    /* Display errors. */
    echo "Error information: ";

    foreach ($errors as $error) {
        echo "SQLSTATE: " . $error['SQLSTATE'] . "";
        echo "Code: " . $error['code'] . "";
        echo "Message: " . $error['message'] . "";
    }
}

//print resultset with 1 date
function PrintResultSetDate($resultSet, $datevar)
{
    echo '<div class="table-responsive">';
    echo ('<table class="table" style="text-align: center; vertical-align:middle">');
    echo '<thead><tr>';
    // Used to check if we have datetime we will echo differently since datetime cannot be converted to string with echo
    $counter = 1;
    $flag = 0;
    $counter2 = 1;

    foreach (sqlsrv_field_metadata($resultSet) as $fieldMetadata) {

        // Find the column where we have a DateTime data type
        // Add with OR for the other 2 dates in other tables
        if ($fieldMetadata["Name"] == $datevar)
            $flag = 1;
        if ($fieldMetadata["Name"] != $datevar && $flag == 0)
            $counter++;

        echo ('<th scope="col">');
        echo $fieldMetadata["Name"];
        echo ("</th>");
    }
    echo ("</tr></thead><tbody>");

    while ($row = sqlsrv_fetch_array($resultSet, SQLSRV_FETCH_ASSOC)) {
        echo ("<tr>");
        foreach ($row as $col) {
            echo ("<td>");
            if ($counter2 == $counter) {
                //Converts datatime to string
                //echo date_format($col,"Y-m-d H:i:s");
                echo date_format($col, "Y-m-d");
                // $myDateTime = DateTime::createFromFormat('Y-m-d', $col);
                // $datetime = $myDateTime->format('d-m-Y');
                // echo $datetime;
            } else {
                echo (is_null($col) ? "Null" : $col);
            }
            echo ("</td>");
            $counter2++;
        }
        $counter2 = 1;
        echo ("</tr>");
    }
    echo ("</tbody></table>");
    echo '</div>';
}

//print resultset with 2 dates (NEEDS CHECKING)
function PrintResultSetDate2($resultSet, $datevar, $date2var)
{
    echo '<div class="table-responsive">';
    echo ('<table class="table" style="text-align: center; vertical-align:middle">');
    echo '<thead><tr>';
    // Used to check if we have datetime we will echo differently since datetime cannot be converted to string with echo
    $counter0 = 1;
    $counter = 1;
    $flag = 0;
    $flag0 = 0;
    $counter2 = 1;

    foreach (sqlsrv_field_metadata($resultSet) as $fieldMetadata) {

        // Find the column where we have a DateTime data type
        // Add with OR for the other 2 dates in other tables
        if ($fieldMetadata["Name"] == $datevar)
            $flag = 1;
        if ($fieldMetadata["Name"] == $date2var)
            $flag0 = 1;
        if ($fieldMetadata["Name"] != $datevar && $flag == 0)
            $counter++;
        if ($fieldMetadata["Name"] != $date2var && $flag0 == 0)
            $counter0++;

        echo ('<th scope="col">');
        echo $fieldMetadata["Name"];
        echo ("</th>");
    }
    echo ("</tr></thead><tbody>");

    while ($row = sqlsrv_fetch_array($resultSet, SQLSRV_FETCH_ASSOC)) {
        echo ("<tr>");
        foreach ($row as $col) {
            echo ("<td>");
            if ($counter2 == $counter || $counter2 == $counter0) {
                //Converts datatime to string
                //echo date_format($col,"Y-m-d H:i:s");
                echo date_format($col, "Y-m-d");
                // $myDateTime = DateTime::createFromFormat('Y-m-d', $col);
                // $datetime = $myDateTime->format('d-m-Y');
                // echo $datetime;
            } else {
                echo (is_null($col) ? "Null" : $col);
            }
            echo ("</td>");
            $counter2++;
        }
        $counter2 = 1;
        echo ("</tr>");
    }
    echo ("</tbody></table>");
    echo '</div>';
}

?>
<!doctype html>
<html lang="en">

<!-- //THIS IS THE HEAD. ITS OK -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.0/mdb.min.css" rel="stylesheet" />

    <title>Observer Home Page</title>
</head>

<body>

    <!-- Titles -->
    <div class="text-center page-header">
        <br>
        <h2>Welcome to Observer Home Page</h2>
        <hr>
    </div>

    <!-- PICK OPTIONS -->
    <div class="text-center page-header w-50 " style="margin-left: 25.5%;">
        <h3>Pick one of the options below</h3>
        <hr>
        <br>
    </div>

    <!-- Accordion with options and forms in it -->

    <div class="accordion p-3" id="accordion">

        <!-- THIS IS THE 1ST CHOICE -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-mdb-toggle="collapse" data-mdb-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Add Company and Company Manager
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-mdb-parent="#accordionExample">

                <!-- THIS IS THE FIRST QUERY -->
                <div class="accordion-body">


                    <!-- The first form for adding company -->
                    <form method="POST" class="w-25 p-3" style="margin-left: 37.5%;">
                        <div class="text-center">
                            <h4>Enter Company Details</h4>
                        </div>
                        <hr>

                        <!-- RegNum input -->
                        <div class="form-outline mb-4">
                            <input type="number" name="Q1RegNum" id="form1Example1" class="form-control" />
                            <label class="form-label" for="form1Example1">Registration Number</label>
                        </div>

                        <!-- CName input -->
                        <div class="form-outline mb-4">
                            <input type="text" name="Q1CName" id="form1Example2" class="form-control" />
                            <label class="form-label" for="form1Example2">Company Name</label>
                        </div>

                        <!-- The second form for adding company manager -->
                        <div class="text-center">
                            <h4>Enter Company Manager Details</h4>
                        </div>
                        <hr>

                        <!-- FName input -->
                        <div class="form-outline mb-4">
                            <input type="text" name="Q1FName" id="form1Example3" class="form-control" />
                            <label class="form-label" for="form1Example3">Fname</label>
                        </div>

                        <!-- LName input -->
                        <div class="form-outline mb-4">
                            <input type="text" name="Q1LName" id="form1Example3" class="form-control" />
                            <label class="form-label" for="form1Example3">Lname</label>
                        </div>

                        <!-- IDCard input -->
                        <div class="form-outline mb-4">
                            <input type="number" name="Q1IDCard" id="form1Example4" class="form-control" />
                            <label class="form-label" for="form1Example4">IDCard</label>
                        </div>

                        <!-- BirthDate input -->
                        <div class="form-outline mb-4">
                            <input type="date" name="Q1BirthDate" id="form1Example5" class="form-control" />
                            <label class="form-label" for="form1Example5">Birth Date</label>
                        </div>

                        <!-- Sex input -->
                        <div class="form-outline mb-4">
                            <input type="number" name="Q1Sex" id="form1Example6" min="0" max="1" class="form-control" />
                            <label class="form-label" for="form1Example6">Sex (1:M|0:F)</label>
                        </div>

                        <!-- Username input -->
                        <div class="form-outline mb-4">
                            <input type="text" name="Q1UserName" id="form1Example7" class="form-control" />
                            <label class="form-label" for="form1Example7">Username</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <input type="password" name="Q1Pass" id="form1Example8" class="form-control" />
                            <label class="form-label" for="form1Example8">Password</label>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" name="CreateCompanyAndManager" class="btn btn-primary btn-block">Submit</button>
                        <br>
                    </form>


                </div>
            </div>
        </div>

        <!-- THIS IS THE 2ND CHOICE -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-mdb-toggle="collapse" data-mdb-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    View details of a Company and its manager
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-mdb-parent="#accordionExample">
                <div class="accordion-body">

                    <?php
                    //Read Stored proc with param
                    $tsql = "{call showCompanyManagerDetails()}";

                    // Getting parameter from the http call and setting it for the SQL call
                    $params = array(
                    );

                    $time_start = microtime(true);
                    $getResults = sqlsrv_query($conn, $tsql, $params);
                    $time_end = microtime(true);
                    echo ("Results:<br/>");
                    if ($getResults == FALSE)
                        die(FormatErrors(sqlsrv_errors()));

                    PrintResultSetDate2($getResults, 'RegDate', 'BirthDate');
                    // Free query  resources. 
                    sqlsrv_free_stmt($getResults);

                    $execution_time = round((($time_end - $time_start) * 1000), 2);
                    echo 'QueryTime: ' . $execution_time . ' ms';


                    // $tsql = "SELECT C.CompanyID,C.CName,P.EmployeeID AS CompanyManagerID FROM COMPANY AS C INNER JOIN PERSON AS P ON C.CompanyID = P.CompanyID";
                    // $tsql = "";
                    // $getResults = sqlsrv_query($conn, $tsql);
                    // $datevar = "RegDate";
                    // PrintResultSetDate($getResults, $datevar);
                    //PrintResultSet($getResults);


                    // <form method="post" class="w-25 p-3" style="margin-left: 37.5%;">
                    //     <div class="text-center">
                    //         <h4>Enter Details to view Company</h4>
                    //     </div>
                    //     <hr>

                    //     <!-- RegNum input -->
                    //     <div class="form-outline mb-4">
                    //         <input type="number" name="RegNum" id="form1Example10" class="form-control" />
                    //         <label class="form-label" for="form1Example10">Company Registration Number</label>
                    //     </div>

                    //     <!-- CName input -->
                    //     <div class="form-outline mb-4">
                    //         <input type="text" name="CName" id="form1Example11" class="form-control" />
                    //         <label class="form-label" for="form1Example11">Company Name</label>
                    //     </div>

                    //     <!-- Submit button -->
                    //     <button type="submit" name="ViewCompany" class="btn btn-primary btn-block">Search</button>
                    //     <br>
                    // </form>

                    ?>

                </div>
            </div>
        </div>

        <!-- THIS IS THE 3RD CHOICE -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-mdb-toggle="collapse" data-mdb-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Modify details of a Company
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-mdb-parent="#accordionExample">
                <div class="accordion-body">                              

                    <form method="post" class="w-25 p-3" style="margin-left: 37.5%;">
                        <div class="text-center">
                            <h4>Enter Company ID Number</h4>
                        </div>
                        

                        <!-- RegNum input -->
                        <div class="form-outline mb-4">
                            <input type="number" name="Q2CompanyID" id="form1Example12" class="form-control" />
                            <label class="form-label" for="form1Example12">Company ID Number</label>
                        </div>

                        <div class="text-center">
                            <h4>Enter the new Company Name</h4>
                        </div>
                        

                        <!-- CName input -->
                        <div class="form-outline mb-4">
                            <input type="text" name="Q2CName" id="form1Example13" class="form-control" />
                            <label class="form-label" for="form1Example13">Company Name</label>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" name="ModifyCompany" class="btn btn-primary btn-block">Submit</button>
                        
                    </form>

                    <?php

                                if(isset($_POST['ModifyCompany'])){

                                    //Read Stored proc with param
                                    $tsql = "{call changeCompanyDetails(?,?)}";

                                    // Getting parameter from the http call and setting it for the SQL call
                                    $params = array(
                                        array((int)$_POST['Q2CompanyID']),
                                        array($_POST['Q2CName'])
                                    );

                                    $time_start = microtime(true);
                                    $getResults = sqlsrv_query($conn, $tsql, $params);
                                    $time_end = microtime(true);
                                    //echo ("Results:<br/>");
                                    if ($getResults == FALSE)
                                        die(FormatErrors(sqlsrv_errors()));

                                    PrintResultSet($getResults);
                                    // Free query  resources. 
                                    sqlsrv_free_stmt($getResults);

                                    $execution_time = round((($time_end - $time_start) * 1000), 2);
                                    echo 'QueryTime: ' . $execution_time . ' ms';

                                }

                                ?>

                </div>
            </div>
        </div>

        <!-- THIS IS THE 4TH CHOICE -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-mdb-toggle="collapse" data-mdb-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    View details of a Company Manager or User
                </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-mdb-parent="#accordionExample">
                <div class="accordion-body">

                    <form method="post" class="w-25 p-3" style="margin-left: 37.5%;">
                        <div class="text-center">
                            <h4>Enter Employee ID</h4>
                        </div>
                        <hr>

                        <!-- ID input -->
                        <div class="form-outline mb-4">
                            <input type="number" name="Q4ID" id="form1Example14" class="form-control" />
                            <label class="form-label" for="form1Example14">ID</label>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" name="ViewUser" class="btn btn-primary btn-block">Search</button>
                        <br>
                    </form>

                    <?php

                                if(isset($_POST['ViewUser'])){

                                    //Read Stored proc with param
                                    $tsql = "{call showPersonDetails(?)}";

                                    // Getting parameter from the http call and setting it for the SQL call
                                    $params = array(
                                        array($_POST['Q4ID'])
                                    );

                                    $time_start = microtime(true);
                                    $getResults = sqlsrv_query($conn, $tsql, $params);
                                    $time_end = microtime(true);
                                    //echo ("Results:<br/>");
                                    if ($getResults == FALSE)
                                        die(FormatErrors(sqlsrv_errors()));

                                    PrintResultSetDate($getResults,'BirthDate');
                                    // Free query  resources. 
                                    sqlsrv_free_stmt($getResults);

                                    $execution_time = round((($time_end - $time_start) * 1000), 2);
                                    echo 'QueryTime: ' . $execution_time . ' ms';

                                }

                                ?>

                </div>
            </div>
        </div>

        <!-- THIS IS THE 5TH CHOICE -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed" type="button" data-mdb-toggle="collapse" data-mdb-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    Modify details of a Company Manager
                </button>
            </h2>
            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-mdb-parent="#accordionExample">
                <div class="accordion-body">

                    <form method="post" class="w-25 p-3" style="margin-left: 37.5%;">
                        <div class="text-center">
                            <h4>Enter Company Manager Employee ID</h4>
                        </div>
                        <hr>

                        <!-- ID input -->
                        <div class="form-outline mb-4">
                            <input type="number" name="Q22ID" id="form1Example15" class="form-control" />
                            <label class="form-label" for="form1Example14">ID</label>
                        </div>

                        <div class="text-center">
                            <h4>Enter the new Company Manager Details</h4>
                        </div>
                        <hr>

                        <!-- FName input -->
                        <div class="form-outline mb-4">
                            <input type="text" name="Q22FName" id="form1Example16" class="form-control" />
                            <label class="form-label" for="form1Example16">First Name</label>
                        </div>

                        <!-- LName input -->
                        <div class="form-outline mb-4">
                            <input type="text" name="Q22LName" id="form1Example16" class="form-control" />
                            <label class="form-label" for="form1Example16">Last Name</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <input type="password" name="Q22Pass" id="form1Example19" class="form-control" />
                            <label class="form-label" for="form1Example19">Password</label>
                        </div>

                        <!-- SuperID must be set to Employee ID -->

                        <!-- Submit button -->
                        <button type="submit" name="ModifyCompanyManager" class="btn btn-primary btn-block">Submit</button>
                        <br>
                    </form>

                    <?php

                                if(isset($_POST['ModifyCompanyManager'])){

                                    //Read Stored proc with param
                                    $tsql = "{call changeDEDetails(?,?,?,?)}";

                                    // Getting parameter from the http call and setting it for the SQL call
                                    $params = array(
                                        array($_POST['Q22FName']),
                                        array($_POST['Q22LName']),
                                        array($_POST['Q22ID']),
                                        array($_POST['Q22Pass'])
                                    );

                                    $time_start = microtime(true);
                                    $getResults = sqlsrv_query($conn, $tsql, $params);
                                    $time_end = microtime(true);
                                    //echo ("Results:<br/>");
                                    if ($getResults == FALSE)
                                        die(FormatErrors(sqlsrv_errors()));

                                    PrintResultSet($getResults);
                                    // Free query  resources. 
                                    sqlsrv_free_stmt($getResults);

                                    $execution_time = round((($time_end - $time_start) * 1000), 2);
                                    echo 'QueryTime: ' . $execution_time . ' ms';

                                }

                                ?>

                </div>
            </div>
        </div>

        <!-- THIS IS THE 6TH CHOICE -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingSix">
                <button class="accordion-button collapsed" type="button" data-mdb-toggle="collapse" data-mdb-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                    View questions of a certain questionnaire
                </button>
            </h2>
            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-mdb-parent="#accordionExample">
                <div class="accordion-body">

                    <form method="post" class="w-25 p-3" style="margin-left: 37.5%;">
                        <div class="text-center">
                            <h4>Enter Questionnaire number to view Questions</h4>
                        </div>
                        <hr>

                        <!-- Qnum input -->
                        <div class="form-outline mb-4">
                            <input type="number" name="A6Qnum" id="form1Example20" class="form-control" />
                            <label class="form-label" for="form1Example20">Questionnaire Number</label>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" name="ViewQuestion" class="btn btn-primary btn-block">Search</button>
                        <br>
                    </form>

                    <?php
                    if(isset($_POST['ViewQuestion'])){

                        //Read Stored proc with param
                        $tsql = "{call displayQuestionnaireMCQQ(?)}";

                        // Getting parameter from the http call and setting it for the SQL call
                        $params = array(
                            array((int)$_POST['A6Qnum'])
                        );

                        $time_start = microtime(true);
                        $getResults = sqlsrv_query($conn, $tsql, $params);
                        $time_end = microtime(true);
                        //echo ("Results:<br/>");
                        if ($getResults == FALSE)
                            die(FormatErrors(sqlsrv_errors()));

                        PrintResultSet($getResults);
                        // Free query  resources. 
                        sqlsrv_free_stmt($getResults);

                        $execution_time = round((($time_end - $time_start) * 1000), 2);
                        echo 'QueryTime: ' . $execution_time . ' ms';


                        //Read Stored proc with param
                        $tsql = "{call displayQuestionnaireNumericalQ(?)}";

                        // Getting parameter from the http call and setting it for the SQL call
                        $params = array(
                            array((int)$_POST['A6Qnum'])
                        );

                        $time_start = microtime(true);
                        $getResults = sqlsrv_query($conn, $tsql, $params);
                        $time_end = microtime(true);
                        //echo ("Results:<br/>");
                        if ($getResults == FALSE)
                            die(FormatErrors(sqlsrv_errors()));

                        PrintResultSet($getResults);
                        // Free query  resources. 
                        sqlsrv_free_stmt($getResults);

                        $execution_time = round((($time_end - $time_start) * 1000), 2);
                        echo 'QueryTime: ' . $execution_time . ' ms';



                        //Read Stored proc with param
                        $tsql = "{call displayQuestionnaireFreeTextQ(?)}";

                        // Getting parameter from the http call and setting it for the SQL call
                        $params = array(
                            array((int)$_POST['A6Qnum'])
                        );

                        $time_start = microtime(true);
                        $getResults = sqlsrv_query($conn, $tsql, $params);
                        $time_end = microtime(true);
                        //echo ("Results:<br/>");
                        if ($getResults == FALSE)
                            die(FormatErrors(sqlsrv_errors()));

                        PrintResultSet($getResults);
                        // Free query  resources. 
                        sqlsrv_free_stmt($getResults);

                        $execution_time = round((($time_end - $time_start) * 1000), 2);
                        echo 'QueryTime: ' . $execution_time . ' ms';

                        }

                        ?>

                </div>
            </div>
        </div>

        <!-- THIS IS THE 7TH CHOICE -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingSeven">
                <button class="accordion-button collapsed" type="button" data-mdb-toggle="collapse" data-mdb-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                    View details of a certain questionnaire
                </button>
            </h2>
            <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-mdb-parent="#accordionExample">
                <div class="accordion-body">

                    <form method="post" class="w-25 p-3" style="margin-left: 37.5%;">
                        <div class="text-center">
                            <h4>Enter Details to view Questionnaire</h4>
                        </div>
                        

                        <!-- Qnum input -->
                        <div class="form-outline mb-4">
                            <input type="number" name="A7QairNum" id="form1Example21" class="form-control" />
                            <label class="form-label" for="form1Example21">Questionnaire Number</label>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" name="ViewQuestionnaire" class="btn btn-primary btn-block">Search</button>
                        
                    </form>

                    <?php

                                if(isset($_POST['ViewQuestionnaire'])){

                                    //Read Stored proc with param
                                    $tsql = "{call showQuestionaireDetails(?)}";

                                    // Getting parameter from the http call and setting it for the SQL call
                                    $params = array(
                                        array((int)$_POST['A7QairNum'])
                                    );

                                    $time_start = microtime(true);
                                    $getResults = sqlsrv_query($conn, $tsql, $params);
                                    $time_end = microtime(true);
                                    //echo ("Results:<br/>");
                                    if ($getResults == FALSE)
                                        die(FormatErrors(sqlsrv_errors()));

                                    PrintResultSet($getResults);
                                    // Free query  resources. 
                                    sqlsrv_free_stmt($getResults);

                                    $execution_time = round((($time_end - $time_start) * 1000), 2);
                                    echo 'QueryTime: ' . $execution_time . ' ms';

                                }

                                ?>

                </div>
            </div>
        </div>
    </div>

    <!-- <br>
    <br>
    <br> -->

    <!-- Titles METAVATIKI STADIO EPILOGON-KOUMPION-->
    <div class="text-center page-header w-50 " style="margin-left: 25.5%;">
        <h3>Additional options for specific company</h3>
    </div>

        <?php
        // Get the company id we want to view options for to use in the sprocs below
            if (isset($_POST['ViewShowOptions'])) {
                $_SESSION['CompanyID'] = $_POST['VRegNum'];
            }
        
            if(isset($_SESSION['CompanyID'])){
                echo '<h5 class="text-center text-danger">Currently Selected Company ID is '.$_SESSION['CompanyID'].'</h5>';
            }
        ?>

    <!-- Last Button to view the company manager and simple user options -->
    <div>
        <!-- Buttons do not work -->
        <form method="post" class="w-25 p-5" style="margin-left: 37.5%;">
            <div class="text-center">
                <h4>Enter company number and click one of the option buttons below</h4>
            </div>
            <hr>

            <!-- CompanyID input -->
            <div class="form-outline mb-4">
                <input type="number" name="VRegNum" id="form1Example21" class="form-control" />
                <label class="form-label" for="form1Example21">Company ID Number</label>
            </div>
            <button type="submit" name="ViewShowOptions" href="ObserverHomePage.php" class="btn btn-primary btn-block">Submit</button>
        </form>


    </div>

    <!-- Add the buttons. Q15 AND Q17 need to input a value x as well -->
    <form method="POST">
        <button type="submit" name="QairesReport" class="btn btn-primary btn-block">View a report of all questionnaires</button>

        <button type="submit" name="PopularQuestions" class="btn btn-primary btn-block">Show popular questions</button>

        <button type="submit" name="QnumPerQaire" class="btn btn-primary btn-block">Show total question number of each questionnaire</button>

        <button type="submit" name="SmallQaires" class="btn btn-primary btn-block">Show small questionnaires</button>

        <button type="submit" name="BigQaires" class="btn btn-primary btn-block">Show big questionnaires</button>

        <button type="submit" name="AvgQuestions" class="btn btn-primary btn-block">Show average number of questions of company</button>

        <button type="submit" name="CommonQuestionsExactly" class="btn btn-primary btn-block">Show the questionnaires that have the exact same questions</button>

        <button type="submit" name="QuestionsInAllQaires" class="btn btn-primary btn-block">Show the questions that are in all questionnaires of the company</button>
    </form>

    <!-- <button type="submit" name="CommonQuestionsAtLeast" class="btn btn-primary btn-block">Show the questionnaires that include in them the same questions and more</button> -->

    <!-- Query 14 -->
    <form method="post" class="w-25 p-3" style="margin-left: 37.5%;">
        <div class="text-center">
            <h4>Questionnaires that include at least the questions of the questionnaire below</h4>
        </div>
        <hr>

        <!-- qID parameter input -->
        <div class="form-outline mb-4">
            <input type="number" name="qIDNumber" id="form1Example21" class="form-control" />
            <label class="form-label" for="form1Example21">Enter questionnaire ID</label>
        </div>
        <button type="submit" name="CommonQuestionsAtLeast" class="btn btn-primary btn-block">Search</button>
    </form>

    <!-- Query 15 -->
    <form method="post" class="w-25 p-3" style="margin-left: 37.5%;">
        <div class="text-center">
            <h4>Show k least included questions in questionnaires</h4>
        </div>
        <hr>

        <!-- k parameter input -->
        <div class="form-outline mb-4">
            <input type="number" name="kNumber" id="form1Example21" class="form-control" />
            <label class="form-label" for="form1Example21">Enter k parameter</label>
        </div>
        <button type="submit" name="kParameterQuestion" class="btn btn-primary btn-block">Search</button>
    </form>

    <!-- Query 17 -->
    <form method="post" class="w-25 p-3" style="margin-left: 37.5%;">
        <div class="text-center">
            <h4>Show total number of questions in a questionnaire including its child questionnaires</h4>
        </div>
        <hr>

        <!-- X parameter input -->
        <div class="form-outline mb-4">
            <input type="number" name="xNumber" id="form1Example21" class="form-control" />
            <label class="form-label" for="form1Example21">Enter Parent Questionnaire Number ID</label>
        </div>
        <button type="submit" name="XParameterQuestion" class="btn btn-primary btn-block mb-3">Search</button>
    </form>

    <!-- </div> -->

    <div class="w-50" style="margin-left: 25%;">
        <form method="post">
            <button type="submit" name="disconnect" class="btn btn-primary btn-block mb-3">Disconnect</button>
        </form>
    </div>
    <!-- </div> -->

    <?php
    //Q7
    if (isset($_POST['QairesReport'])) {
        $tsql = "{call QuestionnaireReport(?)}";

        $params = array(
            array((int)$_SESSION['CompanyID'])
        );

        $time_start = microtime(true);
        $getResults = sqlsrv_query($conn, $tsql, $params);
        $time_end = microtime(true);

        if ($getResults == FALSE)
            die(FormatErrors(sqlsrv_errors()));

        PrintResultSet($getResults);
        sqlsrv_free_stmt($getResults);

        $execution_time = round((($time_end - $time_start) * 1000), 2);
        echo 'QueryTime: ' . $execution_time . ' ms';
    }

    //Q8
    if (isset($_POST['PopularQuestions'])) {
        $tsql = "{call popularQuestions(?)}";

        $params = array(
            array((int)$_SESSION['CompanyID'])
        );

        $time_start = microtime(true);
        $getResults = sqlsrv_query($conn, $tsql, $params);
        $time_end = microtime(true);

        if ($getResults == FALSE)
            die(FormatErrors(sqlsrv_errors()));

        PrintResultSet($getResults);
        sqlsrv_free_stmt($getResults);

        $execution_time = round((($time_end - $time_start) * 1000), 2);
        echo 'QueryTime: ' . $execution_time . ' ms';
    }

    //Q9
    if (isset($_POST['QnumPerQaire'])) {
        $tsql = "{call questionsNumberPerQair(?)}";

        $params = array(
            array((int)$_SESSION['CompanyID'])
        );

        $time_start = microtime(true);
        $getResults = sqlsrv_query($conn, $tsql, $params);
        $time_end = microtime(true);

        if ($getResults == FALSE)
            die(FormatErrors(sqlsrv_errors()));

        PrintResultSet($getResults);
        sqlsrv_free_stmt($getResults);

        $execution_time = round((($time_end - $time_start) * 1000), 2);
        echo 'QueryTime: ' . $execution_time . ' ms';
    }

    //Q10
    if (isset($_POST['AvgQuestions'])) {
        $tsql = "{call averageQuestionsPerCompany(?)}";

        $params = array(
            array((int)$_SESSION['CompanyID'])
        );

        $time_start = microtime(true);
        $getResults = sqlsrv_query($conn, $tsql, $params);
        $time_end = microtime(true);

        if ($getResults == FALSE)
            die(FormatErrors(sqlsrv_errors()));

        PrintResultSet($getResults);
        sqlsrv_free_stmt($getResults);

        $execution_time = round((($time_end - $time_start) * 1000), 2);
        echo 'QueryTime: ' . $execution_time . ' ms';
    }

    //Q11
    if (isset($_POST['BigQaires'])) {
        $tsql = "{call bigQuestionnairesPerCompany(?)}";

        $params = array(
            array((int)$_SESSION['CompanyID'])
        );

        $time_start = microtime(true);
        $getResults = sqlsrv_query($conn, $tsql, $params);
        $time_end = microtime(true);

        if ($getResults == FALSE)
            die(FormatErrors(sqlsrv_errors()));

        PrintResultSet($getResults);
        sqlsrv_free_stmt($getResults);

        $execution_time = round((($time_end - $time_start) * 1000), 2);
        echo 'QueryTime: ' . $execution_time . ' ms';
    }

    //Q12
    if (isset($_POST['SmallQaires'])) {
        $tsql = "{call smallestQuestionnaires(?)}";

        $params = array(
            array((int)$_SESSION['CompanyID'])
        );

        $time_start = microtime(true);
        $getResults = sqlsrv_query($conn, $tsql, $params);
        $time_end = microtime(true);

        if ($getResults == FALSE)
            die(FormatErrors(sqlsrv_errors()));

        PrintResultSet($getResults);
        sqlsrv_free_stmt($getResults);

        $execution_time = round((($time_end - $time_start) * 1000), 2);
        echo 'QueryTime: ' . $execution_time . ' ms';
    }

    //Q13
    if (isset($_POST['CommonQuestionsExactly'])) {
        $tsql = "{call QairesWithSameQuestionsExactly(?)}";

        $params = array(
            array((int)$_SESSION['CompanyID'])
        );

        $time_start = microtime(true);
        $getResults = sqlsrv_query($conn, $tsql, $params);
        $time_end = microtime(true);

        if ($getResults == FALSE)
            die(FormatErrors(sqlsrv_errors()));

        PrintResultSet($getResults);
        sqlsrv_free_stmt($getResults);

        $execution_time = round((($time_end - $time_start) * 1000), 2);
        echo 'QueryTime: ' . $execution_time . ' ms';
    }

    //Q14
    if (isset($_POST['CommonQuestionsAtLeast'])) {
        $tsql = "{call SubsetQairsOfAQair(?,?)}";

        $params = array(
            array((int)$_POST['qIDNumber']),
            array((int)$_SESSION['CompanyID'])
        );

        $time_start = microtime(true);
        $getResults = sqlsrv_query($conn, $tsql, $params);
        $time_end = microtime(true);

        if ($getResults == FALSE)
            die(FormatErrors(sqlsrv_errors()));

        PrintResultSet($getResults);
        sqlsrv_free_stmt($getResults);

        $execution_time = round((($time_end - $time_start) * 1000), 2);
        echo 'QueryTime: ' . $execution_time . ' ms';
    }

    //Q15
    if (isset($_POST['kParameterQuestion'])) {
        $tsql = "{call kQuestionsLeastAppeared(?,?)}";

        $params = array(
            array((int)$_POST['kNumber']),
            array((int)$_SESSION['CompanyID'])
        );

        $time_start = microtime(true);
        $getResults = sqlsrv_query($conn, $tsql, $params);
        $time_end = microtime(true);

        if ($getResults == FALSE)
            die(FormatErrors(sqlsrv_errors()));

        PrintResultSet($getResults);
        sqlsrv_free_stmt($getResults);

        $execution_time = round((($time_end - $time_start) * 1000), 2);
        echo 'QueryTime: ' . $execution_time . ' ms';
    }

    //Q16
    if (isset($_POST['QuestionsInAllQaires'])) {
        $tsql = "{call QuestionsInAllQuestionnaires(?)}";

        $params = array(
            array((int)$_SESSION['CompanyID'])
        );

        $time_start = microtime(true);
        $getResults = sqlsrv_query($conn, $tsql, $params);
        $time_end = microtime(true);

        if ($getResults == FALSE)
            die(FormatErrors(sqlsrv_errors()));

        PrintResultSet($getResults);
        sqlsrv_free_stmt($getResults);

        $execution_time = round((($time_end - $time_start) * 1000), 2);
        echo 'QueryTime: ' . $execution_time . ' ms';
    }

    //Q17
    if (isset($_POST['XParameterQuestion'])) {
        $tsql = "{call DerivativesOfAQuestionnaire(?,?)}";

        $params = array(
            array((int)$_POST['xNumber']),
            array((int)$_SESSION['CompanyID'])
        );

        $time_start = microtime(true);
        $getResults = sqlsrv_query($conn, $tsql, $params);
        $time_end = microtime(true);

        if ($getResults == FALSE)
            die(FormatErrors(sqlsrv_errors()));

        PrintResultSet($getResults);
        sqlsrv_free_stmt($getResults);

        $execution_time = round((($time_end - $time_start) * 1000), 2);
        echo 'QueryTime: ' . $execution_time . ' ms';
    }
    ?>


    <?php
    if (isset($_POST['disconnect'])) {
        //echo "Clossing session and redirecting to start page"; 
        session_unset();
        session_destroy();
        die('<meta http-equiv="refresh" content="0; url=index.php" />');
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.0/mdb.min.js"></script>
</body>

</html>