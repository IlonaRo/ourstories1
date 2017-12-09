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
$sql="SELECT * FROM community
		INNER JOIN companyarea
		ON community.communityID=companyarea.communityID
		INNER JOIN company
		ON companyarea.companyID=company.companyID
		INNER JOIN companystory
		ON companystory.companyID=company.companyID
		INNER JOIN story
		ON companystory.storyID=story.storyID ";
$sql.="WHERE (communityName LIKE '%%$search%%') ".$storytype ;
$sql.="ORDER BY communityName";
$result = $conn->query($sql);
$output=array();
while($row=$result->fetch_assoc()){
	$output[]=$row;
}
echo json_encode($output);
?>