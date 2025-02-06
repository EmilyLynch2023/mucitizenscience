<?php include('administrator_connection.php');

$output= array();
$sql = "SELECT * FROM Observation ";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'id',
	1 => 'user',
	2 => 'email',
	3 => 'category',
	4 => 'scientific_name',
	5 => 'common_name',
	6 => 'count',
	7 => 'weather',
	8 => 'temperature',
	9 => 'latitude',
	10 => 'longitude',
	11 => 'date',
	12 => 'time',
	13 => 'confidence_rating',
	14 => 'image',
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE user like '%".$search_value."%'";
	$sql .= " OR email like '%".$search_value."%'";
	$sql .= " OR category like '%".$search_value."%'";
	$sql .= " OR scientific_name like '%".$search_value."%'";
	$sql .= " OR common_name like '%".$search_value."%'";
	$sql .= " OR count like '%".$search_value."%'";
	$sql .= " OR weather like '%".$search_value."%'";
	$sql .= " OR temperature like '%".$search_value."%'";
	$sql .= " OR latitude like '%".$search_value."%'";
	$sql .= " OR longitude like '%".$search_value."%'";
	$sql .= " OR date like '%".$search_value."%'";
	$sql .= " OR time like '%".$search_value."%'";
	$sql .= " OR confidence_rating like '%".$search_value."%'";
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY id DESC";
}

if($_POST['length'] != -1)
{
	$start = $_POST['start'];
	$length = $_POST['length'];
	$sql .= " LIMIT  ".$start.", ".$length;
}	

$query = mysqli_query($con,$sql);
$count_rows = mysqli_num_rows($query);
$data = array();
while($row = mysqli_fetch_assoc($query))
{
	$sub_array = array();
	$sub_array[] = $row['id'];
	$sub_array[] = $row['user'];
	$sub_array[] = $row['email'];
	$sub_array[] = $row['category'];
	$sub_array[] = $row['scientific_name'];
	$sub_array[] = $row['common_name'];
	$sub_array[] = $row['count'];
	$sub_array[] = $row['weather'];
	$sub_array[] = $row['temperature'];
	$sub_array[] = $row['latitude'];
	$sub_array[] = $row['longitude'];
	$sub_array[] = $row['date'];
	$sub_array[] = $row['time'];
	$sub_array[] = $row['confidence_rating'];
	$image = '<img src="'.$row['image'].'" class="img-thumbnail" width="50" height="35" />';
	$sub_array[] = $image;

	$sub_array[] = '<a href="javascript:void();" data-id="'.$row['id'].'"  class="btn btn-info btn-sm editbtn" >Edit</a>  <a href="javascript:void();" data-id="'.$row['id'].'"  class="btn btn-danger btn-sm deleteBtn" >Delete</a>';
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
