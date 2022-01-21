<?php 
require_once "object.php";
if (isset($_GET['id'])) {
    $role->set('id',$_GET['id']);
    $data = $role->remove();
    header('location:list_role.php');
    if (count($data) == 0) {
        header('location:list_role.php');
    }
} else{
    header('location:list_role.php');
}

?>