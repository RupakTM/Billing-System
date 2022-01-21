<?php 
$title = "Add Video";
require_once "header.php";
if(isset($_POST['btnUpload'])){
    $err = [];

    if(isset($_POST['title']) && !empty($_POST['title'])){
      $video->set('title',$_POST['title']);
    }
    else{
      $err['title'] ="Please enter title";
    }

    if(isset($_POST['video_link']) && !empty($_POST['video_link']) && filter_var($_POST['video_link'],FILTER_VALIDATE_URL)){
      $video->set('video_link',$_POST['video_link']);
    }
    else{
      $err['video_link'] ="Please enter video link";
    }

    if(isset($_POST['description']) && !empty($_POST['description'])){
      $video->set('description',$_POST['description']);
    }
    else{
      $err['description'] ="Please enter description";
    }

     if (isset($_FILES['thumbnail']['error']) && $_FILES['thumbnail']['error'] == 0) {
      $types = ['image/png','image/jpeg','image/gif'];
      if (isset($_FILES['thumbnail']['type']) && in_array($_FILES['thumbnail']['type'], $types)) {
        if (isset($_FILES['thumbnail']['size']) && $_FILES['thumbnail']['size'] < 10000000) {
          $name = uniqid() . '_' .  $_FILES['thumbnail']['name'];
          $video->set('thumbnail',$name);
          if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], 'images/' . $name)) {
          } else {
            $err['thumbnail'] = 'File upload failed';
          }
        } else {
          $err['thumbnail'] = 'File size too large';
        }
      } else {
        $err['thumbnail'] = 'Invalid file type';
      }
    } else {
      $err['thumbnail'] = 'Please select file';
    }


    $video->set('status',$_POST['status']);
    $video->set('created_by',$_SESSION['id']);
    $video->set('created_at',date('Y-m-d H:i:s'));
    if(count($err)==0){
      $status = $video->create();
    }
}
?>
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Video Management</h1>
          <div class="row">
          	<div class="col-lg-12">
          		<div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">
                    Add Video
                    <a href="list_video.php" class="btn btn-primary">
                        <i class="fas fa-list"> List</i>
                    </a>
                  </h6>
                </div>
                <div class="card-body">
                  <?php if(isset($status) && $status === true){ ?>
                      <div class = "alert alert-success">Video Upload Successfully.</div>
                  <?php } ?>
                  <?php if(isset($status) && $status !== true){ ?>
                      <div class = "alert alert-danger">Video Upload Failed.<?php echo $status; ?></div>
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
                      <label for="video_link">Video Link</label>
                      <input type="url" name="video_link" id="video_link" class="form-control" placeholder="https://example.com">
                      <?php if(isset($err['video_link'])){ ?>
                      <label id="exampleInputVideo_link-error" class="error" for="exampleInputVideo_link"><?php echo $err['video_link']; ?></label>
                    <?php } ?>
                    </div> 
                    <div class="form-group">
                      <label for="description">Description</label> 
                      <textarea id="description" name="description" class="form-control"  placeholder="Enter description...">      
                      </textarea>
                      <?php if(isset($err['description'])){ ?>
                        <label id="exampleInputDescription-error" class="error" for="exampleInputDescription"><?php echo $err['description']; ?></label>
                      <?php } ?>
                    </div> 
                    <div class="form-group">
                      <label for="thumbnail">Thumnbnail</label>
                      <input type="file" name="thumbnail" id="thumbnail" class="form-control">
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
          video_link: "required",
          description: "required",
          thumbnail: "required"
        }
      });
    } );
  </script>