<?php


	$HeartRate = $_GET['heart'];
	$BloodPressSYS =  $_GET['pr_sys'];
	$BloodPressDIA =  $_GET['pr_dia'];
	$Saline = $_GET['saline'];
	$Respiration =  $_GET['resp'];
	$Temp = $_GET['temp'];
	
	/*echo '<h3>Your Data</h3>'; 
	echo '<p>HeartRate: '.$HeartRate. "BPM";
	$BloodPress, 
	$Saline, 
	$Respiration, 
	$Temp*/
	
	$servername = "localhost";
	$username = "bdhjdb_db";
	$password = "0000000000";
	$dbname = "bdhjdb_db";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	$sql = "INSERT INTO group_18 (HeartRate, BloodPressSYS, BloodPressDIA, Saline, Respiration, Temp) VALUES ($HeartRate, $BloodPressSYS, $BloodPressDIA, $Saline, $Respiration, $Temp)";

	if (mysqli_query($conn, $sql)) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	mysqli_close($conn);
	exit;

//http://httpsathipattanacom.000webhostapp.com/send.php?heart=89&pr_dia=120&pr_sys=80&saline=20&resp=30&temp=100.1
?>
