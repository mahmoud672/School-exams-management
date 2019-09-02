<?php
require_once '../config.php';

class Class_management{
    private $id_teacher;
    private $id_student;
    private $id_class_room;
    public function __construct($id_teacher,$id_student,$id_class_room){
        $this->id_teacher=$id_teacher;
         $this->id_student=$id_student;
        $this->id_class_room=$id_class_room;
    }
    public function addTeacherAndStudentForSpecificClass(){
            global $dbh;
            $sql=$dbh->prepare("INSERT INTO class_management(id_teacher,id_student,id_class_room)VALUES(' $this->id_teacher','$this->id_student','$this->id_class_room')");
            $sql->execute();
            if(FALSE!==$sql){
                return TRUE;
            }else{
                return FALSE;
            }     
        }
        public static function retrieveTeachersForSpecificClassRoomById($id_class_room){
            global $dbh;
            $sql=$dbh->prepare("SELECT id_teacher FROM class_management WHERE id_class_room='$id_class_room'");
            $sql->execute();
            $data=null;
            while($fetch=$sql->fetch(PDO::FETCH_ASSOC)){
                $data=$fetch;
            }
            return $data['id_teacher'];
            if(FALSE!==$sql){
                return TRUE;
            }else{
                return FALSE;
            } 
        }
         public static function retrieveStudentsForSpecificClassRoomById($id_class_room){
            global $dbh;
            $sql=$dbh->prepare("SELECT id_student FROM class_management WHERE id_class_room='$id_class_room'");
            $sql->execute();
            $data=null;
            while($fetch=$sql->fetch(PDO::FETCH_ASSOC)){
                $data[]=$fetch['id_student'];
            }
            return $data;
            if(FALSE!==$sql){
                return TRUE;
            }else{
                return FALSE;
            } 
        }
        public static function deleteClassRoomFromClassManagementByIdClassRoom($id_class_room){
            global $dbh;
            $sql=$dbh->prepare("DELETE FROM class_management WHERE id_class_room='$id_class_room'");
            $sql->execute();
            if(FALSE !==$sql){
                return TRUE;
            }else{
                return FALSE;
            }
        }
        public function deleteTeacherForSpecificClassRoom(){
            global $dbh;
            $sql=$dbh->prepare("DELETE FROM class_management WHERE id_teacher='$this->id_teacher' AND id_class_room='$this->id_class_room'");
            $sql->execute();
            if(FALSE != $sql){
                return TRUE;
            }else{
                return FALSE;
            }
        }
        public function deleteStudentForSpecificClassRoom(){
            global $dbh;
            $sql=$dbh->prepare("DELETE FROM class_management WHERE id_student='$this->id_student' AND id_class_room='$this->id_class_room'");
            $sql->execute();
            if(FALSE != $sql){
                return TRUE;
            }else{
                return FALSE;
            }
        }
        
}

//test retrieveManagerForSpecificCategoryById($id_category) function:
/*
$manager=  Management::retrieveManagerForSpecificCategoryById(14);
if(is_array($manager)){
    foreach ($manager as $mang){
        echo $mang;
    } 
}else{
    echo $manager;
}
 
 */
