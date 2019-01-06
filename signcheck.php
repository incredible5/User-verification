<?php
    session_start();
    $log = 0;
    require 'credentials.php';
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_GET["value"]))
        {
            if ($_GET["value"] == "logout")
            {
                unset($_SESSION["user"]);
                header("location: index.html");
                exit();
            }
        }
        if(!preg_match("/^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9})$/",$_POST['email']))
            die("Enter a valid Username");
        $conn = new mysqli($server, $username, "", $dbname);
        if($conn->connect_error)
            die("Connection to $dbname failed");
        $sql = "SELECT * FROM logdata";
        $result = $conn->query($sql);
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                if(($_POST["email"] == $row["email"]) && ($_POST["passwd"] == $row["password"]) && ($row["active"] == 1))
                {
                    $log = 1;
                    $_SESSION["user"] = $_POST['email'];
                    die("<script>window.location.assign('vendor.php?sec=products');</script>");
                }
            }
                if($log == 0)
                    die("<script>alert('You are not registered!');window.location.assign('login.html');</script>");
        }
        else
            die ("<script>alert('No registered user');window.location.assign('index.html');</script>");
    }
?>