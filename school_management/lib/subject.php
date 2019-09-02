<?php
    require_once '../config.php';
    class Subject{
        private $id;
        private $name;
        
        
        public function __construct($name,$id="") {
            $this->name=$name;
            $this->id=$id;
        }
        public function addSubject(){
            global $dbh;
            $sql=$dbh->prepare("INSERT INTO subject(name)VALUES('$this->name')");
            $sql->execute();
            if(FALSE!==$sql){
                return $dbh->lastInsertId();
            }else{
                return FALSE;
            }     
        }
        public static function retrieveAllSubjects(){
            global $dbh;
            $sql=$dbh->prepare("SELECT * FROM subject");
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
        public static function retrieveSubjectById($id){
            global $dbh;
            $sql=$dbh->prepare("SELECT * FROM subject WHERE id='$id'");
            $sql->execute();
            $fetch=$sql->fetch(PDO::FETCH_ASSOC);
            return $fetch;
            if(FALSE!==$sql){
                return TRUE;
            }else{
                return FALSE;
            } 
        }
        public static function deleteSubjectById($id){
            global $dbh;
            $sql=$dbh->prepare("DELETE FROM subject WHERE id='$id'");
            $sql->execute();
            if(FALSE!==$sql){
                return TRUE;
            }else{
                return FALSE;
            } 
        }
        public function updateSubject(){
            global $dbh;
            $sql=$dbh->prepare("UPDATE subject SET name='$this->name'WHERE id='$this->id'");
            $sql->execute();
            if(FALSE!==$sql){
                return TRUE;
            }else{
                return FALSE;
            } 
        }
         public static function retrieveSubjectName($id){
            global $dbh;
            $sql=$dbh->prepare("SELECT name FROM subject WHERE id='$id'");
            $sql->execute();
            $fetch=$sql->fetch(PDO::FETCH_ASSOC);
            if(is_array($fetch)){
                return $fetch['name'];
            }else{
                return FALSE;
            }
        }
    }
    
?>


