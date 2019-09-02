<?php
    require_once '../lib/teacher.php';
    require_once '../lib/student.php';
    require_once '../lib/subject.php';
    require_once '../lib/question.php';  
    require_once '../lib/exam.php';
    require_once '../lib/grade.php';
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
        if($action=='show'){
            echo '<table >
                    <thead style="text-align:center;">
                        <tr>
                            <td> student number</td>
                            <td> student name</td>
                            <td> student grade</td>
                        </tr>
                    </thead>
                    <tbody>';
                    $allGrades=Grade::retrieveGradeExamByIdExam($id_exam);
                    if(is_array($allGrades)){
                        foreach ($allGrades as $grades):
                            $student=Student::retrieveStudentById($grades['id_student']);
                            echo '<tr>
                                    <td>'.$grades['id_student'].'</td>
                                    <td>'.$student['name'].'</td>
                                    <td>'.$grades['grade'].'</td>
                                </tr>';
                        endforeach;
                    }else{
                        echo '<div id="msg">there is no grades for these students</div>';
                    }
                    echo'</tbody>
                </table>';
        }else{
            echo '<div id="msg">invalid action</div>';
        }
       
    }
    ?>
 
   
   <table>
       <thead>
           <tr style="text-align:center;">
               <td>exam number</td>
               <td>exam grade</td>
               <td>teacher</td>
               <td>subject</td>
               <td>students grades</td>
           </tr>
       </thead>
       <tbody>
           <?php
             $allExams=Exam::retrieveExamByIdTeacher($_SESSION['id']);
            if(is_array($allExams)){
                foreach ($allExams as $exams):
                    echo '<tr>
                            <td>'.$exams['id'].'</td>
                            <td>'.$exams['grade'].'</td>
                            <td>'.Teacher::retrieveTeacherNameById($exams['id_teacher']).'</td>
                            <td>'.Subject::retrieveSubjectName($exams['id_subject']).'</td>
                            <td><a href="?action=show&id='.$exams['id'].'">Show grades</a></td>    
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