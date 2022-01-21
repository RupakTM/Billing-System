<?php 
require_once "object.php";
if (isset($_GET['id'])) {
    $user->set('id',$_GET['id']);
    $data = $user->remove();
    header('location:list_user.php');
    if (count($data) == 0) {
        header('location:list_user.php');
    }
} else{
    header('location:list_user.php');
}

?>