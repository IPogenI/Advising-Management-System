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
                        <a class="dropdown-item" href="student_login.php">Student</a>
                        <a class="dropdown-item" href="faculty_login.php">Faculty</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</body>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Handle the selected course
    $is_page_refreshed = (isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] == 'max-age=0');
    if (isset($_POST['selectCourses']) && $is_page_refreshed) {
        $selectedCourse = $_POST['selectCourses']; // Assuming only one course is selected
        $selectedCourse_explode = explode(',', $selectedCourse);


        $id = $selectedCourse_explode[0];
        $section = $selectedCourse_explode[1];

        $sql = "SELECT course_id, course_title, course_credit, course_faculty, section, lab, seats, time, day FROM courses WHERE course_id = '$id' and section = '$section'";
        $result = mysqli_query($conn, $sql);
        $courseDetails = mysqli_fetch_assoc($result);

        // Insert the selected course details into the 'selected_courses' table
        $courseId = mysqli_real_escape_string($conn, $courseDetails['course_id']);
        $courseTitle = mysqli_real_escape_string($conn, $courseDetails['course_title']);
        $courseCredit = mysqli_real_escape_string($conn, $courseDetails['course_credit']);
        $courseFaculty = mysqli_real_escape_string($conn, $courseDetails['course_faculty']);
        $courseSection = mysqli_real_escape_string($conn, $courseDetails['section']);
        $lab = mysqli_real_escape_string($conn, $courseDetails['lab']);
        $seats = mysqli_real_escape_string($conn, $courseDetails['seats']);
        $time = mysqli_real_escape_string($conn, $courseDetails['time']);
        $day = mysqli_real_escape_string($conn, $courseDetails['day']);

        
        $stId = mysqli_query($conn, "select student_id from student where logged = '1'");
        $stId = mysqli_fetch_all($stId, MYSQLI_ASSOC);
        $stId = $stId[0]['student_id'];
        $searchSql = mysqli_query($conn, "SELECT course_id FROM selected_courses WHERE course_id = '$courseId' and student_id = $stId");
        $conSql = mysqli_query($conn, "select * from selected_courses where student_id = $stId"); 

        if(mysqli_num_rows($searchSql) == 0){
            if (mysqli_num_rows($conSql) < 4){
                $insertSql = "INSERT INTO selected_courses (course_id, course_title, course_credit, lab, course_faculty, section, seats, time, day, student_id) 
                VALUES ('$courseId', '$courseTitle', '$courseCredit', '$lab', '$courseFaculty', '$courseSection', '$seats', '$time', '$day', '$stId')";
                mysqli_query($conn, $insertSql);

                // Redirect or display a success message as needed
                // header("Location: success_page.php");
            }else{
                echo "Error: " . mysqli_error($conn);
                echo "Need Permission to add more than 4 courses";
            }
        } else {
            echo "Error: " . mysqli_error($conn);
            echo "Cannot Add two sections of same Course";
        }
        // $removeSql = "delete from courses where course_section = '$courseSection'"; 
        //     mysqli_query($conn, $removeSql);
    }
}

// If the form is accessed directly without submission, you may redirect or handle accordingly
// header("Location: error_page.php");
// exit();
?>
