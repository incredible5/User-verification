<?php
	$mail = 1;
	$hash = "";
	if($_POST['verification'] == "email") #Using PHPMailer class
	{
		$mail_to = $_POST['email'];
		$mail_sub = "Verify email";
		$user_hash = md5($_POST['pass']);
		$mail_msg = 'Click <a href="localhost/priish/pass.php?val='.$hash.'&mail='.$mail_to.'">here</a> to verify your email account: ';
		require 'PHPMailer-master/PHPMailerAutoload.php';
		$mail = new PHPMailer();
		$mail -> isSmtp();
		$mail ->SMTPDebug = 0;
		$mail ->SMTPAuth = true;
		$mail ->SMTPSecure = 'ssl';
		$mail ->Host = "smtp.gmail.com";
		$mail ->Port = 465;
		$mail ->IsHTML(true);
		$mail ->Username = "MAIL_ID";
		$mail ->Password = "PASSWORD";
		$mail ->SetFrom('MAIL_ID');
		$mail ->Subject = $mail_sub;
		$mail ->Body = $mail_msg;
		$mail ->AddAddress($mail_to);

		if(!$mail->Send())
		{
			die("<script>alert('Some error occured!');window.location.assign('index.html');</script>");
		}
	}
	else #This section of code has to be copied from your Text Local account's send sms via php section 
	{
		$mobile_number = $_POST['mobile'];
		$user_hash = rand(1000, 9999);
		// Authorisation details.
		$username = "MAIL_ID"; #Or username provided by TextLocal
		$hash = "HASH_CODE"; #Provided by Text Local

		// Config variables. Consult http://api.textlocal.in/docs for more info.
		$test = "0";

		// Data for text message. This is the text message data.
		$sender = "TXTLCL"; // This is who the message appears to be from.
		$numbers = $mobile_number; // A single number or a comma-seperated list of numbers
		$message = "Enter the verification code along with your mail id to verify your number: ".$user_hash.".";
		// 612 chars or less
		// A single number or a comma-seperated list of numbers
		$message = urlencode($message);
		$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
		$ch = curl_init('http://api.textlocal.in/send/?');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch); // This is the result from the API
		curl_close($ch);
		echo $result;
		if ($result == true)
		{
			header("location: vm.php");
		}
	}

	require 'credentials.php';
    $email = $_POST['email'];
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $conn = new mysqli($server, $username, "", $dbname);
    if($conn->connect_error)
        die("Connection to $dbname failed");
    $sql = "INSERT INTO `logdata` (`email`, `mobile`, `password`, `name`, `hash`) VALUES ('$email', '$mobile', '$passwd', '$name', '$user_hash');";
    if($conn->query($sql) == true)
    {
    	if($mail == 1)
        	die("<script>alert('Click on the link sent to your mail to verify your account');window.location.assign('index.html');</script>");
        else
        	die("<script>alert('A message has been sent to your mobile number');window.location.assign('index.html');</script>");
    }
    else
    {
     	die("<script>alert('Some error occurred. Please try again');window.location.assign('index.html');</script>");
    }
?>