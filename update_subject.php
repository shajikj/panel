<?php
include "includes/config.php";
include "includes/security.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM subject_master WHERE id='$id'");
    $fetch_data = mysqli_fetch_assoc($result);
}

if(isset($_POST['update'])){
    $id = $_GET['id'];
    $subjectname = $_POST['subject_name'];
    $subjectcode = $_POST['subject_code'];
    $update_sub_data = mysqli_query($conn, "UPDATE subject_master SET subject_name='$subjectname', subject_code='$subjectcode' WHERE id='$id'");
    header("Location: subject_master");
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
        <h2>Update Subject Master</h2>
        <form method="POST">
            <label>Subject Name</label>
            <input type="text" name="subject_name" value="<?php echo $fetch_data['subject_name']; ?>">

            <label>Subject Code</label>
            <input type="text" name="subject_code" value="<?php echo $fetch_data['subject_code']; ?>">

            <button type="submit" name="update">Update</button>
        </form>
    </div>

</body>

</html>