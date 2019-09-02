<?php
    require_once '../config.php';
    class Class_room{
        private $id;
        private $name;
        
        
        public function __construct($name,$id="") {
            $this->name=$name;
            $this->id=$id;
        }
        public function addClassRoom(){
            global $dbh;
            $sql=$dbh->prepare("INSERT INTO class_room(name)VALUES('$this->name')");
            $sql->execute();
            if(FALSE!==$sql){
                return $dbh->lastInsertId();
            }else{
                return FALSE;
            }     
        }
        public static function retrieveAllClassRooms(){
            global $dbh;
            $sql=$dbh->prepare("SELECT * FROM class_room");
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
        public static function retrieveClassRoomById($id){
            global $dbh;
            $sql=$dbh->prepare("SELECT * FROM class_room WHERE id='$id'");
            $sql->execute();
            $fetch=$sql->fetch(PDO::FETCH_ASSOC);
            return $fetch;
            if(FALSE!==$sql){
                return TRUE;
            }else{
                return FALSE;
            } 
        }
        public static function deleteClassRoomById($id){
            global $dbh;
            $sql=$dbh->prepare("DELETE FROM class_room WHERE id='$id'");
            $sql->execute();
            if(FALSE!==$sql){
                return TRUE;
            }else{
                return FALSE;
            } 
        }
        public function updateClassRoom(){
            global $dbh;
            $sql=$dbh->prepare("UPDATE class_room SET name='$this->name'WHERE id='$this->id'");
            $sql->execute();
            if(FALSE!==$sql){
                return TRUE;
            }else{
                return FALSE;
            } 
        }
         public static function retrieveClassRoomName($id){
            global $dbh;
            $sql=$dbh->prepare("SELECT name FROM class_room WHERE id='$id'");
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


