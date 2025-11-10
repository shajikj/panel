<?php
include "includes/config.php";
include "includes/security.php";

if (isset($_GET['validate_roll_no'])) {
    $roll_no = $_GET['roll_no'];
    $class_id = $_GET['class_id'];
    $check_roll_data = mysqli_query($conn, "SELECT * FROM student_master WHERE roll_number='$roll_no' AND class_id='$class_id'");
    $count_data = mysqli_num_rows($check_roll_data);
    if ($count_data >= 1) {
        echo "exists";
    } else {
        echo "not_exists";
    }
    exit();
}

if (isset($_GET['validate_mark_entry'])) {
    $student_id = $_GET['student_id'];
    $subject_id = $_GET['subject_id'];
    $check_mark_data = mysqli_query($conn, "SELECT * FROM mark_entry WHERE student_id='$student_id' AND subject_id='$subject_id'");
    $count_data = mysqli_num_rows($check_mark_data);
    if ($count_data >= 1) {
        echo "exists";
    } else {
        echo "not_exists";
    }
    exit();
}

if (isset($_GET['validate_sub_id'])) {
    $subject_name = $_GET['subject_name'];
    $subject_code = $_GET['subject_code'];
    $check_sub_data = mysqli_query($conn, "SELECT * FROM subject_master WHERE subject_name = '$subject_name' AND subject_code = '$subject_code'");
    $count_data = mysqli_num_rows($check_sub_data);
    if ($count_data >= 1) {
        echo "exists";
    } else {
        echo "not exists";
    }
    exit();
}

if (isset($_GET['update_student_name'])) {
    $id = $_GET['id'];
    $student_name = $_GET['name'];
    $update_stu_data = mysqli_query($conn, "UPDATE student_master SET student_name = '$student_name' WHERE id = '$id'");
    if ($update_stu_data) {
        echo "Student name updated successfully!";
    } else {
        echo "Error updating name!";
    }
    exit();
}

if (isset($_GET['update_roll_no'])) {
    $id = $_GET['id'];
    $roll_no = $_GET['roll_no'];
    $update_stu_data = mysqli_query($conn, "UPDATE student_master SET roll_number = '$roll_no' WHERE id = '$id'");
    if ($update_stu_data) {
        echo "Roll number is updated";
    } else {
        echo "error";
    }
    exit();
}

if (isset($_GET['update_class_name'])) {
    $id = $_GET['id'];
    $class_name = $_GET['class_name'];
    $update_stu_data = mysqli_query($conn, "UPDATE student_master SET class_name = '$class_name' WHERE id = '$id'");
    if ($update_stu_data) {
        echo "Class name is updated";
    } else {
        echo "Error";
    }
    exit();

}


?>