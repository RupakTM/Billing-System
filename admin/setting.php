<?php 
$title = "Setting";
require_once "header.php";
checkAdminUser('setting edit page');
if(isset($_POST['btnUpdate'])){
    $err = [];
    $setting->set('id',$_POST['setting_id']);                
    if(isset($_POST['name']) && !empty($_POST['name'])){
      $setting->set('name',$_POST['name']);
    }
    else{
      $err['name'] ="Please enter name";
    }

    if(isset($_POST['address']) && !empty($_POST['address'])){
      $setting->set('address',$_POST['address']);
    }
    else{
      $err['address'] ="Please enter address";
    }

    if(isset($_POST['reg_no']) && !empty($_POST['reg_no'])){
      $setting->set('reg_no',$_POST['reg_no']);
    }
    else{
      $err['reg_no'] ="Please enter reg_no";
    }
    if(isset($_POST['pan']) && !empty($_POST['pan'])){
      $setting->set('pan',$_POST['pan']);
    }
    else{
      $err['pan'] ="Please enter pan number";
    }

    if(isset($_POST['listing_limit']) && !empty($_POST['listing_limit']) && is_numeric($_POST['listing_limit'])){
      $setting->set('listing_limit',$_POST['listing_limit']);
    }
    else{
      $err['listing_limit'] ="Please enter listing_limit";
    }

    if(isset($_POST['facebook']) && !empty($_POST['facebook']) && filter_var($_POST['facebook'],FILTER_VALIDATE_URL)){
      $setting->set('facebook',$_POST['facebook']);
    }
    else{
      $err['facebook'] ="Please enter facebook link";
    }

    if(isset($_POST['youtube']) && !empty($_POST['youtube']) && filter_var($_POST['youtube'],FILTER_VALIDATE_URL)){
      $setting->set('youtube',$_POST['youtube']);
    }
    else{
      $err['youtube'] ="Please enter youtube link";
    }
    if(isset($_POST['twitter']) && !empty($_POST['twitter']) && filter_var($_POST['twitter'],FILTER_VALIDATE_URL)){
      $setting->set('twitter',$_POST['twitter']);
    }
    else{
      $err['twitter'] ="Please enter twitter link";
    }

    if(isset($_POST['gmail']) && !empty($_POST['gmail']) && filter_var($_POST['gmail'],FILTER_VALIDATE_URL)){
      $setting->set('gmail',$_POST['gmail']);
    }
    else{
      $err['gmail'] ="Please enter gmail link";
    }

    if(isset($_POST['skype']) && !empty($_POST['skype']) && filter_var($_POST['skype'],FILTER_VALIDATE_URL)){
      $setting->set('skype',$_POST['skype']);
    }
    else{
      $err['skype'] ="Please enter skype link";
    }

    // Logo Validation
    if (isset($_FILES['logo']['error']) && $_FILES['logo']['error'] == 0) {
      $types = ['image/png','image/jpeg','image/gif'];
      if (isset($_FILES['logo']['type']) && in_array($_FILES['logo']['type'], $types)) {
        if (isset($_FILES['logo']['size']) && $_FILES['logo']['size'] < 10000000) {
          $name = uniqid() . '_' .  $_FILES['logo']['name'];
          $setting->set('logo',$name);
          if (move_uploaded_file($_FILES['logo']['tmp_name'], 'images/' . $name)) {
          } else {
            $err['logo'] = 'File upload failed';
          }
        } else {
          $err['logo'] = 'File size too large';
        }
      } else {
        $err['logo'] = 'Invalid file type';
      }
    } 
    //Logo validation ends

    //Fav Icon validation
   if (isset($_FILES['fav_icon']['error']) && $_FILES['fav_icon']['error'] == 0) {
      $types = ['image/png','image/jpeg','image/gif'];
      if (isset($_FILES['fav_icon']['type']) && in_array($_FILES['fav_icon']['type'], $types)) {
        if (isset($_FILES['fav_icon']['size']) && $_FILES['fav_icon']['size'] < 10000000) {
          $name = uniqid() . '_' .  $_FILES['fav_icon']['name'];
          $setting->set('fav_icon',$name);
          if (move_uploaded_file($_FILES['fav_icon']['tmp_name'], 'images/' . $name)) {
          } else {
            $err['fav_icon'] = 'File upload failed';
          }
        } else {
          $err['fav_icon'] = 'File size too large';
        }
      } else {
        $err['fav_icon'] = 'Invalid file type';
      }
    } 

    //Fav Icon validation ends
    $setting->set('phone',$_POST['phone']);
    $setting->set('updated_by',$_SESSION['id']);
    $setting->set('updated_at',date('Y-m-d H:i:s'));

    print_r($err);
    if(count($err)==0){
      $status = $setting->edit();
    }
  }

  $data = $setting->list();

?>

