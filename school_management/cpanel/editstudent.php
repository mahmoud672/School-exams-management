<?php
    require_once '../lib/admin.php';
    require_once '../lib/student.php';
    require_once 'template/header.php';
    //require_once 'template/navbar.tpl';
    
?>
<div id="content">
    <?php
        if (!(isset($_SESSION['id']) && isset($_SESSION['name']))) {
            echo 'please log in to see content <a href=" login.php">log in</a>';
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
                if(Student::deleteStudentById($id)){
                    echo 'Successful deletion';
                }else{
                    echo 'Error occurs';
                }
                break;
            case('edit'):
                 $studentData =  Student::retrieveStudentById($id);
                 if(is_array($studentData)){
                     
                         echo '<div class="form">
                                <form action="'.$_SERVER['PHP_SELF'].'"method="post">
                                   <lable>Employee name:</lable>
                                   <input type="text"name="name"value="'.$studentData['name'].'"/>
                                   <lable>email:</lable>
                                   <input type="text"name="email"value="'.$studentData['email'].'"class="input"/>
                                   <lable>Employee password:</lable>
                                   <input type="password"name="password"value="'.$studentData['password'].'"/>
                                   <lable>address:</lable>
                                   <input type="text"name="address"value="'.$studentData['address'].'"class="input"/>
                                   <lable>phone number:</lable>
                                   <input type="text"name="phone_number"value="'.$studentData['phone_number'].'"class="input"/>     
                                   <input type="hidden"name="id"value="'.$id.'"/>
                                   <input type="submit"name="updateStudent"value="update Student">
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
    if(isset($_POST['updateStudent'])){
        $id=$_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $phone_number = $_POST['phone_number'];
        $student=new Student($name,$email,$password,$address,$phone_number,$id);
        $student->updateStudent();
    }
    
   ?>
    <table>
        <thead>
            <tr>
                <td>id</td>
                <td>student name</td>
                <td>student email</td>
                <td>student password</td>
                <td>student address</td>
                <td>phone number</td>
                <td>delete</td>
                <td>edit</td>
            </tr>
        </thead>
        <tbody>
       <?php
        $allStudents=  Student::retrieveAllStudent();
        if(is_array($allStudents)){
        foreach($allStudents as $students):
            echo '<tr>
                    <td>'.$students['id'].'</td>
                    <td>'.$students['name'].'</td>
                    <td>'.$students['email'].'</td>    
                    <td>'.$students['password'].'</td>
                    <td>'.$students['address'].'</td>
                    <td>'.$students['phone_number'].'</td>
                    <td><a href="?action=delete&id='.$students['id'].'">Delete</a></td>
                    <td><a href="?action=edit&id='.$students['id'].'">Edit</a></td>
                 </tr>';
        endforeach;
        }else{
            echo '<tr><td colspan="8"> no employies to show </td></tr>';
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

