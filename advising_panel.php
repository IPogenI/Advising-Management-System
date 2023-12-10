<!-- Including PHP Files -->
<?php 
    include("header.php"); 
    include("config/database.php");
    include("add_selected_courses.php");
    include("remove_selected_courses.php");
    include("approval.php");

    //Fetching Courses From Database
    $query1 = 'select * from courses';
    $data1 = mysqli_query($conn, $query1);
    $courses = mysqli_fetch_all($data1, MYSQLI_ASSOC);

    //Fetching Selected Courses From Database
    $query2 = 'select * from selected_courses';
    $data2 = mysqli_query($conn, $query2);
    $selectedCourses = mysqli_fetch_all($data2, MYSQLI_ASSOC);
    
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/sdashboard.css">
    <title>Student Dashboard</title>
</head>

<body>
    <div class="advising_panel container-fluid d-flex justify-content-around w-100 h-50">

        <div class="courses container d-flex flex-column justify-content-center my-3 w-30">
            <h5 class="card-title">Courses</h5>
            <form id='add' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <select name="selectCourses" multiple class="form-control">
                    <?php foreach($courses as $course): ?>
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
                    <?php foreach($selectedCourses as $selectedCourse): ?>
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
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('08:00:00' AS time) and day = 2");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }
                                else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('08:00:00' AS time) and day = 3");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('08:00:00' AS time) and day = 4");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('08:00:00' AS time) and day = 5");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('08:00:00' AS time) and day = 6");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('08:00:00' AS time) and day = 7");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('08:00:00' AS time) and day = 1");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="time">09:30 AM-10:50 AM</th>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('09:30:00' AS time) and day = 2");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('09:30:00' AS time) and day = 3");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('09:30:00' AS time) and day = 4");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('09:30:00' AS time) and day = 5");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('09:30:00' AS time) and day = 6");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('09:30:00' AS time) and day = 7");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('09:30:00' AS time) and day = 1");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="time">11:00 AM-12:20 AM</th>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('11:00:00' AS time) and day = 2");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('11:00:00' AS time) and day = 3");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('11:00:00' AS time) and day = 4");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('11:00:00' AS time) and day = 5");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('11:00:00' AS time) and day = 6");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('11:00:00' AS time) and day = 7");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('11:00:00' AS time) and day = 1");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="time">12:30 AM-01:50 AM</th>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('12:30:00' AS time) and day = 2");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('12:30:00' AS time) and day = 3");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('12:30:00' AS time) and day = 4");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('12:30:00' AS time) and day = 5");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('12:30:00' AS time) and day = 6");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('12:30:00' AS time) and day = 7");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('12:30:00' AS time) and day = 1");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="time">02:00 AM-03:20 AM</th>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('02:00:00' AS time) and day = 2");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('02:00:00' AS time) and day = 3");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('02:00:00' AS time) and day = 4");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('02:00:00' AS time) and day = 5");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('02:00:00' AS time) and day = 6");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('02:00:00' AS time) and day = 7");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('02:00:00' AS time) and day = 1");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="time">03:30 AM-04:50 AM</th>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('03:30:00' AS time) and day = 2");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('03:30:00' AS time) and day = 3");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('03:30:00' AS time) and day = 4");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('03:30:00' AS time) and day = 5");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('03:30:00' AS time) and day = 6");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('03:30:00' AS time) and day = 7");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                        <td class="courses">
                            <?php
                                $searchSql = mysqli_query($conn, "SELECT course_title FROM selected_courses WHERE time = CAST('03:30:00' AS time) and day = 1");
                                $courseTime = mysqli_fetch_assoc($searchSql);
                                if(mysqli_num_rows($searchSql) == 0){
                                echo '';
                                }else if(mysqli_num_rows($searchSql) > 1){
                                    echo '<script>alert("Schedule Clash!")</script>';
                                }else{
                                    echo $courseTime['course_title'];
                                } 
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php foreach($selectedCourses as $selectedCourse): ?>

        <?php endforeach; ?>


    </div>

    <div class="advising_panel2 container d-flex justify-content-around w-100">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <input class = "btn btn-blue" type="submit" name="submit" value="Request Advising">
        </form>
    </div>
</body>

</html>