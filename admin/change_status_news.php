<?php 

require_once "object.php";

$news->set('id',$_GET['id']);
$news->set('status',$_GET['status']);

$news->changeStatus();

header('location:list_news.php');


?>