<?php 

require_once "object.php";

$ads->set('id',$_GET['id']);
$ads->set('status',$_GET['status']);

$ads->changeStatus();

header('location:list_advertisement.php');

?>