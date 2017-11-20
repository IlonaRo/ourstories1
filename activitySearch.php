<?php
/*
	file:	ourstories_example/activitySearch.php
	desc:	Returns the list of avtivitíes as JSON
*/
header("Access-Control-Allow-Origin: * "); //all the UIs can access
if(!empty($_GET['search'])) $search=$_GET['search'].'%%';else $search='';
include('db.php');
$sql="SELECT DISTINCT * FROM activity 
		RIGHT JOIN area_activity ON activity.activityID=area_activity.activityID 
		JOIN community ON area_activity.communityID=community.communityID
		WHERE activity.activityName LIKE '$search'
		ORDER BY activityName";
		
$result = $conn->query($sql);
$output=array();
while($row=$result->fetch_assoc()){
	$output[]=$row;
}
if(!empty($search)) echo json_encode($output);
?>