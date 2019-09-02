<?php
    require_once '../lib/admin.php';
    require_once 'template/header.php';
    //require_once 'template/navbar.tpl';
    require_once '../lib/teacher.php';
    require_once '../lib/student.php';
    require_once '../lib/class_room.php';
    require_once '../lib/class_management.php';
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
        if(isset($_POST['addClassRoom'])){
            $name=$_POST['name'];
            $id_teacher=$_POST['id_teacher'];
            $id_student=isset($_POST['id_student'])?$_POST['id_student']:null;
            if($name==null){
                echo '<div id="msg">Please fill the name field!</div>';
            }elseif(is_numeric($name)){
                echo '<div id="msg">Please name must be letters !</div>';
            }elseif($id_teacher==null){
                echo '<div id="msg">Please choose teacher for this class room!</div>';
            }elseif(!is_numeric($id_teacher)){
                echo '<div id="msg">invalid value for teacher!</div>';
            }elseif($id_student==null){
                echo '<div id="msg">Please choose some students for this class room!</div>';
            }/*elseif(!is_numeric($id_student)){
                echo '<div id="msg">invalid value for student!</div>';
            }*/else{
                $clssRoom=new Class_room($name);
                $id_class_room=$clssRoom->addClassRoom();
                if(is_array($id_student)){
                    if($id_class_room !=False && $id_student !=null){
                        foreach($id_student as $student_id):
                            $classManagement=new Class_management($id_teacher,$student_id, $id_class_room);
                            $classManagement->addTeacherAndStudentForSpecificClass();
                        endforeach;
                    }
                }
            }
        }
    ?>
    <div class="form">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>"method="post">
            <lable>Class name:</lable>
            <input type="text"name="name"/>
            <lable>Choose teacher for this class room:</lable>
            <select name="id_teacher"class="input">
                <option value=""></option>
                <?php
                    $allTeacher=  Teacher::retrieveAllTeacher();
                    if(is_array($allTeacher)){
                        foreach ($allTeacher as $teachers):
                            echo '<option value="'.$teachers['id'].'">'.$teachers['name'].'</option>';
                        endforeach;
                    }else{
                        echo 'no data found';
                    }
                    
                ?>
            </select>
            <lable>Choose student for this class room:</lable>
            <select name="id_student[]"multiple="multiple"class="input">
                <option value=""></option>
                <?php
                    $allStudents= Student::retrieveAllStudent();
                    if(is_array($allStudents)){
                        foreach ($allStudents as $students):
                            echo '<option value="'.$students['id'].'">'.$students['name'].'</option>';
                        endforeach;
                    }else{
                        echo 'no data found';
                    }
                    
                ?>
            </select>
            <input type="submit"name="addClassRoom"value="Add Class Room">
        </form>
    </div>
        </div>
    <?php require_once 'template/right_content.tpl'; ?>
    <?php }?>
</div>
<?php
    require_once 'template/footer.tpl';
?>
