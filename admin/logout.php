<?php
/*
	file:	logout.php
	desc:	Destroys session variables, and heads to user.php
*/
session_start();
session_destroy();
header('location:../index.html');
ob_end_clean();
?>