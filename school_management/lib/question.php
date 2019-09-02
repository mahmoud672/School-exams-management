<?php
require_once '../config.php';

class Question{
    private $id;
    private $title;
    private $answer;
    private $id_exam;
    
    
    public function __construct($title,$answer,$id_exam,$id=""){
        $this->title=$title;
        $this->answer=$answer;
        $this->id_exam=$id_exam;
        $this->id=$id;
    }
    public function addQuestion(){
            global $dbh;
            $sql=$dbh->prepare("INSERT INTO exam_questions(title,answer,id_exam)VALUES('$this->title','$this->answer','$this->id_exam')");
            $sql->execute();
            if(false!==$sql){
                return true;
            }else{
                return false;
            }
        
    }
    public static function retrieveAllQuestion(){
        global $dbh;
        $sql=$dbh->prepare("SELECT * FROM exam_questions ");
        $sql->execute();
        $data=null;
        while($fetch=$sql->fetch(PDO::FETCH_ASSOC)){
            $data[]=$fetch;
        }
        return $data;
    }
    public static function deleteQuestionById($id){
        global $dbh;
        $sql=$dbh->prepare("DELETE FROM exam_questions WHERE id='$id'");
        $sql->execute();
        if(false!==$sql){
            return true;
        }  else {
            return false;
        }
    }
    public static function retrieveQuestionById($id){
        global $dbh;
        $sql=$dbh->prepare("SELECT * FROM exam_questions WHERE id='$id'");
        $sql->execute();
        $fetch=$sql->fetch(PDO::FETCH_ASSOC);
        return $fetch;
    }
     public static function retrieveQuestionTitleById($id){
        global $dbh;
        $sql=$dbh->prepare("SELECT title FROM exam_questions WHERE id='$id'");
        $sql->execute();
        $data=null;
        while($fetch=$sql->fetch(PDO::FETCH_ASSOC)){
        $data=$fetch;
        }
        return $data['title'];
    }
    public static function retrieveQuestionByIdExam($id_exam){
        global $dbh;
        $sql=$dbh->prepare("SELECT * FROM exam_questions WHERE id_exam='$id_exam'");
        $sql->execute();
        $data=null;
        while($fetch=$sql->fetch(PDO::FETCH_ASSOC)){
        $data[]=$fetch;
        }
        return $data;
    }
    public function updaQuestion(){
            global $dbh;
            $sql=$dbh->prepare("UPDATE exam_questions SET title='$this->title',answer='$this->answer',id_exam='$this->id_exam'WHERE id='$this->id'");
            $sql->execute();
            if(false!==$sql){
               return TRUE;
            }else{
                return FALSE;
            }
    }
   
}

?>