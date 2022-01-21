<?php 

$title = "Add User";
require_once "header.php";

$data = $user->fetchRole();


if (isset($_POST['btnSave'])) {
	$err = [];
	if(isset($_POST['name']) && !empty($_POST['name']) && trim($_POST['name']) != ''){
		$user->set('name',$_POST['name']);
	} else{
		$err['name'] = "Please enter name";
	}
	if(isset($_POST['username']) && !empty($_POST['username']) && trim($_POST['username']) != ''){
		$user->set('username',$_POST['username']);
	} else{
		$err['username'] = "Please enter username";
	}
	if(isset($_POST['email']) && !empty($_POST['email'])){
		if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
         	$user->set('email',$_POST['email']);
    } else{
		      $err['email'] = "Enter valid email";
      }
	} else{
		$err['email'] = "Please enter email";
	}
	if(isset($_POST['password']) && !empty($_POST['password'])){
		$password = $_POST['password'];
	} else{
		$err['password'] = "Please enter password";
	}
	if ($_POST['password'] != $_POST['cpassword']) {
		$err['cpassword'] = "Password should be match";
	}
  else{
    $user->set('password',md5($_POST['cpassword']));
  }
	if(isset($_POST['role'])){
		$user->set('role',$_POST['role']);
	} else{
		$err['role'] = "Please select role";
	}
  // print_r($_FILES);
  //image upload
   if (isset($_FILES['image']['error']) && $_FILES['image']['error'] == 0) {
      $types = ['image/png','image/jpeg','image/gif'];
      if (isset($_FILES['image']['type']) && in_array($_FILES['image']['type'], $types)) {
        if (isset($_FILES['image']['size']) && $_FILES['image']['size'] < 10000000) {
          $name = uniqid() . '_' .  $_FILES['image']['name'];
          $user->set('image',$name);
          if (move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $name)) {
          } else {
            $err['image'] = 'File upload failed';
          }
        } else {
          $err['image'] = 'File size too large';
        }
      } else {
        $err['image'] = 'Invalid file type';
      }
    } else {
      $err['image'] = 'Please select file';
    }
  //end of image upload

  $user->set('status',$_POST['status']);
  print_r($err);
	if(count($err)==0){
      $status = $user->create();
  }
}
?>


<h1 class="h3 mb-4 text-gray-800">User Management</h1>
          <div class="row">
          	<div class="col-lg-12">
          		<div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">
                  Add User
                  <a href="list_user.php" class="btn btn-primary">
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
                  <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" id="insertUser" enctype = "multipart/form-data">
                  	<div class="form-group">
                  		<label for="name">Name</label>
                  		<input type="text" name="name" id="name" class="form-control" placeholder="Enter name...">
                      <?php if(isset($err['name'])){ ?>
                        <label id="exampleInputName-error" class="error" for="exampleInputName"><?php echo $err['name']; ?></label>
                      <?php } ?>
                  	</div> 
                  	<div class="form-group">
                  		<label for="username">Username</label>
                  		<input type="text" name="username" id="username" class="form-control" placeholder="Enter username...">
                      <?php if(isset($err['username'])){ ?>
                        <label id="exampleInputUsername-error" class="error" for="exampleInputUsername"><?php echo $err['username']; ?></label>
                      <?php } ?>
                  	</div> 
                  	<div class="form-group">
                  		<label for="email">Email</label>
                  		<input type="text" name="email" id="email" class="form-control" placeholder="Enter email...">
                      <?php if(isset($err['email'])){ ?>
                        <label id="exampleInputEmail-error" class="error" for="exampleInputEmail"><?php echo $err['email']; ?></label>
                      <?php } ?>
                  	</div> 
                  	<div class="form-group">
                  		<label for="password">Password</label>
                  		<input type="password" name="password" id="password" class="form-control" placeholder="Enter password...">
                      <?php if(isset($err['password'])){ ?>
                        <label id="exampleInputPassword-error" class="error" for="exampleInputPassword"><?php echo $err['password']; ?></label>
                      <?php } ?>
                  	</div> 
                  	<div class="form-group">
                  		<label for="cpassword">Confirm Password</label>
                  		<input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Enter password...">
                      <?php if(isset($err['cpassword'])){ ?>
                        <label id="exampleInputCPassword-error" class="error" for="exampleInputCPassword"><?php echo $err['cpassword']; ?></label>
                      <?php } ?>
                  	</div>
                    <div class="form-group">
                      <label for="image">Image</label>
                      <input type="file" name="image" id="image" class="form-control">
                    </div>  
                  	<div class="form-group">
                  		<label for="deactive">Status</label>
                  		<input type="radio" name="status" id="active" value="1">Active
                  		<input type="radio" name="status" id="deactive" value="0" checked="checked">Deactive
                  	</div>
                  	<div class="form-group">
                  		<label for="role">Role</label>
                      <!-- data fetch from db -->
                      <select class="form-control" id="role" name="role">
                          <option value="">Select role</option>
                          <?php foreach ($data as $d) { ?>
                          <option value="<?php echo $d->id ?>">
                          <?php echo $d->name ?>
                          </option>
                          <?php } ?>
                      </select>

                  		<?php if(isset($err['name'])){ ?>
                        	<label id="exampleInputRole-error" class="error" for="exampleInputRole"><?php echo $err['role']; ?></label>
                      	<?php } ?>
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


<?php 

require_once "footer.php";

?>

<script type="text/javascript" src="js/jquery_validation/dist/jquery.validate.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$.validator.setDefaults({
			errorPlacement: function(error,element){
				if(element.prop('type')=='radio'){
					error.insertAfter(element.parent());
				}
				else{
					error.insertAfter(element);
				}

			}
		});
		$('#insertUser').validate({
			rules: {
				name: "required",
				username: "required",
				email:{
					required:true,
					email:true
				},
				password: "required",
				cpassword: {
					equalTo: "#password"
				},
        image: "required",
				role: "required"
			},
			messages: {
				cpassword: {
        			equalTo: 'Passoword did not match'
        		},
				role: "Please select role"
			}
		});

	});
</script>