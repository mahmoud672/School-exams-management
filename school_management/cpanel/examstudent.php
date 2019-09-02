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
    //require_once 'template/navbar.tpl';
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
        <?php
            echo'Date of day is :' .date('d/m/Y : h a');
            if(isset($_POST['send'])){
                $id_exam=$_POST['id_exam'];
                $choices=isset($_POST['choice'])?$_POST['choice']:null;
                 $grade=0;
                 if($choices==null){
                     echo '<div id="msg">please choose an answer</div>';
                 }elseif(is_numeric($choices)){
                     echo '<div id="msg">invalid edit for choice</div>';
                 }else{
                    
                     $allQuestions=Question::retrieveQuestionByIdExam($id_exam);
                        if(is_array($allQuestions)){
                            foreach ($allQuestions as $questions):
                                if($choices==$questions['answer']){
                                     ++$grade;
                                    $allStudentGrade=Grade::retrieveGradeByIdStudentAndIdExam($_SESSION['id'], $id_exam);
                                    if($allStudentGrade==null){
                                        $studentGrade=new Grade($_SESSION['id'], $id_exam, $grade);
                                        $studentGrade->addGrade();
                                    }else{
                                        $allStudentGrade=Grade::retrieveGradeByIdStudentAndIdExam($_SESSION['id'], $id_exam);
                                        $grade+=$allStudentGrade['grade'];
                                         $studentGrade=new Grade($_SESSION['id'], $id_exam, $grade);
                                        $studentGrade->updateGrade();
                                    }
                                    //echo 'okkkkk';
                                    //$grade++;
                                    //echo $grade;
                                }  else {
                                   // echo 'fail';
                                }
                            endforeach;
                        }else{
                            echo '<div id="msg">no questions</div>';
                        }
               }
            }
        ?>
        <!--<button id="beginExam">begin exam</button>-->
         <div id="res"></div>
        <div class="form">
            <!--<form action="<?php echo $_SERVER['PHP_SELF'];?>"method="post">-->
            <lable> please read carefully all questions and answers... don't forget to click on question to choose the correct answer</lable>
                <?php
                    $date='5/6/2017 : 9 am';
                    
           $allExams=Exam::retrieveAllExams();
           $index=1;
            if(is_array($allExams)){
              foreach ($allExams as $exam):
                  $examStatus=Exam_sitting::retrieveExamSittingByIdExam($exam['id']);
                  if($exam['exam_date']==$date && $examStatus['status']==1){
                       $allQuestions=Question::retrieveQuestionByIdExam($exam['id']);
                       if(is_array($allQuestions)){
                           foreach ($allQuestions as $questions):
                               echo '<div id="block"><div class="questionBlock">'.$index++.'-'.$questions['title'].'</div>';
                               $allChoices=Question_choices::retrieveQuestionChoicesById($questions['id']);
                               echo '<form action="'.$_SERVER['PHP_SELF'].'"method="post">
                                        ';
                                        if(is_array($allChoices)){
                                            foreach ($allChoices as $choices):
                                                 echo '<div class="answerBlock">'
                                                        .'<label>'.$choices['choice'].'</label>'.'<div id="choiceTitle"><input type="radio"name="choice"value="'.$choices['choice'].'"id="radio"/></div>
                                                    </div>';
                                   
                                            endforeach;
                                        }else {
                                            echo '<div id="msg">no choices for this answer</div>';   
                                        }
                               echo ' <input type="hidden"name="id_exam"value="'.$exam['id'].'"id="id_exam">
                                      <input type="submit"name="send"value="send"id="send"/style="width: 100px;height: 30px;border-radius: 18px;">
                                    </form></div>';           
                           endforeach;
                       }else{
                            echo '<div id="msg">no questions </div>';
                       }
                    }else {
                      //echo '<div id="msg">no exams today</div>';
                  }
              endforeach;
            }else{
                echo '<div id="msg">no exams </div>';
           }
                ?>
                <!--<div id="studentExamPaper">
                </div>-->
                <!--<input type="submit"name="sendResult"value="send result"id="sendResult">-->
            <!--</form>-->
           <button id="finish">finish</button>
        </div>
    </div>
    <?php }?>
    <div id="right_content">
       
    </div>
</div>
<?php
    require_once 'template/footer.tpl';
?>
