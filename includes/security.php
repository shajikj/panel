<?php
if(!isset($_SESSION['is_logged_in'])){
    header("Location: index.php");
    exit();
}
?>