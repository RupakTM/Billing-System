<?php 

require_once "object.php";

$author->set('id',$_GET['id']);
$author->set('status',$_GET['status']);

$author->changeStatus();

header('location:list_author.php');

?>