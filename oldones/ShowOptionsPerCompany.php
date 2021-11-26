<?php 
	session_start();
    // Prevent someone with no access to enter via URL
    if(!isset($_SESSION['PersonType'])) { 
        echo '<h2 style="color:red">Access Denied</h2>'; 
        session_unset();
        session_destroy();
        die('<meta http-equiv="refresh" content="2; url=index.php" />');
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
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.0/mdb.min.css" rel="stylesheet"/>

    <title>Show Options</title>
  </head>

  <body>

        <!-- Titles -->
        <div class="text-center page-header">
                <br>
                <h2>This is the show options page for a specific company</h2>
                <hr>
        </div>

        <div class="text-center page-header w-50 " style="margin-left: 25.5%;">
            <h3>Pick one of the options below</h3>
            <hr>
            <br>
        </div>

        <!-- Add the buttons. Q15 AND Q17 need to input a value x as well -->

        <div class="p-3">
            <button type="submit" name="QairesReport" class="btn btn-primary btn-block">View a report of all questionnaires</button>
            <br>
            <button type="submit" name="PopularQuestions" class="btn btn-primary btn-block">Show popular questions</button>
            <br>
            <button type="submit" name="QnumPerQaire" class="btn btn-primary btn-block">Show total question number of each questionnaire</button>
            <br>
            <button type="submit" name="SmallQaires" class="btn btn-primary btn-block">Show small questionnaires</button>
            <br>
            <button type="submit" name="BigQaires" class="btn btn-primary btn-block">Show big questionnaires</button>
            <br>
            <button type="submit" name="AvgQuestions" class="btn btn-primary btn-block">Show average number of questions of company</button>
            <br>
            <button type="submit" name="CommonQuestionsExactly" class="btn btn-primary btn-block">Show the questionnaires that have the exact same questions</button>
            <br>
            <button type="submit" name="CommonQuestionsAtLeast" class="btn btn-primary btn-block">Show the questionnaires that include in them the same questions and more</button>
            <br>
            <button type="submit" name="QuestionsInAllQaires" class="btn btn-primary btn-block">Show the questions that are in all questionnaires of the company</button>
            <br>

            <form method="post" class="w-25 p-3" style="margin-left: 37.5%;">
                <div class = "text-center"><h4>Show k least included questions in questionnaires</h4></div>
                                <hr>

                            <!-- k parameter input --> 
                            <div class="form-outline mb-4">
                                <input type="number" name="kNumber" id="form1Example21" class="form-control" />
                                <label class="form-label" for="form1Example21">Enter k parameter</label>
                            </div> 
                <button type="submit" name="kParameterQuestion" class="btn btn-primary btn-block">Search</button>
            </form>

            <form method="post" class="w-25 p-3" style="margin-left: 37.5%;">
                <div class = "text-center"><h4>Show total number of questions in a questionnaire including its child questionnaires</h4></div>
                                <hr>

                            <!-- X parameter input --> 
                            <div class="form-outline mb-4">
                                <input type="number" name="xNumber" id="form1Example21" class="form-control" />
                                <label class="form-label" for="form1Example21">Enter Parent Questionnaire Number ID</label>
                            </div> 
                <button type="submit" name="XParameterQuestion" class="btn btn-primary btn-block">Search</button>
            </form>

        </div>

        <!-- Last Button to view the company manager and simple user options -->
        <div class="p-3">
            <!-- Buttons do not work -->
            <div class="w-50" style="margin-left: 25.5%;">
            <form method="post">
            <button type="submit" name="disconnect" class="btn btn-primary btn-block">Disconnect</button>
            </form>
            </div>
        </div>

    <?php
		if(isset($_POST['disconnect'])) { 
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