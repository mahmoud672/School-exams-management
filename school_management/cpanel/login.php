<?php
        require_once 'template/header.tpl';
        require_once '../lib/student.php';
        require_once '../lib/admin.php';
        require_once '../lib/teacher.php';
?>

<div id="content">
    <div id="left_content">
    <?php
    if(isset($_POST['login'])){
        $email=$_POST['email'];
        $password=$_POST['password'];
        if($email==null){
            echo '<div id="msg">e-mail field required </div>';
        }elseif ($password==null) {
            echo '<div id="msg">password field required </div>';
        }else{
        $student= Student::logIn($email, $password);
        $admin= Admin::logIn($email, $password);
        $teacher=  Teacher::logIn($email, $password);
        }
    }
    
    ?>
    <div class="form" id="loginForm">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>"method="post">
            <lable> email:</lable>
            <input type="text"name="email"value=""class="input"placeholder="write here">
            <lable>password:</lable>
            <input type="password"name="password"value=""class="input"placeholder="write here">
            <input type="submit"name="login"value="Log In">
        </form>
    </div>
        </div>
    
</div>
<?php
    require_once 'template/footer.tpl';
?>
