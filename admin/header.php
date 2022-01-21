<?php 
require_once "libs/helper.php";
require_once "object.php";
checkLoginStatus();
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - <?php echo $title; ?></title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <link href="css/custom.css" rel="stylesheet">


</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-plus"></i>
        </div>
        <div class="sidebar-brand-text mx-3">NA <sup>1.0</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Index -->
      <li class="nav-item active">
        <a class="nav-link" target="_blank" href="../index.php">
          <i class="fas fa-eye"></i>
          <span>Preview Website</span></a>
      </li>

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        CMS Section
      </div>

      <!-- Nav Item - Category Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategory" aria-expanded="true" aria-controls="collapseCategory">
          <i class="fas fa-list"></i>
          <span>Category Management</span>
        </a>
        <div id="collapseCategory" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="add_category.php">
                      <i class="fas fa-plus"></i> Add</a>
            <a class="collapse-item" href="list_category.php">
                      <i class="fas fa-list"></i> List</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - News Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNews" aria-expanded="true" aria-controls="collapseNews">
          <i class="fas fa-newspaper"></i>
          <span>News Management</span>
        </a>
        <div id="collapseNews" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="add_news.php">
                      <i class="fas fa-plus"></i> Add</a>
            <a class="collapse-item" href="list_news.php">
                      <i class="fas fa-list"></i> List</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Advertisment Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdvertisement" aria-expanded="true" aria-controls="collapseAdvertisement">
          <i class="fas fa-ad"></i>
          <span>Ads Management</span>
        </a>
        <div id="collapseAdvertisement" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="add_advertisement.php">
                      <i class="fas fa-plus"></i> Add</a>
            <a class="collapse-item" href="list_advertisement.php">
                      <i class="fas fa-list"></i> List</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Page Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePage" aria-expanded="true" aria-controls="collapsePage">
          <i class="fas fa-file-alt"></i>
          <span>Page Management</span>
        </a>
        <div id="collapsePage" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="add_pages.php">
                      <i class="fas fa-plus"></i> Add
            </a>
            <a class="collapse-item" href="list_pages.php">
                      <i class="fas fa-list"></i> List
            </a>
          </div>
        </div>
      </li>
      <!-- Nav Item - Page Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseComment" aria-expanded="true" aria-controls="collapseComment">
          <i class="fas fa-comment"></i>
          <span>Comment Management</span>
        </a>
        <div id="collapseComment" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">

            <a class="collapse-item" href="list_advertisement.php">
                <i class="fas fa-list"></i> List</a>
          </div>
        </div>
      </li>
       <!-- Nav Item - Page Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseVideo" aria-expanded="true" aria-controls="collapseVideo">
          <i class="fas fa-film"></i>
          <span>Video Management</span>
        </a>
        <div id="collapseVideo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="add_video.php">
                <i class="fas fa-plus"></i> Add
            </a>
            <a class="collapse-item" href="list_video.php">
                <i class="fas fa-list"></i> List</a>
          </div>
        </div>
      </li>
      <!-- Access assignment accoring to role -->
      <?php if ($_SESSION['role_name'] == 'Admin') { ?>
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        User Section
      </div>

       <!-- Nav Item - Role Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRole" aria-expanded="true" aria-controls="collapseRole">
          <i class="fas fa-list"></i>
          <span>Role Management</span>
        </a>
        <div id="collapseRole" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="add_role.php">
                      <i class="fas fa-plus"></i> Add</a>
            <a class="collapse-item" href="list_role.php">
                      <i class="fas fa-list"></i> List</a>
          </div>
        </div>
      </li>
      <!-- Nav Item - Author Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAuthor" aria-expanded="true" aria-controls="collapseAuthor">
          <i class="fas fa-user-tie"></i>
          <span>Author Management</span>
        </a>
        <div id="collapseAuthor" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="add_author.php">
                      <i class="fas fa-plus"></i> Add</a>
            <a class="collapse-item" href="list_author.php">
                      <i class="fas fa-list"></i> List</a>
          </div>
        </div>
      </li>

       <!-- Nav Item - User Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="true" aria-controls="collapseUser">
          <i class="fas fa-user-cog"></i>
          <span>User Management</span>
        </a>
        <div id="collapseUser" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="add_user.php">
                      <i class="fas fa-plus"></i> Add</a>
            <a class="collapse-item" href="list_user.php">
                      <i class="fas fa-list"></i> List</a>
          </div>
        </div>
      </li>
    <?php } ?>
    <!-- Nav Item - Setting-->
      <li class="nav-item active">
        <a class="nav-link" href="setting.php">
          <i class="fas fa-fw fa-cog"></i>
          <span>Setting</span></a>
      </li>
      <!-- Nav Item - Logout -->
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>Logout</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                  <?php echo $_SESSION['name']; ?>
                </span>
                <img src="images/<?php echo $_SESSION['image']; ?>" width="32px" height="32px" style="border-radius:50%">
                  <!-- <i class="fas fa-user-circle"></i> -->
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="profile.php?id=<?php echo $_SESSION['id']?>">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="setting.php">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="index.php" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
