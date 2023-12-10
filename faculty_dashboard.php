<?php
include("header.php");
include("./config/database.php");
include("approval.php");

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

if (isset($_POST['add'])) {
    $sql = "UPDATE student SET advising_stat = 1 WHERE student_id = :student_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['student_id' => $_POST['student_id']]);
} elseif (isset($_POST['drop'])) {
    $sql = "UPDATE student SET advising_stat = 0 WHERE student_id = :student_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['student_id' => $_POST['student_id']]);
}

$sql = 'SELECT * FROM student WHERE advising_stat = 0 LIMIT 4';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$students_pending = $stmt->fetchAll();

$sql = 'SELECT * FROM student WHERE advising_stat = 1 LIMIT 4';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$students_approved = $stmt->fetchAll();
?>

<?php 
    //Fetching Courses From Database
    $query1 = 'select student_id, name from student where advising_done = 1';
    $data1 = mysqli_query($conn, $query1);
    $students = mysqli_fetch_all($data1, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Advising Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        background: #e4e9f7;
        flex-direction: column;
    }

    /* nav{
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 60px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 0 50px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            background: white;
        }
        nav .links{
            display: flex;
            align-items: center;
        }
        nav .links a{
            text-decoration: none;
            margin-left: 20px;
            color: black;
        } */
    .tables-container {
        display: flex;
        justify-content: space-between;
        width: 90%;
        margin-top: 80px;
    }

    table {
        border-collapse: collapse;
        margin-top: 20px;
        width: 400px;
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    th,
    td {
        border: 0px;
        padding: 10px;
        text-align: left;
    }

    th {
        background: #f2f2f2;
    }

    .pending {
        background: #ffe6e6;
    }

    .approved {
        background: #e6ffe6;
    }

    .button-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 20px 0;
    }

    .button-container button {
        font-size: 16px;
        padding: 5px 10px;
        border: none;
        border-radius: 20px;
        background: #ddd;
        cursor: pointer;
        outline: none;
        margin-left: 10px;
    }

    select.form-control[multiple],
    select.form-control[size] {
        height: 16rem;
    }

    .btn-blue {
        font-size: 1.1rem;
        color: white;
        border: none;
        background-color: rgba(49, 92, 242, 71%);
    }

    .btn-blue:hover {
        color: black;
        background-color: rgba(49, 92, 242, 61%);
    }
    </style>
</head>

<body>
    <!-- <nav>
        <div class="links">
            <a href="faculty_advising.php">Advising</a>
            <a href="faculty_info.php">Profile</a>
        </div>
    </nav> -->
    <div class="tables-container">
        <div>
            <h1>Approval Pending</h1>
            <form method="post">
                <table>
                    <tr>
                        <th>Student ID</th>
                        <th>Select</th>
                    </tr>
                    <?php foreach ($students_pending as $student): ?>
                    <tr class="pending">
                        <td><?= $student['student_id'] ?></td>
                        <td><input type="radio" name="student_id" value="<?= $student['student_id'] ?>"></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                <div class="button-container">
                    <button type="submit" name="add">Add</button>
                </div>
            </form>
        </div>
        <div>
            <h1>Approved</h1>
            <form method="post">
                <table>
                    <tr>
                        <th>Student ID</th>
                        <th>Select</th>
                    </tr>
                    <?php foreach ($students_approved as $student): ?>
                    <tr class="approved">
                        <td><?= $student['student_id'] ?></td>
                        <td><input type="radio" name="student_id" value="<?= $student['student_id'] ?>"></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                <div class="button-container">
                    <button type="submit" name="drop">Drop</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card courses container-fluid d-flex flex-column justify-content-center my-3 w-75 p-5">
        <h5 class="card-title">Advising Pending List</h5>
        <form id='approve' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"
            class="w-100 card-body p-0">
            <select name="approveCourses" multiple class="form-control">
                <?php foreach($students as $student): ?>
                <option class="p-2 border mb-2 rounded" value="<?= $student['student_id']; ?>">
                    <?= $student['student_id'] . " " . $student['name']; ?>
                </option>
                <?php endforeach; ?>
            </select>
        </form>
        <!-- <button form="approve" type="submit" class="btn btn-blue mt-4 align-self-center">Approve</button> -->
    </div>
</body>

</html>