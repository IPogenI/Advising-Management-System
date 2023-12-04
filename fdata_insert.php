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

    // Check if faculty ID already exists
    $sql = "SELECT * FROM faculty WHERE faculty_id='".$_POST["faculty_id"]."'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      echo "Faculty ID already exists.";
      // Redirect to faculty_signup page
      header("Location: faculty_signup.php");
    } else {
      $sql = "INSERT INTO faculty VALUES ('".$_POST["faculty_id"]."', '".$_POST["first_name"]."', '".$_POST["middle_name"]."', '".$_POST["last_name"]."', '".$_POST["email"]."', '".$_POST["department"]."', '".$_POST["password"]."')";

      if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        // Redirect to faculty_login page
        header("Location: faculty_login.php");
      } else {
        echo "Error. User already exists: " . $sql . "<br>" . $conn->error;
        // Redirect to faculty_signup page
        header("Location: faculty_signup.php");
      }
    }

    $conn->close();
}
?>
