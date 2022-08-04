<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= /** @var string $title */ $title ?></title>
    <link rel="icon" href="/public/img/favicon.png" type="image/png">
    <!-- Custom fonts for this template -->
    <link href="/public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/public/css/sb-admin-2.css" rel="stylesheet">
    <link href="/public/css/custom.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="/public/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<?php if ($this->route['action'] != 'login'): ?>
<body id="page-top">
<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gray-900 sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
            <div class="sidebar-brand-icon">
                <i class="fas fa-spell-check"></i>
            </div>
            <div class="sidebar-brand-text mx-3">AB Panel</div>
        </a>
        <!-- Heading -->
        <div class="sidebar-heading">
            Navigation
        </div>
        <!-- Nav Item - Области -->
        <li class="nav-item <?php if (isset($urlPath) && $urlPath == '/knowledge') { echo 'active'; } ?>">
            <a class="nav-link" href="/">
                <i class="fas fa-database"></i>
                <span>Области знаний</span>
            </a>
        </li>
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
                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">UserName</span>
                            <img class="img-profile rounded-circle" src="/public/img/user.png">
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- End of Topbar -->
            <!-- Begin Page Content -->
            <?php endif; ?>
            <?= /** @var string $content */ $content ?>
            <?php if ($this->route['action'] != 'login'): ?>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->
        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; <?= date('Y') ?></span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<div class="notify"></div>
</body>
<?php endif; ?>
<!-- Bootstrap core JavaScript-->
<script src="/public/vendor/jquery/jquery.min.js"></script>
<script src="/public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Page level plugins -->
<script src="/public/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="/public/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Custom scripts for all pages-->
<script src="/public/js/sb-admin-2.js"></script>
<script src="/public/js/panel.js"></script>
</html>