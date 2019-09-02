<?php
    require_once '../lib/admin.php';
    require_once '../lib/subject.php';
    require_once '../lib/exam.php';
    require_once '../lib/exam_sitting.php';
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
        if(isset($_POST['addStatus'])){
            $id_exam=$_POST['id_exam'];
            $status=isset($_POST['status'])?$_POST['status']:null;
            if($id_exam==null){
                echo '<div id="msg">choose an exam</div>';
            }elseif (!is_numeric($id_exam)) {
                 echo '<div id="msg">invalid edittion for exam</div>';
            }elseif ($status==null) {
                echo '<div id="msg">exam status is empty</div>';
            }elseif (!is_numeric($status)) {
                echo '<div id="msg">invalid edittion for exam status</div>';
            }  else {
                //$examStatus=Exam_sitting::retrieveAllExamSittings();
                $examStatus=  Exam_sitting::retrieveExamSittingByIdExam($id_exam);
                if($examStatus ==null){
                    $exam_sitting=new Exam_sitting($id_exam, $status);
                    $exam_sitting->addExamSitting();
                }  else {
                    $exam_sitting=new Exam_sitting($id_exam, $status);
                    $exam_sitting->updateExamSitting();
                }
                
                                       
            }
        }
        
    ?>
    <div class="form">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>"method="post">
            <lable>select exam:</lable> 
            <select name="id_exam">
                <option value="">--choose an exam--</option>
                <?php 
                    $allExams=  Exam::retrieveAllExams();
                    if(is_array($allExams)){
                        foreach ($allExams as $exams):
                            echo '<option value="'.$exams['id'].'">'.Subject::retrieveSubjectName($exams['id_subject']).'</option>';
                        endforeach;
                    }else{
                        echo '<option>there is no exams</option>';
                    }
                ?>
            </select>
            <lable>exam status:</lable>
            <table id="table"style="width:100px;margin-top:0px ">
                <thead>
                    <tr>
                        <td>on</td>
                        <td>off</td>
                    </tr>
                </thead>
                <tbody>
                     <tr>
                        <td><input type="radio"name="status"value="1"id="radio"></td>
                        <td><input type="radio"name="status"value="0"id="radio"></td>
                    </tr>
                </tbody>
            </table>
            <input type="submit"name="addStatus"value="Add Status">
        </form>
    </div>
        </div>
    <?php require_once 'template/right_content.tpl'; ?>
     <?php }?>
</div>
<?php
    
    require_once 'template/footer.tpl';
?>
