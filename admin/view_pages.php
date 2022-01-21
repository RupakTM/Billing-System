<?php 
$title = "View Pages";
require_once "header.php";
if (isset($_GET['id'])) {
    $page->set('id',$_GET['id']);
    $data = $page->getPagesById();
    // print_r($data);
    if (count($data) == 0) {
        header('location:list_pages.php');
    }
} else{
    header('location:list_pages.php');
}

?>

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Page Management</h1>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
             	<h6 class="m-0 font-weight-bold text-primary">
                    View Pages
                    <a href="add_pages.php" class="btn btn-success">
                        <i class="fas fa-plus"> Add</i>
                    </a>
                    <a href="list_pages.php" class="btn btn-primary">
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
                        <th>Slug</th>
                        <td><?php echo $data[0]->slug ?></td>
                    </tr>
                    <tr>
                        <th>Image</th>
                        <td>
                            <img src="images/<?php echo $data[0]->image ?>" width="100" height="100">
                        </td>
                    </tr>
                    <tr>
                        <th>Short Description</th>
                        <td><?php echo $data[0]->short_description ?></td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td><?php echo $data[0]->description ?></td>
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