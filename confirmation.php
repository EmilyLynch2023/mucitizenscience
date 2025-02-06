<?php

// Initialize the session

session_start();

 

// Check if the user is logged in, if not then redirect him to login page

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){

    header("location: index.php");

    exit;

}

?>
<html data-wf-page="6275555c1f0d9011a6e05f8d" data-wf-site="6275555c1f0d902bf8e05f7f">
<head>
  <meta charset="utf-8">
  <title>Mucs</title>
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta content="Webflow" name="generator">
  <link href="css/normalize.css" rel="stylesheet" type="text/css">
  <link href="css/webflow.css" rel="stylesheet" type="text/css">
  <link href="css/mucs.webflow.css" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
  <script type="text/javascript">WebFont.load({  google: {    families: ["Montserrat:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"]  }});</script>
  <!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
  <link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon">
  <link href="images/webclip.png" rel="apple-touch-icon">
</head>
<body class="body">
  <div class="section-11 wf-section">
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
    <div class="container-3 w-container">
      <h1 class="w-basic-heading heading-4">Your observation was submitted successfully!</h1>
    </div>
  </div>

<div>
<object style="display: block; margin-left: auto; margin-right: auto; width: 40%;" type="image/svg+xml" data="images/ThankYou.svg"></object>
</div>

<div>
<a href="welcome.php">
<button href="welcome.php" style="display: block; margin-left: auto; margin-right: auto; width: 40%;" class="buttonstyle w-button" type="button">RETURN TO HOME PAGE</button> </a>
</div>


  <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=6275555c1f0d902bf8e05f7f" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="js/webflow.js" type="text/javascript"></script>
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
</body>
</html>