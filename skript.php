<?php 
$sql = "SELECT * FROM users";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";
$conn = new mysqli($servername, $username, $password, $dbname);
$result = $conn->query($sql);


$login_success = false;
$full_name = "";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
		if($row["username"] == $_POST["username"] &&
					$row["password"] == $_POST["password"]) {
			$login_success = true;
			$full_name = $row["name"];
			}
	}
} else {
    echo "0 results";
}
$conn->close();

if ($login_success == true){
    echo "login success";
}
else {
    echo "login failed";   
}

echo `<form action="logout.php" method="post">
<input type="submit" name="logout" value="Logout" />
</form>`;


if($login_success) {
	session_start();
	$_SESSION["username"] = $_POST["username"];
}

if($login_success == true ){

    $_SESSION["validateToken"] = true;
    echo'
    <form action="upload.php" method="post" enctype="multipart/form-data">
    Välj en fil att ladda upp:
    <input type="file" name="fileToUpload" id="fileToUpload" />
    <input type="submit" value="Ladda upp" name="submit" />
  </form>';
}

?>

<a href="inloggning.html"> Hemknapp</a>