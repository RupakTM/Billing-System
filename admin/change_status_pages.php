<?php 

require_once "object.php";

$page->set('id',$_GET['id']);
$page->set('status',$_GET['status']);

$page->changeStatus();

header('location:list_pages.php');

?>