<?php 
$title = "Add Author";
require_once "header.php";
if(isset($_POST['btnUpload'])){
    $err = [];

    if(isset($_POST['name']) && !empty($_POST['name'])){
      $author->set('name',$_POST['name']);
    }
    else{
      $err['name'] ="Please enter name";
    }

    if(isset($_POST['bio']) && !empty($_POST['bio'])){
      $author->set('bio',$_POST['bio']);
    }
    else{
      $err['bio'] ="Please enter bio";
    }

     if(isset($_POST['address']) && !empty($_POST['address'])){
      $author->set('address',$_POST['address']);
    }
    else{
      $err['address'] ="Please enter address";
    }

    if(isset($_POST['phone']) && !empty($_POST['phone']) && is_numeric($_POST['phone'])){
      $author->set('phone',$_POST['phone']);
    }
    else{
      $err['phone'] ="Please enter contact number";
    }

    if(isset($_POST['facebook']) && !empty($_POST['facebook']) && filter_var($_POST['facebook'],FILTER_VALIDATE_URL)){
      $author->set('facebook',$_POST['facebook']);
    }
    else{
      $err['facebook'] ="Please enter facebook link";
    }

    if(isset($_POST['twitter']) && !empty($_POST['twitter']) && filter_var($_POST['twitter'],FILTER_VALIDATE_URL)){
      $author->set('twitter',$_POST['twitter']);
    }
    else{
      $err['twitter'] ="Please enter twitter link";
    }

    if(isset($_POST['instagram']) && !empty($_POST['instagram']) && filter_var($_POST['instagram'],FILTER_VALIDATE_URL)){
      $author->set('instagram',$_POST['instagram']);
    }
    else{
      $err['instagram'] ="Please enter instagram link";
    }

    

     if (isset($_FILES['photo']['error']) && $_FILES['photo']['error'] == 0) {
      $types = ['image/png','image/jpeg','image/gif'];
      if (isset($_FILES['photo']['type']) && in_array($_FILES['photo']['type'], $types)) {
        if (isset($_FILES['photo']['size']) && $_FILES['photo']['size'] < 10000000) {
          $name = uniqid() . '_' .  $_FILES['photo']['name'];
          $author->set('photo',$name);
          if (move_uploaded_file($_FILES['photo']['tmp_name'], 'images/' . $name)) {
          } else {
            $err['photo'] = 'File upload failed';
          }
        } else {
          $err['photo'] = 'File size too large';
        }
      } else {
        $err['photo'] = 'Invalid file type';
      }
    } else {
      $err['photo'] = 'Please select file';
    }


    $author->set('status',$_POST['status']);
    $author->set('created_by',$_SESSION['id']);
    $author->set('created_at',date('Y-m-d H:i:s'));
    if(count($err)==0){
      $status = $author->create();
    }
}
?>
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Author Management</h1>
          <div class="row">
          	<div class="col-lg-12">
          		<div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">
                    Add Author
                    <a href="list_author.php" class="btn btn-primary">
                        <i class="fas fa-list"> List</i>
                    </a>
                  </h6>
                </div> <!-- card-header ends -->
                <div class="card-body">
                  <?php if(isset($status) && $status === true){ ?>
                      <div class = "alert alert-success">Insert Successfully.</div>
                  <?php } ?>
                  <?php if(isset($status) && $status !== true){ ?>
                      <div class = "alert alert-danger">Insert Failed.<?php echo $status; ?></div>
                  <?php } ?>
                  <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" id="insertForm" enctype="multipart/form-data">
                  	<div class="form-group">
                  		<label for="name">Name</label>
                  		<input type="text" name="name" id="name" class="form-control" placeholder="Enter name...">
                      <?php if(isset($err['name'])){ ?>
                        <label id="exampleInputName-error" class="error" for="exampleInputName"><?php echo $err['name']; ?></label>
                      <?php } ?>
                  	</div> 
                    <div class="form-group">
                      <label for="photo">Photo</label>
                      <input type="file" name="photo" id="photo" class="form-control">
                    </div> 
                    <label for="phone">Contact Number</label>
                      <input type="number" name="phone" id="phone" class="form-control" placeholder="Enter contact number...">
                      <?php if(isset($err['phone'])){ ?>
                        <label id="exampleInputphone-error" class="error" for="exampleInputphone"><?php echo $err['phone']; ?></label>
                      <?php } ?>
                    </div> 
                    <div class="form-group">
                    <label for="address">Address</label>
                      <input type="text" name="address" id="address" class="form-control" placeholder="Enter address...">
                      <?php if(isset($err['address'])){ ?>
                        <label id="exampleInputaddress-error" class="error" for="exampleInputaddress"><?php echo $err['address']; ?></label>
                      <?php } ?>
                    </div> 
                    <div class="form-group">
                      <label for="bio">Bio</label> 
                      <textarea id="bio" name="bio" class="form-control"  placeholder="Enter bio...">      
                      </textarea>
                      <?php if(isset($err['bio'])){ ?>
                        <label id="exampleInputbio-error" class="error" for="exampleInputbio"><?php echo $err['bio']; ?></label>
                      <?php } ?>
                    </div> 
                    <div class="form-group">
                      <label for="facebook">Facebook</label>
                      <input type="url" name="facebook" id="facebook" class="form-control" placeholder="https://example.com">
                      <?php if(isset($err['facebook'])){ ?>
                      <label id="exampleInputfacebook-error" class="error" for="exampleInputfacebook"><?php echo $err['facebook']; ?></label>
                    <?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="twitter">Twitter</label>
                      <input type="url" name="twitter" id="twitter" class="form-control" placeholder="https://example.com">
                      <?php if(isset($err['twitter'])){ ?>
                      <label id="exampleInputtwitter-error" class="error" for="exampleInputtwitter"><?php echo $err['twitter']; ?></label>
                    <?php } ?>
                    </div> 
                    <div class="form-group">
                      <label for="instagram">Instagram</label>
                      <input type="url" name="instagram" id="instagram" class="form-control" placeholder="https://example.com">
                      <?php if(isset($err['instagram'])){ ?>
                      <label id="exampleInputinstagram-error" class="error" for="exampleInputinstagram"><?php echo $err['instagram']; ?></label>
                    <?php } ?>
                    </div> 
                    <div class="form-group">
                      <label for="deactive">Status</label>
                      <input type="radio" name="status" id="active" value="1">Active
                      <input type="radio" name="status" id="deactive" value="0" checked="checked">Deactive
                    </div>
                  	<div class="form-group">
                  		<button type="submit" name="btnUpload" class="btn btn-success">
                  			<i class="fas fa-save"></i>
                  			Upload
                  		</button>
                  		<button type="reset" class="btn btn-danger">
                  			<i class="fas fa-backspace"></i>
                  			Clear
                  		</button>
                  	</div>
                  </form>
                </div>  <!-- card-body ends -->
              </div> <!-- card shadow ends -->
            </div>
          	</div>
<?php require_once "footer.php"; ?>

<script type="text/javascript" src="js/jquery_validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="vendor/ckeditor/ckeditor.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      $('#insertForm').validate({
        rules: {
        	name: "required",
          address: "required",
          bio: "required",
          photo: "required",
          phone: "required"
        }
      });
    } );
  </script>

 