<?php







// Initialize the session







ob_start();

session_start();





 







// Check if the user is already logged in, if yes then redirect him to welcome page







if(isset($_SESSION["loggedin"])){







    header("location: welcome.php");







    exit;







}







 







// Include config file







require_once "config.php";







 







// Define variables and initialize with empty values







$username = $password = "";







$username_err = $password_err = $login_err = "";







 







// Processing form data when form is submitted







if($_SERVER["REQUEST_METHOD"] == "POST"){







 







    // Check if username is empty







    if(empty(trim($_POST["username"]))){







        $username_err = "Please enter username.";







    } else{







        $username = trim($_POST["username"]);







    }







    







    // Check if password is empty







    if(empty(trim($_POST["password"]))){







        $password_err = "Please enter your password.";







    } else{







        $password = trim($_POST["password"]);







    }







    







    // Validate credentials







    if(empty($username_err) && empty($password_err)){







        // Prepare a select statement







        $sql = "SELECT id, username, password FROM User WHERE username = ?";







        







        if($stmt = mysqli_prepare($link, $sql)){







            // Bind variables to the prepared statement as parameters







            mysqli_stmt_bind_param($stmt, "s", $param_username);







            







            // Set parameters







            $param_username = $username;







            







            // Attempt to execute the prepared statement







            if(mysqli_stmt_execute($stmt)){







                // Store result







                mysqli_stmt_store_result($stmt);







                







                // Check if username exists, if yes then verify password







                if(mysqli_stmt_num_rows($stmt) == 1){                    







                    // Bind result variables







                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);







                    if(mysqli_stmt_fetch($stmt)){



                        if(password_verify($password, $hashed_password)){







                            // Password is correct, so start a new session







                            session_start();







                            







                            // Store data in session variables







                            $_SESSION["loggedin"] = true;







                            $_SESSION["id"] = $id;







                            $_SESSION["username"] = $username;                            



                            







                            // Redirect user to welcome page







                            header("location: welcome.php");







                        } else{







                            // Password is not valid, display a generic error message







                            $login_err = "Invalid username or password.";







                        }







                    }







                } else{







                    // Username doesn't exist, display a generic error message







                    $login_err = "Invalid username or password.";







                }







            } else{







                echo "Oops! Something went wrong. Please try again later.";







            }















            // Close statement







            mysqli_stmt_close($stmt);







        }







    }







    







    // Close connection







    mysqli_close($link);







}







 ?>







<!DOCTYPE html>
<html data-wf-page="62780ed2218d320677de382a" data-wf-site="6275555c1f0d902bf8e05f7f"> 

<head>
  <meta charset="utf-8">
  <title>Login</title>
  <meta content="Login" property="og:title">
  <meta content="Login" property="twitter:title">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <link href="css/normalize.css" rel="stylesheet" type="text/css">
  <link href="css/webflow.css" rel="stylesheet" type="text/css">
  <link href="css/mucs.webflow.css" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
  <script type="text/javascript">WebFont.load({  google: {    families: ["Montserrat:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"]  }});</script>
  <!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>

</head>
<body>
  <div data-animation="default" data-collapse="medium" data-duration="400" data-easing="ease" data-easing2="ease" role="banner" class="navbar-3 w-nav">
    <div class="w-container">
      <a href="index.php" class="brand-2 w-nav-brand"><img src="images/MUCS_logo.png" loading="lazy" width="111" alt="" class="image-4"></a>
  <meta charset="utf-8">





<br><br><br>


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">







  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>







  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>






<link rel="preconnect" href="https://fonts.googleapis.com">







<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>







<link href="https://fonts.googleapis.com/css2?family=Inter:wght@700&display=swap" rel="stylesheet">











<body style="background-color:#F6F6F6;">







</body>







<style>


    ul.nav a:hover { color: #EEB111 !important; }



	.login-form {



	width: 40%;



	height: 700px;


    	margin: 50px auto;
	
	}

	@media only screen and (max-width: 700px) {


	.login-form {



	width: 95%;



	height: 500%;


	overflow: scroll;
	
	}
	}




    .login-form form {



    	margin-bottom: 15px;



        background: #FFFFFF;



        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);



        padding: 30px;



    }
	@media only screen and (max-width: 1170px) {


    .login-form form {




        background: #FFFFFF;



        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);




    }
}





    .login-form h2 {



        margin: 0 0 15px;



    }



    .form-control, .btn {



        min-height: 38px;



        border-radius: 2px;



    }



    .btn {        



        font-size: 15px;



        font-weight: bold;



	   background-color: #EEB212;



    }







    







</style>



</head>


















<div class="login-form">

<br>

<br>

<br>



<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"> 

<br>


<p class="field-label" style="font-size:50px; text-align: center"><b>LOGIN</b></p>



<br>



<br>



 <div class="form-group">







<input type="text" class="text-field formbox w-input" id="username" name="username" placeholder="Username"/>







            </div>







            <div class="form-group">







<input type="password" class="text-field formbox w-input" id="password" name="password" placeholder="Password" autocomplete="new-password"/>







            </div>







            <div class="form-group">











<button type="submit" value="Login" class = "btn btn-primary btn-block" name="but_submit" id="but_submit">Login</button>







            </div>







<label class="pull-left checkbox-inline"><input type="checkbox"> Remember me</label>







 <a href="forgot-password.php" class="pull-right">Forgot Password?</a>



<br>



<br>



<br>



<br>











<p class="text-center"><a href="register.php">Create an Account</a></p>











        </div>







    </form>











</div>







</html>