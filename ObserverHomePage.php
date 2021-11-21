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

    <title>Observer Home Page</title>
  </head>

  <body>

        <!-- Titles -->
        <div class="text-center page-header">
                <br>
                <h2>Welcome to Observer Home Page</h2>
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
                <h2 class="accordion-header" id="headingOne">
                <button
                    class="accordion-button"
                    type="button"
                    data-mdb-toggle="collapse"
                    data-mdb-target="#collapseOne"
                    aria-expanded="true"
                    aria-controls="collapseOne"
                >
                    Add Company and Company Manager
                </button>
                </h2>
                <div
                id="collapseOne"
                class="accordion-collapse collapse"
                aria-labelledby="headingOne"
                data-mdb-parent="#accordionExample"
                >
                <div class="accordion-body">
                    

                    <!-- The first form for adding company -->
                    <form method="post" class="w-25 p-3" style="margin-left: 37.5%;"> 
                        <div class = "text-center"><h4>Enter Company Details</h4></div>
                        <hr>

                    <!-- RegNum input --> 
                    <div class="form-outline mb-4">
                        <input type="number" name="RegNum" id="form1Example1" class="form-control" />
                        <label class="form-label" for="form1Example1">Company Registration Number</label>
                    </div>

                    <!-- CName input -->
                    <div class="form-outline mb-4">
                        <input type="text" name="CName" id="form1Example2" class="form-control" />
                        <label class="form-label" for="form1Example2">Company Name</label>
                    </div>

                     <!-- The second form for adding company manager -->
                    <div class = "text-center"><h4>Enter Company Manager Details</h4></div>
                     <hr>

                    <!-- FName input --> 
                    <div class="form-outline mb-4">
                        <input type="text" name="FName" id="form1Example3" class="form-control" />
                        <label class="form-label" for="form1Example3">Username</label>
                    </div>

                    <!-- ID input --> 
                    <div class="form-outline mb-4">
                        <input type="number" name="ID" id="form1Example4" class="form-control" />
                        <label class="form-label" for="form1Example4">ID</label>
                    </div>

                    <!-- BirthDate input --> 
                    <div class="form-outline mb-4">
                        <input type="date" name="BirthDate" id="form1Example5" class="form-control" />
                        <label class="form-label" for="form1Example5">Birth Date</label>
                    </div>

                    <!-- Sex input --> 
                    <div class="form-outline mb-4">
                        <input type="number" name="Sex" id="form1Example6" min="0" max="1" class="form-control" />
                        <label class="form-label" for="form1Example6">Sex (0 for Male | 1 for Female)</label>
                    </div>

                    <!-- Username input --> 
                    <div class="form-outline mb-4">
                        <input type="text" name="UserName" id="form1Example7" class="form-control" />
                        <label class="form-label" for="form1Example7">Username</label>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" name="Pass" id="form1Example8" class="form-control" />
                        <label class="form-label" for="form1Example8">Password</label>
                    </div>

                    <!-- SuperID input -->
                    <div class="form-outline mb-4">
                        <input type="number" name="SuperID" id="form1Example9" class="form-control" />
                        <label class="form-label" for="form1Example9">Supervisor ID</label>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" name="CreateCompanyAndManager" class="btn btn-primary btn-block">Submit</button>
                    <br>
                    </form>


                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                <button
                    class="accordion-button collapsed"
                    type="button"
                    data-mdb-toggle="collapse"
                    data-mdb-target="#collapseTwo"
                    aria-expanded="false"
                    aria-controls="collapseTwo"
                >
                    View details of a Company
                </button>
                </h2>
                <div
                id="collapseTwo"
                class="accordion-collapse collapse"
                aria-labelledby="headingTwo"
                data-mdb-parent="#accordionExample"
                >
                <div class="accordion-body">
                    
                    <form method="post" class="w-25 p-3" style="margin-left: 37.5%;"> 
                            <div class = "text-center"><h4>Enter Details to view Company</h4></div>
                            <hr>

                        <!-- RegNum input --> 
                        <div class="form-outline mb-4">
                            <input type="number" name="RegNum" id="form1Example10" class="form-control" />
                            <label class="form-label" for="form1Example10">Company Registration Number</label>
                        </div>

                        <!-- CName input -->
                        <div class="form-outline mb-4">
                            <input type="text" name="CName" id="form1Example11" class="form-control" />
                            <label class="form-label" for="form1Example11">Company Name</label>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" name="ViewCompany" class="btn btn-primary btn-block">Search</button>
                        <br>
                        </form>

                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                <button
                    class="accordion-button collapsed"
                    type="button"
                    data-mdb-toggle="collapse"
                    data-mdb-target="#collapseThree"
                    aria-expanded="false"
                    aria-controls="collapseThree"
                >
                    Modify details of a Company
                </button>
                </h2>
                <div
                id="collapseThree"
                class="accordion-collapse collapse"
                aria-labelledby="headingThree"
                data-mdb-parent="#accordionExample"
                >
                <div class="accordion-body">
                    
                        <form method="post" class="w-25 p-3" style="margin-left: 37.5%;"> 
                            <div class = "text-center"><h4>Enter Company Registration Number</h4></div>
                            <hr>

                        <!-- RegNum input --> 
                        <div class="form-outline mb-4">
                            <input type="number" name="RegNum" id="form1Example12" class="form-control" />
                            <label class="form-label" for="form1Example12">Company Registration Number</label>
                        </div>

                        <div class = "text-center"><h4>Enter the new Company Details</h4></div>
                            <hr>

                        <!-- CName input -->
                        <div class="form-outline mb-4">
                            <input type="text" name="CName" id="form1Example13" class="form-control" />
                            <label class="form-label" for="form1Example13">Company Name</label>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" name="ModifyCompany" class="btn btn-primary btn-block">Submit</button>
                        <br>
                        </form>

                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                <button
                    class="accordion-button collapsed"
                    type="button"
                    data-mdb-toggle="collapse"
                    data-mdb-target="#collapseFour"
                    aria-expanded="false"
                    aria-controls="collapseFour"
                >
                    View details of a Company Manager or User
                </button>
                </h2>
                <div
                id="collapseFour"
                class="accordion-collapse collapse"
                aria-labelledby="headingFour"
                data-mdb-parent="#accordionExample"
                >
                <div class="accordion-body">
                    
                        <form method="post" class="w-25 p-3" style="margin-left: 37.5%;"> 
                            <div class = "text-center"><h4>Enter User ID</h4></div>
                            <hr>

                        <!-- ID input --> 
                        <div class="form-outline mb-4">
                            <input type="number" name="ID" id="form1Example14" class="form-control" />
                            <label class="form-label" for="form1Example14">ID</label>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" name="ViewUser" class="btn btn-primary btn-block">Search</button>
                        <br>
                        </form>

                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFive">
                <button
                    class="accordion-button collapsed"
                    type="button"
                    data-mdb-toggle="collapse"
                    data-mdb-target="#collapseFive"
                    aria-expanded="false"
                    aria-controls="collapseFive"
                >
                    Modify details of a Company Manager
                </button>
                </h2>
                <div
                id="collapseFive"
                class="accordion-collapse collapse"
                aria-labelledby="headingFive"
                data-mdb-parent="#accordionExample"
                >
                <div class="accordion-body">
                    
                        <form method="post" class="w-25 p-3" style="margin-left: 37.5%;"> 
                            <div class = "text-center"><h4>Enter User ID</h4></div>
                            <hr>

                        <!-- ID input --> 
                        <div class="form-outline mb-4">
                            <input type="number" name="ID" id="form1Example15" class="form-control" />
                            <label class="form-label" for="form1Example14">ID</label>
                        </div>

                        <div class = "text-center"><h4>Enter the new Company Manager Details</h4></div>
                            <hr>

                            <!-- FName input --> 
                        <div class="form-outline mb-4">
                            <input type="text" name="FName" id="form1Example16" class="form-control" />
                            <label class="form-label" for="form1Example16">Username</label>
                        </div>                     

                        <!-- BirthDate input --> 
                        <div class="form-outline mb-4">
                            <input type="date" name="BirthDate" id="form1Example17" class="form-control" />
                            <label class="form-label" for="form1Example17">Birth Date</label>
                        </div>

                        <!-- Sex input --> 
                        <div class="form-outline mb-4">
                            <input type="number" name="Sex" id="form1Example18" min="0" max="1" class="form-control" />
                            <label class="form-label" for="form1Example6">Sex (0 for Male | 1 for Female)</label>
                        </div>

                        <!-- Username input --> 
                        <div class="form-outline mb-4">
                            <input type="text" name="UserName" id="form1Example18" class="form-control" />
                            <label class="form-label" for="form1Example7">Username</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <input type="password" name="Pass" id="form1Example19" class="form-control" />
                            <label class="form-label" for="form1Example19">Password</label>
                        </div>

                        <!-- SuperID must be set to ID -->                       

                        <!-- Submit button -->
                        <button type="submit" name="ModifyCompanyManager" class="btn btn-primary btn-block">Submit</button>
                        <br>
                        </form>


                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSix">
                <button
                    class="accordion-button collapsed"
                    type="button"
                    data-mdb-toggle="collapse"
                    data-mdb-target="#collapseSix"
                    aria-expanded="false"
                    aria-controls="collapseSix"
                >
                    View details of a certain question
                </button>
                </h2>
                <div
                id="collapseSix"
                class="accordion-collapse collapse"
                aria-labelledby="headingSix"
                data-mdb-parent="#accordionExample"
                >
                <div class="accordion-body">
                    
                        <form method="post" class="w-25 p-3" style="margin-left: 37.5%;"> 
                            <div class = "text-center"><h4>Enter Details to view Question</h4></div>
                            <hr>

                        <!-- Qnum input --> 
                        <div class="form-outline mb-4">
                            <input type="number" name="Qnum" id="form1Example20" class="form-control" />
                            <label class="form-label" for="form1Example20">Question Number</label>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" name="ViewQuestion" class="btn btn-primary btn-block">Search</button>
                        <br>
                        </form>

                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSeven">
                <button
                    class="accordion-button collapsed"
                    type="button"
                    data-mdb-toggle="collapse"
                    data-mdb-target="#collapseSeven"
                    aria-expanded="false"
                    aria-controls="collapseSeven"
                >
                View details of a certain questionnaire
                </button>
                </h2>
                <div
                id="collapseSeven"
                class="accordion-collapse collapse"
                aria-labelledby="headingSeven"
                data-mdb-parent="#accordionExample"
                >
                <div class="accordion-body">
                    
                        <form method="post" class="w-25 p-3" style="margin-left: 37.5%;"> 
                            <div class = "text-center"><h4>Enter Details to view Questionnaire</h4></div>
                            <hr>

                        <!-- Qnum input --> 
                        <div class="form-outline mb-4">
                            <input type="number" name="QairNum" id="form1Example21" class="form-control" />
                            <label class="form-label" for="form1Example21">Questionnaire Number</label>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" name="ViewQuestionnaire" class="btn btn-primary btn-block">Search</button>
                        <br>
                        </form>

                </div>
                </div>
            </div>
        </div>

        <br>

        <!-- Last Button to view the company manager and simple user options -->
        <div class="p-3">
            <!-- Buttons do not work -->
            <form method="post" class="w-25 p-3" style="margin-left: 37.5%;">
                <div class = "text-center"><h4>Enter company number to view additional show options</h4></div>
                                <hr>

                            <!-- RegNum input --> 
                            <div class="form-outline mb-4">
                                <input type="number" name="RegNum" id="form1Example21" class="form-control" />
                                <label class="form-label" for="form1Example21">Company Registration Number</label>
                            </div> 
                <button type="submit" name="ViewShowOptions" href="ObserverHomePage.php" class="btn btn-primary btn-block">View Company Manager and Simple User Options</button>
            </form>

            <br>
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