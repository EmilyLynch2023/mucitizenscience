<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$email = $username = $password = $confirm_password = $confidencerating = $firstname = $lastname = "";
$email_err = $username_err = $password_err = $confirm_password_err = $accounttype_err = $accountstatus_err = $confidencerating_err = $firstname_err = $lastname_err = "";
$accounttype="S";
$accountstatus="V";
    
// Processing form data when form is submitted
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    if(empty(trim($_POST["firstname"]))){
        $firstname_err = "Please enter your First Name.";
    }elseif(!preg_match('/^[a-zA-Z-]+$/', trim($_POST["firstname"]))){
        $firstname_err = "First Name can only contain letters and dashes.";
    }else{
        $firstname = trim($_POST["firstname"]);
    }

    if(empty(trim($_POST["lastname"]))){
        $lastname_err = "Please enter your Last Name.";
    }elseif(!preg_match('/^[a-zA-Z-]+$/', trim($_POST["lastname"]))){
        $lastname_err = "Last name can only contain letters and dashes.";
    }else{
        $lastname = trim($_POST["lastname"]);
    }

    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your Email.";
    }else{
        $email = trim($_POST["email"]);
    }

    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM User WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong when selecting a username. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    if(empty(trim($_POST["confidencerating"]))){
        $confidencerating_err = "Please enter your confidence rating.";
    }elseif(!preg_match('/^[1-5]{1}$/', trim($_POST["confidencerating"]))){
        $confidencerating_err = "Confidence rating can only contain a number from one (very low confidence) through five (very high confidence).";
    }else{
        $confidencerating = trim($_POST["confidencerating"]);
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($firstname_err) && empty($lastname_err) && empty($accounttype_err) && empty($accountstatus_err) && empty($confidencerating_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO User (email, username, password, account_type, account_status, first_name, last_name, confidence_rating) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssss", $param_email, $param_username, $param_password, $param_accounttype, $param_accountstatus, $param_firstname, $param_lastname, $param_confidencerating);
            
            // Set parameters
            $param_email = $email;
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); 
            $param_accounttype = $accounttype;
            $param_accountstatus = $accountstatus;
            $param_firstname = $firstname;
            $param_lastname = $lastname;
            $param_confidencerating = $confidencerating;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: index.php");
            } else{
                echo "Oops! Something went wrong when entering the data to the database. Please try again later.";
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
  <title>Register</title>
  <meta content="Register" property="og:title">
  <meta content="Register" property="twitter:title">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <link href="css/normalize.css" rel="stylesheet" type="text/css">
  <link href="css/webflow.css" rel="stylesheet" type="text/css">
  <link href="css/mucs.webflow.css" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
  <script type="text/javascript">WebFont.load({  google: {    families: ["Montserrat:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"]  }});</script>
  <!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
<style>
	.wrapper {
  	height: 1200%;
	width: 131.5%;
	overflow: scroll;
	}
@media only screen and (max-width: 700px) {


	.wrapper {

	height: 500%;
	width: 90%;
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
<br><br><br>

    <div class="wrapper">
	<br><br><br><br>
        <h2 class="field-label">Sign Up</h2>
        <p class="field-label">Please fill this form to create an account.</p>
	<br>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">
            <div class="form-group">
                <label for="firstname" class="field-label">First Name</label>
                <input type="text" style= "width: 60%" name="firstname" class="text-field formbox w-input form-control <?php echo (!empty($firstname_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $firstname_err; ?></span>
            </div> 

            <div class="form-group">
                <label for="lastname" class="field-label">Last Name</label>
                <input type="text" style= "width: 60%" name="lastname" class="text-field formbox w-input form-control <?php echo (!empty($lastname_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $lastname_err; ?></span>
            </div> 
            <div class="form-group">
                <label for="email" class="field-label">Email</label>
                <input type="text" style= "width: 60%" name="email" class="text-field formbox w-input form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div> 
            <div class="form-group">
                <label for="username" class="field-label">Username</label>
                <input type="text" style= "width: 60%" name="username" class="text-field formbox w-input form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>     
            <div class="form-group">
                <label for="password" class="field-label">Password</label>
                <input type="password" style= "width: 60%" name="password" class="text-field formbox w-input form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" >
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label for="password" class="field-label">Confirm Password</label>
                <input type="password" style= "width: 60%" name="confirm_password" class="text-field formbox w-input form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
                <div class="form-group">
                <label for="confidencerating" class="field-label">Confidence Rating</label>
                <input type="text" style= "width: 60%" name="confidencerating" class="text-field formbox w-input form-control <?php echo (!empty($confidencerating_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confidencerating_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" style= "background-color:#EEB212" name = submit class="buttonstyle w-button" value="Submit">
                <input type="reset" class="buttonstyle w-button" value="Reset">
            </div>
            <label class="field-label">Already have an account? <a href="index.php">Login here</a>.</p>
        </form>
    </div>    
</body>

</html>