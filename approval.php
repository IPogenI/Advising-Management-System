<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Handle the selected course
    $is_page_refreshed = (isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] == 'max-age=0');
    if (isset($_POST['approveCourses']) && $is_page_refreshed) {
        $approvedCourse = $_POST['approveCourses']; // Assuming only one course is selected

        $id = $approvedCourse;
        
        $sql = "update student set approval_stat = '1' WHERE student_id = '$id'";
        mysqli_query($conn, $sql);
    }

    
}

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
        // header("location: advising_panel.php");
    }
}