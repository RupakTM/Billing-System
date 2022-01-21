<?php 

$title = "Edit Role";
require_once "header.php";

if (isset($_POST['btnUpdate'])) {
	$err = [];
	$role->set('id',$_POST['role_id']);
	if (isset($_POST['name']) && !empty($_POST['name'])){
		$role->set('name',$_POST['name']);
	} else{
		$err['name'] = "Please enter role name";
	}
	
	$role->set('status',$_POST['status']);

	if(count($err)==0){
      $status = $role->edit();
    }
}

if (isset($_GET['id'])) {
    $role->set('id',$_GET['id']);
    $data = $role->getRoleById();
    // print_r($data);
    if (count($data) == 0) {
        header('location:list_role.php');
    }
} else{
    header('location:list_role.php');
}

?>

<h1 class="h3 mb-4 text-gray-800">Role Management</h1>
<div class="row">
    <div class="col-lg-12">
          		<div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">
                  Add Role
                  <a href="list_role.php" class="btn btn-primary">
                      <i class="fas fa-list"> List</i>
                  </a>
                </h6>
                </div>
                <div class="card-body">
                <?php if(isset($status) && $status === true){ ?>
                    <div class = "alert alert-success">Update Success</div>
                <?php } ?>
                <?php if(isset($status) && $status !== true){ ?>
                    <div class = "alert alert-danger">Update Failed <?php echo $status; ?></div>
                <?php } ?>
                  <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>?id=<?php echo $_GET['id']?>" id="updateRole">
                  	<input type="hidden" name="role_id" value="<?php echo $data[0]->id ?>">
                  	<div class="form-group">
                  		<label for="name">Name</label>
                  		<input type="text" name="name" id="name" class="form-control" value="<?php echo $data[0]->name?>">
                  		<?php if(isset($err['name'])){ ?>
                        <label id="exampleInputName-error" class="error" for="exampleInputName"><?php echo $err['name']; ?></label>
                      <?php } ?>
                  	</div> 
                  	<div class="form-group">
                  		<label for="deactive">Status</label>
                  		<?php if ($data[0]->status == 1) { ?>
                  			<input type="radio" name="status" id="active" value="1" checked="checked">Active
                  			<input type="radio" name="status" id="deactive" value="0" >Deactive
                  		<?php } else{ ?>
                  			<input type="radio" name="status" id="active" value="1">Active
                  			<input type="radio" name="status" id="deactive" value="0" checked="checked">Deactive
                  		<?php } ?>
                  	</div>
                  	<div class="form-group">
                  		<button type="submit" name="btnUpdate" class="btn btn-success">
                  			<i class="fas fa-recycle"></i>
                  			Update
                  		</button>
                  		<button type="reset" class="btn btn-danger">
                  			<i class="fas fa-backspace"></i>
                  			Clear
                  		</button>
                  	</div>
                  </form>
                </div>
              </div>
    </div>
</div>

<?php require_once "footer.php"; ?>

<script type="text/javascript" src="js/jquery_validation/dist/jquery.validate.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
      $('#updateRole').validate({
			rules: {
				name: "required"
			}
		});
	});
</script>