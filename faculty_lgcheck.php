<?php
    // Database credentials
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

    // Get form data
    $faculty_id = $_POST['faculty_id'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT * FROM faculty WHERE faculty_id = ? AND email = ? AND password = ?");
    $stmt->bind_param("sss", $faculty_id, $email, $password);

    // Execute the statement
    $stmt->execute();

    // Store the result
    $result = $stmt->get_result();

    // Check if any rows were returned
    if ($result->num_rows > 0) {
        echo "Login successful!";
        header("location: success.php");
    } else {
        echo "User not found. Would you like to register?";
        echo "<button onclick=\"window.location.href='faculty_signup.php'\">Register</button>";
    }

    // Close the statement and the connection
    $stmt->close();
    $conn->close();
?>
