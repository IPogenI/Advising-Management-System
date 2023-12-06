<?php
$host = 'localhost';
$db   = 'advisingmanagement';
$user = 'root'; 
$pass = ''; 
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

$sql = 'SELECT * FROM courses';
if (isset($_GET['course_id'])) {
    $sql .= ' WHERE course_id = :course_id';
}
$stmt = $pdo->prepare($sql);
if (isset($_GET['course_id'])) {
    $stmt->execute(['course_id' => $_GET['course_id']]);
} else {
    $stmt->execute();
}
$courses = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Courses</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Poppins',sans-serif;
        }
        body{
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #e4e9f7;
        }
        nav{
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 50px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            background: white;
        }
        nav .search-bar{
            flex: 1;
            margin-left: 50px;
        }
        nav .search-bar input[type="text"]{
            font-size: 16px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 20px;
            outline: none;
            width: 20%;
        }
        nav .search-bar input[type="submit"]{
            font-size: 16px;
            padding: 5px 10px;
            border: none;
            border-radius: 20px;
            background: #ddd;
            cursor: pointer;
            outline: none;
            margin-left: 10px;
        }
        nav .links{
            display: flex;
        }
        nav .links a{
            text-decoration: none;
            margin-left: 20px;
            color: black;
        }
        table{
            border-collapse: collapse;
            width: 600px;
            margin-top: 80px;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td{
            border: 0px;
            padding: 10px;
            text-align: left;
        }
        th{
            background: #f2f2f2;
        }
    </style>
</head>
<body>
    <nav>
        <form class="search-bar" method="get">
            <input type="text" name="course_id" placeholder="Search by Course ID">
            <input type="submit" value="Search">
        </form>
        <div class="links">
            <a href="student_advising.php">Advising</a>
        </div>
    </nav>
    <table>
        <tr>
            <th>Course ID</th>
            <th>Course Title</th>
            <th>Course Credit</th>
            <th>Section</th>
        </tr>
        <?php if (count($courses) > 0): ?>
            <?php foreach ($courses as $course): ?>
            <tr>
                <td><?= $course['course_id'] ?></td>
                <td><?= $course['course_title'] ?></td>
                <td><?= $course['course_credit'] ?></td>
                <td><?= $course['section'] ?></td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">No courses found.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
