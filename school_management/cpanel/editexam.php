<?php
    require_once '../lib/teacher.php';
    require_once '../lib/subject.php';
    require_once '../lib/question.php';  
    require_once '../lib/exam.php';
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
        $id=$_GET['id'];
        switch ($action):
            case('showQuestions'):
                 $allQuestions=Question::retrieveQuestionByIdExam($id);
                echo '<table>
                    <thead>
                        <tr>
                            <td>question number</td>
                            <td>title</td>
                            <td>answer</td>                          
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
                            </tr>';
                            $index++;
                    endforeach;
                }else{
                    echo '<tr><td colspan="5">no question to show</td></tr>';
                }
                echo '</tbody>
                        </table>';
            
            break;
            case('delete'):
                if(Exam::deleteExamById($id)){ 
                }else{
                    echo '<div id="msg">erroe in deleting processing</div>';
                }
                break;
            case('edit'):
                $exam=Exam::retrieveExamById($id);
       echo' <div class="form">
        <form action="'.$_SERVER['PHP_SELF'].'"method="post">
            <input type="hidden"name="id"value="'.$id.'"class="input"/>
            <lable>old exam date:</lable>
            <input type="text"name="exam_date"value="'.$exam['exam_date'].'"class="input"disabled/>
            <lable>exam date:</lable>
           
            <input type="text"name="exam_day"value=""id="exam_day"class="input"placeholder="D"/>
            <input type="text"name="exam_month"value=""id="exam_month"class="input"placeholder="M"/>
            <input type="text"name="exam_year"value=""id="exam_year"class="input"placeholder="Y"/>
             <input type="text"name="exam_time"value=""id="exam_time"class="input"placeholder="time"/>
             <select name="am_pm"id="exam_time">
                 <option value="am">AM</option>
                 <option value="pm">PM</option>
             </select>
            <lable>exam duration:</lable>
            <input type="text"name="exam_duration"value="'.$exam['exam_duration'].'"class="input"placeholder="time in houres"/>
            <lable>exam grade:</lable>
            <input type="text"name="grade"value="'.$exam['grade'].'"class="input"placeholder="write here"/>
            <lable>select subject for this exam</lable>
            <select name="id_subject">
            ';
                $allSubjects=Subject::retrieveAllSubjects();
                if(is_array($allSubjects)){
                    foreach ($allSubjects as $subjects):
                         if($exam['id_subject']==$subjects['id']){
                        echo '<option value="'.$subjects['id'].'"selected="selected">'.$subjects['name'].'</option>';
                         }else{
                             echo '<option value="'.$subjects['id'].'">'.$subjects['name'].'</option>';
                         }
                    endforeach;
                }else{
                    echo '<option>there is no subject to select</option>';
                }
                
           echo' </select>
            <input type="submit"name="updateExam"value="update Exam"class="input"/>
        </form>
    </div>';
                break;
            default:
                echo '<div id="msg">invalid action</div>';
        endswitch;
    }
    
   if(isset($_POST['updateExam'])){
        $id=$_POST['id'];
        $exam_day=$_POST['exam_day'];
        $exam_month=$_POST['exam_month'];
        $exam_year=$_POST['exam_year'];
        $exam_time=$_POST['exam_time'];
        $am_pm=$_POST['am_pm'];
        $exam_date=Exam::DayMonthYearConversion($exam_day,$exam_month,$exam_year,$exam_time,$am_pm);
        //echo $exam_date;
        $exam_duration=$_POST['exam_duration'];
        $grade=$_POST['grade'];
        $id_teacher=$_SESSION['id'];
        $id_subject=$_POST['id_subject'];
        if($exam_duration==null){
            echo '<div id="msg">exam duration field must be inserted</div>';
        }elseif (!is_numeric($exam_duration)) {
             echo '<div id="msg">exam duration value must be numbers</div>';
        }elseif ($grade==null) {
             echo '<div id="msg">exam grade field must be inserted</div>';
        }elseif (!is_numeric($grade)) {
             echo '<div id="msg">exam grade value must be numbers</div>';
        }elseif ($id_subject==null) {
             echo '<div id="msg">please select a subject of this exam</div>';
        }elseif (!is_numeric($id_subject)) {
             echo '<div id="msg">invalid editing for subject value</div>';
        }else{
            $exam=new Exam($exam_date, $exam_duration, $grade, $id_teacher, $id_subject,$id);
            if($exam->updateExam()){
                echo '<div id="msg">successful updating</div>';
            }  else {
                echo '<div id="msg">error in updating processing</div>';
            }
        }
   }
    
    ?>
 
   
   <table>
       <thead>
           <tr>
               <td>exam date</td>
               <td>exam duration</td>
               <td>exam grade</td>
               <td>teacher</td>
               <td>subject</td>
               <td>show questions</td>
               <td>delete</td>
               <td>edit</td>
           </tr>
       </thead>
       <tbody>
           <?php
             $allExams=Exam::retrieveExamByIdTeacher($_SESSION['id']);
            if(is_array($allExams)){
                foreach ($allExams as $exams):
                    echo '<tr>
                            <td>'.$exams['exam_date'].'</td>
                            <td>'.$exams['exam_duration'].'</td>
                            <td>'.$exams['grade'].'</td>
                            <td>'.Teacher::retrieveTeacherNameById($exams['id_teacher']).'</td>
                            <td>'.Subject::retrieveSubjectName($exams['id_subject']).'</td>
                             <td><a href="?action=showQuestions&id='.$exams['id'].'">Questions</a></td>
                            <td><a href="?action=delete&id='.$exams['id'].'">Delete</a></td>
                            <td><a href="?action=edit&id='.$exams['id'].'">Edit</a></td>    
                         </tr>';
                endforeach;
            }else{
                echo '<tr><td colspan="4">no exams to show</td></tr>';
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