<?php
    require_once '../lib/teacher.php';
    require_once '../lib/subject.php';
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
    if(isset($_POST['addExam'])){
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
            $exam=new Exam($exam_date, $exam_duration, $grade, $id_teacher, $id_subject);
            if($exam->addExam()){
                echo '<div id="msg">successful addition</div>';
            }  else {
                echo '<div id="msg">error in addition processing</div>';
            }
        }
    }
    
    ?>
 
    <div class="form">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>"method="post">
            <lable>exam date:</lable> 
            <input type="text"name="exam_day"value=""id="exam_day"class="input"placeholder="D">
            <input type="text"name="exam_month"value=""id="exam_month"class="input"placeholder="M">
            <input type="text"name="exam_year"value=""id="exam_year"class="input"placeholder="Y">
             <input type="text"name="exam_time"value=""id="exam_time"class="input"placeholder="time">
             <select name="am_pm"id="exam_time">
                 <option value="am">AM</option>
                 <option value="pm">PM</option>
             </select>
            <lable>exam duration:</lable>
            <input type="text"name="exam_duration"value=""class="input"placeholder="time in houres">
            <lable>exam grade:</lable>
            <input type="text"name="grade"value=""class="input"placeholder="write here">
            <lable>select subject for this exam</lable>
            <select name="id_subject">
                <option value="">--select subject--</option>
                <?php
                $allSubjects=  Subject::retrieveAllSubjects();
                if(is_array($allSubjects)){
                    foreach ($allSubjects as $subjects):
                        echo '<option value="'.$subjects['id'].'">'.$subjects['name'].'</option>';
                    endforeach;
                }else{
                    echo '<option>there is no subject to select</option>';
                }
                ?>
            </select>
            <input type="submit"name="addExam"value="Add Exam">
        </form>
    </div>
        </div>
    <?php  require_once 'template/right_content_teacher.tpl'; ?>
    <?php }?>
</div>

<?php
    require_once 'template/footer.tpl'; 
?>