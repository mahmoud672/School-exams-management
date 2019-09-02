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
        
        
    ?>
    <div class="form">
        <table>
            <thead>
                <tr>
                    <td>exam number</td>
                    <td>exam subject</td>
                    <td>exam date</td>
                    <td>exam duration</td>
                    <td>show setting</td>
                </tr>
            </thead>
            <tbody>
                <?php
                 $allExamsSitting=Exam_sitting::retrieveAllExamSittings();     
                    if(is_array($allExamsSitting)){
                        foreach ($allExamsSitting as $examsSitting ):
                            if($examsSitting['status']==0){
                                $examsSitting['status']='off';
                            }else{
                                $examsSitting['status']='on';
                            }
                             $exam=Exam::retrieveExamById($examsSitting['id_exam']);
                            echo '<tr>
                                    <td>'.$examsSitting['id_exam'].'</td>
                                    <td>'.Subject::retrieveSubjectName($exam['id_subject']).'</td>
                                    <td>'.$exam['exam_date'].'</td>
                                    <td>'.$exam['exam_duration'].'</td>
                                    <td>'.$examsSitting['status'].'<td>
                                </tr>';
                        endforeach;
                    }else{
                        echo '<tr><td colspan="5">there are no exams</td></tr>';
                    }
                ?>
            </tbody>
        </table>
  
   
    </div>
        </div>
    <?php require_once 'template/right_content.tpl'; ?>
     <?php }?>
</div>
<?php
    
    require_once 'template/footer.tpl';
?>
