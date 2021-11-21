<?php 
	session_start(); 
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

    <title>Login Page</title>
  </head>

  <body>
  <?php
  // If the db credentials are empty you will get this error message and be redirected back to the index page 

	if (isset($_POST['connect'])) {
		echo "<br/><center>Setting session variables...</center><br/>";
		// collect value of input field
		$sqlDBname = $_POST['dbName'];
		$sqlUser = $_POST['userName'];
		$sqlPass = $_POST['pswd'];
	
		if (empty($sqlDBname)) echo "Database name is empty!<br/>";
		if (empty($sqlUser)) echo "Username is empty!<br/>";
		if (empty($sqlPass)) echo "Password name is empty!<br/>";

		if (!(empty($sqlDBname) || empty($sqlUser) || empty($sqlPass))) {
			// Set session variables
			$_SESSION["serverName"] = "universitycsdbnstavr04.database.windows.net";
			$_SESSION["connectionOptions"] = array(
				"Database" => $sqlDBname,
				"Uid" => $sqlUser,
				"PWD" => $sqlPass
			);
		} else {
			session_unset();
			session_destroy();
			echo "<br/>Cannot setup the session variables! Redirecting back in 5 seconds<br/>";
			die('<meta http-equiv="refresh" content="5; url=index.php" />');
		}
	}
    ?>

<!-- The main page code -->

    <form action="ObserverHomePage.php" method="post" class="w-25 p-3" style="margin-left: 37.5%;"> 
        <div class = "text-center"><h4>Enter your login credentials</h4></div>
        <hr>

    <!-- Username input --> 
    <div class="form-outline mb-4">
        <input type="text" name="LoginUserName" id="form1Example1" class="form-control" />
        <label class="form-label" for="form1Example1">Username</label>
    </div>

    <!-- Password input -->
    <div class="form-outline mb-4">
        <input type="password" name="LoginPswd" id="form1Example2" class="form-control" />
        <label class="form-label" for="form1Example2">Password</label>
    </div>

    <!-- Submit button -->
    <button type="submit" name="LoginConnect" class="btn btn-primary btn-block">Login</button>
    <br>
    <button type="submit" name="disconnect" class="btn btn-primary btn-block">Disconnect</button>
    </form>


	<?php
		if(isset($_POST['disconnect'])) { 
			echo "Clossing session and redirecting to start page"; 
			session_unset();
			session_destroy();
			die('<meta http-equiv="refresh" content="2; url=index.php" />');
		} 
	?> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.0/mdb.min.js"></script>
    </body>
</html>