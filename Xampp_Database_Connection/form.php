<?php

$localhost = "localhost";
$username = "root";
$password = "";
$database = "crud";

$connection = mysqli_connect($localhost, $username, $password, $database);
if ($connection) {
    echo "Connection successful";
} else {
    die("Connection failed");
}
?>