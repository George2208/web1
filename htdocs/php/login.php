<?php
if(isset($_POST["submitlogin"]))
{
	require 'dbhandler.php';
	$username = $_POST["username"];
	$password = $_POST["password"];
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT ID, Username, Password, email FROM users";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        echo $row["ID"]. " - Name: " . $row["Username"]. " " . $row["Password"]. "<br>";
	    }
	} else {
	    echo "0 results";
	}
	$conn->close();
}
else
{
	header("Location: index.html");
}
?>