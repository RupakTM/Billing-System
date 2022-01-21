<?php 
$title = "List Video";
require_once "header.php";

$data = $video->list();
?>

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Video Management</h1>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
             	<h6 class="m-0 font-weight-bold text-primary">
                    List Video
                    <a href="add_video.php" class="btn btn-success">
                        <i class="fas fa-plus"> Add</i>
                    </a>
                </h6>
            </div>
            <div class="card-body">
            	<table class="table table-bordered">
            		<thead>
            			<tr>
            				<th>SN</th>
            				<th>Title</th>
                            <th>Video Link</th>
            				<th>Status</th>
            				<th>Created By</th>
            				<th>Created At</th>
                            <th>Action</th>
            			</tr>
            		</thead>
            		<tbody>
            		<?php foreach ($data as $sn => $d){?>
            			<tr>
            				<td><?php echo $sn+1; ?></td>
            				<td><?php echo $d->title; ?></td>
                            <td>
                                <a target="_blank" href="<?php echo $d->video_link;?>">
                                    <?php echo $d->video_link; ?>
                                </a>
                            </td>
            				<td>
                                <?php if ($d->status == 1) { ?>
                                    <a href="change_status_video.php?id=<?php echo $d->id ?>& status=0" title="click to deactivate">
                                        <label class="text text-success">Active</label>
                                    </a>
                                <?php } else{?>
                                    <a href="change_status_video.php?id=<?php echo $d->id ?>& status=1" title="click to activate">
                                        <label class="text text-danger">Deactive</label>
                                    </a>
                                <?php } ?>            
                            </td>
            				<td><?php echo $d->uname; ?></td>
            				<td><?php echo $d->created_at; ?></td>
                            <td>
                                <a href="view_video.php?id=<?php echo $d->id; ?>" class="btn btn-info">
                                    <i class="fas fa-eye"> View</i>
                                </a>
                                <a href="edit_video.php?id=<?php echo $d->id; ?>" class="btn btn-warning">
                                    <i class="fas fa-edit"> Edit</i>
                                </a>
                                <a href="delete_video.php?id=<?php echo $d->id; ?>" class="btn btn-danger" onclick="return confirm('Are you sure delete data ?')">
                                    <i class="fas fa-trash"> Delete</i>
                                </a>
                            </td>
            			</tr>
            		<?php } ?>
            		</tbody>
            	</table>
            </div>
        </div>
    </div>
</div>

<?php require_once "footer.php"; ?>