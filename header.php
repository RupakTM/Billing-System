<?php 

require_once "admin/object.php";
$menu = $category->getCategoryForMenu();
$trendingNews = $news->getTrendingNews();
$settingData = $setting->list();
if (isset($_GET['category_id'])) {
	$category->set('id',$_GET['category_id']);
	$categoryData = $category->getCategoryById();
}

$addAds = $ads->getAdvertisement();



?>

<!DOCTYPE html>
<html lang="en">
<head>

	<!-- Basic Page Needs
	================================================== -->
	<meta charset="utf-8">
	<title><?php echo $title; ?> | <?php echo $settingData[0]->name ?></title>

	<!-- Mobile Specific Metas
	================================================== -->

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

	<!--Favicon-->
	<link rel="shortcut icon" href="admin/images/<?php echo $settingData[0]->fav_icon ?>" type="image/x-icon">
	<link rel="icon" href="admin/images/<?php echo $settingData[0]->fav_icon ?>" type="image/x-icon">
	
	<!-- CSS
	================================================== -->
	
	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Template styles-->
	<link rel="stylesheet" href="css/style.css">
	<!-- Responsive styles-->
	<link rel="stylesheet" href="css/responsive.css">
	<!-- FontAwesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Animation -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Owl Carousel -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<!-- Colorbox -->
	<link rel="stylesheet" href="css/colorbox.css">
	<!-- Custom css -->
	<link rel="stylesheet" href="css/custom.css">


	<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

</head>
	
<body>

	<div class="body-inner">

   <div id="top-bar" class="top-bar">
      <div class="container">
         <div class="row">
            <div class="col-md-8">
               <div class="ts-date">
                  <i class="fa fa-calendar-check-o"></i><?php echo date('M d, Y'); ?>
               </div>
               <ul class="unstyled top-nav">
                  <li><a href="about.php">About</a></li>
                  <li><a href="review.php">Write for Us</a></li>
                  <li><a href="advertise.php">Advertise</a></li>
                  <li><a href="contact.php">Contact</a></li>
               </ul>
            </div><!--/ Top bar left end -->

            <div class="col-md-4 top-social text-lg-right text-md-center">
               <ul class="unstyled">
                  <li>
                     <a title="Facebook" target="_blank" href="<?php echo $settingData[0]->facebook ?>">
                        <span class="social-icon"><i class="fa fa-facebook"></i></span>
                     </a>
                     <a title="Twitter" target="_blank" href="<?php echo $settingData[0]->twitter ?>">
                        <span class="social-icon"><i class="fa fa-twitter"></i></span>
                     </a>
                     <a title="Google+" target="_blank" href="<?php echo $settingData[0]->gmail ?>">
                        <span class="social-icon"><i class="fa fa-envelope"></i></span>
                     </a>
                     <a title="Linkdin" target="_blank" href="<?php echo $settingData[0]->youtube ?>">
                        <span class="social-icon"><i class="fa fa-youtube-play"></i></span>
                     </a>
                     <a title="Skype" target="_blank" href="<?php echo $settingData[0]->skype ?>">
                        <span class="social-icon"><i class="fa fa-skype"></i></span>
                     </a>
                  </li>
               </ul><!-- Ul end -->
            </div><!--/ Top social col end -->
         </div><!--/ Content row end -->
      </div><!--/ Container end -->
   </div><!--/ Topbar end -->

	<!-- Header start -->
	<header id="header" class="header">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-12">
					<div class="logo">
						 <a href="index.php">
							<img src="admin/images/<?php echo $settingData[0]->logo ?>" alt="" width="180" height="46">
						 </a>
					</div>
				</div><!-- logo col end -->

				<div class="col-md-9 col-sm-12 header-right">
					<div class="ad-banner float-right">
						<a href="<?php echo $addAds[0]->link ?>"><img src="admin/images/<?php echo $addAds[0]->image ?>" alt="" width="730" height="90"></a>
					</div>
				</div><!-- header right end -->
			</div><!-- Row end -->
		</div><!-- Logo and banner area end -->
	</header><!--/ Header end -->

	<div class="main-nav clearfix">
		<div class="container">
			<div class="row">
				<nav class="navbar navbar-expand-lg col">
					<div class="site-nav-inner float-left">
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
               </button>
               <!-- End of Navbar toggler -->

						<div id="navbarSupportedContent" class="collapse navbar-collapse navbar-responsive-collapse">
							<ul class="nav navbar-nav">
								<?php 
									$scriptArray = explode('/', $_SERVER['SCRIPT_NAME']);
									$class = '';
									if ($scriptArray[count($scriptArray)-1] === 'index.php') {
										$class = 'active';
									}
								?>
								<li class="nav-item dropdown <?php echo $class ?>">
									<a href="index.php" class="nav-link">Home</a>
								</li>
								<?php 
									$count = 0;
									foreach ($menu as $m) {
										if($count < 7){ 
								?>
										<?php 
										$c = '';
										if (isset($_GET['category_id']) && $_GET['category_id'] == $m->id) {
											$c = 'active';
										} 
										?>
										<li class="<?php echo $c ?>">
											<a href="category.php?category_id=<?php echo $m->id ?>"><?php echo $m->name ?></a>
										</li>
										<?php $count ++;
											array_shift($menu);
										} 	
									}?>
									<?php 
										$cl = '';
										foreach ($menu as $mr) {
											if (isset($_GET['category_id']) && $_GET['category_id'] == $mr->id) {
												$cl = 'active';
											} 
										}
									?>
								<li class="nav-item dropdown <?php echo $cl ?>">
									<a href="#" class="nav-link" data-toggle="dropdown">More <i class="fa fa-angle-down"></i></a>
									<ul class="dropdown-menu" role="menu">
										<?php foreach ($menu as $mr) { ?>
											<li class="">
												<a href="category.php?category_id=<?php echo $mr->id ?>"><?php echo $mr->name ?></a>
											</li>
										<?php } ?>	
									</ul>
								</li>
								
							</ul><!--/ Nav ul end -->
						</div><!--/ Collapse end -->

					</div><!-- Site Navbar inner end -->
				</nav><!--/ Navigation end -->

				<div class="nav-search">
					<span id="search"><i class="fa fa-search"></i></span>
				</div><!-- Search end -->
				
				<div class="search-block" style="display: none;">
					<input type="text" class="form-control" placeholder="Type what you want and enter">
					<span class="search-close">&times;</span>
				</div><!-- Site search end -->

			</div><!--/ Row end -->
		</div><!--/ Container end -->

	</div><!-- Menu wrapper end -->
   
   <div class="trending-light d-md-block d-lg-block d-none">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h3 class="trending-title">Trending Now</h3>
					<div id="trending-slide" class="owl-carousel owl-theme trending-slide">
						<?php foreach($trendingNews as $tn){ ?>
							<div class="item">
							   <div class="post-content">
							      <h2 class="post-title title-small">
							         <a href="news.php?category_id=<?php echo $tn->category_id ?>&& news_id=<?php echo $tn->id ?>"><?php echo $tn->title ?></a>
							      </h2>
							   </div><!-- Post content end -->
							</div><!-- Item 1 end -->
						<?php } ?>
					</div><!-- Carousel end -->
				</div><!-- Col end -->
			</div><!--/ Row end -->
		</div><!--/ Container end -->
	</div><!--/ Trending end -->