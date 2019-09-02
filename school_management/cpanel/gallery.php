<?php
    require_once '../lib/teacher.php';
    require_once '../lib/subject.php';
    require_once '../lib/exam.php';
    require_once '../lib/question.php';
    require_once '../lib/question_choices.php';
    require_once '../lib/student.php';
      require_once '../lib/grade.php';
    require_once 'template/header.php';
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
            echo'Date of day is :' .date('d/m/Y : h a');
        ?>
        <div id="image_gallery_top">
            <img src="template/images/DD2CD25D-FD46-B9FF-37B04C51F27DB3BD_largecarouselimages.jpg">
        </div>
        <div id="image_gallery">
            <div class="image_box">
                <img src="template/images/1036-4-High-School-Students-Sitting-on-the-Grass.jpg">
                <img src="template/images/education.jpg">
                <img src="template/images/school_of_law_0.jpg">

            </div>
            <div class="image_box">
                <img src="template/images/1452998777.jpg">
                <img src="template/images/dd.jpg">
                <img src="template/images/defining_excellence-e1445001612210.jpg">

            </div>
            <div class="image_box right">
                <img src="template/images/taps-top.jpg">
                <img src="template/images/school-students-header.jpg">
                <img src="template/images/New Zealand schooling.jpg">

            </div>
        </div> 
        </div>
    </div>
    <?php }?>
    <div id="right_content">
       
    </div>
</div>
<?php
    require_once 'template/footer.tpl';
?>
