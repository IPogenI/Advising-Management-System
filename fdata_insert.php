<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "advisingmanagement";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Check if faculty ID already exists
    $sql = "SELECT * FROM facultylogininfo WHERE facId='".$_POST["facId"]."'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      echo "Faculty ID already exists.";
      // Redirect to faculty_signup page
      header("Location: faculty_signup.php");
    } else {
      $sql = "INSERT INTO facultylogininfo VALUES ('".$_POST["facId"]."', '".$_POST["name"]."', '".$_POST["email"]."', '".$_POST["password"]."')";

      if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        // Redirect to faculty_login page
        // header("Location: faculty_login.php");
      echo "YES!";
      } else {
        echo "Error. User already exists: " . $sql . "<br>" . $conn->error;
        // Redirect to faculty_signup page
        // header("Location: faculty_signup.php");
        echo "NO!";
      }
    }

    $conn->close();
}
?>
