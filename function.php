<?php

function getRank($conn, $order, $rank) {

    // ASC = lowest, DESC = highest
    $orderBy = ($order == "highest") ? "DESC" : "ASC";

    // rank → LIMIT (rank - 1,1) limit starts by 0
    $offset = $rank - 1;

    $query = "SELECT mark_entry.marks, student_master.student_name FROM mark_entry INNER JOIN student_master ON mark_entry.student_id = student_master.id ORDER BY mark_entry.marks $orderBy LIMIT $offset, 1";
    $run = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($run);
}
