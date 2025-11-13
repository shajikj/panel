<?php
include "includes/config.php";
include "includes/security.php";
if (isset($_POST['submit'])) {
    $subjectname = $_POST['subject_name'];
    $subjectcode = $_POST['subject_code'];
    $insert_sub_data = mysqli_query($conn, "INSERT INTO subject_master(subject_name, subject_code) VALUES('$subjectname', '$subjectcode')");
    header("Location: subject_master");
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $subjectname = $_POST['subject_name'];
    $subjectcode = $_POST['subject_code'];
    $update_sub_data = mysqli_query($conn, "UPDATE subject_master SET subject_name='$subjectname', subject_code='$subjectcode' WHERE id='$id'");
    header("Location: subject_master");
    exit();
}

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sub_data = mysqli_query($conn, "DELETE FROM subject_master WHERE id='$delete_id'");
    header("Location: subject_master.php");
    exit();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Subject Master</title>
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
                    <label>Subject Name</label>
                    <input required id="subject_name" type="text" onchange="validate_sub_id()" name="subject_name"
                        placeholder="Enter Subject Name"><br>
                    <span id="subject_error" style="display: none; color: red;">This field already exists</span>
                </div>
                <div class="form-group">
                    <label>Subject Code</label>
                    <input required id="subject_code" type="text" onchange="validate_sub_id()" name="subject_code"
                        placeholder="Enter Subject Code"><br>
                    <span id="subject_code_error" style="display: none; color: red;">This field is already exists</span>
                </div>
                <button type="submit" name="submit">Save</button>
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
            <h2>Student Master Data</h2>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Subject Name</th>
                        <th>Subject Code</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $sel_student_data = mysqli_query($conn, "SELECT * FROM subject_master");
                    while ($fetch_data = mysqli_fetch_assoc($sel_student_data)) {
                        //print_r($fetch_data);
                        ?>
                        <tr>
                            <td><?php echo $fetch_data['id']; ?></td>

                            <td ondblclick="update_sub_name(<?php echo $fetch_data['id'];?>, '<?php echo $fetch_data['subject_name']; ?>')">

                                <span id="subjectID<?php echo $fetch_data['id']; ?>" >
                                    <?php echo $fetch_data['subject_name']; ?>
                                </span>
                            </td>

                            <td ondblclick="update_sub_code(<?php echo $fetch_data['id']; ?>, '<?php echo $fetch_data['subject_code']?>')">
                                 <span id="subcodeID<?php echo $fetch_data['id']; ?>">
                                     <?php echo $fetch_data['subject_code']; ?>
                                 </span>
                                </td>

                            <td>
                                <a href="update_subject.php?id=<?php echo $fetch_data['id']; ?>" class="btn update-btn"
                                    style="text-decoration: none;">Update</a>
                                <a href="subject_master.php?delete_id=<?php echo $fetch_data['id']; ?>"
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    function validate_sub_id() {
        var subject_id = $("#subject_name").val();
        var subject_code = $("#subject_code").val();
        if (subject_id != "" && subject_code != "") {
            var data = "validate_sub_id&subject_id=" + subject_id + "&subject_code=" + subject_code;
            $.ajax({
                type: "GET",
                url: "ajax.php",
                data: data,
                success: function (response) {
                    if (response == "exists") {
                        $("#subject_error").show();
                        $("#subject_name").val("");
                        $("#subject_code_error").show();
                        $("#subject_code").val("");
                    } else {
                        $("#subject_error").hide();
                        $("#subject_code_error").hide();
                    }
                }
            })
        }
    }

    function update_sub_name(ID, NAME) {
        selectorID = "subjectID" + ID;
        console.log(selectorID);
        $("#" + selectorID).html("<input type = 'text' class = 'subject_name' value = '"+ NAME + "'>");
    }

    function update_sub_code(ID, CODE) {
        selectorID = "subcodeID" + ID;
        console.log(selectorID);
        $("#" + selectorID).html("<input type = 'text' class = 'subject_code' value = '"+ CODE +"'>");
    }
</script>

</html>