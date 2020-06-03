<?php
//Database Configuration

$mysql_host="localhost";
$mysql_user="root";
$mysql_password="app";
$dbName = "lmsystem";
$conn=mysqli_connect($mysql_host,$mysql_user,$mysql_password);

if(!$conn) {
    die('Cannot connect to the database');
}
else {
    if(@mysqli_select_db($conn, $dbName)) {
        echo ' ';
    }
else {
    die('Cannot connect to '.$dbName.' database');
}
}
?>