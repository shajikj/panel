<?php
include "includes/config.php";
include "includes/security.php";

if(isset($_GET['validate_roll_no'])){
    $roll_no = $_GET['roll_no'];
    $class_id = $_GET['class_id'];
    $check_roll_data = mysqli_query($conn, "SELECT * FROM student_master WHERE roll_number='$roll_no' AND class_id='$class_id'");
    $count_data = mysqli_num_rows($check_roll_data);
    if($count_data >= 1){
        echo "exists";
    } else {
        echo "not_exists";
    }
}