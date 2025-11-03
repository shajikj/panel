<?php
include "includes/config.php";
include "includes/security.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $select_mark_data = mysqli_query($conn, "SELECT * FROM mark_entry INNER JOIN student_master ON mark_entry.student_id = student_master.id INNER JOIN subject_master ON mark_entry.subject_id = subject_master.id WHERE mark_entry.id = $id");
    $fetch_mark_data = mysqli_fetch_assoc($select_mark_data);
}

if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $student_name = $_POST['student_name'];
    $subject_name = $_POST['subject_name']; 
    $marks = $_POST['marks'];
    $remarks = $_POST['remarks'];
    $update_mark_data = mysqli_query($conn, "UPDATE mark_entry SET student_id='$student_id', subject_id='$subject_id', marks='$marks', remarks='$remarks'  WHERE id='$id'");
    header("Location: mark_entry.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Mark</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .update-form-container {
            background: #fff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 25px;
        }

        form label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #333;
        }

        form select,
        form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #3498db;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #2980b9;
        }

        @media(max-width: 480px) {
            .update-form-container {
                width: 90%;
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="update-form-container">
        <h2>Update Mark</h2>
        <form method="POST">
            <label>Student</label>
            <input type="text" name="student_id" value="<?php echo $fetch_mark_data['student_name']; ?>">
            
            <label>Subject</label>
            <input type="text" name="subject_id" value="<?php echo $fetch_mark_data['subject_name']; ?>">

            <label>Marks</label>
            <input type="text" name="marks" value="<?php echo $fetch_mark_data['marks']; ?>">

            <label>Remarks</label>
            <input type="text" name="remarks" value="<?php echo $fetch_mark_data['remarks']; ?>">

            <button type="submit" name="update">Update</button>
        </form>
    </div>

</body>

</html>