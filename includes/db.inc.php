<?php

$serverip = "127.0.0.1";
$dBUsername = "root";
$dBPassword = "";
$dBName = "RBR";

$conn = mysqli_connect($serverip, $dBUsername, $dBPassword, $dBName);

if (!$conn){
  die("Connection failed: ".mysqli_connect_error());
}