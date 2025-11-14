<?php
include "includes/config.php";
include "includes/security.php";
include "function.php";

$sub_count = mysqli_query($conn, "SELECT COUNT(*) AS total FROM subject_master");
$subject_count = mysqli_fetch_assoc($sub_count)['total'];
$stu_count = mysqli_query($conn, "SELECT COUNT(*)  AS total FROM student_master");
$student_count = mysqli_fetch_assoc($stu_count)['total'];

$first_high  = getRank($conn, "highest", 1);
$second_high = getRank($conn, "highest", 2);
$third_high  = getRank($conn, "highest", 3);

$first_low  = getRank($conn, "lowest", 1);
$second_low = getRank($conn, "lowest", 2);
$third_low  = getRank($conn, "lowest", 3);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Admin Dashboard</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0
        }

        .header {
            display: flex;
            justify-content: space-between;
            /* pushes h2 left and button right */
            align-items: center;
            /* vertically centers items */
            background-color: #f5f5f5;
            padding: 15px 30px;
            border-bottom: 2px solid #ddd;
        }

        .header h2 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        .header button {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .header button:hover {
            background-color: #e60000;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
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
            padding: 20px;
        }

        .header {
            background: #fff;
            padding: 15px 20px;
            border-bottom: 1px solid #ddd;
            margin: -20px -20px 20px;
            border-radius: 4px 4px 0 0
        }

        .dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .card {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .card h3 {
            margin: 0;
            font-size: 18px;
            color: #555;
        }

        .card p {
            margin-top: 10px;
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
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

        .card.rank-card {
            background: #ffffff;
            padding: 25px;
            border-radius: 14px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
            text-align: center;
            transition: 0.3s;
            position: relative;
            overflow: hidden;
        }

        .card.rank-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 22px rgba(0, 0, 0, 0.18);
        }

        .card.rank-card .badge {
            position: absolute;
            top: -15px;
            right: -15px;
            background: #ff4d4d;
            color: white;
            padding: 10px 18px;
            font-size: 14px;
            font-weight: bold;
            transform: rotate(20deg);
            border-radius: 6px;
        }

        .card.rank-card h3 {
            font-size: 22px;
            font-weight: bold;
            color: #333;
        }

        .card.rank-card .mark {
            font-size: 40px;
            font-weight: bold;
            color: #ff4d4d;
            margin: 10px 0;
        }

        .card.rank-card .student {
            font-size: 16px;
            font-weight: 500;
            color: #555;
            opacity: 0.8;
        }
    </style>
</head>

<body>

    <?php include "includes/menu.php"; ?>

    <div class="content">
        <div class="header">
            <h2>Dashboard</h2>
            <form action="logout.php" method="post">
                <button type="submit" name="logout">Log out</button>
            </form>
        </div>

        <div class="dashboard">
            <div class="card">
                <h3>Total Subjects</h3>
                <p><?php echo $subject_count; ?></p>
            </div>

            <div class="card">
                <h3>Total Students</h3>
                <p><?php echo $student_count; ?></p>
            </div>

            <div class="card" style="border-top:5px solid #ff4d4d;">
                <h3>1st Mark</h3>
                <p><?php echo $first_high['marks']; ?></p>
                <p><?php echo $first_high['student_name']; ?></p>
            </div>

            <div class="card" style="border-top:5px solid #3498db;">
                <h3>2nd Mark</h3>
                <p><?php echo $second_high['marks']; ?></p>
                <p><?php echo $second_high['student_name']; ?></p>
            </div>

            <div class="card" style="border-top:5px solid #2ecc71;">
                <h3>3rd Mark</h3>
                <p><?php echo $third_high['marks']; ?></p>
                <p><?php echo $third_high['student_name']; ?></p>
            </div>

            <div class="card" style="border-top:5px solid green;">
                <h3>1st Lowest</h3>
                <p><?php echo $first_low['marks']; ?></p>
                <p><?php echo $first_low['student_name']; ?></p>
            </div>

            <div class="card" style="border-top:5px solid orange;">
                <h3>2nd Lowest</h3>
                <p><?php echo $second_low['marks']; ?></p>
                <p><?php echo $second_low['student_name']; ?></p>
            </div>

            <div class="card" style="border-top:5px solid purple;">
                <h3>3rd Lowest</h3>
                <p><?php echo $third_low['marks']; ?></p>
                <p><?php echo $third_low['student_name']; ?></p>
            </div>
        </div>
    </div>

</body>

</html>