<?php 

$title = "Edit Video";
require_once "header.php";

if(isset($_POST['btnUpdate'])){
    $err = [];
    $video->set('id',$_POST['video_id']);
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
    } 

    $video->set('status',$_POST['status']);
    $video->set('updated_by',$_SESSION['id']);
    $video->set('updated_at',date('Y-m-d H:i:s'));
    if(count($err)==0){
      $status = $video->edit();
    }
}

if (isset($_GET['id'])) {
    $video->set('id',$_GET['id']);
    $data = $video->getVideoById();
    if (count($data) == 0) {
        header('location:list_video.php');
    }
} else{
    header('location:list_video.php');
}

?>

 <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Video Management</h1>
          <div class="row">
          	<div class="col-lg-12">
          		<div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">
                    Edit Video
                    
                    <a href="list_video.php" class="btn btn-primary">
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
                  	<input type="hidden" name="video_id" value="<?php echo $data[0]->id ?>">

                  	<div class="form-group">
                  		<label for="title">Title</label>
                  		<input type="text" name="title" id="title" class="form-control" value="<?php echo $data[0]->title ?>">
                      <?php if(isset($err['title'])){ ?>
                        <label id="exampleInputTitle-error" class="error" for="exampleInputTitle"><?php echo $err['title']; ?></label>
                      <?php } ?>
                  	</div> 
              
                    <div class="form-group">
                      <label for="video_link">Video Link</label>
                      <input type="url" name="video_link" id="video_link" class="form-control" value="<?php echo $data[0]->video_link ?>">
                      <?php if(isset($err['video_link'])){ ?>
                      <label id="exampleInputVideo_Link-error" class="error" for="exampleInputVideo_Link"><?php echo $err['video_link']; ?></label>
                    <?php } ?>
                    </div> 

                    <div class="form-group">
                      <label for="description">Description</label>
                      <input type="text" name="description" id="description" class="form-control" value="<?php echo $data[0]->description ?>">
                      <?php if(isset($err['description'])){ ?>
                        <label id="exampleInputdescription-error" class="error" for="exampleInputdescription"><?php echo $err['description']; ?></label>
                      <?php } ?>
                    </div> 

                    <div class="form-group">
                      <label for="thumbnail">Thumnbnail</label>
                      <input type="file" name="thumbnail" id="thumbnail" class="form-control">
                      <img src="images/<?php echo $data[0]->thumbnail ?>" width="64" height="64">
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
          title: "required",
          video_link: "required",
          description: "required"
        }
      });
    } );
  </script>