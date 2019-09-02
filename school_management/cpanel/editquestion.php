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
        if(isset($_GET['action'],$_GET['id'])){
            $action=$_GET['action'];
            $id_exam=$_GET['id'];
            if($action='showQuestions'){
                $allQuestions=Question::retrieveQuestionByIdExam($id_exam);
                echo '<table>
                    <thead>
                        <tr>
                            <td>question number</td>
                            <td>title</td>
                            <td>answer</td>
                            <td>delete</td>
                            <td>edit</td>
                            <td>choices</td>
                        </tr>
                    </thead>
                    <tbody>';
                if(is_array($allQuestions)){
                    $index=1;
                    foreach ($allQuestions as $questions):
                        echo '<tr>
                                <td>'.$index.'</td>
                                <td>'.$questions['title'].'</td>
                                <td>'.$questions['answer'].'</td>
                                <td><a href="?actionOfQuestion=deleteQuestion&id='.$questions['id'].'">Delete</a></td>
                                <td><a href="?actionOfQuestion=editQuestion&id='.$questions['id'].'">Edit</a></td>
                                <td><a href="?actionOfQuestion=showQuestionChoices&id='.$questions['id'].'">show</a></td>
                            </tr>';
                    $index++;
                    endforeach;
                }else{
                    echo '<tr><td colspan="5">no question to show</td></tr>';
                }
                echo '</tbody>
                        </table>';
            }else{
                echo '<div id="msg">invalid action <div>';
            }
        }
        
        if(isset($_GET['actionOfQuestion'],$_GET['id'])){
            $action=$_GET['actionOfQuestion'];
            $id=$_GET['id'];
            switch ($action):
                case('deleteQuestion'):
                    Question::deleteQuestionById($id);
                break;
                case('editQuestion'):
                    $question=Question::retrieveQuestionById($id);
                    if(is_array($question)){
                        echo '<div class="form">
                                 <form action="'.$_SERVER['PHP_SELF'].'"method="post">
                                    <lable>question :</lable>
                                    <input type="text"name="title"value="'.$question['title'].'"class="input"placeholder="question"id="QA">
                                    <lable>answer:</lable>
                                    <input type="text"name="answer"value="'.$question['answer'].'"class="input"placeholder="answer"id="QA">
                                    <input type="hidden"name="id"value="'.$question['id'].'">
                                    <input type="hidden"name="id_exam"value="'.$question['id_exam'].'">    
                                    <input type="submit"name="updateQuestion"value="Update Question">
                                </form>
                             </div>';
                    }  else {
                        echo '<div id="msg">no question to edit<div>';
                    }
                break;
                case('showQuestionChoices'):
                    $allQuestionChoices=Question_choices::retrieveQuestionChoicesById($id);
                    echo '<table>
                            <thead>
                                <tr>
                                    <td>choices</td>
                               </tr>
                            </thead>
                            <tbody>';
                                if(is_array($allQuestionChoices)){
                                    foreach ($allQuestionChoices as $questionChoices):
                                       echo'<tr>
                                                <td>'.$questionChoices['choice'].'</td>
                                           </tr>
                                           ';
                                    endforeach;
                                }else{
                                    echo '<tr><td>no choices for this question</td></tr>';
                                }
                    echo' </tbody>
                        </table>
                         ';
                    break;
                default:
                    echo '<div id="msg">invalid action</div>';
            endswitch;
        }
       
        
        //update question
        if(isset($_POST['updateQuestion'])){
            $id=$_POST['id'];
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
                
                $question=new Question($title, $answer, $id_exam,$id);
                if($question->updaQuestion()){
                    echo '<div id="msg">successfull addition processing</div>';
                }  else {
                    echo '<div id="msg">error in addition processing</div>';
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
                    <td>questions and answer</td>
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
                                <td><a href="?action=showQuestions&id='.$exams['id'].'">show questions</a></td>
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