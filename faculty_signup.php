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
        <input type="text" id="faculty_id" name="facId" required><br>
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br>
        <!-- <label for="first_name">First Name:</label><br>
        <input type="text" id="first_name" name="first_name" required><br>
        <label for="middle_name">Middle Name:</label><br>
        <input type="text" id="middle_name" name="middle_name"><br>
        <label for="last_name">Last Name:</label><br>
        <input type="text" id="last_name" name="last_name" required><br> -->
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <!-- <label for="department">Department:</label><br>
        <input type="text" id="department" name="department" required><br> -->
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Submit">
    </form>
    <script>
        // Add your JavaScript here
    </script>
</body>
</html>

