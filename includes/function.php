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
