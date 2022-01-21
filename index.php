<?php 
// UNLINK
$title = "Home Page";
require_once "header.php";
$sliderNews = $news->getSliderForNews();
$newsCategory = $category->getCategoryForFeatureNews();
$listNewsCategory = $category->getCategoryForNewsList();
$settingData = $setting->list();
$moreNews = $news->getNewsForMoreNews();
$videoList = $video->getVideoList();
?>

<section class="featured-post-area no-padding">
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 pad-r">
			<div id="featured-slider" class="owl-carousel owl-theme featured-slider">
				<?php foreach($sliderNews as $sn){ ?>
					<div class="item" style="background-image:url(admin/images/<?php echo $sn->feature_image ?>)">
						<div class="featured-post">
					 		<div class="post-content">
					 			<a class="post-cat" href="#"><?php echo $sn->name ?></a>
					 			<h2 class="post-title title-extra-large">
					 				<a href="news.php?category_id=<?php echo $sn->category_id ?>&& news_id=<?php echo $sn->id ?>"><?php echo $sn->title ?></a>
					 			</h2>
					 			<span class="post-date"><?php echo $sn->created_at ?></span>
					 		</div>
					 	</div><!--/ Featured post end -->
						
					</div><!-- Item 1 end -->
				<?php } ?>
			</div><!-- Featured owl carousel end-->
		</div><!-- Col 6 end -->     

	</div><!-- Row end -->
</div><!-- Container end -->
</section><!-- Trending post end -->

