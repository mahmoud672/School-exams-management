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
    if(isset($_GET['action'],$_GET['id'])){
        $action=$_GET['action'];
        $id=$_GET['id'];
        switch ($action):
            case('delete'):
                if(Book::deleteBookById($id)){
                    echo '<div id="msg">successfull deleting</div>';
                }  else {
                    echo '<div id="msg">error in deleting processing</div>';
                }
                break;
            case('edit'):
                $bookData=Book::retrieveBookById($id);
                if(is_array($bookData)){
                    echo '<div class="form">
                            <form action="'.$_SERVER['PHP_SELF'].'"method="post"enctype="multipart/form-data">
                                <lable>book title:</lable> 
                                <input type="text"name="title"value="'.$bookData['title'].'"class="input"placeholder="write here">
                                <lable>book description:</lable>
                                <textarea name="description"placeholder="write here"class="textArea">'.$bookData['description'].'</textarea>
                                <lable>book image:</lable>
                                <input type="file"name="image"value=""class="input"placeholder="write here">
                                <input type="hidden"name="id"value="'.$id.'">
                                <input type="submit"name="updateBook"value="Update Book">
                          </div>';
                }else{
                    echo '<div id="msg"> there is no data to show</div>';
                }
                break;
            default:
            echo '<div id="masg">invalid action</div>';
        endswitch;
    }
    
    if(isset($_POST['updateBook'])){
        $id=$_POST['id'];
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
           $book=new Book($title, $description, $image, $image_tmp, $id);
           if($book->updateBook()){
               echo '<div id="msg">successful updating</div>';
           }  else {
               echo '<div id="msg">error in updating procssing</div>';
           }
        }
    }
        
    ?>
       <table>
        <thead>
            <tr>
                <td>id</td>
                <td>book title</td>
                <td>book description</td>
                <td>book image</td>
                <td>delete</td>
                <td>edit</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $allBooks=Book::retrieveAllBooks();
            if(is_array($allBooks)){
                foreach ($allBooks as $books):
                    echo '<tr>
                            <td>'.$books['id'].'</td>
                            <td>'.$books['title'].'</td>
                            <td>'.$books['description'].'</td>
                            <td><img src="../upload/'.$books['image'].'"/></td>
                            <td><a href="?action=delete&id='.$books['id'].'">Delete</a></td>
                            <td><a href="?action=edit&id='.$books['id'].'">Edit</a></td>
                        </tr>
                         ';
                endforeach;
            }  else {
                echo'<tr><td colspan="5">no books to show</td></tr>';
            }
            ?>
        </tbody>
    </table>
       
        </div>
    <?php require_once 'template/right_content.tpl'; ?>
     <?php }?>
</div>
<?php
   
    require_once 'template/footer.tpl';
?>
