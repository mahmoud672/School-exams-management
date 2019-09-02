<?php
    require_once '../lib/exam.php';
    require_once '../lib/question.php';
    require_once '../lib/question_choices.php';
    
    if(isset($_GET['id'])){
        $id_exam=$_GET['id'];
        $allQuestions=Question::retrieveQuestionByIdExam($id_exam);
        echo '
            ';
        $index=1;
        if(is_array($allQuestions)){
            foreach ($allQuestions as $questions):
                echo '
                        
                        <div id="questionTitle"><h3>'.$index.'-'.$questions['title'].'</h3></div>';
                $allChoices=Question_choices::retrieveQuestionChoicesById($questions['id']);
                if(is_array($allChoices)){
                    foreach ($allChoices as $choices):
                        echo ''.$choices['choice'].'<input id="choice"type="checkbox"name="choice[]"value="'.$choices['choice'].'">';

                    endforeach;
                }else{
                   echo '<td>there is no choices</td>'; 
                }
                $index++;
            endforeach;
        }else{
            echo '<tr><td cospan="3">there is(r) no question(s)</td></tr>';
        }
        echo '';
        
    }

    /*if(isset($_GET['choice'])){
        echo 'okkkkkkk';
        $choices=isset($_GET['choice'])?$_GET['choice']:null;
        if(is_array($choices)){
            foreach ($choices as $choice):
                echo $choice;
            endforeach;
        }  else {
            echo 'no choices you have been choosen';
        }
    }*/
    
   
?>

