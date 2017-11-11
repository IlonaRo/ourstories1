<?php
/*
	file:	admin/index.php
	desc:	Display the admin page if user is logged in
			checks that user is logged in and prevents 
			the page to be  saved any cache, proxy etc
*/
if(!empty($_GET['page'])) $page=$_GET['page'];else $page='';
session_start();
if(!isset($_SESSION['userID'])) header('location:../index.html');
header('Cache-control:no-store,no-cache,must-revalidate');
include('../db.php');
$sql="SELECT level FROM user WHERE userID=".$_SESSION['userID'];
$result=$conn->query($sql);  //runs the query in database
if($result->num_rows>0){
	$row=$result->fetch_assoc();
	$level=$row['level'];
}else header('location:../index.html');

?>
<!DOCTYPE html>
<html>
	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>User Database</title>
		<!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<!--jQuery-->
	<script src="../js/jquery-3.2.1.min.js"></script>
   	
	</head>
	<body>

	
		 <div class="panel panel-default container">
	     <h3>Our Stories - Admin site</h3>
		  <p>
			<a href="index.php">Admin home</a>
			<a href="index.php?page=story">Story</a>
			<a href="index.php?page=company">Company</a>
			<a href="index.php?page=community">Community</a>
			<a href="index.php?page=activity">Activity</a>
			<?php if($level=='admin')echo '<a href="index.php?page=users">Users</a>';?>
			<a href="index.php?page=chpwd"><?php echo $_SESSION['name']?></a>
			<a href="logout.php">Logout</a>
		  </p>
		 </div>

	<section  class="container " >
		<?php
			if($page=='') echo '<h2>Welcome to admin site</h2><p>This is the admin site for admins and editors.</p>';
			if($page=='chpwd') include('changepassword.php');
			if($level=='admin'&&$page=='users') include('users.php');
			if($page=='story') include('story.php');
			if($page=='company') include('company.php');
			if($page=='addcompany') include('addcompany.php');
			if($page=='editcompany') include('editcompany.php');
			if($page=='updatecompany') include('updatecompany.php');
			if($page=='community') include('community.php');
			if($page=='addcommunity') include('addcommunity.php');
			if($page=='editcommunity') include('editcommunity.php');
			if($page=='updatecommunity') include('updatecommunity.php');			
			if($level=='admin'&&$page=='edituser') include('edituser.php');
			if($level=='admin'&&$page=='edituserpass') include('edituserpass.php');
			if($level=='admin'&&$page=='updateuserpass') include('updateuserpass.php');
			if($page=='activity') include('activity.php');
			if($page=='addactivity') include('addactivity.php');
			if($page=='editactivity') include('editactivity.php');
			if($page=='updateactivity') include('updateactivity.php');
			if($level=='admin'&&$page=='removeuser') include('removeuser.php');
			if($level=='admin'&&$page=='insertuser') include('insertuser.php');
			if($page=='editstory') include('editstory.php');
			if($level=='admin'&&$page=='deleteuser') include('deleteuser.php');
			if($level=='admin'&&$page=='updateuser') include('updateuser.php');
		?>
		
		</section>
		
	 <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/popper/popper.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

 

    <!-- Custom scripts for this template -->
    


  	</body>
</html>