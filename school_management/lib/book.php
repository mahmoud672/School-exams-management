<?php
require_once '../config.php';

class Book{
    
    private $id;
    private $title;
    private $description;
    private $image;
    private $image_tmp;
    
    public function __construct($title,$description,$image,$image_tmp,$id=""){
        $this->id=$id;
        $this->title=$title;
        $this->description=$description;
        $this->image=$image;
        $this->image_tmp=$image_tmp;
    }
    public function addBook(){
        if(is_uploaded_file($this->image_tmp)){
            $this->image=time().$this->image;
            if(move_uploaded_file($this->image_tmp, '../upload/'.$this->image)){
                global $dbh;
                $sql=$dbh->prepare("INSERT INTO book(title,description,image)VALUES(' $this->title','$this->description','$this->image') ");
                $sql->execute();
                if(false!==$sql)
                    return TRUE;
                else 
                    return FALSE;
            }
        }
    }
    public static function deleteBookById($id){
        global $dbh;
        $sql=$dbh->prepare("DELETE FROM book WHERE id='$id'");
        $sql->execute();
        if(false!==$sql)
                    return TRUE;
                else 
                    return FALSE;
        
    }
    public static function retrieveAllBooks(){
        global $dbh;
        $sql=$dbh->prepare("SELECT * FROM book");
        $sql->execute();
        $data=null;
        while($fetch=$sql->fetch(PDO::FETCH_ASSOC)):
            $data[]=$fetch;
        endwhile;
        return $data;
    }
    public static function retrieveBookById($id){
        global $dbh;
        $sql=$dbh->prepare("SELECT * FROM book WHERE id='$id'");
        $sql->execute();
       
        $fetch=$sql->fetch(PDO::FETCH_ASSOC);
        return $fetch;
    }
    public function updateBook(){
        if(is_uploaded_file($this->image_tmp)){
            $this->image=time().$this->image;
            if(move_uploaded_file($this->image_tmp, '../upload/'.$this->image)){
                global $dbh;
                $sql=$dbh->prepare("UPDATE book SET title='$this->title',description='$this->description',image='$this->image' WHERE id='$this->id'");
                $sql->execute();
                if(false!==$sql)
                    return TRUE;
                else 
                    return FALSE;
            }
        }
    }
    
}
?>
