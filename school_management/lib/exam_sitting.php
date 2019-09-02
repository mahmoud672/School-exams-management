<?php
    require_once '../config.php';
    class Exam_sitting{
        private $id_exam;
        private $status;
        
        
        public function __construct($id_exam,$status){
            $this->id_exam=$id_exam;
            $this->status=$status;
        }
        public function addExamSitting(){
            global $dbh;
            $sql=$dbh->prepare("INSERT INTO exam_sitting(id_exam,status)VALUES('$this->id_exam','$this->status')");//,'$this->status'
            $sql->execute();
            if(FALSE!==$sql){
                return true;
            }else{
                return FALSE;
            }     
        }
        public static function retrieveAllExamSittings(){
            global $dbh;
            $sql=$dbh->prepare("SELECT * FROM exam_sitting");
            $sql->execute();
            $data=null;
            while($fetch=$sql->fetch(PDO::FETCH_ASSOC)){
                $data[]=$fetch;
            }
            return $data;
            if(FALSE!==$sql){
                return TRUE;
            }else{
                return FALSE;
            } 
        }
        public static function retrieveExamSittingByIdExam($id_exam){
            global $dbh;
            $sql=$dbh->prepare("SELECT * FROM exam_sitting WHERE id_exam='$id_exam'");
            $sql->execute();
            $fetch=$sql->fetch(PDO::FETCH_ASSOC);
            return $fetch;
            if(FALSE!==$sql){
                return TRUE;
            }else{
                return FALSE;
            } 
        }
        public function updateExamSitting(){
            global $dbh;
            $sql=$dbh->prepare("UPDATE exam_sitting SET status='$this->status' WHERE id_exam='$this->id_exam'");
            $sql->execute();
            if(FALSE!==$sql){
                return TRUE;
            }else{
                return FALSE;
            } 
        }
    }
    
?>


