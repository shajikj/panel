<?php
include "includes/config.php";
include "includes/security.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $class_data = mysqli_query($conn, "SELECT * FROM class_master WHERE id='$id'");
    $fetch_class_data = mysqli_fetch_assoc($class_data);
    //print_r($fetch_class_data);
}

if(isset($_POST['update'])){
    $id = $_GET['id'];
    $class = $_POST['class'];
    $update_class_data = mysqli_query($conn, "UPDATE class_master SET class='$class' WHERE id='$id'");
    header("Location: class_master.php");
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
            <label>Class</label>
            <input type="text" name="class" value="<?php echo $fetch_class_data['class']; ?>">

            <button type="submit" name="update">Update</button>
        </form>
    </div>

</body>

</html>