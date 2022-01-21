<?php 
$title = "Add Page";
require_once "header.php";
if(isset($_POST['btnSave'])){
    $err = [];
    if(isset($_POST['title']) && !empty($_POST['title'])){
      $page->set('title',$_POST['title']);
    }
    else{
      $err['title'] ="Please enter title";
    }

    if(isset($_POST['slug']) && !empty($_POST['slug'])){
      $page->set('slug',$_POST['slug']);
    }
    else{
      $err['slug'] ="Please enter slug";
    }
    if(isset($_POST['short_description']) && !empty($_POST['short_description'])){
      $page->set('short_description',$_POST['short_description']);
    }
    else{
      $err['short_description'] ="Please enter short description";
    }
    if(isset($_POST['description']) && !empty($_POST['description'])){
      $page->set('description',$_POST['description']);
    }
    else{
      $err['description'] ="Please enter description";
    }

    //feature image upload

    if (isset($_FILES['image']['error']) && $_FILES['image']['error'] == 0) {
      $types = ['image/png','image/jpeg','image/gif'];
      if (isset($_FILES['image']['type']) && in_array($_FILES['image']['type'], $types)) {
        if (isset($_FILES['image']['size']) && $_FILES['image']['size'] < 10000000) {
          $name = uniqid() . '_' .  $_FILES['image']['name'];
          $page->set('image',$name);
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
    $page->set('status',$_POST['status']);
    $page->set('created_by',$_SESSION['id']);
    $page->set('created_at',date('Y-m-d H:i:s'));

    if(count($err)==0){
      $status = $page->create();
    }
  }
?>
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Page Management</h1>
          <div class="row">
            <div class="col-lg-12">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">
                    Add Page
                    <a href="list_pages.php" class="btn btn-primary">
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
                      <label for="slug">Slug</label>
                      <input type="text" name="slug" id="slug" class="form-control" placeholder="Enter slug...">
                      <?php if(isset($err['slug'])){ ?>
                        <label id="exampleInputSlug-error" class="error" for="exampleInputSlug"><?php echo $err['slug']; ?></label>
                      <?php } ?>
                    </div> 
                    <div class="form-group">
                      <label for="short_description">Short Description</label> 
                      <textarea id="short_description" name="short_description" class="form-control"  placeholder="Enter short description...">      
                      </textarea>
                      <?php if(isset($err['short_description'])){ ?>
                        <label id="exampleInputShort_description-error" class="error" for="exampleInputShort_description"><?php echo $err['short_description']; ?></label>
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
                      <label for="image">Image</label>
                      <input type="file" name="image" id="image" class="form-control">
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
          slug: "required",
          image: "required",
          short_description: "required",
          description: "required"
        }
      });

      $("#title").keyup(function(){
        var Text = $(this).val();
        Text = Text.toLowerCase();
        Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
        $("#slug").val(Text);        
      });
    });

   CKEDITOR.replace('description',{
      filebrowserBrowseUrl: '/browser/browse.php',
      filebrowserUploadUrl: '/uploader/upload.php'
    });
  </script>