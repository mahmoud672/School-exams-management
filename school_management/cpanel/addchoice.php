<?php
    require_once '../lib/teacher.php';
    require_once '../lib/subject.php';
    require_once '../lib/exam.php';
    require_once '../lib/question.php';
    require_once '../lib/question_choices.php';
    require_once 'template/header.php';
   // require_once 'template/navbar.tpl';
   
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
        if(isset($_GET['action'],$_GET['id'])){
            $action=$_GET['action'];
            $id_exam=$_GET['id'];
            switch($action):
                case('addChoices'):
                    $allQuestions=Question::retrieveQuestionByIdExam($id_exam);
                    echo '<div class="form">
                            <form action="'.$_SERVER['PHP_SELF'].'"method="post">
                                <lable>select question:</lable>
                                <select name="id_question">
                                    <option value="">--select question--</option>
                        ';
                                if(is_array($allQuestions)){
                                    foreach ($allQuestions as $questions):
                                        echo '<option value="'.$questions['id'].'">'.$questions['title'].'</option>';
                                    endforeach;
                                }else{
                                    echo '<div id="msg">no questions to show</div>';
                                }
                                echo'</select>
                                <lable>choices:</lable>
                                <input type="text"name="choice[]"class="input"placeholder="wirte choice"/>
                                <input type="text"name="choice[]"class="input"placeholder="wirte choice"/>
                                <input type="text"name="choice[]"class="input"placeholder="wirte choice"/>
                                <input type="text"name="choice[]"class="input"placeholder="wirte choice"/>
                                <input type="submit"name="addChoice"value="Add Choice">
                            </form>
                        </div>';
                break;
                default:
                echo '<div id="msg">invalid action</div>';
            endswitch;
        }
        if(isset($_POST['addChoice'])){
            $id_question=$_POST['id_question'];
            $choices=isset($_POST['choice'])?$_POST['choice']:null;
            if($id_question==null){
                echo '<div id="msg">please choose a question to attach some choices to .</div>';
            }elseif(!is_numeric($id_question)){
                echo '<div id="msg">invalid editable for question value</div>';
            }elseif ($choices==null) {
                echo '<div id="msg">please write the choices for this question</div>';    
            }else{
                if(is_array($choices)){
                foreach ($choices as $choice):
                   $question_choices=new Question_choices($id_question, $choice);
                   $question_choices->addQuestion();
                endforeach;
            }  else {
                echo '<div id="msg">there is an error choices</div>';;
            }
            }
            
        }
        ?>
        <table>
            <thead>
            <tr>
                <td>exam number</td>
               <td>teacher</td>
               <td>subject</td>
               <td>manage choices</td>
           </tr>
            </thead>
            <tbody>
               <?php
                $allExams=Exam::retrieveExamByIdTeacher($_SESSION['id']);
                if(is_array($allExams)){
                    foreach ($allExams as $exams):
                        echo '<tr>
                                <td>'.$exams['id'].'</td>
                                <td>'.  Teacher::retrieveTeacherNameById($exams['id_teacher']).'</td>
                                <td>'.  Subject::retrieveSubjectName($exams['id_subject']).'</td>
                                <td><a href="?action=addChoices&id='.$exams['id'].'">add choices</a></td>
                            </tr>';
                    endforeach;
                }  else {
                    echo '<tr><td>no exam to show its questions</td></tr>';
                }
                ?> 
            </tbody>
        </table>
        </div>
    <?php  require_once 'template/right_content_teacher.tpl'; ?>
    <?php }?>
</div>

<?php
    require_once 'template/footer.tpl'; 
?>