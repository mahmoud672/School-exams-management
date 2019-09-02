<?php
    require_once '../lib/teacher.php';
    require_once '../lib/subject.php';
    require_once '../lib/exam.php';
    require_once '../lib/question.php';
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
        if(isset($_POST['addQuestion'])){
            $title=$_POST['title'];
            $answer=$_POST['answer'];
            $id_exam=$_POST['id_exam'];
            if($title==null){
                echo '<div id="msg">please enter a question</div>';
            }elseif($answer==null){
                 echo '<div id="msg">please enter an answer</div>';
            }elseif($id_exam==null){
                 echo '<div id="msg">please choose an exam</div>';
            }elseif(!is_numeric($id_exam)){
                 echo '<div id="msg">invalid editing value for exam</div>';
            }else{
                
                $question=new Question($title, $answer, $id_exam);
                if($question->addQuestion()){
                    echo '<div id="msg">successfull addition processing</div>';
                    $questions=count(Question::retrieveQuestionByIdExam($id_exam));
                    echo 'you have '.$questions.' question(s) .';
                }  else {
                    echo '<div id="msg">error in addition processing</div>';
                }
            }
        }
        ?>
   
 
    <div class="form">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>"method="post">
            <lable>question :</lable>
            <input type="text"name="title"value=""class="input"placeholder="question"id="QA">
            <lable>answer:</lable>
            <input type="text"name="answer"value=""class="input"placeholder="answer"id="QA">
            <!----------------->
            <lable>select subject for this exam</lable>
            <select name="id_exam">
                <option value="">--select exam--</option>
                <?php
                $allExams=Exam::retrieveExamByIdTeacher($_SESSION['id']);
                if(is_array($allExams)){
                    foreach ($allExams as $exams):
                        echo '<option value="'.$exams['id'].'">'.Subject::retrieveSubjectName($exams['id_subject']).'</option>';
                    endforeach;
                }else{
                    echo '<option>there is no exams for you to select</option>';
                }
                ?>
            </select>
            <input type="submit"name="addQuestion"value="Add Question">
        </form>
    </div>
        </div>
    <?php  require_once 'template/right_content_teacher.tpl'; ?>
    <?php }?>
</div>

<?php
    require_once 'template/footer.tpl'; 
?>