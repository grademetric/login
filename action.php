<?php
//wag gagalawin tong putanginang to

$server = "localhost";
$username = "root";
$pass = "";
$database = "qpal";

$connction = mysqli_connect($server, $username, $pass, $database);


if (!$connction) {
   die("<script>alert('Connection Failed.')</script>");
}
?>