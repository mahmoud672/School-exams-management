<?php
    require_once '../lib/admin.php';
    require_once 'template/header.php';
    //require_once 'template/navbar.tpl';
    require_once '../lib/subject.php';
   
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
        if(isset($_POST['addSubject'])){
            $name=$_POST['name'];
            if($name==null){
                echo '<div id="msg">Please fill the name field!</div>';
            }elseif(is_numeric($name)){
                echo '<div id="msg">Please name must be letters !</div>';
            }else{
                $subject=new Subject($name);
                if($subject->addSubject()){
                    echo '<div id="msg">successfull addition</div>';
                }  else {
                    echo '<div id="msg"> error in addition processing</div>';
                } 
            }
        }
    ?>
    <div class="form">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>"method="post">
            <lable>subject name:</lable>
            <input type="text"name="name"placeholder="write here"class="input"/>
            <input type="submit"name="addSubject"value="Add Subject">
        </form>
    </div>
        </div>
    <?php require_once 'template/right_content.tpl'; ?>
    <?php }?>
</div>
<?php
    require_once 'template/footer.tpl';
?>
