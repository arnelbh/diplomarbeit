<?php
$servername = "localhost";
$username = "arnel";
$password = "ah87ba";
$dbname = "gh";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM act";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
// output data of each row

$row = $result->fetch_assoc();
echo $row["act1"] . " " . $row["act2"] . " " . $row["act3"] . " " . $row["act4"] . " " . $row["behelterNiveau"] . " " . $row["behelterMax"] . " " . $row["behelterMin"] . " " . $row["tempNiveau"] . " " . $row["tempMax"] . " " . $row["tempMin"];

} else {
echo "0 results";
}
?>