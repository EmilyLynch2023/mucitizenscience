<?php



// Initialize the session



ob_start();



 



// Check if the user is logged in, otherwise redirect to login page



// if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){



//    header("location: index.php");



//    exit;



//}



 



// Include config file



require_once "config.php";



 



// Define variables and initialize with empty values





$new_password = $confirm_password = $username = "";



$new_password_err = $confirm_password_err = $username_err = "";



 



// Processing form data when form is submitted



if($_SERVER["REQUEST_METHOD"] == "POST"){



     if(empty(trim($_POST["username"]))){



        $username_err = "Please enter a username.";     



    } else{



        $username = trim($_POST["username"]);



    }



    // Validate new password



    if(empty(trim($_POST["new_password"]))){



        $new_password_err = "Please enter the new password.";     



    } elseif(strlen(trim($_POST["new_password"])) < 6){



        $new_password_err = "Password must have atleast 6 characters.";



    } else{



        $new_password = trim($_POST["new_password"]);



    }



    



    // Validate confirm password



    if(empty(trim($_POST["confirm_password"]))){



        $confirm_password_err = "Please confirm the password.";



    } else{



        $confirm_password = trim($_POST["confirm_password"]);



        if(empty($new_password_err) && ($new_password != $confirm_password)){



            $confirm_password_err = "Password did not match.";



        }



    }



        



    // Check input errors before updating the database



    if(empty($new_password_err) && empty($confirm_password_err)){



        // Prepare an update statement



        $sql = "UPDATE User SET password = ? WHERE username = ?";



        



        if($stmt = mysqli_prepare($link, $sql)){



            // Bind variables to the prepared statement as parameters



            mysqli_stmt_bind_param($stmt, "ss", $param_password, $param_username);



            



            // Set parameters



            $param_password = password_hash($new_password, PASSWORD_DEFAULT);



            $param_username = $username;



            



            // Attempt to execute the prepared statement



            if(mysqli_stmt_execute($stmt)){



                // Password updated successfully. Destroy the session, and redirect to login page



                session_destroy();



                header("location: index.php");



                exit();



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
  <title>Forgot Password</title>
  <meta content="Forgort Password" property="og:title">
  <meta content="Forgot Password" property="twitter:title">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <link href="css/normalize.css" rel="stylesheet" type="text/css">
  <link href="css/webflow.css" rel="stylesheet" type="text/css">
  <link href="css/mucs.webflow.css" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
  <script type="text/javascript">WebFont.load({  google: {    families: ["Montserrat:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"]  }});</script>
  <!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
<style>
@media only screen and (max-width: 700px) {


	.wrapper {

	height: 400%;
	margin: 10%;
	overflow: scroll;
	
	}
	}
</style>

</head>
<body>
  <div data-animation="default" data-collapse="medium" data-duration="400" data-easing="ease" data-easing2="ease" role="banner" class="navbar-3 w-nav">
    <div class="w-container">
      <a href="index.php" class="brand-2 w-nav-brand"><img src="images/MUCS_logo.png" loading="lazy" width="111" alt="" class="image-4"></a>
  <meta charset="utf-8">

<br><br><br><br><br><br><br>

    <div class="wrapper">



        <h2 label class="field-label">Forgot Password</h2>



        <p class="field-label">Please fill out this form to reset your password.</p>

	<br>



        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

            <div class="form-group">



                <label for="username" class="field-label">Username</label>



                <input type="text" style= "width: 60%" name="username" class="text-field formbox w-input form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">



                <span class="invalid-feedback"><?php echo $username_err; ?></span>



            </div>



            <div class="form-group">



                <label for="new_password" class="field-label">New Password</label>



                <input type="password" style= "width: 60%" name="new_password" class="text-field formbox w-input form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">



                <span class="invalid-feedback"><?php echo $new_password_err; ?></span>



            </div>



            <div class="form-group">



                <label for="confirm_password" class="field-label" >Confirm Password</label>



                <input type="password" style= "width: 60%" name="confirm_password" class="text-field formbox w-input form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">



                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>



            </div>



            <div class="form-group">



                <input type="submit" style= "background-color:#EEB212" class="buttonstyle w-button" value="Submit">



                <a class="btn btn-link ml-2" href="welcome.php">Cancel</a>



            </div>



        </form>



    </div>    



</body>



</html>