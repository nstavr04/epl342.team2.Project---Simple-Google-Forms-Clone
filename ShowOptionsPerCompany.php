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


        <!-- Last Button to view the company manager and simple user options -->
        <div class="p-3">
            <!-- Buttons do not work -->
            <div class="w-50" style="margin-left: 25.5%;">
            <button type="submit" name="disconnect" class="btn btn-primary btn-block">Disconnect</button>
            </div>
        </div>

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