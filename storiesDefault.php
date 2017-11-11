<?php
/*
	file:	ourstories_example/storiesDefault.php
	desc:	Returns the list of companies as JSON
*/
header("Access-Control-Allow-Origin: * "); //all the UIs can access
if(!empty($_GET['search'])) $search=$_GET['search'];else $search='%%';
if(!empty($_GET['type'])) $type=$_GET['type'];else $type='';
if($type!='') $storytype=" AND storyType='$type'";else $storytype='';
include('db.php');
$sql="SELECT * FROM story ";
$sql.="WHERE (storyTitle LIKE '%%$search%%' OR storyKeywords LIKE '%%$search%%') ".$storytype ;
$sql.=" ORDER BY storyTitle";
$result = $conn->query($sql);
$output=array();
while($row=$result->fetch_assoc()){
	$output[]=$row;
}
echo json_encode($output);
?>