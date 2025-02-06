<?php 
include('administrator_connection.php');
$user = $_POST['user'];
$email = $_POST['email'];
$category = $_POST['category'];
$scientific_name = $_POST['scientific_name'];
$common_name = $_POST['common_name'];
$confidence_rating = $_POST['confidence_rating'];
$id = $_POST['id'];

$sql = "UPDATE `Observation` SET `user`='$user',  `email`='$email', `category`='$category' , `scientific_name`= '$scientific_name', `conmmon_name`='$common_name',  `confidence_rating`='$confidence_rating' WHERE id='$id' ";

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