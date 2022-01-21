<?php 

require_once "object.php";

$category->set('id',$_GET['id']);
$category->set('status',$_GET['status']);

$category->changeStatus();

header('location:list_category.php');

?>