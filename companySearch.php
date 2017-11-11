<?php
/*
	file:	ourstories_example/companySearch.php
	desc:	Returns the list of companies as JSON
*/
header("Access-Control-Allow-Origin: * "); //all the UIs can access
if(!empty($_GET['search'])) $search=$_GET['search'].'%%';else $search='';
include('db.php');
$sql="SELECT DISTINCT * FROM company
	RIGHT JOIN companyarea
	ON company.companyID=companyarea.companyID
	JOIN community
	ON companyarea.communityID=community.communityID
	WHERE community.communityName LIKE '$search'";
$result = $conn->query($sql);
$output=array();
while($row=$result->fetch_assoc()){
	$output[]=$row;
}
if(!empty($search)) echo json_encode($output);
?>