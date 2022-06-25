<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbName     = "phpdatabase";

$conn = new mysqli($servername, $username, $password, $dbName);
if(!$conn)
{
    die("connection failed : " .$conn->connect_error);
}
$sql = "CREATE TABLE data (id int(10), username varchar(20), name varchar(20), age int(5), password varchar(30))";

if ($conn->query($sql) === TRUE) {
  echo "Table created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>