<section class="block-wrapper">
<div class="container">
	<div class="row">
		<?php $colors = array('color-blue','color-red','color-orange','color-black','color-violet'); ?>
		<div class="col-lg-8 col-md-12">	
			<!--- Featured Tab startet -->
			<?php 
				foreach($newsCategory as $index => $nc){ 
					$news->set('category_id',$nc->id);
					$featureNews = $news->getFeatureNewsByCategoryId();
			?>	
			<?php if (count($featureNews) > 0) { ?>
				<div class="featured-tab <?php echo $colors[$index] ?>">
					<h3 class="block-title"><span><?php echo $nc->name ?></span></h3>
					<ul class="nav nav-tabs">
					  	<li>
					  		<a class="active animated fadeIn" href="#tab_a" data-toggle="tab">
					  			<span class="tab-head">
									<span class="tab-text-title">Featured News</span>					
								</span>
					  		</a>
					  	</li>
					</ul>

					<div class="tab-content">
						
					      <div class="tab-pane active animated fadeInRight" id="tab_a">
					      	<div class="row">
						      	<div class="col-md-6">
						      		<div class="post-block-style clearfix">
											<div class="post-thumb">
												<a href="news.php?category_id=<?php echo $featureNews[0]->category_id ?>&& news_id=<?php echo $featureNews[0]->id ?>">
													<img class="img-fluid" src="admin/images/<?php echo $featureNews[0]->feature_image ?>" alt="" />
												</a>
											</div>
											<div class="post-content">
									 			<h2 class="post-title">
									 				<a href="news.php?category_id=<?php echo $featureNews[0]->category_id ?>&& news_id=<?php echo $featureNews[0]->id ?>"><?php echo $featureNews[0]->title ?></a>
									 			</h2>
									 			<div class="post-meta">
									 				<span class="post-author"><a href="#"><?php echo $featureNews[0]->uname ?></a></span>
									 				<span class="post-date"><?php echo $featureNews[0]->created_at ?></span>
									 			</div>
									 			<p><?php echo $featureNews[0]->short_description ?></p>
								 			</div><!-- Post content end -->
										</div><!-- Post Block style end -->
						      	</div><!-- Col end -->
						      	<?php array_shift($featureNews); ?>
						      	<div class="col-md-6">
						      		<div class="list-post-block">
											<ul class="list-post">
												<?php foreach($featureNews as $fn){ ?>
													<li class="clearfix">
														<div class="post-block-style post-float clearfix">
															<div class="post-thumb">
																<a href="news.php?category_id=<?php echo $fn->category_id ?>&& news_id=<?php echo $fn->id ?>">
																	<img class="img-fluid" src="admin/images/<?php echo $fn->feature_image ?>" alt="" />
																</a>
															</div><!-- Post thumb end -->

															<div class="post-content">
													 			<h2 class="post-title title-small">
													 				<a href="news.php?category_id=<?php echo $fn->category_id ?>&& news_id=<?php echo $fn->id ?>"><?php echo $fn->title ?></a>
													 			</h2>
													 			<div class="post-meta">
													 				<span class="post-date"><?php echo $fn->created_at ?></span>
													 			</div>
												 			</div><!-- Post content end -->
														</div><!-- Post block style end -->
													</li><!-- Li 1 end -->
												<?php } ?>
											</ul><!-- List post end -->
										</div><!-- List post block end -->
						      	</div><!-- List post Col end -->
					      	</div><!-- Tab pane Row 1 end -->
					      </div><!-- Tab pane 1 end -->
				  	
					</div><!-- tab content --> 
				</div><!-- Technology Tab end -->
				<?php }?>
			<?php } ?>

			<div class="gap-40"></div>

			<div class="gap-50"></div>
  			<?php 
  				$latestNews = $news->getLatestNews();
  				$latestNewsData = array_chunk($latestNews, 2);
  			?>
			<div class="latest-news block color-red">
				<h3 class="block-title"><span>Latest News</span></h3>
				<div id="latest-news-slide" class="owl-carousel owl-theme latest-news-slide">
					<?php foreach ($latestNewsData as $lnd) { ?>
						<div class="item">
							<ul class="list-post">
								<?php foreach($lnd as $ln){ ?>
									<li class="clearfix">
										<div class="post-block-style clearfix">
											<div class="post-thumb">
												<a href="news.php?category_id=<?php echo $ln->category_id ?>&& news_id=<?php echo $ln->id ?>">
													<img src="admin/images/<?php echo $ln->feature_image ?>" alt=""  height="136" width="223" />
												</a>
											</div>
											<div class="post-content">
									 			<h2 class="post-title title-medium">
									 				<a href="news.php?category_id=<?php echo $ln->category_id ?>&& news_id=<?php echo $ln->id ?>"><?php echo $ln->title ?></a>
									 			</h2>
									 			<div class="post-meta">
									 				<span class="post-author"><a href="#"><?php echo $ln->name ?></a></span>
									 				<span class="post-date"><?php echo $ln->created_at ?></span>
									 			</div>
								 			</div><!-- Post content end -->
										</div><!-- Post Block style end -->
									</li><!-- Li end -->

									<div class="gap-30"></div>
								<?php } ?>
							</ul><!-- List post 1 end -->

						</div><!-- Item 1 end -->
					<?php } ?>
				</div><!-- Latest News owl carousel end-->
			</div><!--- Latest news end -->

		</div><!-- Content Col end -->
		<!-- Side Bar Column -->
		<div class="col-lg-4 col-md-12">
			<div class="sidebar sidebar-right">
			<?php require_once "sidebarColumn.php"; ?>
			<div class="widget color-default m-bottom-0">
					<h3 class="block-title"><span>Trending News</span></h3>
					<div id="post-slide" class="owl-carousel owl-theme post-slide">
						<div class="item">
							<?php 
								$trendingSidebar = $news->getTrendingNewsForSidebar();
								foreach($trendingSidebar as $key => $ts){ 
									if ($key < 2) {
							?>
								<div class="post-overaly-style text-center clearfix">
								   <div class="post-thumb">
								      <a href="#">
								         <img class="img-fluid" src="admin/images/<?php echo $ts->feature_image ?>" alt="" />
								      </a>
								   </div><!-- Post thumb end -->

								   <div class="post-content">
								      <h2 class="post-title">
								         <a href="news.php?category_id=<?php echo $ts->category_id ?>&& news_id=<?php echo $ts->id ?>"><?php echo $ts->title ?></a>
								      </h2>
								      <div class="post-meta">
								         <span class="post-date"><?php echo $ts->created_at ?></span>
								      </div>
								   </div><!-- Post content end -->
								</div><!-- Post Overaly Article 1 end -->
							<?php } } ?>
							

						</div><!-- Item 1 end -->

						<div class="item">
							<?php 
								$NewsSidebar = array_slice($trendingSidebar,2);
								foreach($NewsSidebar as $sidebar){  
							?>
								<div class="post-overaly-style text-center clearfix">
								   <div class="post-thumb">
								      <a href="#">
								         <img class="img-fluid" src="admin/images/<?php echo $sidebar->feature_image ?>" alt="" />
								      </a>
								   </div><!-- Post thumb end -->

								   <div class="post-content">
								      <h2 class="post-title">
								         <a href="news.php?category_id=<?php echo $sidebar->category_id ?>&& news_id=<?php echo $sidebar->id ?>"><?php echo $sidebar->title ?></a>
								      </h2>
								      <div class="post-meta">
								         <span class="post-date"><?php echo $sidebar->created_at?></span>
								      </div>
								   </div><!-- Post content end -->
								</div><!-- Post Overaly Article 3 end -->
							<?php } ?>
						</div><!-- Item 2 end -->

					</div><!-- Post slide carousel end -->
			</div><!-- Trending news end -->
			
			</div><!-- Sidebar right end -->
		</div>
		<!-- Side Bar Column Ends -->
		<!-- Side Bar Column Ends-->
	</div><!-- Row end -->
