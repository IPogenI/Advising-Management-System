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

        $searchSql = mysqli_query($conn, "SELECT course_id FROM selected_courses WHERE course_id = '$courseId'");
        $conSql = mysqli_query($conn, "select * from selected_courses"); 

        if(mysqli_num_rows($searchSql) == 0){
            if (mysqli_num_rows($conSql) < 4){
                $insertSql = "INSERT INTO selected_courses (course_id, course_title, course_credit, lab, course_faculty, section, seats, time, day) 
                VALUES ('$courseId', '$courseTitle', '$courseCredit', '$lab', '$courseFaculty', '$courseSection', '$seats', '$time', '$day')";
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