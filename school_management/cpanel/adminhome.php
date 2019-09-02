<?php
require_once '../lib/admin.php';
require_once '../lib/teacher.php';
require_once '../lib/student.php';
require_once '../lib/class_room.php';
require_once 'template/header.php';
//require_once 'template/navbar.tpl';

?>

<div id="content">
    <?php
        if (!(isset($_SESSION['id']) && isset($_SESSION['name']))) {
            echo 'please log in <a href="login.php">log in</a>';
            echo '<div id="loginImage"><a href="login.php"title="login"><img src="template/images/Log In.jpg"></a></div>';
        } else {
            ?>
    <div id="left_content">
        <?php
        $allTeachers=  Teacher::retrieveAllTeacher();
        $allStudents = Student::retrieveAllStudent();
        $classRooms = Class_room::retrieveAllClassRooms();
        ?>
        <div id="statistics">
            <div class="statisticsRow">
                <lable>total teachers count:</lable>
                <div class="statisticsInfo">
                    <?php echo count($allTeachers)?>
                     <?php //echo 'hellow'?>
                </div>
            </div>
            <div class="statisticsRow">
                <lable>total students count:</lable>
                <div class="statisticsInfo">
                    <?php echo count($allStudents)?>
                </div>
            </div>
            <div class="statisticsRow">
                <lable>total class rooms count:</lable>
                <div class="statisticsInfo">
                    <?php echo count($classRooms)?>
                </div>
            </div>
        </div>
    </div>
    <?php require_once 'template/right_content.tpl'; ?>
     <?php }?>
</div>
<?php
require_once 'template/footer.tpl';
?>
