<?php
    require_once '../lib/admin.php';
    require_once 'template/header.php';
    //require_once 'template/navbar.tpl';
    require_once '../lib/teacher.php';
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
    if(isset($_GET['action'], $_GET['id'])){
        $action=$_GET['action'];
        $id=$_GET['id'];
        switch($action):
            case('delete'):
                if(Teacher::deleteTeacherById($id)){
                    echo 'Successful deletion';
                }else{
                    echo 'Error occurs';
                }
                break;
            case('edit'):
                 $teacherData =Teacher::retrieveTeacherById($id);
                 if(is_array($teacherData)){
                     
                         echo '<div class="form">
                                <form action="'.$_SERVER['PHP_SELF'].'"method="post">
                                   <lable>Teacher name:</lable>
                                   <input type="text"name="name"value="'.$teacherData['name'].'"/>
                                   <lable>email:</lable>
                                   <input type="text"name="email"value="'.$teacherData['email'].'"class="input"/>
                                   <lable>Employee password:</lable>
                                   <input type="password"name="password"value="'.$teacherData['password'].'"/>
                                   <lable>address:</lable>
                                   <input type="text"name="address"value="'.$teacherData['address'].'"class="input"/>
                                   <lable>phone number:</lable>
                                   <input type="text"name="phone_number"value="'.$teacherData['phone_number'].'"class="input"/>     
                                   <input type="hidden"name="id"value="'.$id.'"/>
                                   <input type="submit"name="updateTeacher"value="update Teacher">
                               </form>
                           </div>';
                   
                 }else{
                     echo 'No data to show !';
                 }
                 break;
             default:
                 echo 'Invalid action';
        endswitch;
    }
    if(isset($_POST['updateTeacher'])){
        $id=$_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $phone_number = $_POST['phone_number'];
        $teacher=new Teacher($name,$email,$password,$address,$phone_number,$id);
        $teacher->updateTeacher();
    }
    
   ?>
        
    <table>
        <thead>
            <tr>
                <td>id</td>
                <td>user name</td>
                <td>user email</td>
                <td>user password</td>
                <td>address</td>
                <td>phone number</td>
                <td>delete</td>
                <td>edit</td>
            </tr>
        </thead>
        <tbody>
            
       <?php
        $allTeachers=Teacher::retrieveAllTeacher();
        if(is_array($allTeachers)){
        foreach($allTeachers as $teachers):
            echo '<tr>
                    <td>'.$teachers['id'].'</td>
                    <td> Mr.'.$teachers['name'].'</td>
                    <td> Mr.'.$teachers['email'].'</td>
                    <td>'.$teachers['password'].'</td>
                    <td>'.$teachers['address'].'</td>
                    <td>'.$teachers['phone_number'].'</td>
                    <td><a href="?action=delete&id='.$teachers['id'].'">Delete</a></td>
                    <td><a href="?action=edit&id='.$teachers['id'].'">Edit</a></td>
                 </tr>';
        endforeach;
        }else{
            echo '<tr><td colspan="5"> no employies to show </td></tr>';
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

