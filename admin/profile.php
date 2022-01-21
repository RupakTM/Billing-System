<?php 
$title = "View User";
require_once "header.php";
if (isset($_GET['id'])) {
  $user->set('id',$_GET['id']);
  $data = $user->getUserById();
  if (count($data) == 0) {
        header('location:list_user.php');
    }
} else{
  header('location: list_user.php');
}

?>

<div class="row">
  <div class="col-lg-12">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
        User Profile
      </h6>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <tr>
            <th>Name</th>
            <td><?php echo $data[0]->name ?></td>
          </tr>
          <tr>
            <th>Email</th>
            <td><?php echo $data[0]->email ?></td>
          </tr>
          <tr>
            <th>Username</th>
            <td><?php echo $data[0]->username ?></td>
          </tr>  
          <tr>
            <th>Password</th>
            <td><?php echo $data[0]->password ?></td>
          </tr>
          <tr>
          <tr>
            <th>Image</th>
            <td>
              <img src="images/<?php echo $data[0]->image ?>" width="150" height="150">
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
            <th>Role</th>
            <td><?php echo $data[0]->rname ?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>

<?php 
require_once "footer.php";
?>