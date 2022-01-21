<?php 
require_once "object.php";
if (isset($_GET['id'])) {
    $video->set('id',$_GET['id']);
    $data = $video->remove();
    header('location:list_video.php');
    if (count($data) == 0) {
        header('location:list_video.php');
    }
} else{
    header('location:list_video.php');
}

?>