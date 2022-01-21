<?php 
$title = "View Video";
require_once "header.php";
if (isset($_GET['id'])) {
    $video->set('id',$_GET['id']);
    $data = $video->getVideoById();
    if (count($data) == 0) {
        header('location:list_video.php');
    }
} else{
    header('location:list_video.php');
}

?>

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Video Management</h1>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
             	<h6 class="m-0 font-weight-bold text-primary">
                    View Video
                    <a href="add_video.php" class="btn btn-success">
                        <i class="fas fa-plus"> Add</i>
                    </a>
                    <a href="list_video.php" class="btn btn-primary">
                        <i class="fas fa-list"> List</i>
                    </a>
                </h6>
            </div>
            <div class="card-body">
            	<table class="table table-bordered">
                    <tr>
                        <th>Title</th>
                        <td><?php echo $data[0]->title ?></td>
                    </tr>
                    <tr>
                        <th>Video Link</th>
                        <td>
                            <a target="_blank" href="<?php echo $data[0]->video_link;?>">
                                <?php echo $data[0]->video_link; ?>
                            </a>
                        </td>
                    </tr>
                     <tr>
                        <th>Description</th>
                        <td><?php echo $data[0]->description ?></td>
                    </tr>
                     <tr>
                        <th>Thumbnail</th>
                        <td>
                            <img src="images/<?php echo $data[0]->thumbnail ?>" width="64" height="64">
                        </td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <?php if ($data[0]->status) { ?>
                                <label class="text text-success">Active</label>
                            <?php } else{?>
                                <label class="text text-danger">Deactive</label>
                            <?php } ?>        
                        </td>
                    </tr>
                    <tr>
                        <th>Created By</th>
                        <td><?php echo $data[0]->uname ?></td>
                    </tr>
                    <tr>
                        <th>Updated By</th>
                        <td><?php echo $data[0]->updated_by ?></td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td><?php echo $data[0]->created_at ?></td>
                    </tr>
                    <tr>
                        <th>Updated At</th>
                        <td><?php echo $data[0]->updated_at ?></td>
                    </tr>
            	</table>
            </div>
        </div>
    </div>
</div>

<?php require_once "footer.php"; ?>