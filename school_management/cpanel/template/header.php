<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Index</title>
        <link type="text/css" rel="stylesheet" href="template/css/base.css"/>
    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <div id="leftheader">
                    <div id="logo">
                            <!--<img src="template/images/logo.png"/>-->
                        <p>M.</p><div id="fifty">50</div> <div id="cent">Cent</div>
                    </div>
                </div>
                <div id="rightheader">
                    <?php
                    if (isset($_SESSION['id']) && isset($_SESSION['name'])) {
                        echo'<div id="wellSession">welcome <span>' . $_SESSION['name'] . '</span></div>'.' <div id="logOut"><a href="logout.php">Log out</a></div>';
                    }else{
                        echo'<div id="wellSession">welcome <span>visitors</span></div>'.' <div id="logOut"><a href="login.php">Log in</a></div>';
                    }
                    ?>
                </div>
            </div>
            <div id="slideshow">
                <img src="template/images/dd.jpg"/>
                <img src="template/images/defining_excellence-e1445001612210.jpg"/>
                <img src="template/images/New Zealand schooling.jpg"/>
                <img src="template/images/education.jpg"/>
                <img src="template/images/Selfie_Ultra HD.jpg"/>
                <img src="template/images/school-students-header.jpg"/>
                <img src="template/images/school_of_law_0.jpg"/>
                <img src="template/images/taps-top.jpg"/>
                <img src="template/images/DD2CD25D-FD46-B9FF-37B04C51F27DB3BD_largecarouselimages.jpg"/>
                <img src="template/images/1452998777.jpg"/>
                <img src="template/images/1036-4-High-School-Students-Sitting-on-the-Grass.jpg"/>
            </div>

            