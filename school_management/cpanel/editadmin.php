<?php
    require_once '../lib/admin.php';
    require_once 'template/header.php';
    //require_once 'template/navbar.tpl';
    require_once '../lib/admin.php';
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
                if(Admin::deleteAdminById($id)){
                    echo 'Successful deletion';
                }else{
                    echo 'Error occurs';
                }
                break;
            case('edit'):
                 $adminData =  Admin::retrieveAdminById($id);
                 if(is_array($adminData)){
                     
                         echo '<div class="form">
                                <form action="'.$_SERVER['PHP_SELF'].'"method="post">
                                   <lable>Teacher name:</lable>
                                   <input type="text"name="name"value="'.$adminData['name'].'"/>
                                   <lable>email:</lable>
                                   <input type="text"name="email"value="'.$adminData['email'].'"class="input"/>
                                   <lable>Employee password:</lable>
                                   <input type="password"name="password"value="'.$adminData['password'].'"/>
                                   <lable>address:</lable>
                                   <input type="text"name="address"value="'.$adminData['address'].'"class="input"/>
                                   <lable>phone number:</lable>
                                   <input type="text"name="phone_number"value="'.$adminData['phone_number'].'"class="input"/>     
                                   <input type="hidden"name="id"value="'.$id.'"/>
                                   <input type="submit"name="updateAdmin"value="update Admin">
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
    if(isset($_POST['updateAdmin'])){
        $id=$_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $phone_number = $_POST['phone_number'];
        $admin=new Admin($name,$email,$password,$address,$phone_number,$id);
        $admin->updateAdmin();
    }
    
   ?>
        
    <table>
        <thead>
            <tr>
                <td>id</td>
                <td>admin name</td>
                <td>admin email</td>
                <td>admin password</td>
                <td>address</td>
                <td>phone number</td>
                <td>delete</td>
                <td>edit</td>
            </tr>
        </thead>
        <tbody>
            
       <?php
        $allAdmins=  Admin::retrieveAllAdmins();
        if(is_array($allAdmins)){
        foreach($allAdmins as $admins):
            echo '<tr>
                    <td>'.$admins['id'].'</td>
                    <td> Mr.'.$admins['name'].'</td>
                    <td> Mr.'.$admins['email'].'</td>
                    <td>'.$admins['password'].'</td>
                    <td>'.$admins['address'].'</td>
                    <td>'.$admins['phone_number'].'</td>
                    <td><a href="?action=delete&id='.$admins['id'].'">Delete</a></td>
                    <td><a href="?action=edit&id='.$admins['id'].'">Edit</a></td>
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

