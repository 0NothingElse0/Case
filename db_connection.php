<?php
$host="localhost";
$username="root";
$password="";
$dbname="case";
$connect = new mysqli($host, $username, $password, $dbname);
if ($connect -> connect_error) {
    echo "Connection established".mysqli_connect_error();
  exit();
};
?>