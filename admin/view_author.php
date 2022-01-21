<?php 
$title = "View Video";
require_once "header.php";
if (isset($_GET['id'])) {
    $author->set('id',$_GET['id']);
    $data = $author->getAuthorById();
    if (count($data) == 0) {
        header('location:list_author.php');
    }
} else{
    header('location:list_author.php');
}

?>

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Author Management</h1>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
             	<h6 class="m-0 font-weight-bold text-primary">
                    View Author
                    <a href="add_author.php" class="btn btn-success">
                        <i class="fas fa-plus"> Add</i>
                    </a>
                    <a href="list_author.php" class="btn btn-primary">
                        <i class="fas fa-list"> List</i>
                    </a>
                </h6>
            </div>
            <div class="card-body">
            	<table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <td><?php echo $data[0]->name ?></td>
                    </tr>
                    <tr>
                        <th>Photo</th>
                        <td>
                            <img src="images/<?php echo $data[0]->photo ?>" width="64" height="64">
                        </td>
                    </tr>
                    <tr>
                        <th>Contact</th>
                        <td><?php echo $data[0]->phone ?></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td><?php echo $data[0]->address ?></td>
                    </tr>
                    <tr>
                        <th>Bio</th>
                        <td><?php echo $data[0]->bio ?></td>
                    </tr>
                    <tr>
                        <th>Facebook</th>
                        <td>
                            <a target="_blank" href="<?php echo $data[0]->facebook;?>">
                                <?php echo $data[0]->facebook; ?>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>Twitter</th>
                        <td>
                            <a target="_blank" href="<?php echo $data[0]->twitter;?>">
                                <?php echo $data[0]->twitter; ?>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>Instagram</th>
                        <td>
                            <a target="_blank" href="<?php echo $data[0]->instagram;?>">
                                <?php echo $data[0]->instagram; ?>
                            </a>
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