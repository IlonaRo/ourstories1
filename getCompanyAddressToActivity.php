<?php
/*
	file:	getCompanyAddressToActivity.php
	desc:	Gets the company address from db
*/
if(!empty($_GET['area'])) $area=$_GET['area'].'%%';else $area='%%';
include('db.php');
$sql="SELECT * FROM company
			INNER JOIN companyactivity ON company.companyID=companyactivity.companyID
			INNER JOIN activity ON companyactivity.activityID=activity.activityID
			WHERE city LIKE '$area'";
$result = $conn->query($sql);
$JSONstring='{"companies":[';

$x=0;
while($row = $result->fetch_assoc()) {
	$JSONstring.='{';
	$JSONstring.='"Activityname":';
	$JSONstring.='"'.$row['activityName'].'",';
	$JSONstring.='"Companyname":';
	$JSONstring.='"'.$row['companyName'].'",';
	$JSONstring.='"Street":';
	$JSONstring.='"'.$row['street'].'",';
	$JSONstring.='"City":';
	$JSONstring.='"'.$row['city'].'",';
	$JSONstring.='"Web":';
	$JSONstring.='"'.$row['website'].'"';
	$x++;
	if($result->num_rows>$x) $JSONstring.='},';else $JSONstring.='}';
}
$conn->close();  

$JSONstring.=']}';
//return JSON
echo $JSONstring;
?>