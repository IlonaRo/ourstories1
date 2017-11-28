<?php
/*
	file:	ourstories_example/activityDefault.php
	desc:	Returns the list of companies as JSON
*/
header("Access-Control-Allow-Origin: * "); //all the UIs can access
include('db.php');
$sql="SELECT * FROM activity 		
		ORDER BY activityName";
$result3 = $conn->query($sql);
$output=array();
while($row=$result3->fetch_assoc()){
	$output[]=$row;
}
echo json_encode($output);
?>