<?php 
require_once "object.php";
if (isset($_GET['id'])) {
    $page->set('id',$_GET['id']);
    $data = $page->remove();
    header('location:list_pages.php');
    if (count($data) == 0) {
        header('location:list_pages.php');
    }
} else{
    header('location:list_pages.php');
}

?>