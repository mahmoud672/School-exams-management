<?php
require_once '../config.php';

class Question_choices{
    private $id_question;
    private $choice;

    
    
    public function __construct($id_question,$choice){
        $this->id_question=$id_question;
        $this->choice=$choice;
    }
    public function addQuestion(){
            global $dbh;
            $sql=$dbh->prepare("INSERT INTO  manage_question_choices(id_question,choice)VALUES('$this->id_question','$this->choice')");
            $sql->execute();
            if(false!==$sql){
                return true;
            }else{
                return false;
            }
        
    }
    public static function retrieveAllQuestionChoices(){
        global $dbh;
        $sql=$dbh->prepare("SELECT * FROM  manage_question_choices ");
        $sql->execute();
        $data=null;
        while($fetch=$sql->fetch(PDO::FETCH_ASSOC)){
            $data[]=$fetch;
        }
        return $data;
    }
    public static function deleteQuestionChoicesByIdQuestion($id_question){
        global $dbh;
        $sql=$dbh->prepare("DELETE FROM  manage_question_choices WHERE id_question='$id_question'");
        $sql->execute();
        if(false!==$sql){
            return true;
        }  else {
            return false;
        }
    }
     public static function deleteQuestionChoiceByIdQuestionAndChoice($id_question,$choice){
        global $dbh;
        $sql=$dbh->prepare("DELETE FROM  manage_question_choices WHERE id_question='$id_question' AND choice='$choice'");
        $sql->execute();
        if(false!==$sql){
            return true;
        }  else {
            return false;
        }
    }
    public static function retrieveQuestionChoicesById($id_question){
        global $dbh;
        $sql=$dbh->prepare("SELECT * FROM  manage_question_choices WHERE id_question='$id_question'");
        $sql->execute();
        $data=null;
        while($fetch=$sql->fetch(PDO::FETCH_ASSOC)):
           $data[]= $fetch;
        endwhile;
        return $data;
    }
     public static function retrieveSpecificQuestionChoiceByIdQuestionAndChoice($id_question,$choice){
        global $dbh;
        $sql=$dbh->prepare("SELECT * FROM  manage_question_choices WHERE id_question='$id_question' AND choice='$choice'");
        $sql->execute();
        while($fetch=$sql->fetch(PDO::FETCH_ASSOC));
        return $fetch;
    }
    public function updateQuestionChoice(){
            global $dbh;
            $sql=$dbh->prepare("UPDATE  manage_question_choices SET id_question='$this->id_question',choice='$this->choice' WHERE id_question='$this->id_question' AND choice='$this->choice'");
            $sql->execute();
            if(false!==$sql){
               return TRUE;
            }else{
                return FALSE;
            }
    }
   
}

?>