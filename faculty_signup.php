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
<!DOCTYPE html>
<html>
<head>
    <title>Faculty Form</title>
    <style>
        /* Add your CSS here */
    </style>
</head>
<body>
    <form id="facultyForm" method="post" action="fdata_insert.php">
        <label for="faculty_id">Faculty ID:</label><br>
        <input type="text" id="faculty_id" name="faculty_id" required><br>
        <label for="first_name">First Name:</label><br>
        <input type="text" id="first_name" name="first_name" required><br>
        <label for="middle_name">Middle Name:</label><br>
        <input type="text" id="middle_name" name="middle_name"><br>
        <label for="last_name">Last Name:</label><br>
        <input type="text" id="last_name" name="last_name" required><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="department">Department:</label><br>
        <input type="text" id="department" name="department" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Submit">
    </form>
    <script>
        // Add your JavaScript here
    </script>
</body>
</html>

