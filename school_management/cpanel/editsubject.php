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
        if(isset($_GET['action'],$_GET['id'])){
            $action=$_GET['action'];
            $id=$_GET['id'];
            switch($action):
                case('delete'):
                    if(Subject::deleteSubjectById($id)){
                        echo '<div id="msg">success deletion</div>';
                    }  else {
                         echo '<div id="msg">error in  deletion processing</div>';
                    }
                    break;
                case('edit'):
                    $subjectData=  Subject::retrieveSubjectById($id);
                    if(is_array($subjectData)){
                        echo '<div class="form">
                                <form action="'.$_SERVER['PHP_SELF'].'"method="post">
                                   <lable>subject name:</lable>
                                   <input type="text"name="name"value="'.$subjectData['name'].'"placeholder="write here"class="input"/>
                                   <input type="hidden"name="id"value="'.$subjectData['id'].'"/>
                                   <input type="submit"name="updateSubject"value="Update Subject">
                                </form>
                             </div>';
                    }else{
                        echo '<div id="msg">there is no subject to show</div>';
                    }
                    break;
                default:
                    echo '<div id="msg">invalid action</div>';
            endswitch;
            
        }
        if(isset($_POST['updateSubject'])){
            $id=$_POST['id'];
            $name=$_POST['name'];
            if($name==null){
                echo '<div id="msg">Please fill the name field!</div>';
            }elseif(is_numeric($name)){
                echo '<div id="msg">Please name must be letters !</div>';
            }else{
                $subject=new Subject($name,$id);
                if($subject->updateSubject()){
                    echo '<div id="msg">successfull updating</div>';
                }  else {
                    echo '<div id="msg"> error in updating processing</div>';
                } 
            }
        }
    ?>
     <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>subject</th>
                    <th>Delete subject</th>
                    <th>Edit subject</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $allSubjects=Subject::retrieveAllSubjects();
                    if(is_array($allSubjects)){
                        foreach ($allSubjects as $subjects):
                            echo '<tr>
                                    <td>'.$subjects['id'].'</td>
                                    <td>'.$subjects['name'].'</td>
                                    <td><a href="?action=delete&id='.$subjects['id'].'">Delete</a></td>
                                    <td><a href="?action=edit&id='.$subjects['id'].'">Edit</a></td>
                                </tr>
                                 
                                ';
                        endforeach;
                    }else{
                        echo '<div id="msg">no subject to show</div>';
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
