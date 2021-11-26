<!-- <html>
<head>
	<title>EPL342 project test page</title>
</head>
<body>

	<table cellSpacing=0 cellPadding=5 width="100%" border=0>
	<tr>
		<td vAlign=top width=170><img height=91 alt=UCY src="images/ucy.jpg" width=94>
			<h5>
				<a href="http://www.ucy.ac.cy/">University of Cyprus</a><BR/>
				<a href="http://www.cs.ucy.ac.cy/">Dept. of Computer Science</a>
			</h5>
		</td>
		<td vAlign=center align=middle><h2>Welcome to the EPL342 project test page</h2></td>
	</tr>
    </table>
	<hr>
    
    Please give the SQL DB, username and password to connect to:
    <form action="connect.php" method="post">
	Database: <input type="text" name="dbName"><br>
    Username: <input type="text" name="userName"><br>
    Password: <input type="password" name="pswd"><br>
    <input type="submit" name="connect"> 
    </form>
</body>

</html> -->

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

    <title>Enter DB Credentials</title>
  </head>

  <body>
	
	<div class="text-center page-header">
		<br>
		<h1>Welcome to EPL342 Team2 Project</h1>
		<hr>
	</div>
	<br>

	<form action="loginPage.php" method="post" class="w-25 p-3" style="margin-left: 37.5%;"> 
	<div class = "text-center"><h4>Enter Database Credentials</h4></div>
	<hr>
  <!-- Database Name input -->
  <div class="form-outline mb-4">
    <input type="text" name="dbName" id="form1Example1" class="form-control" />
    <label class="form-label" for="form1Example1">Database Name</label>
  </div>

  <!-- Username input --> 
  <div class="form-outline mb-4">
    <input type="text" name="userName" id="form1Example2" class="form-control" />
    <label class="form-label" for="form1Example2">Database Username</label>
  </div>

  <!-- Password input -->
  <div class="form-outline mb-4">
    <input type="password" name="pswd" id="form1Example2" class="form-control" />
    <label class="form-label" for="form1Example3">Database Password</label>
  </div>

  <!-- Submit button -->
  <button type="submit" name="connect" class="btn btn-primary btn-block">Enter</button>
</form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.0/mdb.min.js"></script>
</body>
</html>

