<?php include 'partial/_DBconnect.php'; 
 $qry =mysqli_query($conn,"select * from student where logged = 1");

 /*
 if(mysqli_num_rows($qry)=0){
    header("location: student_login.php");
        }
 $std_info = mysqli_fetch_assoc($qry);
 */
?>

<?php 
    /*if(isset($_POST['submit'])){ 
    mysqli_query($conn, "UPDATE student SET logged = 0 WHERE student_id = '$std_info[student_id]'");
    header("location: student_login.php");
        exit();
    }*/
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <title>Student Dashboard</title>
</head>
<body>
    <div>
        <?php echo $std_info['student_id']; ?> <br/>
        <?php echo $std_info['name']; ?> <br/>
        <?php echo $std_info['email']; ?> <br/>
    </div>
        <?php
        $crs_qry =mysqli_query($conn,"SELECT * FROM selected_courses where student_id = '$std_info[student_id]'"); 
    ?>
    <table border ="3" name ="Payslip">
    <tr>
        <th>Course Title</th>
        <th>Course ID</th>
        <th>Section</th>
        <th>Faculty</th>
        <th>Credit</th>
        <th>Seats</th>
    </tr>
    <?php while($crs= mysqli_fetch_assoc($crs_qry)){
        ?>
        <tr>
            <td><?php echo $crs['course_title'];?></td>
            <td><?php echo $crs['course_id']?></td>
            <td><?php echo $crs['section']?></td>
            <td><?php echo $crs['course_faculty']?></td>
            <td><?php echo $crs['course_credit']?></td>
            <td><?php echo $crs['seats']?></td>

        </tr>
    <?php
    }
    ?>
    </table>

    <table border ="3" name ="Payslip">
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
        $crs_qry =mysqli_query($conn,"SELECT Count(*) as total FROM selected_courses where student_id = '$std_info[student_id]'");
        $Crs_count=mysqli_fetch_assoc($crs_qry);
        $x = $Crs_count['total'] 
    ?>
        <td><?php echo $x*20000;?>TK</td>
    </tr>
    <tr>
        <td>Total</td>
        <td><?php echo 25000+5000+3000+7000+$x*20000;?>TK</td>
    </tr>
    </table>
    <?php /*
    if($x=0 ){
                echo "
                        <p>You Have not taken any courses!</p> <br>";
                echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
            }
            */?>
    <div class="field button">
        <input type="submit" class="btn" name="submit" value="Submit" required>
    </div>


</body>