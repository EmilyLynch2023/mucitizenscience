<?php 
include('administrator_connection.php');
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$username = $_POST['username'];
$email = $_POST['email'];
$account_type = $_POST['account_type'];
$id = $_POST['id'];

$sql = "UPDATE `User` SET `first_name`='$first_name',  `last_name`='$last_name', `username`='$username' , `email`= '$email', `account_type`='$account_type' WHERE id='$id' ";
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