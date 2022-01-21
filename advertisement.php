<?php 
$title = "Site Terms";
require_once "header.php";
$advertisement = $page->getAdvertisement();
 
?>

<section class="">
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 pad-r">
			<?php echo $advertisement[0]->description; ?>
		</div>
	</div>
</div>
</section>

<?php 

require_once "footer.php";
 
?>
