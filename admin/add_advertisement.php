<?php 
$title = "Add Advertisement";
require_once "header.php";
if(isset($_POST['btnSave'])){
    $err = [];

    if(isset($_POST['title']) && !empty($_POST['title'])){
      $ads->set('title',$_POST['title']);
    }
    else{
      $err['title'] ="Please enter title";
    }

    if(isset($_POST['link']) && !empty($_POST['link']) && filter_var($_POST['link'],FILTER_VALIDATE_URL)){
      $ads->set('link',$_POST['link']);
    }
    else{
      $err['link'] ="Please enter link";
    }



    //feature image upload

    if (isset($_FILES['image']['error']) && $_FILES['image']['error'] == 0) {
      $types = ['image/png','image/jpeg','image/gif'];
      if (isset($_FILES['image']['type']) && in_array($_FILES['image']['type'], $types)) {
        if (isset($_FILES['image']['size']) && $_FILES['image']['size'] < 10000000) {
          $name = uniqid() . '_' .  $_FILES['image']['name'];
          $ads->set('image',$name);
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

    //end of feature image upload
    $ads->set('expire_date',$_POST['expire_date']);
    $ads->set('status',$_POST['status']);
    $ads->set('created_by',$_SESSION['id']);
    $ads->set('created_at',date('Y-m-d H:i:s'));
    if(count($err)==0){
      $status = $ads->create();
    }
  }

  $categoryList = $category->getCategoryNameAndId();
?>
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Advertisement Management</h1>
          <div class="row">
          	<div class="col-lg-12">
          		<div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">
                    Add Advertisement
                    <a href="list_advertisement.php" class="btn btn-primary">
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
                  <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" id="insertForm" enctype="multipart/form-data">
                  	<div class="form-group">
                  		<label for="title">Title</label>
                  		<input type="text" name="title" id="title" class="form-control" placeholder="Enter title...">
                      <?php if(isset($err['title'])){ ?>
                        <label id="exampleInputTitle-error" class="error" for="exampleInputTitle"><?php echo $err['title']; ?></label>
                      <?php } ?>
                  	</div> 
                    <div class="form-group">
                      <label for="image">Image</label>
                      <input type="file" name="image" id="image" class="form-control">
                    </div> 
                    <div class="form-group">
                      <label for="expire_date">Expire Date</label>
                      <input type="date" name="expire_date" id="expire_date" class="form-control">
                      <?php if(isset($err['expire_date'])){ ?>
                        <label id="exampleInputExpire_date-error" class="error" for="exampleInputExpire_date"><?php echo $err['expire_date']; ?></label>
                      <?php } ?>
                    </div> 
                    <div class="form-group">
                      <label for="link">Link</label>
                      <input type="url" name="link" id="link" class="form-control" placeholder="https://example.com">
                      <?php if(isset($err['link'])){ ?>
                      <label id="exampleInputLink-error" class="error" for="exampleInputLink"><?php echo $err['link']; ?></label>
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
<script type="text/javascript" src="vendor/ckeditor/ckeditor.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      $('#insertForm').validate({
        rules: {
        	title: "required",
          image: "required",
          expire_date: "required",
          link: "required"
        }
      });
    } );
  </script>