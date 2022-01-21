
				<div class="widget">
					<h3 class="block-title"><span>Follow Us</span></h3>

					<ul class="social-icon">
						<li>
							<a target="_blank" href="<?php echo $settingData[0]->facebook ?>">
								<i class="fa fa-facebook"></i>
							</a>
						</li>
						<li>
							<a target="_blank" href="<?php echo $settingData[0]->twitter ?>">
								<i class="fa fa-twitter"></i>
							</a>
						</li>
						<li>
							<a href="<?php echo $settingData[0]->gmail ?>" target="_blank">
								<i class="fa fa-envelope"></i>
							</a>
						</li>
						<li>
							<a href="<?php echo $settingData[0]->skype ?>" target="_blank">
								<i class="fa fa-skype"></i>
							</a>
						</li>
						<li>
							<a href="<?php echo $settingData[0]->youtube ?>" target="_blank">
								<i class="fa fa-youtube-play"></i>
							</a>
						</li>
					</ul>
				</div><!-- Widget Social end -->

				<div class="widget color-default">
					<h3 class="block-title"><span>Popular News</span></h3>
					<?php 
					$popularNews = $news->getPopularNews(); 
					?>
					<div class="post-overaly-style clearfix">
						<div class="post-thumb">
							<a href="#">
								<img class="img-fluid" src="admin/images/<?php echo $popularNews[0]->feature_image ?>" alt="" />
							</a>
						</div>
						
						<div class="post-content">
				 			<a class="post-cat" href="#"><?php echo $popularNews[0]->name ?></a>
				 			<h2 class="post-title">
				 				<a href="news.php?category_id=<?php echo $popularNews[0]->category_id ?>&& news_id=<?php echo $popularNews[0]->id ?>">
				 					<?php echo $popularNews[0]->title ?>
				 				</a>
				 			</h2>
				 			<div class="post-meta">
				 				<span class="post-date"><?php echo $popularNews[0]->created_at ?></span>
				 			</div>
			 			</div><!-- Post content end -->
					</div><!-- Post Overaly Article end -->


					<div class="list-post-block">
						<ul class="list-post">
							<?php 
								array_shift($popularNews);
								foreach($popularNews as $pn){
							?>
								<li class="clearfix">
									<div class="post-block-style post-float clearfix">
										<div class="post-thumb">
											<a href="news.php?category_id=<?php echo $pn->category_id ?>&& news_id=<?php echo $pn->id ?>">
												<img src="admin/images/<?php echo $pn->feature_image ?>" alt="" width="100" height="75" />
											</a>
											<a class="post-cat" href="#"><?php echo $pn->name ?></a>
										</div><!-- Post thumb end -->

										<div class="post-content">
								 			<h2 class="post-title title-small">
								 				<a href="news.php?category_id=<?php echo $pn->category_id ?>&& news_id=<?php echo $pn->id ?>">
								 					<?php echo $pn->title ?>
								 				</a>
								 			</h2>
								 			<div class="post-meta">
								 				<span class="post-date"><?php echo $pn->created_at ?></span>
								 			</div>
							 			</div><!-- Post content end -->
									</div><!-- Post block style end -->
								</li><!-- Li 1 end -->
							<?php } ?>


						</ul><!-- List post end -->
					</div><!-- List post block end -->

				</div><!-- Popular news widget end -->

				
