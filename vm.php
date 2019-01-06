<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="nlp.jpg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="home.css">
	<title></title>
	<style type="text/css">
		.sign
		{
			float: none;
			width: 27%;
			margin: 20% auto 0 auto;
		}
		.oent, input
		{
			width: 100%;
			font-size: 1.5em;
		}

		@media only screen and (max-width: 1000px)
		{
			.sign td
			{
				display: block;
			}
		}

		@media only screen and (max-width: 600px)
		{
			.sign
			{
				width: 42%;
			}
			.oent
			{
				font-size: 1em;
			}
			.sign input
			{
				font-size: 1em;
			}
		}

		@media only screen and (max-width: 450px)
		{
			.sign
			{
				width: 60%;
			}
		}
	</style>
</head>
<body>
	<div class="sign">
		<form action="pass.php" method="GET">
			<table>
				<tr>
					<td>
						<span class="oent">Email: </span>
					</td>
					<td>
						<input type="email" name="mail" />
					</td>
				</tr>
				<tr>
					<td>
						<span class="oent">OTP: </span>
					</td>
					<td>
						<input type="text" name="val" />
					</td>
				</tr>
				<tr>
					<td>
						<input type="submit" value="Verify OTP" />
					</td>
				</tr>
		</form>
	</div>
</body>
</html>