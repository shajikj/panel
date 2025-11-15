<?php include "includes/config.php";
include "includes/security.php";
if (isset($_POST['submit'])) {
    $teachername = $_POST['teacher_name'];
    $subjectid = $_POST['subject_id'];
    $contactnumber = $_POST['contact_number'];
    $email = $_POST['email'];
    $insert_tec_data = mysqli_query($conn, "INSERT INTO teacher_master(teacher_name, subject_id, contact_number, email) VALUES('$teachername', '$subjectid', '$contactnumber', '$email')");
    header("Location: teacher_master.php");
    exit();
}
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_data = mysqli_query($conn, "DELETE FROM teacher_master WHERE id='$delete_id'");
    header("Location: teacher_master.php");
    exit();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Teacher Master</title>
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
            min-height: 100vh
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
            <h2>Teacher Master</h2>
        </div>
        <?php

        if (isset($_GET['error'])) {
            echo "<p style='color:red;'>" . $_GET['error'] . "</p>";
        }
        ?>
        <div class="card">
            <form method="POST">
                <div class="form-group">
                    <label>Teacher Name</label>
                    <input type="text" name="teacher_name" placeholder="Enter teacher name">
                </div>
                <div class="form-group">
                    <label>Subject Name</label>
                    <select name="subject_id" class="form-control">
                        <option value="">-- Select Subject --</option>
                        <?php
                        $select_sub_data = mysqli_query($conn, "SELECT * FROM subject_master");
                        while ($fetch_data = mysqli_fetch_assoc($select_sub_data)) {
                            echo "<option value = '" . $fetch_data['id'] . "'>" . $fetch_data['subject_name'] . "</option>";
                            ?>

                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Contact Number</label>
                    <input type="tel" name="contact_number" placeholder="Enter contact number">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Enter email">
                </div>
                <button type="submit" name="submit">Save Details</button>
            </form>
        </div>
        <div>
            <table border="1">
                <tr>
                    <th>Id</th>
                    <th>Teacher Name</th>
                    <th>Subject Name</th>
                    <th>Contact Number</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                <?php
                $select_data = mysqli_query($conn, "SELECT teacher_master.id AS teacher_id, teacher_master.teacher_name, teacher_master.contact_number, teacher_master.email, subject_master.subject_name FROM teacher_master INNER JOIN subject_master ON teacher_master.subject_id = subject_master.id");
                $i = 0;
                // using inner join to fetch subject name from subject_master table to teacher_master table.
                while ($fetch_data = mysqli_fetch_assoc($select_data)) {
                    $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>

                        <td
                            ondblclick="update_teacher_name(<?php echo $fetch_data['teacher_id']; ?>, '<?php echo $fetch_data['teacher_name']; ?>')">
                            <span id="teacherID<?php echo $fetch_data['teacher_id']; ?>">
                                <?php echo $fetch_data['teacher_name']; ?>
                            </span>

                        </td>

                        <td
                            ondblclick="update_sub_name(<?php echo $fetch_data['teacher_id']; ?>, '<?php echo $fetch_data['subject_name']; ?>')">
                            <span id="subjectID<?php echo $fetch_data['teacher_id']; ?>">
                                <?php echo $fetch_data['subject_name']; ?>
                            </span>
                        <td
                            ondblclick="update_cod_no(<?php echo $fetch_data['teacher_id']; ?>, <?php echo $fetch_data['contact_number']; ?>)">
                            <span id="contactID<?php echo $fetch_data['teacher_id']; ?>">
                                <?php echo $fetch_data['contact_number']; ?>
                            </span>
                        </td>
                        <td
                            ondblclick="update_email(<?php echo $fetch_data['teacher_id']; ?>, '<?php echo $fetch_data['email']; ?>')">
                            <span id="emailID<?php echo $fetch_data['teacher_id']; ?>">
                                <?php echo $fetch_data['email']; ?>
                            </span>

                        </td>

                        <td>
                            <a href="update_teacher.php?id=<?php echo $fetch_data['teacher_id']; ?>" class="btn update-btn"
                                style="text-decoration: none;">Update</a>
                            <a href="teacher_master.php?delete_id=<?php echo $fetch_data['teacher_id']; ?>"
                                onclick="return confirm('Are you sure you want to delete this data?');"
                                class="btn delete-btn" style="text-decoration: none;">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    function update_teacher_name(ID, NAME) {
        selectorID = "teacherID" + ID;
        console.log(selectorID);
        $("#" + selectorID).html("<input type = 'text' class = 'teacher_name' value = '" + NAME + "'>");
    }

    function update_sub_name(ID, SUB) {
        selectorID = "subjectID" + ID;
        console.log(selectorID);
        $("#" + selectorID).html("<input type = 'text' class = 'subject_name' value = '" + SUB + "'>");
    }

    function update_cod_no(ID, NO) {
        selectorID = "contactID" + ID;
        console.log(selectorID);
        $("#" + selectorID).html("<input type = 'text' class = 'contact_number' value = '" + NO + "'>");
    }

    function update_email(ID, EMAIL) {
        selectorID = "emailID" + ID;
        console.log(selectorID);
        $("#" + selectorID).html("<input type = 'text' class = 'email' value = '" + EMAIL + "'>");
    }
</script>

</html>