<?php 
require_once "object.php";
if (isset($_GET['id'])) {
    $news->set('id',$_GET['id']);
    $data = $news->remove();
    header('location:list_news.php');
    if (count($data) == 0) {
        header('location:list_news.php');
    }
} else{
    header('location:list_news.php');
}

?>