</div><!-- Container end -->
</section><!-- First block end -->

<section class="ad-content-area text-center no-padding custom-marigin">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<?php array_shift($addAds); ?>
					<a href="<?php echo $addAds[0]->link ?>"><img src="admin/images/<?php echo $addAds[0]->image ?>" alt=""></a>
				</div><!-- Col end -->
				
			</div><!-- Row end -->
		</div><!-- Container end -->
	</section>
</section><!-- Ad content top end -->



<section class="block-wrapper video-block">
<div class="container">
	<div class="row">
		<div class="video-tab clearfix">
			<h2 class="video-tab-title">Watch Now</h2>
			<div class="row">
			<div class="col-lg-7 pad-r-0">
					<div class="tab-content">
					<?php foreach($videoList as $key => $vl){ ?>
						<div class="tab-pane <?php echo ($key==0)?'active':'' ?> animated fadeIn" id="video<?php echo $key+1?>">
							<div class="post-overaly-style clearfix">
							   <div class="post-thumb">
									<img src="admin/images/<?php echo $vl->thumbnail;?>" alt="" width="668" height="444"/>
									<a class="popup" href="<?php echo $vl->video_link;?>?autoplay=1&loop=1">
				                  <div class="video-icon">
				                  	<i class="fa fa-play"></i>
				               	</div>
				            	</a>
							   </div><!-- Post thumb end -->
							   <div class="post-content">
							      <h2 class="post-title">
							         <a href="#"><?php echo $vl->title; ?></a>
							      </h2>
							   </div><!-- Post content end -->
							</div><!-- Post Overaly Article end -->
						</div><!--Tab pane 1 end-->
						<?php } ?>
					</div><!-- Tab content end -->
				
			</div><!--Tab col end -->

			<div class="col-lg-5 pad-l-0">
				<ul class="nav nav-tabs">
					<?php foreach($videoList as $key => $video){ ?>
					  	<li class="nav-item <?php echo ($key==0)?'active':'' ?>">
					  		<a class="nav-link animated fadeIn" href="#video<?php echo $key+1;?>" data-toggle="tab">
					  			<div class="post-thumb">
							        <img src="admin/images/<?php echo $video->thumbnail;?>" width="110" height="85" alt="" />
							   </div><!-- Post thumb end -->
					  			<h3><?php echo $video->title;?></h3>
					  		</a>
					  	</li>
				  	<?php } ?>
				</ul>
			</div><!--Tab nav col end -->

			</div>
		</div><!-- Video tab end -->

	</div><!-- Row end -->
