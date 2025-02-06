<?php 
include('connection.php');
$user = $_POST['user'];
$email = $_POST['email'];
$category = $_POST['category'];
$scientific_name = $_POST['scientific_name'];
$common_name = $_POST['common_name'];
$confidence_rating = $_POST['confidence_rating'];

$sql = "INSERT INTO `Observation` (`user`,`email`,`category`,`scientific_name`, `common_name`, `confidence_rating`) values ('$user', '$email', '$category', '$scientific_name', '$common_name', '$confidence_rating')";
$query= mysqli_query($con,$sql);
$lastId = mysqli_insert_id($con);
if($query ==true)
{
   
    $data = array(
        'status'=>'true',
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'false',
      
    );

    echo json_encode($data);
} 

?>