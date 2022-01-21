<?php 
require_once "object.php";
if (isset($_GET['id'])) {
    $author->set('id',$_GET['id']);
    $data = $author->remove();
    header('location:list_author.php');
    if (count($data) == 0) {
        header('location:list_author.php');
    }
} else{
    header('location:list_author.php');
}

?>