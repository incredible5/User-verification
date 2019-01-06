<?php
	session_start();
	if(!isset($_SESSION['user']))
	{
       	header("location: login.html");
    }
    require 'credentials.php';
    $password = "";

    $mail = $_SESSION['user'];

    $conn = new mysqli($server, $username, $password, $dbname);
    if($conn->connect_error)
        die("<script>alert('Some problem occured!');</script>");

    if(isset($_POST['pdname']) && isset($_POST['bp']) && isset($_POST['sp']) && isset($_POST['desc']))
	{
		$pd = $_POST['pdname'];
		$bp = $_POST['bp'];
		$sp = $_POST['sp'];
		$desc = $_POST['desc'];
		$sql = "INSERT INTO `products` (`mail`, `product`, `buying`, `selling`, `description`) VALUES ('$mail', '$pd', '$bp', '$sp', '$desc');";
		unset($_POST['pdname']);
		unset($_POST['bp']);
		unset($_POST['sp']);
		unset($_POST['desc']);
	    if($conn->query($sql) == true)
	    {
	        die("<script>alert('Product added successfully');window.location.assign('vendor.php?sec=add-new');</script>");
	    }
	    else
	    {
	     	die("<script>alert('Product was not added');window.location.assign('vendor.php?sec=add-new');</script>");
	    }
	}

    $sql = "SELECT name FROM logdata WHERE email = '".$mail."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $name = $row["name"];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<title>Project Verify</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="vendor.css">
</head>
<body>
	<div class="headcontain">
		<div class="header">
			<img src="logo.jfif">
			<h1>PHP Project</h1>
		</div>
	</div>
	<div class="info">
		<h3>Vendor name: <?php echo "$name"; ?></h3>
		<h3>Vendor's email-id: <?php echo "$mail"; ?></h3>
	</div>
	<div class="vertnav">
		<div class="menu-item">
			<a href="vendor.php?sec=products"><p>Products</p></a>
		</div>
		<div class="menu-item">
			<a href="vendor.php?sec=sales"><p>Sales</p></a>
		</div>
		<div class="menu-item">
			<a href="vendor.php?sec=add-new"><p>Add New</p></a>
		</div>
		<div class="menu-item">
			<a href="#"><p>FAQ</p></a>
		</div>
		<div class="menu-item">
			<a href="#"><p>Contact Us</p></a>
		</div>
	</div>
	<div class="logout">
		<form action="signcheck.php?value=logout" method="POST">
	        <input type="submit" value="logout">
	    </form>
	</div>
	<div class="main-data" id="main-data">
		<div class="product" id="product">
			<?php
			$section = $_GET['sec'];
			if($section == "products")
		    {
		    	echo '<script>document.getElementById("product").style.display="block";</script>';
		        $sql = "SELECT * FROM products WHERE mail = '".$mail."'";
		        $result = $conn->query($sql);
		        if($result->num_rows > 0)
		        {
		        	echo '<table style="width: 100%;"><th style="text-align: center; margin-bottom: 30px; border-right: 1px dashed black; border-bottom: 1px solid black;"><h3>Products</h3></th><th style="text-align: center; margin-bottom: 30px; border-right: 1px dashed black; border-bottom: 1px solid black;"><h3>Buying Price</h3></th><th style="text-align: center; margin-bottom: 30px; border-right: 1px dashed black; border-bottom: 1px solid black;"><h3>Selling Price</h3></th><th style="text-align: center; margin-bottom: 30px; border-bottom: 1px solid black;"><h3>Description</h3></th>';
		            while($row = $result->fetch_assoc())
		            {
		                $txt = '<tr style="border-bottom: 1px solid black;"><td style="border-bottom: 1px solid black;border-right: 1px dashed black; text-align: center;">'.$row["product"].'</td><td style="border-bottom: 1px solid black;border-right: 1px dashed black; text-align: center;">'.$row["buying"].'</td><td style="border-bottom: 1px solid black;border-right: 1px dashed black; text-align: center;">'.$row["selling"].'</td><td style="border-bottom: 1px solid black; text-align: center;">'.$row["description"].'</td></tr>';
		                echo $txt;
		            }
		            echo "</table>";
		        }
		        else
		        	echo '<h3 style="text-align: center">Nothing to show</h3>';
		    }
    		?>
		</div>
		<div id="piechart">
			<?php
				if($section == "sales")
				{
					echo '<script>document.getElementById("piechart").style.display="block";</script>';
				}
			?>
		</div>
		<div id="add-new">
			<?php
				if($section == "add-new")
				{
					echo '<script>document.getElementById("add-new").style.display="block";</script>';
				}
			?>
			<div class="pd-input">
				<form method="POST" action="vendor.php?sec=add-new">
					<table>
						<tr>
							<td><h2>Product Name</h2></td>
							<td><input type="text" name="pdname"></td>
						</tr>
						<tr>
							<td><h2>Buying Price</h2></td>
							<td><input type="text" name="bp"></td>
						</tr>
						<tr>
							<td><h2>Selling Price</h2></td>
							<td><input type="text" name="sp"></td>
						</tr>
						<tr>
							<td><h2>Description</h2></td>
							<td><input type="textarea" max-lenght = "300" name="desc"></td>
						</tr>
					</table>
					<input class="submit" type="submit" value="Submit">
				</form>
			</div>
		</div>
	</div>

	<!-- <script type="text/javascript">

		window.onload = function()
        {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function()
            {
                if(this.readyState == 4 && this.status == 200)
                {
                   document.getElementById("main-data").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "response.php", true);
            xhttp.send();
        }
	</script> -->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

	<script type="text/javascript">
		// Load google charts
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		// Draw the chart and set the chart values
		function drawChart()
		{
			var data = google.visualization.arrayToDataTable([
			['Task', 'Hours per Day'],
			['Work', 8],
			['Eat', 2],
			['TV', 4],
			['Gym', 2],
			['Sleep', 8]
			]);

			// Optional; add a title and set the width and height of the chart
			var options = {'title':'My Average Day', 'width':550, 'height':400};

			// Display the chart inside the <div> element with id="piechart"
			var chart = new google.visualization.PieChart(document.getElementById('piechart'));
		  	chart.draw(data, options);
		}
	</script>
</body>
</html>