<?php
    require_once '../lib/admin.php';
    require_once '../lib/book.php';
    require_once 'template/header.php';
    //require_once 'template/navbar.tpl';
    
?>

<div id="content">
    <?php
        if (!(isset($_SESSION['id']) && isset($_SESSION['name']))) {
            echo 'please log in <a href="login.php">log in</a>';
            echo '<div id="loginImage"><a href="login.php"title="login"><img src="template/images/Log In.jpg"></a></div>';
        } else {
            ?>
    <div id="left_content">
    <?php
    if(isset($_POST['addBook'])){
        $title=$_POST['title'];
        $description=$_POST['description'];
        $image=$_FILES['image']['name'];
        $image_tmp=$_FILES['image']['tmp_name'];
        $image_type=$_FILES['image']['type'];
        $image_error=$_FILES['image']['error'];
        if($title==null){
            echo '<div id="msg">please insert the title field</div>';
        }elseif (strlen($title)>255) {
            echo '<div id="msg">title field vlaue must be less than 255</div>';
        }elseif ($description==null) {
            echo '<div id="msg">please insert the description field</div>';
        }elseif ($image==null) {
            echo '<div id="msg">please brows an image for book</div>';
        }elseif (!($image_type=='image/jpeg'||$image_type=='image/png')) {
            echo '<div id="msg">image type must be image/jpg or image/png </div>';
        }elseif ($image_error) {
            echo '<div id="msg">there is an error in your image choose another one</div>';
        }  else {
            $book=new Book($title, $description, $image, $image_tmp);
            if($book->addBook()){
                echo '<div id="msg">new book has been added</div>';
            }  else {
                echo '<div id="msg">error in addition processing</div>';
            }
        }
    }
        
    ?>
    <div class="form">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>"method="post"enctype="multipart/form-data">
            <lable>book title:</lable> 
            <input type="text"name="title"value=""class="input"placeholder="write here">
            <lable>book description:</lable>
            
            <textarea name="description"placeholder="write here"class="textArea"></textarea>
            <lable>book image:</lable>
            <input type="file"name="image"value=""class="input"placeholder="write here">
            <input type="submit"name="addBook"value="Add Book">
        </form>
    </div>
        </div>
    <?php require_once 'template/right_content.tpl'; ?>
    <?php }?>
</div>
<?php
    require_once 'template/footer.tpl';
?>
