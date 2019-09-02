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
            switch($action):
                case('editChoices'):
                    $allQuestions=Question::retrieveQuestionByIdExam($id_exam);
                    echo '<table>
                            <thead>
                                <tr>
                                    <td>question number</td>
                                    <td>title</td>
                                    <td>answer</td>
                                    <td>choices</td>
                                </tr>
                            </thead>
                            <tbody>
                        ';if(is_array($allQuestions)){
                    $index=1;
                    foreach ($allQuestions as $questions):
                        echo '<tr>
                                <td>'.$index.'</td>
                                <td>'.$questions['title'].'</td>
                                <td>'.$questions['answer'].'</td>
                                <td><a href="?actionOfQuestion=showQuestionChoices&id='.$questions['id'].'">show</a></td>
                            </tr>';
                    $index++;
                    endforeach;
                }else{
                    echo '<tr><td colspan="5">no question to show</td></tr>';
                }
                echo '</tbody>
                        </table>';
                break;
                default:
                echo '<div id="msg">invalid action</div>';
            endswitch;
        }
        //switch choices to edit
        if(isset($_GET['actionOfQuestion'],$_GET['id'])){
            $action=$_GET['actionOfQuestion'];
            $id_question=$_GET['id'];
            switch($action):
                case('showQuestionChoices'):
                    $allQuestionChoices=Question_choices::retrieveQuestionChoicesById($id_question);
                    echo '<table>
                            <thead>
                                <tr>
                                    <td>available choices</td>
                                    <td>delete</td>
                                    <td>edit</td>
                                </tr>
                            </thead>
                            <tbody>
                            ';
                        if(is_array($allQuestionChoices)){
                            foreach ($allQuestionChoices as $questionChoices):
                                echo '<tr>
                                        <td>'.$questionChoices['choice'].'</td>
                                        <td><a href="?actionOfChoice=deleteChoice&id_question='.$questionChoices['id_question'].'&questionChoice='.$questionChoices['choice'].'">Delete</a></td>
                                        <td><a href="?actionOfChoice=editChoice&id_question='.$questionChoices['id_question'].'&questionChoice='.$questionChoices['choice'].'">Edit</a></td>
                                    </tr>
                                    ';
                            endforeach;
                        }else{
                             echo '<tr><td colspan="4">no choices for this question</td></tr>';
                        }
                        echo '</tbody>
                            </table>';
                    break;
                default:
                    echo '<div id="msg">invalid action</div>';
            endswitch; 
        }
        if(isset($_GET['actionOfChoice'],$_GET['id_question'],$_GET['questionChoice'])){
            $action_choice=$_GET['actionOfChoice'];
            $id_question=$_GET['id_question'];
            $choice=$_GET['questionChoice'];
            switch($action_choice):
                case('deleteChoice'):
                    if(Question_choices::deleteQuestionChoiceByIdQuestionAndChoice($id_question,$choice)){
                        echo '<div id="msg">successfull deleting</div>';
                    }  else {
                        echo '<div id="msg">error in deleting</div>';
                    }
                break;
                case('editChoice'):
                        echo '<div class="form">
                            <form action="'.$_SERVER['PHP_SELF'].'"method="post">
                                <input type="hidden"name="id_question"value="'.$id_question.'"/>
                                <lable>choice:</lable>
                                <input type="text"name="choice"value="'.$choice.'"placeholder="write choice here"class="input"/>
                                <input type="submit"name="updateQuestionChoice"value="Update Choice"class="input"/>
                            </form>
                        </div>    
                        ';                  
                    break;
                default:
                    echo '<div id="msg">invalid action</div>';
            endswitch;
        }
        if(isset($_POST['updateQuestionChoice'])){
             $id_question=$_POST['id_question'];
             $choice=$_POST['choice'];
             if($id_question==null){
                 echo '<div id="msg">you must not leave question empty!</div>';
             }elseif (!is_numeric($id_question)) {
                 echo '<div id="msg">you must not edit question value!</div>';
            }elseif ($choice==null) {
                echo '<div id="msg">please insert the choice value</div>';
            }else{
                $question_choice= new Question_choices($id_question,$choice);
                if($question_choice->updateQuestionChoice()){
                    echo '<div id="msg">successfull updating</div>';
                }else{
                    echo '<div id="msg">error in updating</div>';
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
                                <td>'.Teacher::retrieveTeacherNameById($exams['id_teacher']).'</td>
                                <td>'.Subject::retrieveSubjectName($exams['id_subject']).'</td>
                                <td><a href="?action=editChoices&id='.$exams['id'].'">edit choices</a></td>
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