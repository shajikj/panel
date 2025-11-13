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
if (isset($_GET['delete_id'])) {
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

        #roll_no_id {
            border: 1px solid red;
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
                    <input required type="text" name="student_name" placeholder="Enter student name">
                </div>

                <div class="form-group">
                    <label>Roll Number</label>
                    <input required id="roll_no_id" onchange="validate_roll_no()" type="text" name="roll_number"
                        placeholder="Enter roll number ">
                    <br>
                    <span id="roll_no_error" style="color:red; display:none;">Roll Number already exists for the
                        selected class.</span>
                </div>

                <div class="form-group">
                    <label>Class Name</label>
                    <select onchange="validate_roll_no()" required id="class_id" name="class_name" class="form-control">
                        <option value="">-- Select Class --</option>
                        <?php
                        $select_class_data = mysqli_query($conn, "SELECT * FROM class_master");
                        while ($fetch_class_data = mysqli_fetch_assoc($select_class_data)) {
                            echo "<option value = '" . $fetch_class_data['id'] . "'>" . $fetch_class_data['class'] . "</option>";
                            ?>
                        <?php } ?>
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
                        <td
                            ondblclick="update_student_name(<?php echo $fetch_data['id']; ?>,'<?php echo $fetch_data['student_name']; ?>')">
                            <span id="studentnameID<?php echo $fetch_data['id']; ?>">
                                <?php echo $fetch_data['student_name']; ?>
                            </span>
                        </td>

                        <td
                             ondblclick="update_roll_no(<?php echo $fetch_data['id']; ?>,'<?php echo $fetch_data['roll_number']; ?>')">
                            <span id="rollnumberID<?php echo $fetch_data['id']; ?>">
                                <?php echo $fetch_data['roll_number']; ?>
                            </span>
                        </td>
                        
                        <td 
                             ondblclick="update_class_name(<?php echo $fetch_data['id'];?>, '<?php echo $fetch_data['class']; ?>')">
                             <span id="classID<?php echo $fetch_data['id']; ?>">
                                 <?php echo $fetch_data['class']; ?>
                             </span>
                        </td>

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    function validate_roll_no() {
        var roll_no = $("#roll_no_id").val();// get roll number from the input field
        var class_id = $("#class_id").val();// get class id value from the select field
        if (roll_no != "" && class_id != "") {// check if both field have values
            // prepare data to send to server
            var data = "validate_roll_no&roll_no=" + roll_no + "&class_id=" + class_id;// create a query string
            $.ajax({// send ajax request
                type: "GET",
                url: "ajax.php",// the php file processing the request
                data: data,
                success: function (response) {// handle server response
                    if (response == "exists") {
                        $("#roll_no_error").show();// show error message
                        $("#roll_no_id").val("");// clear the input field
                    } else {
                        $("#roll_no_error").hide();// hide error if roll number is okay
                    }
                }
            })
        }
    }
    function update_student_name(ID, NAME) {
        selectorID = "studentnameID" + ID;
         console.log(selectorID);
        $("#" + selectorID).html("<input onchange='change_name(" + ID + ", this.value)' type='text' name='student_name' value='" + NAME + "'>");
    }
    function change_name(ID,NAME){
        var data = "update_student_name&name="+NAME+"&id="+ID;
        $.ajax({
            type:"GET",
            url:"ajax.php",
            data:data,
            success: function(response){
                alert("OOK Running");
            }
        })

    }

    function update_roll_no(ID, ROLL){
        selectorID = "rollnumberID" + ID;
        console.log(selectorID);
        $("#" + selectorID).html("<input onchange = 'change_roll_no("+ ID +", this.value)' type = 'text' name = 'roll_no' value = '"+ ROLL +"'>");

    }
    function change_roll_no(ID, ROLL) {
        var data = "update_roll_no&roll_no="+ROLL+"&id="+ID;
        $.ajax({
            type:"GET",
            url: "ajax.php",
            data:data,
            success: function(response) {
                // alert("ok");
            }
        })
    }

    function update_class_name(ID, CLASS) {
      selectorID = "classID" + ID;
      console.log(selectorID);
      $("#" + selectorID).html("<input onchange = 'change_class("+ID +", this.value)' type = 'text' name = 'class_name' value = '"+CLASS+"'>");
    }
    function change_class(ID, CLASS) {
        var data = "update_class_name&class_name="+CLASS+"&id="+ID;
        $.ajax({
            type: "GET",
            url: "ajax.php",
            data: data,
            success: function(response){
                alert("ok");
            }
        })
    }
</script>

</html>