<!-- Including PHP Files -->
<?php
// include("header.php");
include("config/database.php");
include("add_selected_courses.php");
include("remove_selected_courses.php");

//Fetching Courses From Database
$query1 = 'select * from courses';
$data1 = mysqli_query($conn, $query1);
$courses = mysqli_fetch_all($data1, MYSQLI_ASSOC);

$stId = mysqli_query($conn, "select student_id from student where logged = '1'");
$stId = mysqli_fetch_all($stId, MYSQLI_ASSOC);
$stId = $stId[0]['student_id'];

//Fetching Selected Courses From Database
$query2 = "select * from selected_courses where student_id = $stId";
$data2 = mysqli_query($conn, $query2);
$selectedCourses = mysqli_fetch_all($data2, MYSQLI_ASSOC);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $is_page_refreshed = (isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] == 'max-age=0');
    if (isset($_POST['submit']) && $is_page_refreshed) {
        $searchSql = "select * from student where logged = '1'";
        $data = mysqli_query($conn, $searchSql);
        $student = mysqli_fetch_all($data, MYSQLI_ASSOC);
        $id = $student[0]['student_id'];
        $sql = "update student set advising_done = '1' WHERE student_id = '$id'";
        mysqli_query($conn, $sql);
        // Used to redirect to dashboard
        header("location: student_login_dashboard.php");
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/main.css">
    <!-- <link rel="stylesheet" href="./styles/style.css"> -->
    <link rel="icon" href="./images/logo6.png" type="image/x-icon">
    <link rel="stylesheet" href="./styles/sdashboard.css">
    <style>
        .btn {
            margin: 0;
        }

        .navbtn {
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

        input.btn-blue:hover{
            background: rgba(49, 92, 242, 31%) !important; 
        }
    </style>
    <title>Student Dashboard</title>
</head>

<body>
    <div class="advising_panel container-fluid d-flex justify-content-around w-100 h-50">

        <div class="courses container d-flex flex-column justify-content-center my-3 w-30">
            <h5 class="card-title">Courses</h5>
            <form id='add' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <select name="selectCourses" multiple class="form-control">
                    <?php foreach ($courses as $course): ?>
                        <option class="p-2 border mb-2 rounded"
                            value="<?= $course['course_id']; ?>,<?= $course['section']; ?>">
                            <?= $course['course_title'] . " " . $course['course_faculty'] . " " . $course['section']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>
        <div class="buttons d-flex flex-column justify-content-center">
            <button form="add" type="submit" class="btn btn-blue mt-2">ADD</button>
            <button form="drop" type="submit" class="btn btn-blue mt-2">DROP</button>
        </div>

        <div class="courses container d-flex flex-column justify-content-center my-3 w-30">
            <h5 class="card-title">Selected Courses</h5>
            <form id="drop" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <select name="selectedCourses" multiple class="form-control">
                    <?php foreach ($selectedCourses as $selectedCourse): ?>
                        <option class="p-2 border mb-2 rounded"
                            value="<?= $selectedCourse['course_id']; ?>,<?= $selectedCourse['section']; ?>">
                            <?= $selectedCourse['course_title'] . " " . $selectedCourse['course_faculty'] . " " . $selectedCourse['section']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>
    </div>
    <div class="advising_panel2 container d-flex justify-content-around w-100 h-50">
        <h5 class="card-title">Routine</h5>
        <div class="table-responsive">
            <table class='table table-striped table-bordered table-hover'>
                <thead>
                    <tr>
                        <th scope="col" class="entry">Time/Day</th>
                        <th scope="col" class="days">Sunday</th>
                        <th scope="col" class="days">Monday</th>
                        <th scope="col" class="days">Tuesday</th>
                        <th scope="col" class="days">Wednesday</th>
                        <th scope="col" class="days">Thursday</th>
                        <th scope="col" class="days">Friday</th>
                        <th scope="col" class="days">Saturday</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th class="time">08:00 AM-09:20 AM</th>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('08:00:00' AS time) and day = 2  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('08:00:00' AS time) and day = 3  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('08:00:00' AS time) and day = 4  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('08:00:00' AS time) and day = 5  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('08:00:00' AS time) and day = 6  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('08:00:00' AS time) and day = 7  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('08:00:00' AS time) and day = 1  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="time">09:30 AM-10:50 AM</th>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('09:30:00' AS time) and day = 2  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('09:30:00' AS time) and day = 3  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('09:30:00' AS time) and day = 4  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('09:30:00' AS time) and day = 5  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('09:30:00' AS time) and day = 6  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('09:30:00' AS time) and day = 7  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('09:30:00' AS time) and day = 1  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="time">11:00 AM-12:20 AM</th>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('11:00:00' AS time) and day = 2  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('11:00:00' AS time) and day = 3  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('11:00:00' AS time) and day = 4  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('11:00:00' AS time) and day = 5  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('11:00:00' AS time) and day = 6  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('11:00:00' AS time) and day = 7  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('11:00:00' AS time) and day = 1  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="time">12:30 AM-01:50 AM</th>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('12:30:00' AS time) and day = 2  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('12:30:00' AS time) and day = 3  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('12:30:00' AS time) and day = 4  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('12:30:00' AS time) and day = 5  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('12:30:00' AS time) and day = 6  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('12:30:00' AS time) and day = 7  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('12:30:00' AS time) and day = 1  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="time">02:00 AM-03:20 AM</th>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('02:00:00' AS time) and day = 2  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('02:00:00' AS time) and day = 3  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('02:00:00' AS time) and day = 4  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('02:00:00' AS time) and day = 5  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('02:00:00' AS time) and day = 6  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('02:00:00' AS time) and day = 7  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('02:00:00' AS time) and day = 1  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="time">03:30 AM-04:50 AM</th>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('03:30:00' AS time) and day = 2  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('03:30:00' AS time) and day = 3  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('03:30:00' AS time) and day = 4  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('03:30:00' AS time) and day = 5  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('03:30:00' AS time) and day = 6  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('03:30:00' AS time) and day = 7  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                            $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('03:30:00' AS time) and day = 1  and student_id = $stId");
                            $courseTime = mysqli_fetch_assoc($searchSql);
                            if (mysqli_num_rows($searchSql) == 0) {
                                echo '';
                            } else if (mysqli_num_rows($searchSql) > 1) {
                                echo '<script>alert("Schedule Clash!")</script>';
                            } else {
                                echo $courseTime['course_title'];
                            }
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php foreach ($selectedCourses as $selectedCourse): ?>

        <?php endforeach; ?>


    </div>

    <div class="advising_panel2 container d-flex justify-content-around w-100 mb-5">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <input class="btn btn-blue" type="submit" name="submit" value="Request Advising">
        </form>
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

</html>