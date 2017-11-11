<?php
/*
	file:	ourstories_example/selectedStory.php
	desc:	Returns the selected story as JSON
*/
header("Access-Control-Allow-Origin: * "); //all the UIs can access
$error=false;
if(!empty($_GET['storyID'])) $storyID=$_GET['storyID'];else $error=true;
include('db.php');
$sql="SELECT * FROM story WHERE storyID=$storyID ORDER BY storyTitle";
$result = $conn->query($sql);
$output=array();
while($row=$result->fetch_assoc()){
	$output[]=$row;
}
if(!$error) echo json_encode($output);
?>