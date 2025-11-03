<?php
include "includes/config.php";
include "includes/security.php";
if (isset($_POST['submit'])) {
    $student_id = $_POST['student_id'];
    $subject_id = $_POST['subject_id'];
    $marks = $_POST['marks'];
    $remarks = $_POST['remarks'];
    $check_mark_data = mysqli_query($conn, "SELECT * FROM mark_entry WHERE student_id='$student_id' AND subject_id='$subject_id'");
    if (mysqli_num_rows($check_mark_data) > 0) {
        echo "Mark is already entered for this student and subject data.";
    } else {
        $insert_mark_data = mysqli_query($conn, "INSERT INTO mark_entry(student_id, subject_id, marks, remarks)  VALUES('$student_id', '$subject_id', '$marks', '$remarks')");
        header("Location: mark_entry.php");
        exit();
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Mark Entry</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f6fa;
            color: #333;
            display: flex;
            min-height: 100vh;
            padding: 0px !important;
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

        .form-group input,
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

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <?php include "includes/menu.php"; ?>

    <div class="content">
        <div class="header">
            <h2>Mark Entry</h2>
        </div>
        <div class="card">
            <form method="POST">
                <div class="form-group">
                    <label>Student Name</label>
                    <?php
                    $student_id = $_POST['student_id'] ?? $_GET['student_id'] ?? null;
                    if ($student_id) {
                        $student_data = mysqli_query($conn, "SELECT * FROM student_master WHERE id='$student_id'");
                        $student = mysqli_fetch_assoc($student_data);
                        echo "<input type='hidden' name='student_id' value='" . $student['id'] . "'>";
                        echo "<input type='text' value='" . $student['student_name'] . "' readonly>";
                    }
                    ?>
                </div>

                <div class="form-group">
                    <label>Subject Name</label>
                    <?php
                    $subject_id = $_POST['subject_id'] ?? $_GET['subject_id'] ?? null;
                    if ($subject_id) {
                        $subject_data = mysqli_query($conn, "SELECT * FROM subject_master WHERE id='$subject_id'");
                        $subject = mysqli_fetch_assoc($subject_data);
                        echo "<input type='hidden' name='subject_id' value='" . $subject['id'] . "'>";
                        echo "<input type='text' value='" . $subject['subject_name'] . "' readonly>";
                        //print_r($subject);
                    }
                    ?>
                </div>

                <div class="form-group">
                    <label>Marks</label>
                    <input type="text" name="marks" required>
                </div>

                <div class="form-group">
                    <label>Remarks</label>
                    <input type="text" name="remarks">
                </div>
                <button type="submit" name="submit">Save Details</button>
            </form>
        </div>
        <div>

            <style>
                body {
                    font-family: Arial, sans-serif;
                    padding: 20px;
                    background: #f5f6fa;
                }

                table {
                    width: 100%;
                    border-collapse: collapse;
                    background: #fff;
                }

                th,
                td {
                    padding: 12px;
                    border: 1px solid #ddd;
                    text-align: left;
                }

                th {
                    background: #2c3e50;
                    color: #fff;
                }

                tr:nth-child(even) {
                    background: #f2f2f2;
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

                table {
                    width: 100%;
                    border-collapse: collapse;
                    background: #fff;
                }

                th,
                td {
                    padding: 12px;
                    border: 1px solid #ddd;
                    text-align: left;
                }

                th {
                    background: #2c3e50;
                    color: #fff;
                }

                tr:nth-child(even) {
                    background: #f2f2f2;
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
            <h2>Marks Entry</h2>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Student Name</th>
                        <th>Subject</th>
                        <th>Marks</th>
                        <th>Remarks</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i=0;
                    $select_mark_data = mysqli_query($conn, "SELECT mark_entry.id AS mark_id, student_master.student_name, subject_master.subject_name, mark_entry.marks, mark_entry.remarks, mark_entry.student_id FROM mark_entry INNER JOIN student_master ON mark_entry.student_id = student_master.id INNER JOIN subject_master ON mark_entry.subject_id = subject_master.id");
                    while ($fetch_mark_data = mysqli_fetch_assoc($select_mark_data)) {
                        //print_r($fetch_mark_data);
                        $i++;
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $fetch_mark_data['student_name']; ?></td>
                            <td><?php echo $fetch_mark_data['subject_name']; ?></td>
                            <td><?php echo $fetch_mark_data['marks']; ?></td>
                            <td><?php echo $fetch_mark_data['remarks'] ?></td>
                            <td>
                                <a href="updatemark.php?id=<?php echo $fetch_mark_data['mark_id']; ?>" class="btn update-btn"
                                    style="text-decoration: none;">Update</a>
                                <a href="mark_entry.php?delete_id=<?php echo $fetch_mark_data['mark_id']; ?>"
                                    onclick="return confirm('Are you sure you want to delete this data?');"
                                    class="btn delete-btn" style="text-decoration: none;">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>