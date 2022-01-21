<?php 
$title = "View Role";
require_once "header.php";
if (isset($_GET['id'])) {
  $role->set('id',$_GET['id']);
  $data = $role->getRoleById();
  // print_r($data);
  if (count($data) == 0) {
        header('location:list_role.php');
    }
} else{
  header('location: list_role.php');
}

?>

<h1 class="h3 mb-4 text-gray-800">Role Management</h1>
<div class="row">
  <div class="col-lg-12">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
        View Role
        <a href="add_role.php" class="btn btn-success">
          <i class="fas fa-plus"> Add</i>
        </a>
        <a href="list_role.php" class="btn btn-primary">
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
            <th>Status</th>
            <td>
              <?php if ($data[0]->status) { ?>
                <label class="text text-success">Active</label>
              <?php } else{?>
                <label class="text text-danger">Deactive</label>
              <?php } ?>    
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>

<?php 
require_once "footer.php";
?>