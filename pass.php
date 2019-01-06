<?php
	session_start();
	if(isset($_GET['val']) && isset($_GET['mail']))
	{
		require 'credentials.php';
    	$email = $_GET['mail'];
    	$hash = $_GET['val'];
    	$conn = new mysqli($server, $username, "", $dbname);
        if($conn->connect_error)
            die("Connection to $dbname failed");
    	$sql = "UPDATE `logdata` SET `active` = '1' WHERE `logdata`.`email` = '".$email."'";
    	if($conn->query($sql) == true)
    	{
    		$_SESSION['user'] = $email;
    		header("location: vendor.php?sec=products");
    	}
    	else
    		header("location: index.html");
	}
?>