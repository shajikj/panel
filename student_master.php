<?php
include "includes/config.php";
include "includes/security.php";
if (isset($_POST['submit'])) {
    $studentname = $_POST['student_name'];
    $rollnumber = $_POST['roll_number'];
    $classname = $_POST['class_name'];
    $subjectcode = $_POST['subject_code'];
    $insert_data = mysqli_query($conn, "INSERT INTO student_master(student_name, roll_number, class_id, subject_code) VALUES('$studentname', '$rollnumber', '$classname', '$subjectcode')");
    header("Location: student_master.php");
    exit();
}
if(isset($_GET['delete_id'])){
    $delete_id = $_GET['delete_id'];
    $delete_data = mysqli_query($conn, "DELETE FROM student_master WHERE id='$delete_id '");
    header("Location: student_master.php");
    exit();
}
?>
<!doctype html>
<html lang="en">    
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Student Master</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f6fa;
            color: #333;
            display: flex;
            min-height: 100vh;
            padding: 0px ! important;
        }

        .sidebar {
            width: 220px;
            background: #2c3e50;
            color: #ecf0f1;
            flex-shrink: 0;
            display: flex;
            flex-direction: column
        }

        .sidebar h2 {
            padding: 20px;
            font-size: 18px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1)
        }

        .menu {
            list-style: none;
            padding: 0;
            margin: 0;
            flex: 1
        }

        .menu li a {
            display: block;
            padding: 12px 20px;
            color: #ecf0f1;
            text-decoration: none;
            transition: background 0.2s
        }

        .menu li a:hover,
        .menu li a.active {
            background: #34495e
        }

        .content {
            flex: 1;
            padding: 20px
        }

        .header {
            background: #fff;
            padding: 15px 20px;
            border-bottom: 1px solid #ddd;
            margin: -20px -20px 20px;
            border-radius: 4px 4px 0 0
        }

        .card {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }

        .form-group input {
            width: 33%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
        }

        .form-group select {
            width: 33%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
        }


        button {
            padding: 10px 16px;
            background: #2c3e50;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }

        button:hover {
            background: #34495e;
        }

        @media(max-width:768px) {
            .sidebar {
                position: fixed;
                left: -220px;
                top: 0;
                bottom: 0;
                transition: left 0.3s
            }

            .sidebar.show {
                left: 0
            }

            .toggle-btn {
                display: block;
                cursor: pointer;
                background: #2c3e50;
                color: #fff;
                padding: 10px 15px
            }
        }

        .toggle-btn {
            display: none
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #333;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background: #f4f4f4;
        }
         .btn {
                    padding: 6px 12px;
                    border: none;
                    border-radius: 4px;
                    color: #fff;
                    cursor: pointer;
                    font-size: 14px;
                }

                .update-btn {
                    background-color: #198132;
                }

                .delete-btn {
                    background-color: #e74c3c;
                    /* red */
                }

                .btn:hover {
                    opacity: 0.8;
                }
    </style>
</head>
<body>
    <?php include "includes/menu.php"; ?>

    <div class="content">
        <div class="header">
            <h2>Subject Master</h2>
        </div>

        <div class="card">
            <form method="POST">
                <div class="form-group">
                    <label>Student Name</label>
                    <input type="text" name="student_name" placeholder="Enter student name">
                </div>

                <div class="form-group">
                    <label>Roll Number</label>
                    <input type="text" name="roll_number" placeholder="Enter roll number ">

                    </select>
                </div>

                <div class="form-group">
                    <label>Class Name</label>
                    <select name="class_name" class="form-control">
                        <option value="">-- Select Class --</option>
                        <?php
                        $select_class_data = mysqli_query($conn, "SELECT * FROM class_master");
                        while ($fetch_class_data = mysqli_fetch_assoc($select_class_data)) {
                            echo "<option value = '".$fetch_class_data['id']."'>" . $fetch_class_data['class']."</option>";
                            ?>
                            <?php }?>
                    </select>
                </div>
                
                <button type="submit" name="submit">Save Details</button>
            </form>
        </div>
        <div>
            <table border="1">
                <tr>
                    <th>Id</th>
                    <th>Student Name</th>
                    <th>Roll Number</th>
                    <th>Class Name</th>
                    <th>Action</th>
                </tr>

                <?php
                $select_data = mysqli_query($conn, "SELECT * FROM student_master 
                         INNER JOIN class_master ON student_master.class_id = class_master.id");
                            // using inner join to fetch subject name and code from subject_master table
                while ($fetch_data = mysqli_fetch_assoc($select_data)) { ?>
                    <tr>
                        <td><?php echo $fetch_data['id']; ?></td>
                        <td><?php echo $fetch_data['student_name']; ?></td>
                        <td><?php echo $fetch_data['roll_number']; ?></td>
                        <td><?php echo $fetch_data['class']; ?></td>
                        <td>
                                <a href="update_student.php?id=<?php echo $fetch_data['id']; ?>"
                                    class="btn update-btn">Update</a>
                               <a href="student_master.php?delete_id=<?php echo $fetch_data['id']; ?>"
                                    onclick="return confirm('Are you sure you want to delete this data?');"
                                    class="btn delete-btn">Delete</a>
                            </td>
                    </tr>
                <?php } ?>
            </table>
        </div>

    </div>
    </div>

</body>

</html>