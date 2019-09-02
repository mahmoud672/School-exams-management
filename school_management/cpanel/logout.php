<?php
    require_once '../lib/student.php';
    
    if(isset($_SESSION['id'])&&isset($_SESSION['name'])){
        unset($_SESSION['id']);
        unset($_SESSION['name']);
        header("location:login.php");
        exit();
    }else{
        header("location:index.php");
        exit();
    }
?>

