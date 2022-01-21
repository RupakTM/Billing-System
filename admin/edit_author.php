<?php 

$title = "Edit Author";
require_once "header.php";

if(isset($_POST['btnUpdate'])){
    $err = [];
    $author->set('id',$_POST['author_id']);
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
    } 

    $author->set('status',$_POST['status']);
    $author->set('updated_by',$_SESSION['id']);
    $author->set('updated_at',date('Y-m-d H:i:s'));
    if(count($err)==0){
      $status = $author->edit();
    }
}

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
                    Edit Author
                    
                    <a href="list_author.php" class="btn btn-primary">
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
                  <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>?id=<?php echo $_GET['id']?>" id="updateForm" enctype="multipart/form-data">
                  	<input type="hidden" name="author_id" value="<?php echo $data[0]->id ?>">

                  	<div class="form-group">
                  		<label for="name">Name</label>
                  		<input type="text" name="name" id="name" class="form-control" value="<?php echo $data[0]->name ?>">
                      <?php if(isset($err['name'])){ ?>
                        <label id="exampleInputname-error" class="error" for="exampleInputname"><?php echo $err['name']; ?></label>
                      <?php } ?>
                  	</div> 

                     <div class="form-group">
                      <label for="photo">Photo</label>
                      <input type="file" name="photo" id="photo" class="form-control">
                      <img src="images/<?php echo $data[0]->photo ?>" width="64" height="64">
                    </div> 
                    
                    <div class="form-group">
                      <label for="phone">Contact</label>
                      <input type="text" name="phone" id="phone" class="form-control" value="<?php echo $data[0]->phone ?>">
                      <?php if(isset($err['phone'])){ ?>
                        <label id="exampleInputphone-error" class="error" for="exampleInputphone"><?php echo $err['phone']; ?></label>
                      <?php } ?>
                    </div> 

                    <div class="form-group">
                      <label for="address">Address</label>
                      <input type="text" name="address" id="address" class="form-control" value="<?php echo $data[0]->address ?>">
                      <?php if(isset($err['address'])){ ?>
                        <label id="exampleInputaddress-error" class="error" for="exampleInputaddress"><?php echo $err['address']; ?></label>
                      <?php } ?>
                    </div> 

                    <div class="form-group">
                      <label for="bio">Bio</label>
                       <textarea id="bio" name="bio" class="form-control"><?php echo $data[0]->bio?></textarea>
                      <?php if(isset($err['bio'])){ ?>
                        <label id="exampleInputbio-error" class="error" for="exampleInputbio"><?php echo $err['bio']; ?></label>
                      <?php } ?>
                    </div>

                    <div class="form-group">
                      <label for="facebook">Facebook</label>
                      <input type="url" name="facebook" id="facebook" class="form-control" value="<?php echo $data[0]->facebook ?>">
                      <?php if(isset($err['facebook'])){ ?>
                      <label id="exampleInputfacebook-error" class="error" for="exampleInputfacebook"><?php echo $err['facebook']; ?></label>
                    <?php } ?>
                    </div>  

                    <div class="form-group">
                      <label for="twitter">Twitter</label>
                      <input type="url" name="twitter" id="twitter" class="form-control" value="<?php echo $data[0]->twitter ?>">
                      <?php if(isset($err['twitter'])){ ?>
                      <label id="exampleInputtwitter-error" class="error" for="exampleInputtwitter"><?php echo $err['twitter']; ?></label>
                    <?php } ?>
                    </div> 

                    <div class="form-group">
                      <label for="instagram">Instagram</label>
                      <input type="url" name="instagram" id="instagram" class="form-control" value="<?php echo $data[0]->instagram ?>">
                      <?php if(isset($err['instagram'])){ ?>
                      <label id="exampleInputinstagram-error" class="error" for="exampleInputinstagram"><?php echo $err['instagram']; ?></label>
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
<script type="text/javascript" src="vendor/ckeditor/ckeditor.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      $('#updateForm').validate({
        rules: {
          name: "required",
          address: "required",
          bio: "required",
          phone: "required"
        }
      });
    } );
  </script>
