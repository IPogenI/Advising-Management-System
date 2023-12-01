<?php
//database connection establishment 
//databse name: advising // modify this part when needed 
$server="localhost";
$username="root";
$password="";
$database="advising";
$conn=mysqli_connect($server, $username, $password, $database);

//previously done this which gave error:
//$conn=mysqli_connect($server, $student_id, $user_name, $email, $department, $admitted_semester, $password, $database);
//The mysqli_connect() function expects the parameters in the following order: host, username, password, database

//error handling 
if (!$conn){
    die("Error".mysqli_connect_error());
}

?>