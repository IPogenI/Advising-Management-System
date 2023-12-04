<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <form action="faculty_lgcheck.php" method="post">
        <label for="faculty_id">Faculty ID:</label><br>
        <input type="text" id="faculty_id" name="faculty_id"><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br>
        <input type="submit" value="Login">
    </form>
    <button onclick="window.location.href='faculty_signup.php'">Register</button>
</body>
</html>
