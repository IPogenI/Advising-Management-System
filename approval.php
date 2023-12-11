<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Handle the selected course
    $is_page_refreshed = (isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] == 'max-age=0');
    if (isset($_POST['approveCourses']) && $is_page_refreshed) {
        $approvedCourse = $_POST['approveCourses']; // Assuming only one course is selected
        $id = $approvedCourse;
        $sql = "update student set approval_stat = '1' WHERE student_id = '$id'";
        if ($is_page_refreshed) {
            mysqli_query($conn, $sql);
        }
    } 
}