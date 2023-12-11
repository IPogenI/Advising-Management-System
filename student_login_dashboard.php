<?php include 'partial/_DBconnect.php';
$qry = mysqli_query($conn, "select * from student where logged = 1");
$searchSql = "select * from student where advising_stat = '1' and logged = '1' and approval_stat != '1'";
$permission = mysqli_query($conn, $searchSql);
$searchSql = "select * from student where advising_stat = '1' and logged = '1'";
$permission2 = mysqli_query($conn, $searchSql);

/*
if(mysqli_num_rows($qry)=0){
   header("location: student_login.php");
       }*/
$std_info = mysqli_fetch_assoc($qry);

?>

<?php
if (isset($_POST['submit'])) {
    mysqli_query($conn, "UPDATE student SET logged = 0 WHERE student_id = '$std_info[student_id]'");
    header("location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/main.css">
    <!-- <link rel="stylesheet" href="./styles/style.css"> -->
    <link rel="icon" href="./images/logo6.png" type="image/x-icon">
    <link rel="stylesheet" href="./styles/style.css">
    <title>Student Dashboard</title>
    <style>

        .advisingbtn a{
            color: white;
            list-style: none;
            text-decoration: none !important;
        }

        .container {
            min-height: 30vh !important;
        }

        th,
        td,
        tr {
            border: 1px solid rgba(20, 20, 20, 30%) !important;
        }

        .btn {
            margin: 0;
        }

        input.btn-blue {
            width: fit-content;
            height: 40px;
            background: transparent !important;
            border: 0;
            border-radius: 5px;
            color: #fff;
            font-size: 15px;
            cursor: pointer;
            transition: all .3s;
            padding: 0px 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-blue">
        <a class="navbar-brand ml-5" href="#"><img src="./images/logo6.png" alt="advising logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end align-items-center mr-6" id="navbarSupportedContent">
            <ul class="navbar-nav mr-2">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <ul class="navbar-nav mr-2">
                <li class="nav-item">
                    <a class="nav-link" href="course_show.php">Courses</a>
                </li>
            </ul>
            <ul class="navbar-nav mr-2">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        SignUp
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="student_signup.php">Student</a>
                        <a class="dropdown-item" href="faculty_signup.php">Faculty</a>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav mr-2">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Login
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="index.php">Student</a>
                        <a class="dropdown-item" href="faculty_login.php">Faculty</a>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">
                        <?php

                        if (mysqli_num_rows($permission2) == 1) {
                            echo "Approved";
                        } else {
                            echo "Pending";
                        }
                        ?>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav mr-2 align-self-center">
                <li class="nav-item">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <input type="submit" class="btn btn-blue" name="submit" value="Log Out" required>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
    <div class="d-flex p-4 justify-content-center align-items-center advisingbtn">
        <?php
        if (mysqli_num_rows($permission) == 1) {
            ?>
            <button class="btn btn-blue">
                <a href="advising_panel.php">Do advising</a>
            </button>
            <?php
        }else{
            echo '';
        }
        ?>
    </div>


    <!-- <div>
        <?php //echo $std_info['student_id']; ?> <br />
        <?php //echo $std_info['name']; ?> <br />
        <?php //echo $std_info['email']; ?> <br />
    </div> -->
    <?php
    $crs_qry = mysqli_query($conn, "SELECT * FROM selected_courses where student_id = '$std_info[student_id]'");
    ?>
    <div class="container d-flex flex-column">
        <h5 class="card-title align-self-center">Advised Courses</h5>
        <table class='table table-striped table-bordered table-hover' name="Payslip">
            <tr>
                <th>Course Title</th>
                <th>Course ID</th>
                <th>Section</th>
                <th>Faculty</th>
                <th>Credit</th>
                <th>Seats</th>
            </tr>
            <?php while ($crs = mysqli_fetch_assoc($crs_qry)) {
                ?>
                <tr>
                    <td>
                        <?php echo $crs['course_title']; ?>
                    </td>
                    <td>
                        <?php echo $crs['course_id'] ?>
                    </td>
                    <td>
                        <?php echo $crs['section'] ?>
                    </td>
                    <td>
                        <?php echo $crs['course_faculty'] ?>
                    </td>
                    <td>
                        <?php echo $crs['course_credit'] ?>
                    </td>
                    <td>
                        <?php echo $crs['seats'] ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>

    <div class="container d-flex flex-column">
        <h5 class="card-title align-self-center">Payment Bill</h5>
        <table class='table table-striped table-bordered table-hover' name="Payslip">
            <tr>
                <th>Description</th>
                <th>Cost</th>
            </tr>
            <tr>
                <td>Session Fee</td>
                <td>25000Tk</td>
            </tr>
            <tr>
                <td>Computer Lab</td>
                <td>5000Tk</td>
            </tr>
            <tr>
                <td>Library Fee</td>
                <td>3000Tk</td>
            </tr>
            <tr>
                <td>Facilities Fee</td>
                <td>7000Tk</td>
            </tr>
            <tr>
                <td>Course Fee</td>
                <?php
                $crs_qry = mysqli_query($conn, "SELECT Count(*) as total FROM selected_courses where student_id = '$std_info[student_id]'");
                $Crs_count = mysqli_fetch_assoc($crs_qry);
                $x = $Crs_count['total']
                    ?>
                <td>
                    <?php echo $x * 20000; ?>TK
                </td>
            </tr>
            <tr>
                <td>Total</td>
                <td>
                    <?php echo 25000 + 5000 + 3000 + 7000 + $x * 20000; ?>TK
                </td>
            </tr>
        </table>
    </div>

    <div class="field button">

    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>