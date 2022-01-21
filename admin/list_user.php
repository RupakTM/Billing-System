<?php 

$title = "List User";
require_once "header.php";

$data = $user->list();

?>


<h1 class="h3 mb-4 text-gray-800">User Management</h1>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
             	<h6 class="m-0 font-weight-bold text-primary">
                List User
                <a href="add_user.php" class="btn btn-success">
                    <i class="fas fa-plus"> Add</i>
                </a>
            </h6>
            </div>
            <div class="card-body">
            	<table class="table table-bordered">
            		<thead>
            			<tr>
            				<th>SN</th>
            				<th>Name</th>
            				<th>Username</th>
            				<th>Email</th>
            				<th>Password</th>
            				<th>Status</th>
            				<th>Role</th>
                            <th>Action</th>
            			</tr>
            		</thead>
            		<tbody>
            		<?php foreach ($data as $sn => $d){?>
            			<tr>
            				<td><?php echo $sn+1; ?></td>
            				<td><?php echo $d->name; ?></td>
            				<td><?php echo $d->username; ?></td>
            				<td><?php echo $d->email; ?></td>
            				<td><?php echo $d->password; ?></td>
            				<td>
                                <?php if ($d->status) { ?>
                                    <label class="text text-success">Active</label>
                                <?php } else{ ?>
                                    <label class="text text-danger">Deactive</label>
                                <?php } ?>            
                            </td>
            				<td><?php echo $d->rname; ?></td>
                            <td>
                                <a href="view_user.php?id=<?php echo $d->id; ?>" class="btn btn-info">
                                  <i class="fas fa-eye"> View</i>
                                </a>
                                <a href="edit_user.php?id=<?php echo $d->id; ?>" class="btn btn-warning">
                                  <i class="fas fa-edit"> Edit</i>
                                </a>
                                <a href="delete_user.php ?id=<?php echo $d->id; ?>" class="btn btn-danger" onclick="return confirm('Are you sure delete data ?')">
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


<?php 

require_once "footer.php";

?>