</div><!-- Container end -->
</section><!-- Video block end -->



<section class="block-wrapper p-bottom-0">
<div class="container">
	<div class="row">
		<div class="col-lg-8 col-md-12">
			<div class="more-news block color-default">
				<h3 class="block-title"><span>More News</span></h3>

				<div id="more-news-slide" class="owl-carousel owl-theme more-news-slide">
					<div class="item">
						<?php
						for ($i=0; $i < 3 ; $i++) { 
						?>
							<div class="post-block-style post-float-half clearfix">
								<div class="post-thumb">
									<a href="#">
										<img class="img-fluid" src="admin/images/<?php echo $moreNews[$i]->feature_image ?>" alt="" />
									</a>
								</div>
								<a class="post-cat" href="#"><?php echo $moreNews[$i]->name ?></a>
								<div class="post-content">
						 			<h2 class="post-title">
						 				<a href="news.php?category_id=<?php echo $moreNews[$i]->category_id ?>&& news_id=<?php echo $moreNews[$i]->id ?>"><?php echo $moreNews[$i]->title ?></a>
						 			</h2>
						 			<div class="post-meta">
						 				<span class="post-author"><a href="#"><?php echo $moreNews[$i]->uname ?></a></span>
						 				<span class="post-date"><?php echo $moreNews[$i]->created_at ?></span>
						 			</div>
						 			<p><?php echo $moreNews[$i]->short_description ?></p>
					 			</div><!-- Post content end -->
							</div><!-- Post Block style 1 end -->

							<div class="gap-30"></div>
							<?php 
								} 
							?>
					</div><!-- Item 1 end -->
					<div class="item">
						<?php for ($i=3; $i < 6 ; $i++) { 
						?>
							<div class="post-block-style post-float-half clearfix">
								<div class="post-thumb">
									<a href="#">
										<img class="img-fluid" src="admin/images/<?php echo $moreNews[$i]->feature_image ?>" alt="" />
									</a>
								</div>
								<a class="post-cat" href="#"><?php echo $moreNews[$i]->name ?></a>
								<div class="post-content">
						 			<h2 class="post-title">
						 				<a href="news.php?category_id=<?php echo $moreNews[$i]->category_id ?>&& news_id=<?php echo $moreNews[$i]->id ?>"><?php echo $moreNews[$i]->title ?></a>
						 			</h2>
						 			<div class="post-meta">
						 				<span class="post-author"><a href="#"><?php echo $moreNews[$i]->uname ?></a></span>
						 				<span class="post-date"><?php echo $moreNews[$i]->created_at ?></span>
						 			</div>
						 			<p><?php echo $moreNews[$i]->short_description ?></p>
					 			</div><!-- Post content end -->
							</div><!-- Post Block style 5 end -->

							<div class="gap-30"></div>
						<?php } ?>	
					</div><!-- Item 2 end -->		
				</div><!-- More news carousel end -->
			</div><!--More news block end -->
		</div><!-- Content Col end -->

		<div class="col-lg-4 col-md-12">
			<div class="sidebar sidebar-right">
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
			</div><!--Sidebar right end -->
		</div><!-- Sidebar col end -->
	</div><!-- Row end -->
</div><!-- Container end -->
</section><!-- 3rd block end -->

<section class="ad-content-area text-center">
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<?php array_shift($addAds); ?>
					<a href="<?php echo $addAds[0]->link ?>"><img src="admin/images/<?php echo $addAds[0]->image ?>" alt=""></a>
		</div><!-- Col end -->
	</div><!-- Row end -->
</div><!-- Container end -->
</section><!-- Ad content two end -->



<?php 
	require_once "footer.php";
?>