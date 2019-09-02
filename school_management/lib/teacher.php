<?php
require_once '../config.php';

class Teacher{
    private $id;
    private $name;
    private $email;
    private $password;
    private $address;
    private $phone_number;
    
    
    public function __construct($name,$email,$password,$address,$phone_number,$id=""){
        $this->name=$name;
        $this->email=$email;
        $this->password=$password;
        $this->address=$address;
        $this->phone_number=$phone_number;
        $this->id=$id;
    }
    public function addTeacher(){
        if( $this->name==null){
            echo '<div id="msg">Name field must be inserted</div>';
        }elseif(is_numeric($this->name)){
             echo '<div id="msg">Name must be letters</div>';
        }elseif ($this->email==null) {
            echo '<div id="msg">E-mail field must be inserted</div>';
        }elseif ($this->password==null) {
            echo '<div id="msg">Password field must be inserted</div>';
        }elseif (strlen($this->password)<8) {
            echo '<div id="msg">Your password must be at least 8 char</div>';
        }elseif ($this->address==null) {
             echo '<div id="msg">Address field must be inserted</div>';
        }elseif ($this->phone_number == null) {
             echo '<div id="msg">Phone number field must be inserted</div>';
        }elseif (!is_numeric($this->phone_number)) {
            echo '<div id="msg">Phone number must be numbers</div>';
        }elseif (strlen($this->phone_number)!=11) {
             echo '<div id="msg">your phone number must be 11 digits</div>';
        }else{
            global $dbh;
            $sql=$dbh->prepare("INSERT INTO teacher(name,email,password,address,phone_number)VALUES('$this->name','$this->email','$this->password','$this->address','$this->phone_number')");
            $sql->execute();
            if(false!==$sql){
                echo '<div id="msg">successful addition processing</div>';
            }else{
                echo '<div id="msg"> error occured in addition processing</div>';
            }
        }
    }
    public static function retrieveAllTeacher(){
        global $dbh;
        $sql=$dbh->prepare("SELECT * FROM teacher ");
        $sql->execute();
        $data=null;
        while($fetch=$sql->fetch(PDO::FETCH_ASSOC)){
            $data[]=$fetch;
        }
        //return json_encode($data);
        return $data;
//        if(false!==$sql){
//            echo '<div id="msg">successful retrieving for data</div>';
//        }else{
//            echo '<div id="msg">error in retrieving data</div>';
//        }
    }
    public static function deleteTeacherById($id){
        global $dbh;
        $sql=$dbh->prepare("DELETE FROM teacher WHERE id='$id'");
        $sql->execute();
        if(false!==$sql){
            return true;
        }  else {
            return false;
        }
    }
    public static function retrieveTeacherById($id){
        global $dbh;
        $sql=$dbh->prepare("SELECT * FROM teacher WHERE id='$id'");
        $sql->execute();
        $fetch=$sql->fetch(PDO::FETCH_ASSOC);
        return $fetch;
    }
     public static function retrieveTeacherNameById($id){
        global $dbh;
        $sql=$dbh->prepare("SELECT name FROM teacher WHERE id='$id'");
        $sql->execute();
        $data=null;
        while($fetch=$sql->fetch(PDO::FETCH_ASSOC)){
        $data=$fetch;
        }
        return $data['name'];
    }
    public function updateTeacher(){
        if( $this->name==null){
            echo '<div id="msg">Name field must be inserted</div>';
        }elseif(is_numeric($this->name)){
             echo '<div id="msg">Name must be letters</div>';
        }elseif ($this->email==null) {
            echo '<div id="msg">E-mail field must be inserted</div>';
        }elseif ($this->password==null) {
            echo '<div id="msg">Password field must be inserted</div>';
        }elseif (strlen($this->password)<8) {
            echo '<div id="msg">Your password must be at least 8 char</div>';
        }elseif ($this->address==null) {
             echo '<div id="msg">Address field must be inserted</div>';
        }elseif ($this->phone_number == null) {
             echo '<div id="msg">Phone number field must be inserted</div>';
        }elseif (!is_numeric($this->phone_number)) {
            echo '<div id="msg">Phone number must be numbers</div>';
        }elseif (strlen($this->phone_number)!=11) {
             echo '<div id="msg">your phone number must be 11 digits</div>';
        }else{
            global $dbh;
            $sql=$dbh->prepare("UPDATE teacher SET name='$this->name',email='$this->email',password='$this->password',address='$this->address',phone_number='$this->phone_number' WHERE id='$this->id'");
            $sql->execute();
            if(false!==$sql){
                echo '<div id="msg">successful updating</div>';
            }else{
                echo '<div id="msg">error in updating processing</div>';
            }
        }
    }
    public static function logIn($email,$password){
        global $dbh;
        $sql=$dbh->prepare("SELECT id,name FROM teacher WHERE email='$email' AND password='$password'");
        $sql->execute();
        $fetch=$sql->fetch(PDO::FETCH_ASSOC);
        if(is_array($fetch)){
        $_SESSION['id']=$fetch['id'];
        $_SESSION['name']=$fetch['name'];
        header("location:addexam.php");
        exit();
        }else{
            header("location:login.php");
        }
    }
    
}
/*$teacher=Teacher::retrieveTeacherNameById(2);
echo $teacher;*/
?>