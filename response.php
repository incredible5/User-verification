<?php
    $files = array();
    require 'credentials.php';
    $password = "";

    $conn = new mysqli($server, $username, $password, $dbname);
    if($conn->connect_error)
        die("<script>alert('Some problem occured loading the downloadable contents. Please refresh or contact admin');</script>");

    // $section = $_GET['sec'];
    $section = "sales";
    
    if($section == "products")
    {
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);
        echo '<table style="width: 100%;"><th style="text-align: center; margin-bottom: 30px; border-right: 1px dashed black; border-bottom: 1px solid black;"><h3>Products</h3></th><th style="text-align: center; margin-bottom: 30px; border-right: 1px dashed black; border-bottom: 1px solid black;"><h3>Buying Price</h3></th><th style="text-align: center; margin-bottom: 30px; border-right: 1px dashed black; border-bottom: 1px solid black;"><h3>Selling Price</h3></th><th style="text-align: center; margin-bottom: 30px; border-bottom: 1px solid black;"><h3>Description</h3></th>';
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $txt = '<tr style="border-bottom: 1px solid black;"><td style="border-bottom: 1px solid black;border-right: 1px dashed black; text-align: center;">'.$row["product"].'</td><td style="border-bottom: 1px solid black;border-right: 1px dashed black; text-align: center;">'.$row["buying"].'</td><td style="border-bottom: 1px solid black;border-right: 1px dashed black; text-align: center;">'.$row["selling"].'</td><td style="border-bottom: 1px solid black; text-align: center;">'.$row["description"].'</td></tr>';
                echo $txt;
            }
        }
        echo "</table>";
    }
    elseif ($section == "sales")
    {
        // echo '<script>document.getElementById("piechart").style.display="block";document.getElementById("product").style.display="block";</script>';
    }
?>