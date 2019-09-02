<?php
require_once '../lib/admin.php';
require_once 'template/header.php';
//require_once 'template/navbar.tpl';
require_once '../lib/teacher.php';
require_once '../lib/student.php';
require_once '../lib/class_room.php';
require_once '../lib/class_management.php';
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
        if (isset($_GET['action'], $_GET['id_class_room'])) {
            $action = $_GET['action'];
            $id_class_room = $_GET['id_class_room'];
            switch ($action):
                case('delete'):
                    Class_room::deleteClassRoomById($id_class_room);
                    // Management::deleteCategoryFromManagementByIdCategory($id_category);
                    break;
                case('edit'):
                    $class_room = Class_room::retrieveClassRoomById($id_class_room);
                    echo ' <div class="form">
                            <form action="' . $_SERVER['PHP_SELF'] . '"method="post">
                               <lable>class room name:</lable>
                               <input type="text"name="name"value="' . $class_room['name'] . '"/>
                               <input type="hidden"name="id_class_room"value="' . $id_class_room . '"/>
                               <input type="submit"name="updateClassRoom"value="Update class room">
                            </form> 
                           </div>';
                    break;
                case('show'):
                    $allStudents = Student::retrieveAllStudent();
                    $allDataInClassManagement = Class_management::retrieveStudentsForSpecificClassRoomById($id_class_room);
                    if (is_array($allStudents) && is_array($allDataInClassManagement)) {
                        echo'<div class="form">
                                <form action="' . $_SERVER['PHP_SELF'] . '"method="post">
                                    <input type="hidden"name="id_class_room" value="' . $id_class_room . '"/>
                                    <table>
                                       <thead>
                                           <tr>
                                                <th>id</th>
                                                <th>student name</th>
                                                <th>Mark</th>
                                           </tr>
                                       </thead>
                                       <tbody>   
                              ';
                        foreach ($allStudents as $students):
                            if (in_array($students['id'], $allDataInClassManagement)) {
                                echo '<tr>
                                        <td>' . $students['id'] . '</td>
                                        <td>' . $students['name'] . '</td>
                                        <td><input type="checkbox"name="id_student[]"value="' . $students['id'] . '"checked="checked"/></td>
                                     </tr>
                                       ';
                            } else {
                                echo '<tr>
                                         <td>' . $students['id'] . '</td>
                                         <td>' . $students['name'] . '</td>
                                         <td><input type="checkbox"name="id_student[]"value="' . $students['id'] . '"/></td>
                                     </tr>
                                       ';
                            }

                        endforeach;
                    } else {
                        echo '<tr><td colspan="4">There is no data to show </td></tr>';
                    }
                    echo '</tbody>
                          </table>
                          <input type="submit"name="updateClssStudent"value="Update class student"/>
                        <form>
                       </div>';
                    break;
                default:
                    echo 'Invalid action !';

            endswitch;
        }
        //update category
        if (isset($_POST['updateClassRoom'])) {
            $name = $_POST['name'];
            $id_class_room = $_POST['id_class_room'];
            if ($name == null) {
                echo 'Please fill the name field!';
            } elseif (is_numeric($name)) {
                echo 'Please name must be letters !';
            } else {
                $class_room = new Class_room($name, $id_class_room);
                if ($class_room->updateClassRoom()) {
                    echo 'Updating successfuly';
                } else {
                    echo 'Error occurs!';
                }
            }
        }
        //update manager
        if (isset($_POST['updateClssStudent'])) {
            $id_student = isset($_POST['id_student']) ? $_POST['id_student'] : null;
            $id_class_room = $_POST['id_class_room'];
            $id_teacher=  Class_management::retrieveTeachersForSpecificClassRoomById($id_class_room);
            $allStudentInClassManagement =Class_management::retrieveStudentsForSpecificClassRoomById($id_class_room);
            if (is_array($allStudentInClassManagement) && is_array($id_student)) {
                $newStudent = array_diff($id_student, $allStudentInClassManagement);
                $removeStudent = array_diff($allStudentInClassManagement, $id_student);

                if (count($newStudent) > 0) {
                    foreach ($newStudent as $new_student):
                        $classManagement = new Class_management($id_teacher,$new_student, $id_class_room);
                        $classManagement->addTeacherAndStudentForSpecificClass();
                        echo $new_student;
                    endforeach;
                }
                if (count($removeStudent) > 0) {
                    foreach ($removeStudent as $remove_student):
                        $classManagement = new Class_management($id_teacher,$remove_student, $id_class_room);
                        $classManagement->deleteStudentForSpecificClassRoom();
                        echo $remove_student;
                    endforeach;
                }
            }else {
                echo 'no result found';
            }
        }
        ?>
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>class room name</th>
                    <th>class room teacher</th>
                    <th>students</th>
                    <th>Delete category</th>
                    <th>Edit category</th>
                </tr>
            </thead>
            <tbody>
<?php
$allClassRooms = Class_room::retrieveAllClassRooms();
if (is_array($allClassRooms)) {
    foreach ($allClassRooms as $classRooms):
        $teacher = Class_management::retrieveTeachersForSpecificClassRoomById($classRooms['id']);
        echo '<tr>
                <td>' . $classRooms['id'] . '</td>
                <td>' . $classRooms['name'] . '</td>
                <td>' . Teacher::retrieveTeacherNameById($teacher) . '</td>
                <td><a href="?action=show&id_class_room=' . $classRooms['id'] . '">Show students</a></td>
                <td><a href="?action=delete&id_class_room=' . $classRooms['id'] . '">Delete</a></td>
                <td><a href="?action=edit&id_class_room=' . $classRooms['id'] . '">Edit</a></td>
             </tr>';
    endforeach;
}else {
    echo '<tr><td colspan=5> There is no data to show !</td></tr>';
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
