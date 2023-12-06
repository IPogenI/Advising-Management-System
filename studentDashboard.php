<!-- Including PHP Files -->
<?php 
    include("header.php"); 
    include("config/database.php");
    include("add_selected_courses.php");
    include("remove_selected_courses.php");

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
                        <option class="p-2 border mb-2 rounded" value="<?= $course['course_id']; ?>,<?= $course['section']; ?>">
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
                        <option class="p-2 border mb-2 rounded" value="<?= $selectedCourse['course_id']; ?>,<?= $selectedCourse['section']; ?>">
                            <?= $selectedCourse['course_title'] . " " . $selectedCourse['course_faculty'] . " " . $selectedCourse['section']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>
    </div>
    
</body>
</html>