<?php
    require_once '../lib/teacher.php';
    require_once '../lib/subject.php';
    require_once '../lib/exam.php';
    require_once '../lib/question.php';
    require_once '../lib/question_choices.php';
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
        if(isset($_POST['sendResult'])){
            $id_exam=$_POST['id_exam'];
            $choices=isset($_POST['choice'])?$_POST['choice']:null;
            $total=0;
            if(is_array($choices)){
                foreach ($choices as $choice):
                    $allQuestions=Question::retrieveQuestionByIdExam($id_exam);
                     foreach ($allQuestions as $questions):
                         if($choice==$questions['answer']){
                             //echo 'okk'.' ';
                             $total++;
                         }  else {
                             //echo 'fail'.' ';
                         }
                     endforeach;
                endforeach;
                $grade=$total*2;
                echo'your grade is:'. $grade;
            }  else {
                echo 'no choosen answers';
            }
        }
        //29/5/2017 : 9 am
        /*$date=date('d/m/Y : h a');
        echo $date.'</br>';//28/04/2017 : 06
        $string=12;
        echo strlen($string);*/
        
        ?>
        <div class="form">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>"method="post">
                <lable>select exam to choose its paper</lable>
                <select name="id_exam"id="selectExam">
                    <option>--select exam--</option>
                <?php
                $exams=Exam::retrieveExamByIdTeacher($_SESSION['id']);
                if(is_array($exams)){
                    foreach ($exams as $exam):
                        echo '<option value="'.$exam['id'].'">'.Subject::retrieveSubjectName($exam['id_subject']).'</option>';
                    endforeach;
                }  else {
                    echo '<div id="msg">no exams </div>';
                }
                ?>
                     </select>
                <div id="examPaper">
                </div>
                <div id="asd">
                </div>
                <!--<button id="sendResult"type="submit">Send Result</button>-->
                <input type="submit"name="sendResult"value="send result">
            </form>
        </div>
        </div>
    <?php  require_once 'template/right_content_teacher.tpl'; ?>
    <?php }?>
</div>

<?php
    require_once 'template/footer.tpl'; 
?>