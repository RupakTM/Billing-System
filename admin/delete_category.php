<?php 
require_once "object.php";
if (isset($_GET['id'])) {
    $category->set('id',$_GET['id']);
    $data = $category->remove();
    header('location:list_category.php');
    if (count($data) == 0) {
        header('location:list_category.php');
    }
} else{
    header('location:list_category.php');
}

?>