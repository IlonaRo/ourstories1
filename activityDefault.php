<?php
/*
	file:	ourstories_example/activityDefault.php
	desc:	Returns the list of companies as JSON
*/
header("Access-Control-Allow-Origin: * "); //all the UIs can access
include('db.php');
$sql="SELECT * FROM activity ORDER BY activityName";
$result = $conn->query($sql);
$output=array();
while($row=$result->fetch_assoc()){
	$output[]=$row;
}
echo json_encode($output);
?>