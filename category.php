<?php 
	$title = "Category Page";
	require_once "header.php";
	$category->set('id',$_GET['category_id']);
	$categoryData = $category->getCategoryById();
	$news->set('category_id',$_GET['category_id']);
	
	$settingData = $setting->list();
	$limit = $settingData[0]->listing_limit;
	if (isset($_GET['page'])) {
		$offset = ($_GET['page'] - 1 )*$limit; 
		$page = $_GET['page'];
	} else{
		$offset = 0;
		$page = 1;
	}

	$newsData = $news->getNewsByCategoryId($limit,$offset);
	$newsCount = $news->getNewsCountByCategoryId();
?>
	<hr> 
	<section class="block-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-12">

					<div class="block category-listing category-style2">
						<h3 class="block-title"><span><?php echo $categoryData[0]->name ?></span></h3>
						<?php 
							if (count($newsData) > 0) {
								foreach($newsData as $nd){ 
						?>
							<div class="post-block-style post-list clearfix">
								<div class="row">
									<div class="col-lg-5 col-md-6">
										<div class="post-thumb thumb-float-style">
											<a href="#">
												<img class="img-fluid" src="admin/images/<?php echo $nd->feature_image ?>" alt="" />
											</a>
										</div>
									</div><!-- Img thumb col end -->

									<div class="col-lg-7 col-md-6">
										<div class="post-content">
								 			<h2 class="post-title title-large">
								 				<a href="news.php?category_id=<?php echo $nd->category_id ?>&& news_id=<?php echo $nd->id ?>"><?php echo $nd->title ?></a>
								 			</h2>
								 			<div class="post-meta">
								 				<span class="post-author"><a href="#"><?php echo $nd->uname ?></a></span>
								 				<span class="post-date"><?php echo $nd->created_at ?></span>
								 				<span class="post-comment pull-right"><i class="fa fa-comments-o"></i>
												<a href="#" class="comments-link"><span>03</span></a></span>
								 			</div>
								 			<p><?php echo $nd->short_description ?></p>
							 			</div><!-- Post content end -->
									</div><!-- Post col end -->
								</div><!-- 1st row end -->
							</div><!-- 1st Post list end -->
						<?php }  } else {?>
							<p class="alert alert-danger">News not available for <?php echo $categoryData[0]->name ?></p>
						<?php } ?>

					</div><!-- Block Technology end -->
					<?php if (count($newsData) > 0) { ?>
						<div class="paging">
							
			            <ul class="pagination">
			            	<?php
			            		$pageCount = ceil(($newsCount[0]->news_count)/$limit); 
			            		if ( $pageCount > 1) {?>
			            	<?php 
				            	for($i=1;$i<=$pageCount;$i++){
				            		 if ($page == $i) {
				            			$c = 'active';
				            		} else{
				            			$c = '';
				            		} ?>
				            		<li class="<?php echo $c; ?>"><a href="category.php?category_id=<?php echo $_GET['category_id']; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
				            	<?php } ?>
			            	<?php } ?>
			              <li>
			              	<span class="page-numbers">Page <?php echo $page; ?> of <?php echo $pageCount; ?>
			              	</span>
			              </li>
			            </ul>
		          		</div>
	          		<?php } ?>


				</div><!-- Content Col end -->

				<div class="col-lg-4 col-md-12">
					<div class="sidebar sidebar-right">
						<?php require_once "sidebarColumn.php"; ?>

						<div class="widget m-bottom-0">
							<h3 class="block-title"><span>Newsletter</span></h3>
							<div class="ts-newsletter">
								<div class="newsletter-introtext">
									<h4>Get Updates</h4>
									<p>Subscribe our newsletter to get the best stories into your inbox!</p>
								</div>

								<div class="newsletter-form">
									<form action="#" method="post">
										<div class="form-group">
											<input type="email" name="email" id="newsletter-form-email" class="form-control form-control-lg" placeholder="E-mail" autocomplete="off">
											<button class="btn btn-primary">Subscribe</button>
										</div>
									</form>
								</div>
							</div><!-- Newsletter end -->
						</div><!-- Newsletter widget end -->

					</div><!-- Sidebar right end -->
				</div><!-- Sidebar Col end -->

			</div><!-- Row end -->
		</div><!-- Container end -->
	</section><!-- First block end -->

	<?php require_once "footer.php"; ?>
	