<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Handle the selected course
    $is_page_refreshed = (isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] == 'max-age=0');
    if (isset($_POST['selectedCourses']) && $is_page_refreshed) {
        $selectedCourse = $_POST['selectedCourses']; // Assuming only one course is selected
        $selectedCourse_explode = explode(',', $selectedCourse);

        $stId = mysqli_query($conn, "select student_id from student where logged = '1'");
        $stId = mysqli_fetch_all($stId, MYSQLI_ASSOC);
        $stId = $stId[0]['student_id'];
        // Now $courseId and $section contain the separated values

        $courseId = $selectedCourse_explode[0];
        $section = $selectedCourse_explode[1];

        // Perform database operations to get additional information about the selected course
        // Replace this with your actual database connection and query logic
        $selectedCourseId = mysqli_real_escape_string($conn, $courseId);
        // Assuming 'courses' table has columns 'course_id', 'course_title', 'course_credit', 'course_faculty', and 'lab'
        $sql = "SELECT course_id, course_title, course_credit, course_faculty, section, lab FROM selected_courses WHERE course_id = '$selectedCourseId' and section = '$section' and student_id = $stId";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $courseDetails = mysqli_fetch_assoc($result);

            // Insert the selected course details into the 'selected_courses' table
            // Assuming 'selected_courses' table has columns 'course_title', 'course_credit', 'course_faculty', and 'lab'
            if($courseDetails != NULL){
                $courseId = mysqli_real_escape_string($conn, $courseDetails['course_id']);
                $courseTitle = mysqli_real_escape_string($conn, $courseDetails['course_title']);
                $courseCredit = mysqli_real_escape_string($conn, $courseDetails['course_credit']);
                $courseFaculty = mysqli_real_escape_string($conn, $courseDetails['course_faculty']);
                $courseSection = mysqli_real_escape_string($conn, $courseDetails['section']);
                $lab = mysqli_real_escape_string($conn, $courseDetails['lab']);

                // Insert the selected course details into the 'selected_courses' table
                // Assuming 'selected_courses' table has columns 'course_title', 'course_credit', 'course_faculty', and 'lab'
                
                
                if(mysqli_num_rows($result) == 1){
                    $removeSql = "DELETE from selected_courses where section = '$courseSection' and course_id = '$courseId'";
                    mysqli_query($conn, $removeSql);

                    
                    // Redirect or display a success message as needed
                    // header("Location: success_page.php");
                } else {
                    // echo "Error: " . mysqli_error($conn);
                }
                // $removeSql = "delete from courses where course_section = '$courseSection'"; 
                //     mysqli_query($conn, $removeSql);
            }
        } 
    }
}

// If the form is accessed directly without submission, you may redirect or handle accordingly
// header("Location: error_page.php");
// exit();
?>