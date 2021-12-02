<?php
session_start();
include 'dbsqlconnection.php';
include 'functions.php';
// Prevent someone with no access to enter via URL
if (!isset($_SESSION['PersonType']) || $_SESSION['PersonType'] != 0) {
    // print_r($_SESSION['USERINFO']);
    // $temp=$_SESSION['USERINFO'];
    echo '<h2 style="color:red">Access Denied</h2>';
    // echo $temp;
    session_unset();
    session_destroy();
    die('<meta http-equiv="refresh" content="2; url=index.php" />');
    // echo $temp;
}
?>
<!doctype html>
<html lang="en">

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

    <title>Simple User Home Page</title>
</head>

<body>

    <div class="text-center page-header">
        <br>
        <h2>Welcome to Simple User Home Page</h2>
        <hr>
    </div>

    <div class="text-center page-header w-50 " style="margin-left: 25.5%;">
        <h3>Pick one of the options below</h3>
        <hr>
        <br>
    </div>

    <!-- Accordion with options and forms in it -->

    <div class="accordion p-3" id="accordion">

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed" type="button" data-mdb-toggle="collapse" data-mdb-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    Create a Questionnaire
                </button>
            </h2>
            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-mdb-parent="#accordionExample">
                <div class="accordion-body">

                    <form method="post" class="w-25 p-3" style="margin-left: 37.5%;">
                        <div class="text-center">
                            <h4>Enter Questionnaire Details</h4>
                        </div>
                        <hr>

                        <!-- Title input -->
                        <div class="form-outline mb-4">
                            <input type="text" name="Title" id="form1Example16" class="form-control" />
                            <label class="form-label" for="form1Example16">Title</label>
                        </div>

                        <!-- Link needs to be set to null until we assign a url -->

                        <!-- QairState needs to be set to 0 -->

                        <!-- QairVersion needs to be set to 0 -->

                        <!-- Parent Title needs to be set to Title -->
                        <!-- What happens with clone? -->

                        <!-- QairNum input -->
                        <div class="form-outline mb-4">
                            <input type="number" name="QairNum" id="form1Example15" class="form-control" />
                            <label class="form-label" for="form1Example14">Questionnaire Number ID</label>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" name="CreateQuestionnaire" class="btn btn-primary btn-block">Submit</button>
                        <br>
                    </form>


                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingSix">
                <button class="accordion-button collapsed" type="button" data-mdb-toggle="collapse" data-mdb-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                    Modify an existing Questionnaire
                </button>
            </h2>
            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-mdb-parent="#accordionExample">
                <div class="accordion-body">

                    <!-- Add question -->
                    <form method="post" class="w-25 p-3" style="margin-left: 37.5%;">
                        <div class="text-center">
                            <h4>Enter Questionnaire ID</h4>
                        </div>
                        <hr>

                        <!-- QairNum input -->
                        <div class="form-outline mb-4">
                            <input type="number" name="QairNum" id="form1Example15" class="form-control" />
                            <label class="form-label" for="form1Example14">Questionnaire Number ID</label>
                        </div>

                        <div class="text-center">
                            <h4>Add a Question</h4>
                        </div>
                        <hr>

                        <!-- Qnum input -->
                        <div class="form-outline mb-4">
                            <input type="number" name="Qnum" id="form1Example16" class="form-control" />
                            <label class="form-label" for="form1Example16">Question Number</label>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" name="AddQuestionIntoQuestionnaire" class="btn btn-primary btn-block">Submit</button>
                        <br>
                    </form>

                    <br>
                    <br>

                    <!-- Remove a question -->
                    <form method="post" class="w-25 p-3" style="margin-left: 37.5%;">
                        <div class="text-center">
                            <h4>Enter Questionnaire ID</h4>
                        </div>
                        <hr>

                        <!-- QairNum input -->
                        <div class="form-outline mb-4">
                            <input type="number" name="QairNum" id="form1Example15" class="form-control" />
                            <label class="form-label" for="form1Example14">Questionnaire Number ID</label>
                        </div>

                        <div class="text-center">
                            <h4>Remove a Question</h4>
                        </div>
                        <hr>

                        <!-- Qnum input -->
                        <div class="form-outline mb-4">
                            <input type="number" name="Qnum" id="form1Example16" class="form-control" />
                            <label class="form-label" for="form1Example16">Question Number</label>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" name="RemoveQuestionFromQuestionnaire" class="btn btn-primary btn-block">Submit</button>
                        <br>
                    </form>

                    <br>
                    <br>

                    <!-- Swap a question -->
                    <form method="post" class="w-25 p-3" style="margin-left: 37.5%;">
                        <div class="text-center">
                            <h4>Enter Questionnaire ID</h4>
                        </div>
                        <hr>

                        <!-- QairNum input -->
                        <div class="form-outline mb-4">
                            <input type="number" name="QairNum" id="form1Example15" class="form-control" />
                            <label class="form-label" for="form1Example14">Questionnaire Number ID</label>
                        </div>

                        <div class="text-center">
                            <h4>Swap a Question</h4>
                        </div>
                        <hr>

                        <!-- Qnum input -->
                        <div class="form-outline mb-4">
                            <input type="number" name="Qnum" id="form1Example16" class="form-control" />
                            <label class="form-label" for="form1Example16">Old Question Question Number</label>
                        </div>

                        <!-- Qnum input -->
                        <div class="form-outline mb-4">
                            <input type="number" name="Qnum2" id="form1Example16" class="form-control" />
                            <label class="form-label" for="form1Example16">New Question Question Number</label>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" name="ReplaceQuestionFromQuestionnaire" class="btn btn-primary btn-block">Submit</button>
                        <br>
                    </form>

                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingSeven">
                <button class="accordion-button collapsed" type="button" data-mdb-toggle="collapse" data-mdb-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                    Create a Question
                </button>
            </h2>
            <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-mdb-parent="#accordionExample">
                <div class="accordion-body">

                    <form method="post" class="w-25 p-3" style="margin-left: 37.5%;">
                        <div class="text-center">
                            <h4>Enter Free Text Question Details</h4>
                        </div>
                        <hr>

                        <!-- Descr input -->
                        <div class="form-outline mb-4">
                            <input type="text" name="Descr" id="form1Example16" class="form-control" />
                            <label class="form-label" for="form1Example16">Description</label>
                        </div>

                        <!-- Qtext input -->
                        <div class="form-outline mb-4">
                            <input type="text" name="Qtext" id="form1Example16" class="form-control" />
                            <label class="form-label" for="form1Example16">Question text</label>
                        </div>

                        <!-- QNum input -->
                        <div class="form-outline mb-4">
                            <input type="number" name="QNum" id="form1Example15" class="form-control" />
                            <label class="form-label" for="form1Example14">Question Number ID</label>
                        </div>

                        <!-- User ID needs to be set manually -->

                        <!-- Submit button -->
                        <button type="submit" name="CreateFreeTextQuestion" class="btn btn-primary btn-block">Submit</button>
                        <br>
                    </form>

                    <br>
                    <br>

                    <form method="post" class="w-25 p-3" style="margin-left: 37.5%;">
                        <div class="text-center">
                            <h4>Enter Numerical Choice Question Details</h4>
                        </div>
                        <hr>

                        <!-- Descr input -->
                        <div class="form-outline mb-4">
                            <input type="text" name="Descr" id="form1Example16" class="form-control" />
                            <label class="form-label" for="form1Example16">Description</label>
                        </div>

                        <!-- Qtext input -->
                        <div class="form-outline mb-4">
                            <input type="text" name="Qtext" id="form1Example16" class="form-control" />
                            <label class="form-label" for="form1Example16">Question text</label>
                        </div>

                        <!-- QNum input -->
                        <div class="form-outline mb-4">
                            <input type="number" name="QNum" id="form1Example15" class="form-control" />
                            <label class="form-label" for="form1Example14">Question Number ID</label>
                        </div>

                        <!-- User ID needs to be set manually -->

                        <!-- UpperBounds input -->
                        <div class="form-outline mb-4">
                            <input type="number" name="UpperBounds" id="form1Example15" class="form-control" />
                            <label class="form-label" for="form1Example14">Set Upper Bounds | 0 if none</label>
                        </div>

                        <!-- LowerBounds input -->
                        <div class="form-outline mb-4">
                            <input type="number" name="LowerBounds" id="form1Example15" class="form-control" />
                            <label class="form-label" for="form1Example14">Set Lower Bounds | 0 if none</label>
                        </div>

                        <!-- WithBounds needs to be set manually -->

                        <!-- NCID needs to be set manually -->

                        <!-- Submit button -->
                        <button type="submit" name="CreateNumericalQuestion" class="btn btn-primary btn-block">Submit</button>
                        <br>
                    </form>

                    <br>
                    <br>

                    <form method="post" class="w-25 p-3" style="margin-left: 37.5%;">
                        <div class="text-center">
                            <h4>Enter Multiple Choice Question Details</h4>
                        </div>
                        <hr>

                        <!-- Descr input -->
                        <div class="form-outline mb-4">
                            <input type="text" name="Descr" id="form1Example16" class="form-control" />
                            <label class="form-label" for="form1Example16">Description</label>
                        </div>

                        <!-- Qtext input -->
                        <div class="form-outline mb-4">
                            <input type="text" name="Qtext" id="form1Example16" class="form-control" />
                            <label class="form-label" for="form1Example16">Question text</label>
                        </div>

                        <!-- QNum input -->
                        <div class="form-outline mb-4">
                            <input type="number" name="QNum" id="form1Example15" class="form-control" />
                            <label class="form-label" for="form1Example14">Question Number ID</label>
                        </div>

                        <!-- User ID needs to be set manually -->

                        <!-- Awnsers input -->
                        <div class="form-outline mb-4">
                            <input type="number" name="Awnser" id="form1Example15" class="form-control" />
                            <label class="form-label" for="form1Example14">Enter the awnsers | separate with ,</label>
                        </div>

                        <!-- Single Choice, MCID, AwnserID need to be set manually -->

                        <!-- Submit button -->
                        <button type="submit" name="CreateMultipleQuestion" class="btn btn-primary btn-block">Submit</button>
                        <br>
                    </form>

                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingEight">
                <button class="accordion-button collapsed" type="button" data-mdb-toggle="collapse" data-mdb-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                    Modify an existing Question
                </button>
            </h2>
            <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-mdb-parent="#accordionExample">
                <div class="accordion-body">

                    <form method="post" class="w-25 p-3" style="margin-left: 37.5%;">

                        <!-- For modify we need to check which type of question it is and act accordingly and that it matches the question id -->

                        <div class="text-center">
                            <h4>Enter Question Number ID to Delete</h4>
                        </div>
                        <hr>

                        <!-- QNum input -->
                        <div class="form-outline mb-4">
                            <input type="number" name="QNum" id="form1Example15" class="form-control" />
                            <label class="form-label" for="form1Example14">Question Number ID</label>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" name="DeleteQuestion" class="btn btn-primary btn-block">Submit</button>
                        <br>
                    </form>

                    <form method="post" class="w-25 p-3" style="margin-left: 37.5%;">
                        <div class="text-center">
                            <h4>Enter Question Details to Modify | Set only the details that apply to the question</h4>
                        </div>
                        <hr>

                        <!-- Descr input -->
                        <div class="form-outline mb-4">
                            <input type="text" name="Descr" id="form1Example20" class="form-control" />
                            <label class="form-label" for="form1Example20">Description</label>
                        </div>

                        <!-- Qtext input -->
                        <div class="form-outline mb-4">
                            <input type="text" name="Qtext" id="form1Example16" class="form-control" />
                            <label class="form-label" for="form1Example16">Question text</label>
                        </div>

                        <!-- User ID needs to be set manually -->

                        <!-- UpperBounds input -->
                        <div class="form-outline mb-4">
                            <input type="number" name="UpperBounds" id="form1Example15" class="form-control" />
                            <label class="form-label" for="form1Example14">Set Upper Bounds | 0 if none</label>
                        </div>

                        <!-- LowerBounds input -->
                        <div class="form-outline mb-4">
                            <input type="number" name="LowerBounds" id="form1Example15" class="form-control" />
                            <label class="form-label" for="form1Example14">Set Lower Bounds | 0 if none</label>
                        </div>

                        <!-- WithBounds needs to be set manually -->

                        <!-- NCID needs to be set manually -->

                        <!-- Awnsers input -->
                        <div class="form-outline mb-4">
                            <input type="number" name="Awnser" id="form1Example15" class="form-control" />
                            <label class="form-label" for="form1Example14">Enter the awnsers | separate with ,</label>
                        </div>

                        <!-- Single Choice, MCID, AwnserID need to be set manually -->

                        <!-- Submit button -->
                        <button type="submit" name="ModifyQuestion" class="btn btn-primary btn-block">Submit</button>
                        <br>
                    </form>

                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingNine">
                <button class="accordion-button collapsed" type="button" data-mdb-toggle="collapse" data-mdb-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                    Clone a Questionnaire
                </button>
            </h2>
            <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine" data-mdb-parent="#accordionExample">
                <div class="accordion-body">

                    <form method="post" class="w-25 p-3" style="margin-left: 37.5%;">
                        <div class="text-center">
                            <h4>Enter Questionnaire Number ID to clone</h4>
                        </div>
                        <hr>

                        <!-- QairNum input -->
                        <div class="form-outline mb-4">
                            <input type="number" name="QairNum" id="form1Example16" class="form-control" />
                            <label class="form-label" for="form1Example16">Questionnaire Number ID</label>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" name="CloneQuestionnaire" class="btn btn-primary btn-block">Submit</button>
                        <br>
                    </form>


                </div>
            </div>
        </div>
    </div>

    <br>
    <br>
    <!-- Titles -->
    <div class="text-center page-header w-50 " style="margin-left: 25.5%;">
        <?php
        echo '<h3>Additional options for the company. (Company ID = ' . $_SESSION['CompanyID'] . ')</h3>';
        ?>
        <hr>
        <br>
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
            <h4>Questionnaires that include the questions of the questionnaire below</h4>
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