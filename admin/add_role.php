<?php 

$title = "Add Role";
require_once "header.php";

if (isset($_POST['btnSave'])) {
	$err = [];
	if (isset($_POST['name']) && !empty($_POST['name'])){
		$role->set('name',$_POST['name']);
	} else{
		$err['name'] = "Please enter role name";
	}
	
	$role->set('status',$_POST['status']);

	if(count($err)==0){
      $status = $role->create();
    }
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
          <div class = "alert alert-success">Insert Success</div>
      <?php } ?>
      <?php if(isset($status) && $status !== true){ ?>
          <div class = "alert alert-danger">Insert Failed <?php echo $status; ?></div>
      <?php } ?>
        <form method="post" action="" id="insertRole">
        	<div class="form-group">
        		<label for="name">Name</label>
        		<input type="text" name="name" id="name" class="form-control" placeholder="Enter name...">
        		<?php if(isset($err['name'])){ ?>
              <label id="exampleInputName-error" class="error" for="exampleInputName"><?php echo $err['name']; ?></label>
            <?php } ?>
        	</div> 
        	<div class="form-group">
        		<label for="deactive">Status</label>
        		<input type="radio" name="status" id="active" value="1">Active
        		<input type="radio" name="status" id="deactive" value="0" checked="checked">Deactive
        	</div>
        	<div class="form-group">
        		<button type="submit" name="btnSave" class="btn btn-success">
        			<i class="fas fa-save"></i>
        			Save
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
      $('#insertRole').validate({
			rules: {
				name: "required"
			}
		});
	});
</script>