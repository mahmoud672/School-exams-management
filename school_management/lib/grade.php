<?php
require_once '../config.php';

class Grade{
    private $id_student;
     private $id_exam;
    private $grade;

    public function __construct($id_student,$id_exam,$grade){
        $this->id_student=$id_student;
        $this->id_exam=$id_exam;
        $this->grade=$grade;
    }
    public function addGrade(){
            global $dbh;
            $sql=$dbh->prepare("INSERT INTO grades(id_student,id_exam,grade)VALUES('$this->id_student','$this->id_exam','$this->grade')");
            $sql->execute();
            if(false!==$sql){
                return true;
            }else{
                return false;
            }
        
    }
    public static function retrieveAllGrades(){
        global $dbh;
        $sql=$dbh->prepare("SELECT * FROM exam ");
        $sql->execute();
        $data=null;
        while($fetch=$sql->fetch(PDO::FETCH_ASSOC)){
            $data[]=$fetch;
        }
        return $data;
    }
   
    public static function retrieveGradeByIdStudentAndIdExam($id_student,$id_exam){
        global $dbh;
        $sql=$dbh->prepare("SELECT * FROM grades WHERE id_student='$id_student' AND id_exam='$id_exam'");
        $sql->execute();
        $fetch=$sql->fetch(PDO::FETCH_ASSOC);
        return $fetch;
    }
     public static function retrieveStudentGradesByIdStudent($id_student){
        global $dbh;
        $sql=$dbh->prepare("SELECT * FROM grades WHERE id_student='$id_student'");
        $sql->execute();
        $data=null;
        while($fetch=$sql->fetch(PDO::FETCH_ASSOC)):
           $data[]=$fetch; 
        endwhile;
        return $data;
    }
     public static function retrieveGradeExamByIdExam($id_exam){
        global $dbh;
        $sql=$dbh->prepare("SELECT * FROM grades WHERE id_exam='$id_exam'");
        $sql->execute();
        $data=null;
        while($fetch=$sql->fetch(PDO::FETCH_ASSOC)){
        $data[]=$fetch;
        }
        return $data;
    }
    public function updateGrade(){
            global $dbh;
            $sql=$dbh->prepare("UPDATE grades SET id_student='$this->id_student',id_exam='$this->id_exam',grade='$this->grade' WHERE id_student='$this->id_student' AND id_exam='$this->id_exam'");
            $sql->execute();
            if(false!==$sql){
               return TRUE;
            }else{
                return FALSE;
            }
    }
   
}

?>