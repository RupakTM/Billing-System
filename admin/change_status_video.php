<?php 

require_once "object.php";

$video->set('id',$_GET['id']);
$video->set('status',$_GET['status']);

$video->changeStatus();

header('location:list_video.php');

?>