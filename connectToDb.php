<?php
	$server = 'localhost';
	$user = 'root';
	$password = '';
	$db = 'leaguematchups';
	$con = mysqli_connect($server, $user, $password) or die(mysqli_error());
	mysqli_select_db($con, $db) or die(mysqli_error());

	function reconnect() {
		mysqli_close($con);
		$con = mysqli_connect($server, $user, $password) or die(mysqli_error());
		mysqli_select_db($con, $db) or die(mysqli_error());
	}

	function closeDb() {
		mysqli_close($con);
	}

?>