<!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Setting Management</h1>
          <div class="row">
          	<div class="col-lg-12">
          		<div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">
                    Edit Setting
                  </h6>
                </div>
                <div class="card-body">
                  <?php if(isset($status) && $status === true){ ?>
                      <div class = "alert alert-success">Update Success</div>
                  <?php } ?>
                  <?php if(isset($status) && $status !== true){ ?>
                      <div class = "alert alert-danger">Update Failed <?php echo $status; ?></div>
                  <?php } ?>
                  <form method="post" action="" id="updateForm" enctype="multipart/form-data">
                  	<input type="hidden" name="setting_id" value="<?php echo $data[0]->id ?>">
                  	<div class="form-group">
                  		<label for="name">Name</label>
                  		<input type="text" name="name" id="name" class="form-control" value="<?php echo $data[0]->name?>">
                      <?php if(isset($err['name'])){ ?>
                        <label id="exampleInputName-error" class="error" for="exampleInputName"><?php echo $err['name']; ?></label>
                      <?php } ?>
                  	</div> 
                  	<div class="form-group">
                  		<label for="address">Address</label>
                  		<input type="text" name="address" id="address" class="form-control" value="<?php echo $data[0]->address?>">
                      <?php if(isset($err['address'])){ ?>
                        <label id="exampleInputAddress-error" class="error" for="exampleInputAddress"><?php echo $err['address']; ?></label>
                      <?php } ?>
                  	</div> 
                  	<div class="form-group">
                  		<label for="pan">Pan VAT</label>
                  		<input type="number" name="pan" id="pan" class="form-control" value="<?php echo $data[0]->pan?>">
                      <?php if(isset($err['pan'])){ ?>
                        <label id="exampleInputPan-error" class="error" for="exampleInputPan"><?php echo $err['pan']; ?></label>
                      <?php } ?>
                  	</div>
                    <div class="form-group">
                      <label for="regno">Reg No.</label>
                      <input type="number" name="reg_no" id="reg_no" class="form-control" value="<?php echo $data[0]->reg_no?>">
                      <?php if(isset($err['reg_no'])){ ?>
                        <label id="exampleInputRegno-error" class="error" for="exampleInputRegno"><?php echo $err['reg_no']; ?></label>
                      <?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="listing_limit">Listing Limit</label>
                      <input type="number" name="listing_limit" id="listing_limit" class="form-control" value="<?php echo $data[0]->listing_limit?>">
                      <?php if(isset($err['listing_limit'])){ ?>
                        <label id="exampleInputListing_limit-error" class="error" for="exampleInputListing_limit"><?php echo $err['listing_limit']; ?></label>
                      <?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="facebook">Facebook</label>
                      <input type="text" name="facebook" id="facebook" class="form-control" value="<?php echo $data[0]->facebook?>">
                      <?php if(isset($err['facebook'])){ ?>
                        <label id="exampleInputFacebook-error" class="error" for="exampleInputFacebook"><?php echo $err['facebook']; ?></label>
                      <?php } ?>
                    </div>   
                    <div class="form-group">
                      <label for="youtube">Youtube</label>
                      <input type="text" name="youtube" id="youtube" class="form-control" value="<?php echo $data[0]->youtube?>">
                      <?php if(isset($err['youtube'])){ ?>
                        <label id="exampleInputYoutube-error" class="error" for="exampleInputYoutube"><?php echo $err['youtube']; ?></label>
                      <?php } ?>
                    </div> 
                    <div class="form-group">
                      <label for="twitter">Twitter</label>
                      <input type="text" name="twitter" id="twitter" class="form-control" value="<?php echo $data[0]->twitter?>">
                      <?php if(isset($err['twitter'])){ ?>
                        <label id="exampleInputTwitter-error" class="error" for="exampleInputTwitter"><?php echo $err['twitter']; ?></label>
                      <?php } ?>
                    </div> 
                    <div class="form-group">
                      <label for="gmail">Gmail</label>
                      <input type="text" name="gmail" id="gmail" class="form-control" value="<?php echo $data[0]->gmail?>">
                      <?php if(isset($err['gmail'])){ ?>
                        <label id="exampleInputGmail-error" class="error" for="exampleInputGmail"><?php echo $err['gmail']; ?></label>
                      <?php } ?>
                    </div> 
                  	<div class="form-group">
                      <label for="skype">Skype</label>
                      <input type="text" name="skype" id="skype" class="form-control" value="<?php echo $data[0]->skype?>">
                      <?php if(isset($err['skype'])){ ?>
                        <label id="exampleInputSkype-error" class="error" for="exampleInputSkype"><?php echo $err['skype']; ?></label>
                      <?php } ?>
                    </div> 
                    <div class="form-group">
                      <label for="phone">Phone</label>
                      <input type="text" name="phone" id="phone" class="form-control" value="<?php echo $data[0]->phone?>">
                      <?php if(isset($err['phone'])){ ?>
                        <label id="exampleInputPhone-error" class="error" for="exampleInputPhone"><?php echo $err['phone']; ?></label>
                      <?php } ?>
                    </div> 
                    <div class="form-group">
                      <label for="logo">Logo</label>
                      <input type="file" name="logo" id="logo" class="form-control">
                      <img src="images/<?php echo $data[0]->logo?>" width="100" height="100"/>
                    </div> 
                    <div class="form-group">
                      <label for="fav_icon">Fav Icon</label>
                      <input type="file" name="fav_icon" id="fav_icon" class="form-control">
                      <img src="images/<?php echo $data[0]->fav_icon?>" width="100" height="100"/>
                    </div> 
                  	<button type="submit" name="btnUpdate" class="btn btn-success"><i class="fas fa-recycle"></i>Update</button>
                    <button type="reset" class="btn btn-danger"><i class="fas fa-backspace"></i>Clear</button>
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
      $('#updateForm').validate({
        rules: {
        	name: "required",
        	address: "required",
          pan: "required",
          reg_no: "required",
          listing_limit: {
            required : true,
            number: true
          },
          facebook: "required",
          youtube: "required",
          twitter: "required",
          gmail: "required",
          skype: "required",
        	phone: "required"
        }
      });
    });
  </script>