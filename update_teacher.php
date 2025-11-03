<?php
include "includes/config.php";
include "includes/security.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $select_tec_data = mysqli_query($conn, "SELECT * FROM teacher_master INNER JOIN subject_master ON teacher_master.subject_id = subject_master.id WHERE teacher_master.id = $id");
    $fetch_tec_data = mysqli_fetch_assoc($select_tec_data);
    if(empty($fetch_tec_data)){
        header("Location: teacher_master.php?error=Data not found");
        exit();
    }
}

if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $teachername = $_POST['teacher_name'];
    $subjectid = $_POST['subject_id'];
    $contactnumber = $_POST['contact_number'];
    $email = $_POST['email'];
    $update_tec_data = mysqli_query($conn, "UPDATE teacher_master SET teacher_name='$teachername', subject_id='$subjectid', contact_number='$contactnumber', email='$email' WHERE id='$id'");
    header("Location: teacher_master.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Teacher Data</title>
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
        <h2>Update Teacher Data</h2>
        <form method="POST">
            <label>Teacher Name</label>
            <input type="text" name="teacher_name" value="<?php echo $fetch_tec_data['teacher_name']; ?>">

            <label>Subject Name</label>
            <input type="text" name="subject_id" value="<?php echo $fetch_tec_data['subject_name']; ?>">

            <label>Contact Number</label>
            <input type="text" name="contact_number" value="<?php echo $fetch_tec_data['contact_number']; ?>">

            <label>Email</label>
            <input type="text" name="email" value="<?php echo $fetch_tec_data['email']; ?>">

            <button type="submit" name="update">Update</button>
        </form>
    </div>
</body>

</html>