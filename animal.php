<?php





session_start();

 

date_default_timezone_set('America/Indiana/Indianapolis');







//Check if the user is already logged in, if yes then redirect him to welcome page















//Include config file















require_once "config.php";















 















// Define variables and initialize with empty values











$scientific_name = $common_name = $count = $weather = $temperature = $latitude = $longitude = $date =  $time =$confidence = $imgContent = "";



$confidence_err = "";




// Processing form data when form is submitted



if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $userID = $_SESSION['id'];

        $user_email = $_SESSION['username'];

        $category = "Animal";

        $scientific_name = trim($_POST["species_name"]);

        $common_name = trim($_POST["common_name"]);

        $count = trim($_POST["count"]);

        $weather = $_POST["weather"];

        $temperature = trim($_POST["temperature"]);

        $latitude = trim($_POST["latitude"]);

        $longitude = trim($_POST["longitude"]);

        $date =  $_POST["date"];

        $time = $_POST["time"];





    if(empty($_POST["confidence"])){


        $confidence_err = "Please enter the confidence.";


    }else{

        $confidence = $_POST["confidence"];







    }



        $image = $_FILES['image']['tmp_name']; 



	$imgContent = addslashes(file_get_contents($image));











	$file = $_FILES['image'];



	$fileName = $_FILES['image']['name'];



	$fileTmpName = $_FILES['image']['tmp_name'];



	$fileSize = $_FILES['image']['size'];



	$fileError = $_FILES['image']['error'];



	$fileType = $_FILES['image']['type'];







	$fileExt = explode('.', $fileName);



	$fileActualExt = strtolower(end($fileExt));











		if ($fileError === 0) {



			$fileNameNew = uniqid('', true).".".$fileActualExt;



			$fileDestination = 'uploads/'.$fileNameNew;



			move_uploaded_file($fileTmpName, $fileDestination );

			



			$imgContent = $fileDestination;





			header("Location: animal.php?uploadsuccess");



		}else{



			echo "There was an error uploading this file!";



		}



		



























    // Check input errors before inserting in database







    if(empty($confidence_err)){







        







        // Prepare an insert statement







        $sql = "INSERT INTO Observation (`user`, email, category, scientific_name, common_name, count, weather, temperature, latitude, longitude, `date`, time, confidence_rating, image) VALUES ('$userID', '$user_email', '$category', '$scientific_name', '$common_name', '$count', '$weather', '$temperature', '$latitude', '$longitude', '$date', '$time', '$confidence', '$imgContent')";

         







        if($stmt = mysqli_prepare($link, $sql)){







            // Bind variables to the prepared statement as parameters











            if(mysqli_stmt_execute($stmt)){


		echo '<script type="text/JavaScript"> window.location.replace("confirmation.php"); </script>';

           
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
  <title>Animal Observation</title>
  <meta content="Animal Observation" property="og:title">
  <meta content="Animal Observation" property="twitter:title">
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
      <a href="welcome.php" class="brand-2 w-nav-brand"><img src="images/MUCS_logo.png" loading="lazy" width="111" alt="" class="image-4"></a>
      <nav role="navigation" class="nav-menu-3 w-nav-menu">
        <a href="welcome.php" class="button w-button"><strong class="bold-text">New Observation</strong></a>
        <a href="#" class="nav-link-5 w-nav-link">Contact Us</a>
        <a href="logout.php" class="nav-link-6 w-nav-link"><strong class="bold-text-2">Logout</strong></a>
      </nav>
      <div class="menu-button w-nav-button">
        <div class="icon-2 w-icon-nav-menu"></div>
      </div>
    </div>
  </div>
  <div class="section-5 wf-section">
    <div class="w-container">
      <h1 class="heading">Animal Observation</h1>
      <div class="text-block-4">MUCSÂ OBSERVATION</div>
    </div>
  </div>
  <div class="section-7 wf-section">
    <div class="w-container">
      <div class="w-layout-grid grid">
        <div id="w-node-b2a66be4-5573-891d-43bf-e386994f5d6f-77de382a" class="w-layout-grid grid-2">
          <h1 id="w-node-eba90d95-da5c-9d1a-b43a-62e61e7e9faf-77de382a" class="heading-3">Tips when making animal observations</h1>
          <div id="w-node-_72c255c3-ae10-2b21-82df-603a55660092-77de382a" class="div-block-6"></div>
          <div id="w-node-_703c7112-2156-2319-e027-a946612b5d27-77de382a" class="text-block-5"><strong>Be realistic</strong><br>It's important to be realistic when making observations. If you are not confident in the observation, make sure to rate your confidence rating on the lower scale.<br><br><strong>Photos increase quality of observations</strong><br>The best way for us to validate your observation are photos. We recommend -- whenever possible -- to include images of your provided observations. This helps our team confirm the animal recorded. <br> <br>
<img src="/images/MUCS_AnimalObservation.png" alt="Animal Photo Tips" width="500px">

</div>
        </div>
        <div id="w-node-_068b06dc-1860-6e75-e1e4-791cdd0c37b4-77de382a" class="w-form">


        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" redirect="www.mucs.bhweb.ws/welcome.php" data-redirect="www.mucs.bhweb.ws/welcome.php" method="post" class="form" autocomplete="off" enctype="multipart/form-data">

            <div class="form-group">

                <label for="species_name" class="field-label">SPECIES NAME</label>

                <input type="text" class="text-field formbox w-input" maxlength="256" name="species_name" data-name="species_name" placeholder="Species Name" id="species_name">

            </div>


            <div class="form-group">

                <label for="common_name" class="field-label">COMMON NAME</label>

                <input type="text" class="text-field formbox w-input" maxlength="256" name="common_name" data-name="common_name" placeholder="Common Name" id="common_name">

            </div> 



            <div class="form-group">

		<label for="count" class="field-label">COUNT</label>
		<input type="text" class="text-field formbox w-input" maxlength="256" name="count" data-name="count" placeholder="Estimated Count" id="count">

            </div> 



            <div class="form-group">

		<label for="latitude" class="field-label">LATITUDE</label>
		<input type="text" class="text-field formbox w-input" maxlength="256" name="latitude" data-name="latitude" placeholder="Latitude" id="latitude" value="">

            </div>     

            
	   <div class="form-group">

	    <label for="Longitude" class="field-label">LONGITUDE</label>
            <input type="text" class="text-field formbox w-input" maxlength="256" name="longitude" data-name="longitude" placeholder="Longitude" id="longitude" value="">

            </div>



            <div class="form-group">
		<label for="Date" class="field-label">DATE</label>
		<input type="date" value="<?php echo date('Y-m-d'); ?>" class="text-field formbox w-input" maxlength="256" name="date" data-name="date" placeholder="" id= "date">

            </div>



            <div class="form-group">

	<label for="Time" class="field-label">TIME</label>
	<input type="time" value="<?= date('h:i'); ?>" class="text-field formbox w-input" maxlength="256" name="time" data-name="time" placeholder="time" id="time">



            </div>



        <div class="form-group">

<label for="weather" class="field-label">WEATHER</label><select id="weather" name="weather" data-name="weather" class="select-field w-select">
        <option value="">Select one...</option>    

        <option value="Cloudy">Cloudy</option>

        <option value="Sunny">Sunny</option>

        <option value="Overcast">Overcast</option>

        <option value="Light Rain">Light Rain</option>

        <option value="Heavy Rain">Heavy Rain</option>

        <option value="Light Snow">Light Snow</option>

        <option value="Heavy Snow">Heavy Snow</option>

        <option value="Light Fog">Light Fog</option>

        <option value="Heavy Fog">Heavy Fog</option>

    </select>

        

            <div class="form-group">

		<input type="text" class="text-field formbox w-input" maxlength="256" name="temperature" data-name="temperature" placeholder="Temperature" id="temperature">

            </div>



        <div class="form-group">



       </select><label for="confidence" class="field-label">LEVELÂ OFÂ CONFIDENCE</label><select id="confidence" name="confidence" data-name="confidence" required="" class="select-field w-select">


	<option value="">Select one...</option>

        <option value="1">1 (Very Low Confidence)</option>

        <option value="2">2 (Low Confidence)</option>

        <option value="3">3 (Medium Confidence)</option>



        <option value="4">4 (High Confidence)</option>



        <option value="5">5 (Very High Confidence)</option>

    </select>



    </div>


    <div class = "form-group">

	<label for="image" class="field-label">UPLOAD IMAGE</label>

      <input class="text-field formbox w-input" type="file" name="image" select id="image" data-name="image">

        

	</div>

            <div class="form-group">



                <input type="submit" name = submit value="SUBMIT OBSERVATION" data-wait="Please wait..." class="buttonstyle w-button">





                <input type="reset" class="buttonstyle w-button" value="Reset">
		
		<button type="button" onclick="getLocation()" class = "buttonstyle w-button">Geolocate</button>





            </div>      


       </form>


    </div>
<div class="success-message w-form-done">
            <div><strong>Thank you! Your submission has been received!</strong></div>
          </div>
          <div class="w-form-fail">
            <div>Oops! Something went wrong while submitting the form.</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="section-2 wf-section">
    <div class="w-container">
      <div class="div-block-2"></div>
    </div>
  </div>

  <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=6275555c1f0d902bf8e05f7f" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="js/webflow.js" type="text/javascript"></script>

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script>
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          $('#imgPlaceholder').attr('src', e.target.result);
        }
        // base64 string conversion
        reader.readAsDataURL(input.files[0]);
      }
    }
    $("#chooseFile").change(function () {
      readURL(this);
    });

var Long = document.getElementById("longitude");
var Lat = document.getElementById("latitude");

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
  }
}

function showPosition(position) {  
  Lat.value = position.coords.latitude;
  Long.value = position.coords.longitude;
}

</script>

    </body>   
</html>