<?php 
require_once "object.php";
if (isset($_GET['id'])) {
    $ads->set('id',$_GET['id']);
    $data = $ads->remove();
    header('location:list_advertisement.php');
    if (count($data) == 0) {
        header('location:list_advertisement.php');
    }
} else{
    header('location:list_advertisement.php');
}

?>