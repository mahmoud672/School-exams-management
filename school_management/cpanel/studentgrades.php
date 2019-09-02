<?php
    require_once '../lib/teacher.php';
    require_once '../lib/subject.php';
    require_once '../lib/exam.php';
    require_once '../lib/question.php';
    require_once '../lib/question_choices.php';
    require_once '../lib/student.php';
    require_once '../lib/grade.php';
    require_once '../lib/exam_sitting.php';
    require_once 'template/header.php';
    require_once 'template/navbar.tpl';
    require_once '../lib/book.php';
?>

<div id="content">
    <?php
        if (!(isset($_SESSION['id']) && isset($_SESSION['name']))) {
            echo 'please log in <a href="login.php">log in</a>';
            echo '<div id="loginImage"><a href="login.php"title="login"><img src="template/images/Log In.jpg"></a></div>';
        } else {
            ?>
    <div id="left_content">
        <div id="getData"></div>
        <table>
            <thead style="text-align:center;">
                <tr><td colspan="4"><?php echo $_SESSION['name'].' ';?><span style="color:#c1d500;">grades</span></td></tr>
                <tr style='font-family:georgia;text-transform:capitalize;'>
                    <td>exam number</td>
                    <td>subject name</td>
                    <td>grade</td>
                    <td>teacher</td>
                </tr>
            </thead>
            <tbody style="background:#FFF;color:#000;">
                <?php
                    $allGrades=Grade::retrieveStudentGradesByIdStudent($_SESSION['id']);
                    if(is_array($allGrades)){
                        foreach ($allGrades as $grades):
                            $id_sbject= Exam::retrieveExamSubjectById($grades['id_exam']);
                            $exam=Exam::retrieveExamById($grades['id_exam']);
                            
                            echo '<tr>
                                    <td>'.$grades['id_exam'].'</td>
                                    <td>'.Subject::retrieveSubjectName($id_sbject).'</td>
                                    <td>'.$grades['grade'].'</td>';
                                    if(is_array($exam)){
                                       echo'<td>Mr. '.Teacher::retrieveTeacherNameById($exam['id_teacher']).'</td>'; 
                                    }else{
                                        echo '<div id="msg">no teachers<div>';
                                    }
                                    
                                    echo '</tr>';
                        endforeach;
                    }else{
                        echo '<div id="msg">there is no result you may not have entered the exam</div>';
                    }
                ?>
            </tbody>
        </table>
    </div>
    <?php }?>
    <div id="right_content">
       
    </div>
</div>
<?php
    require_once 'template/footer.tpl';
?>
