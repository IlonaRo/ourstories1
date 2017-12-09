<?php
/*
	file:	getcommunityAddressTostory.php
	desc:	Gets the community from db
*/
if(!empty($_GET['area'])) $area=$_GET['area'].'%%';else $area='%%';
include('db.php');
$sql="SELECT * FROM community
		INNER JOIN companyarea
		ON community.communityID=companyarea.communityID
		INNER JOIN company
		ON companyarea.companyID=company.companyID
		INNER JOIN companystory
		ON companystory.companyID=company.companyID
		INNER JOIN story
		ON companystory.storyID=story.storyID
		WHERE community.communityName LIKE '$area%%'";
$result = $conn->query($sql);
$JSONstring='{"communities":[';

$x=0;
while($row = $result->fetch_assoc()) {
	$JSONstring.='{';
	$JSONstring.='"Communityname":';
	$JSONstring.='"'.$row['communityName'].'",';
	$JSONstring.='"Country":';
	$JSONstring.='"'.$row['country'].'",';
	$JSONstring.='"Story":';
	$JSONstring.='"'.$row['storyTitle'].'",';
	$JSONstring.='"Street":';
	$JSONstring.='"'.$row['street'].'",';
	$JSONstring.='"City":';
	$JSONstring.='"'.$row['city'].'",';
	$JSONstring.='"Web":';
	$JSONstring.='"'.$row['storyLink'].'",';
	$x++;
	if($result->num_rows>$x) $JSONstring.='},';else $JSONstring.='}';
}
$conn->close();  

$JSONstring.=']}';
//return JSON
echo $JSONstring;
?>