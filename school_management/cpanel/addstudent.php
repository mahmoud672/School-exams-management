<?php
     require_once '../lib/admin.php';
    require_once '../lib/student.php';
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
        if(isset($_POST['addStudent'])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $address = $_POST['address'];
            $phone_number =$_POST['phone_number'];
            $student = new Student($name, $email, $password, $address, $phone_number);
            $student->addStudent();
        }
        
    ?>
    <div class="form">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>"method="post">
            <lable>student name:</lable> 
            <input type="text"name="name"value=""class="input"placeholder="write here">
            <lable>student email:</lable>
            <input type="text"name="email"value=""class="input"placeholder="write here">
            <lable>student password:</lable>
            <input type="password"name="password"value=""class="input"placeholder="write here">
            <lable>student address:</lable>
            <input type="text"name="address"value=""class="input"placeholder="write here">
            <lable>phone number:</lable>
            <input type="text"name="phone_number"value=""class="input"placeholder="write here">
            <input type="submit"name="addStudent"value="Add Student">
        </form>
    </div>
        </div>
    <?php require_once 'template/right_content.tpl'; ?>
    <?php }?>
</div>
<?php
    require_once 'template/footer.tpl';
?>
