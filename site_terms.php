<?php 
$title = "Site Terms";
require_once "header.php";
$siteTerms = $page->getSiteTerms();
 
?>

<section class="">
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 pad-r">
			<?php echo $siteTerms[0]->description; ?>
		</div>
	</div>
</div>
</section>

<?php 

require_once "footer.php";
 
?>
