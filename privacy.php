
<?php 
$title = "Privacy Policy";
require_once "header.php";
$privay_policy = $page->getPrivacyPolicy();
 
?>

<section class="">
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 pad-r">
			<?php echo $privay_policy[0]->description; ?>
		</div>
	</div>
</div>
</section>

<?php 

require_once "footer.php";
 
?>
