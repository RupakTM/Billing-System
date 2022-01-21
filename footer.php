<footer id="footer" class="footer">
         <div class="footer-main">
            <div class="container">
               <div class="row">
                  <div class="col-lg-4 col-sm-12 footer-widget">
                     <h3 class="widget-title">Trending Now</h3>
                     <div class="list-post-block">
                        <ul class="list-post">
                          <?php 
                            $trendingNews = $news->getTrendingNewsForFooter();
                            foreach($trendingNews as $tn){
                          ?>
                             <li class="clearfix">
                                <div class="post-block-style post-float clearfix">
                                   <div class="post-thumb">
                                      <a href="news.php?category_id=<?php echo $tn->category_id ?>&& news_id=<?php echo $tn->id ?>">
                                         <img src="admin/images/<?php echo $tn->feature_image ?>" alt="" width="95" height="75" />
                                      </a>
                                   </div><!-- Post thumb end -->
     
                                   <div class="post-content">
                                       <h2 class="post-title title-small">
                                          <a href="news.php?category_id=<?php echo $tn->category_id ?>&& news_id=<?php echo $tn->id ?>"><?php echo $tn->title ?></a>
                                       </h2>
                                       <div class="post-meta">
                                          <span class="post-date"><?php echo $tn->created_at ?></span>
                                       </div>
                                    </div><!-- Post content end -->
                                </div><!-- Post block style end -->
                             </li><!-- Li 1 end -->
                           <?php }  ?>
                        </ul><!-- List post end -->
                     </div><!-- List post block end -->
                     
                  </div><!-- Col end -->
                  <div class="col-lg-4 col-sm-12 footer-widget widget-categories">
                     <h3 class="widget-title">Hot Categories</h3>
                     <ul>
                      <?php 
                        $categoryId = $category->getCategoryForHotCategories();
                        foreach($categoryId as $lc){
                          $news->set('category_id',$lc->id);
                          $hotCategoryList = $news->getNewsForHotCategory();
                          $countNews = count($hotCategoryList);
                          if($countNews > 0){
                      ?>
                        <li>
                           <a href="category.php?category_id=<?php echo $lc->id ?>">
                              <span class="catTitle"><?php echo $lc->name ?></span>
                              <span class="catCounter"> (<?php echo $countNews ?>)</span>
                            </a>
                        </li>
                      <?php 
                          } 
                        }
                      ?>
                     </ul>
                    
                  </div><!-- Col end -->
   
                  <div class="col-lg-4 col-sm-12 footer-widget">
                     <h3 class="widget-title">Post Gallery</h3>
                     <div class="gallery-widget">
                      <?php
                        $galleryImage = $news->getImageForGallery();
                        foreach($galleryImage as $gm){
                      ?>
                        <a href="news.php?category_id=<?php echo $gm->category_id ?>&& news_id=<?php echo $gm->id ?>"><img src="admin/images/<?php echo $gm->feature_image ?>" alt="" width="80" height="65" /></a>
                      <?php } ?>
                     </div>
                  </div><!-- Col end -->
   
               </div><!-- Row end -->
            </div><!-- Container end -->
         </div><!-- Footer main end -->
   
         <div class="footer-info text-center">
            <div class="container">
               <div class="row">
                  <div class="col-md-12">
                     <div class="footer-info-content">
                        <div class="footer-logo">
                           <img class="img-fluid" src="admin/images/<?php echo $settingData[0]->logo ?>" alt="" width="180" height="46"/>
                        </div>
                        <p>News247 Worldwide is a popular online newsportal and going source for technical and digital content for its influential audience around the globe. You can reach us via email or phone.</p>
                        <p class="footer-info-phone"><i class="fa fa-phone"></i><?php echo $settingData[0]->phone ?></p>
                        <p class="footer-info-email"><i class="fa fa-envelope-o"></i><?php echo $settingData[0]->gmail ?></p>
                        <ul class="unstyled footer-social">
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
                              <a title="Skype" target="_blank" href="<?php echo $settingData[0]->skype ?>">
                                 <span class="social-icon"><i class="fa fa-skype"></i></span>
                              </a>
                              <a title="Youtube" target="_blank" href="<?php echo $settingData[0]->youtube ?>">
                                 <span class="social-icon"><i class="fa fa-youtube-play"></i></span>
                              </a>
                           </li>
                        </ul>
                     </div><!-- Footer info content end -->
                  </div><!-- Col end -->
               </div><!-- Row end -->
            </div><!-- Container end -->
         </div><!-- Footer info end -->
   </footer><!-- Footer end -->
   
   <div class="copyright">
         <div class="container">
            <div class="row">
               <div class="col-sm-12 col-md-6">
                  <div class="copyright-info">
                     <span>Copyright © <?php echo date('Y') ?> News247 All Rights Reserved. Designed By Tripples</span>
                  </div>
               </div>

               <div class="col-sm-12 col-md-6">
                  <div class="footer-menu">
                     <ul class="nav unstyled">
                        <li><a href="site_terms.php">Site Terms</a></li>
                        <li><a href="privacy.php">Privacy</a></li>
                        <li><a href="advertisement.php">Advertisement</a></li>
                        <li><a href="cookie_policy.php">Cookies Policy</a></li>
                        <li><a href="contact_us.php">Contact Us</a></li>
                     </ul>
                  </div>
               </div>
            </div><!-- Row end -->

            <div id="back-to-top" class="back-to-top">
               <button class="btn btn-primary" title="Back to Top">
                  <i class="fa fa-angle-up"></i>
               </button>
            </div>

         </div><!-- Container end -->
   </div><!-- Copyright end -->


	<!-- Javascript Files
	================================================== -->

	<!-- initialize jQuery Library -->
	<script type="text/javascript" src="js/jquery.js"></script>
	<!-- Popper js -->
	<script type="text/javascript" src="js/popper.min.js"></script>
	<!-- Bootstrap jQuery -->
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<!-- Owl Carousel -->
	<script type="text/javascript" src="js/owl.carousel.min.js"></script>
	<!-- Color box -->
	<script type="text/javascript" src="js/jquery.colorbox.js"></script>
	<!-- Smoothscroll -->
	<script type="text/javascript" src="js/smoothscroll.js"></script>


	<!-- Template custom -->
	<script type="text/javascript" src="js/custom.js"></script>
	
	</div><!-- Body inner end -->
</body>

<!-- Mirrored from demo.themewinter.com/html/news247-bs4/index-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 13 Sep 2020 02:35:37 GMT -->
</html>