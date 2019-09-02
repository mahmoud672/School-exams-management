<?php
require_once '../config.php';

class Exam{
    private $id;
    private $exam_date;
    private $exam_duration;
    private $grade;
    private $id_teacher;
    private $id_subject;
    
    
    public function __construct($exam_date,$exam_duration,$grade,$id_teacher,$id_subject,$id=""){
        $this->exam_date=$exam_date;
        $this->exam_duration=$exam_duration;
        $this->grade=$grade;
        $this->id_teacher=$id_teacher;
        $this->id_subject=$id_subject;
        $this->id=$id;
    }
    public function addExam(){
            global $dbh;
            $sql=$dbh->prepare("INSERT INTO exam(exam_date,exam_duration,grade,id_teacher,id_subject)VALUES('$this->exam_date','$this->exam_duration','$this->grade','$this->id_teacher','$this->id_subject')");
            $sql->execute();
            if(false!==$sql){
                return true;
            }else{
                return false;
            }
        
    }
    public static function retrieveAllExams(){
        global $dbh;
        $sql=$dbh->prepare("SELECT * FROM exam ");
        $sql->execute();
        $data=null;
        while($fetch=$sql->fetch(PDO::FETCH_ASSOC)){
            $data[]=$fetch;
        }
        return $data;
    }
    public static function deleteExamById($id){
        global $dbh;
        $sql=$dbh->prepare("DELETE FROM exam WHERE id='$id'");
        $sql->execute();
        if(false!==$sql){
            return true;
        }  else {
            return false;
        }
    }
    public static function retrieveExamById($id){
        global $dbh;
        $sql=$dbh->prepare("SELECT * FROM exam WHERE id='$id'");
        $sql->execute();
        $fetch=$sql->fetch(PDO::FETCH_ASSOC);
        return $fetch;
    }
    
     public static function retrieveExamByIdTeacher($id_teacher){
        global $dbh;
        $sql=$dbh->prepare("SELECT * FROM exam WHERE id_teacher='$id_teacher'");
        $sql->execute();
        $data=null;
        while($fetch=$sql->fetch(PDO::FETCH_ASSOC)):
           $data[]=$fetch; 
        endwhile;
        return $data;
    }
     public static function retrieveExamSubjectById($id){
        global $dbh;
        $sql=$dbh->prepare("SELECT id_subject FROM exam WHERE id='$id'");
        $sql->execute();
        $data=null;
        while($fetch=$sql->fetch(PDO::FETCH_ASSOC)){
        $data=$fetch;
        }
        return $data['id_subject'];
    }
    public function updateExam(){
            global $dbh;
            $sql=$dbh->prepare("UPDATE exam SET exam_date='$this->exam_date',exam_duration='$this->exam_duration',grade='$this->grade',id_teacher='$this->id_teacher',id_subject='$this->id_subject' WHERE id='$this->id'");
            $sql->execute();
            if(false!==$sql){
               return TRUE;
            }else{
                return FALSE;
            }
    }
    public static function DayMonthYearConversion($day,$month,$year,$time,$am_pm){
	if($day==null||$month==null||$year==null||$time==null||$am_pm==null){
		echo'<div id="msg">exam date fields are required</div>';
	}elseif(!(is_numeric($day)&&is_numeric($month)&&is_numeric($year)&&is_numeric($time))){
		echo'<div id="msg">invalid data. date must be numbers of day/month/year-time</div>';
	}elseif(($day<=0 ||$day>=32)||($month<=0 ||$month>=13)||($year<=0 ||$year>=3000)||($time<=0 ||$time>=13)){
		echo'<div id="msg">day must be between 1:31 ,month between 1:12 , year between 1:3000 and time between 1:12 </div>';
	}elseif (strlen($day)!=2 && strlen($month)!=2 && strlen($time)!=2) {
            echo '<div id="msg">please day , month and time format must be combination of 2 numbers 00</div>';
        }else{
		
		$date= $day.'/'.$month.'/'.$year.' : '.$time.' '.$am_pm;
		return $date;
	}
}
}

?>