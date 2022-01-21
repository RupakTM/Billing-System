<?php 
$title = "View Advertisement";
require_once "header.php";
if (isset($_GET['id'])) {
    $ads->set('id',$_GET['id']);
    $data = $ads->getAdvertisementById();
    // print_r($data);
    if (count($data) == 0) {
        header('location:list_advertisement.php');
    }
} else{
    header('location:list_advertisement.php');
}

?>

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Advertisement Management</h1>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
             	<h6 class="m-0 font-weight-bold text-primary">
                    View Advertisement
                    <a href="add_advertisement.php" class="btn btn-success">
                        <i class="fas fa-plus"> Add</i>
                    </a>
                    <a href="list_advertisement.php" class="btn btn-primary">
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
                        <th>Image</th>
                        <td>
                            <img src="images/<?php echo $data[0]->image ?>" width="64" height="64">
                        </td>
                    </tr>
                    <tr>
                        <th>Expire Date</th>
                        <td><?php echo $data[0]->expire_date ?></td>
                    </tr>
                    <tr>
                        <th>Link</th>
                        <td><?php echo $data[0]->link ?></td>
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