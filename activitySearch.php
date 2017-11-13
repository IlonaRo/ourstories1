<?php
/*
	file:	ourstories_example/activitySearch.php
	desc:	Returns the list of avtivitíes as JSON
*/
header("Access-Control-Allow-Origin: * "); //all the UIs can access
if(!empty($_GET['search3'])) $search3=$_GET['search3'].'%%';else $search3='';
include('db.php');
$sql="SELECT DISTINCT * FROM activity
	";
$result = $conn->query($sql);
$output=array();
while($row=$result->fetch_assoc()){
	$output[]=$row;
}
if(!empty($search)) echo json_encode($output);
?>