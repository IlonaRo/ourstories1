<?php
/*
	file:	getCompanyAddressTostory.php
	desc:	Gets the company address from db
*/
if(!empty($_GET['area'])) $area=$_GET['area'].'%%';else $area='%%';
include('db.php');
$sql="SELECT * FROM company
			INNER JOIN companystory ON company.companyID=companystory.companyID
			INNER JOIN story ON companystory.storyID=story.storyID
			WHERE city LIKE '$area'";
$result = $conn->query($sql);
$JSONstring='{"companys":[';

$x=0;
while($row = $result->fetch_assoc()) {
$JSONstring.='{';
	$JSONstring.='"Story":';
	$JSONstring.='"'.$row['storyTitle'].'",';
	$JSONstring.='"Companyname":';
	$JSONstring.='"'.$row['companyName'].'",';
	$JSONstring.='"Street":';
	$JSONstring.='"'.$row['street'].'",';
	$JSONstring.='"City":';
	$JSONstring.='"'.$row['city'].'",';
	$JSONstring.='"Web":';
	$JSONstring.='"'.$row['storyLink'].'"';
	$x++;
	if($result->num_rows>$x) $JSONstring.='},';else $JSONstring.='}';
}
$conn->close();  

$JSONstring.=']}';
//return JSON
echo $JSONstring;
?>
