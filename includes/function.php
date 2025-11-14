<?php
   function subject_master($conn, $ID){
    $select_sub_data = mysqli_query($conn, "SELECT * FROM subject_master");
    return mysqli_fetch_assoc($select_sub_data);
   }
?>

<?php
function teacher_master($conn) {
    // Query to get all teachers
    $select_teacher_data = mysqli_query($conn, "SELECT * FROM teacher_master");
    
    $teachers = [];
    while($row = mysqli_fetch_assoc($select_teacher_data)) {
        $teachers[] = $row; // store each row in array
    }
    return $teachers;
}
?>

<?php
     function student_master($conn){
      $select_student_data = mysqli_query($conn, "SELECT * FROM student_master");
      $student = [];
      while($row = mysqli_fetch_assoc($select_student_data)){
         $student[] = $row;
      }
      return $student;
     }
?>

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
?>

<?php
   function getclass($conn, $order, $rank) {
         $orderby = ($order == "highest") ? "DESC" : "ASC";
         $offset = $rank - 1;
         $query = "SELECT mark_entry.marks, student_master.student_name FROM mark_entry INNER JOIN student_master ON mark_entry.student.id = student_master.id ORDER BY mark_entry.marks $orderby LIMIT $offset, 1";
         $run = mysqli_query($conn, $query);
         return mysqli_fetch_assoc($run);    
   }
?>
