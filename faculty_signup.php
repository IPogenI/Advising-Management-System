<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "advising";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO faculty VALUES ('".$_POST["faculty_id"]."', '".$_POST["first_name"]."', '".$_POST["middle_name"]."', '".$_POST["last_name"]."', '".$_POST["email"]."', '".$_POST["department"]."', '".$_POST["password"]."')";

    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
      header("Location: index.php");
    } else {
      echo "Error: ";
      header("Location: faculty_signup.php");
    }

    $conn->close();
}
?>
