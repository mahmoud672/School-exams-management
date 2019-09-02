<?php
    require_once '../lib/student.php';
    require_once 'template/header.php';
    //require_once 'template/header.tpl';
    require_once 'template/navbar.tpl';
    require_once '../lib/book.php';
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
            $allBooks=Book::retrieveAllBooks();
            if(is_array($allBooks)){
                foreach ($allBooks as $books):
                    echo '<div class="liberary_book">
                            <div class="image_book">
                                <a href="?estpphooigkl&id='.$books['id'].'"><img src="../upload/'.$books['image'].'"></a>
                            </div>
                            <div id="book_title">
                                <h4>'.$books['title'].'</h4>
                                <div id="readMore">
                                    <a href="?estpphooigkl&id='.$books['id'].'">read more</a>
                                </div>
                            </div>
                          </div>';
                endforeach;
            }  else {
                echo '<div id="msg">there is no books</div>';
            }
            
            if(isset($_GET['estpphooigkl'],$_GET['id'])){
                $action=$_GET['estpphooigkl'];
                $id=$_GET['id'];
                $bookData=Book::retrieveBookById($id);
                if(is_array($bookData)){
                    //echo $bookData['description'] ;
                    echo '<div id="book_descContent">
                           <img src="template/images/paper.jpg">
                            <div id="con">'.$bookData['description'].'</div>
                          </div>
                        ';
                }else{
                    echo '<div id="msg"> there is no content</div>';
                }
            }
        ?>
        
    </div>
    <?php }?>
    <div id="right_content">
       
    </div>
</div>
<?php
    require_once 'template/footer.tpl';
?>
