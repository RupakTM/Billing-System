<?php 
	$title = "News Details";
	require_once "header.php";
	$news->set('id',$_GET['news_id']);
	$newsDetail = $news->getNewsById();

	$news->set('view_count',$newsDetail[0]->view_count+1);
	$news->updateViewCount();

	$news->set('category_id',$newsDetail[0]->category_id);
	$relatedNews = $news->getRelatedNews();

	if (isset($_POST['btnComment'])) {
		$comment->set('comment',$_POST['comment']);
		$comment->set('name',$_POST['name']);
		$comment->set('email',$_POST['email']);
		$comment->set('news_id',$_POST['news_id']);
		$comment->set('comment_date',date('Y-m-d H:i:s'));
		$comment->set('status',0);
		$status = $comment->create();
	}

	$comment->set('news_id',$newsDetail[0]->id);
	$commentList = $comment->getCommentsByNewsId();

	$fetchAuthor = $news->getAuthorByNewsId();
?>

	<div class="page-title">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ol class="breadcrumb">
     					<li><a href="#">Home</a></li>
     					<li><?php echo $categoryData[0]->name ?></a></li>
     				</ol>
				</div><!-- Col end -->
			</div><!-- Row end -->
		</div><!-- Container end -->
	</div><!-- Page title end -->

	<section class="block-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-12">
					<?php if (isset($status)) { ?>
						<p class="alert alert-success">Comment submitted successfully.</p>
					<?php } ?>
					<div class="single-post">
						
						<div class="post-title-area">
							<h2 class="post-title">
				 				<?php echo $newsDetail[0]->title ?>
				 			</h2>
				 			<div class="post-meta">
								<span class="post-author">
									By <a href="#"><?php echo $newsDetail[0]->uname ?></a>
								</span>
								<span class="post-date"><i class="fa fa-clock-o"></i><?php echo $newsDetail[0]->created_at ?></span>
								<span class="post-hits"><i class="fa fa-eye"></i> <?php echo $newsDetail[0]->view_count +1 ?></span>
								<span class="post-comment"><i class="fa fa-comments-o"></i>
								<a href="#" class="comments-link"><span>01</span></a></span>
							</div>
						</div><!-- Post title end -->

						<div class="post-content-area">
							<div class="post-media post-featured-image">
								<a href="#" class="gallery-popup"><img src="admin/images/<?php echo $newsDetail[0]->feature_image ?>" class="img-fluid" alt=""></a>
							</div>
							<div class="entry-content">
								<?php echo $newsDetail[0]->description ?>
							</div><!-- Entery content end -->

   							<!-- ShareThis BEGIN -->
							<div class="sharethis-inline-share-buttons"></div>
							<!-- ShareThis END -->

						</div><!-- post-content end -->
					</div><!-- Single post end -->


					<div class="author-box">
						<div class="author-img pull-left">
							<img src="admin/images/<?php echo $fetchAuthor[0]->photo; ?>" alt="">
						</div>
						<div class="author-info">
							<h3><?php echo $fetchAuthor[0]->name; ?></h3>
							<p class="author-url"><a href="<?php echo $fetchAuthor[0]->facebook;?>" target="_blank"><?php echo $fetchAuthor[0]->facebook; ?></a></p>
							<p><?php echo $fetchAuthor[0]->bio; ?></p>
							<div class="authors-social">
                        <span>Follow Me: </span>
                        <a href="<?php echo $fetchAuthor[0]->facebook;?>" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a href="<?php echo $fetchAuthor[0]->twitter;?>" target="_blank"><i class="fa fa-twitter"></i></a>
                        <a href="<?php echo $fetchAuthor[0]->instagram;?>" target="_blank"><i class="fa fa-instagram"></i></a>
                    </div>
						</div>
					</div> <!-- Author box end -->

					<div class="related-posts block">
						<h3 class="block-title"><span>Related Posts</span></h3>

						<div id="latest-news-slide" class="owl-carousel owl-theme latest-news-slide">
							<?php foreach($relatedNews as $rn){ 
									if ($rn->id != $newsDetail[0]->id) {
							?>
								<div class="item">
									<div class="post-block-style clearfix">
										<div class="post-thumb">
											<a href="#"><img class="img-fluid" src="admin/images/<?php echo $rn->feature_image ?>" alt="" /></a>
										</div>
										<div class="post-content">
								 			<h2 class="post-title title-medium">
								 				<a href="news.php?category_id=<?php echo $rn->category_id ?>&& news_id=<?php echo $rn->id ?>">
								 					<?php echo $rn->title ?>
								 				</a>
								 			</h2>
								 			<div class="post-meta">
								 				<span class="post-author"><a href="#"><?php echo $rn->uname ?></a></span>
								 				<span class="post-date"><?php echo $rn->created_at ?></span>
								 			</div>
							 			</div><!-- Post content end -->
									</div><!-- Post Block style end -->
								</div><!-- Item 1 end -->
							<?php } ?>
							<?php } ?>
						</div><!-- Carousel end -->

					</div><!-- Related posts end -->

					<!-- Post comment start -->
					<div id="comments" class="comments-area block">
						<h3 class="block-title"><span><?php echo count($commentList); ?> Comments</span></h3>

						<ul class="comments-list">
							<?php foreach($commentList as $cl){ ?>
								<li>
									<div class="comment">
										<img class="comment-avatar pull-left" alt="" src="admin/images/5f5d96cf86956_user.png">
										<div class="comment-body">
											<div class="meta-data">
												<span class="comment-author"><?php echo $cl->name ?></span>
												<span class="comment-date pull-right"><?php echo $cl->comment_date ?></span>
											</div>
											<div class="comment-content">
											<p><?php echo $cl->comment ?></p></div>
										</div>
									</div><!-- Comments end -->
									<?php if ($cl->reply != '') { ?>
										<ul class="comments-reply">
											<li>
												<div class="comment">
													<img class="comment-avatar pull-left" alt="" src="admin/images/5f5f8656139f4_admin.png">
													<div class="comment-body">
														<div class="meta-data">
															<span class="comment-author">Admin</span>
															<span class="comment-date pull-right"><?php echo $cl->comment_date ?></span>
														</div>
														<div class="comment-content">
														<p><?php echo $cl->reply ?></p></div>
													</div>
												</div><!-- Comments end -->
											</li>
										</ul><!-- comments-reply end -->
									<?php } ?>
								</li><!-- Comments-list li end -->
							<?php } ?>
						</ul><!-- Comments-list ul end -->
					</div><!-- Post comment end -->

					<div class="comments-form">
						<h3 class="title-normal">Leave a comment</h3>

						<form role="form" action="" method="post">
							<input type="hidden" name="news_id" value="<?php echo $newsDetail[0]->id?>">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<textarea name="comment" class="form-control required-field" id="message" placeholder="Your Comment" rows="10" required></textarea>
									</div>
								</div><!-- Col end -->

								<div class="col-md-12">
									<div class="form-group">
										<input class="form-control" name="name" id="name" placeholder="Your Name" type="text" required>
									</div>
								</div><!-- Col end -->

								<div class="col-md-12">
									<div class="form-group">
										<input class="form-control" name="email" id="email" placeholder="Your Email" type="email" required>
									</div>
								</div>
							</div><!-- Form row end -->
							<div class="clearfix">
								<button name="btnComment" class="comments-btn btn btn-primary" type="submit">Post Comment</button> 
							</div>
						</form><!-- Form end -->
					</div><!-- Comments form end -->

				</div><!-- Content Col end -->

				<div class="col-lg-4 col-md-12">
					<div class="sidebar sidebar-right">
						<?php require_once "sidebarColumn.php"; ?>

						<div class="widget text-center">
							<img class="banner img-fluid" src="images/banner-ads/ad-sidebar.png" alt="" />
						</div><!-- Sidebar Ad end -->

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



<?php  

	require_once "footer.php";

?>
<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5f68bf24d3589c001281081a&product=inline-share-buttons' async='async'></script>