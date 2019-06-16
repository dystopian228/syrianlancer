<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./assets/stylesheets/bootstrap.min.css">
    <script src="./assets/js/jquery3_4.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/main.js"></script>
    <script src="./assets/fontawesome/js/all.js"></script>

    <?php if (basename($_SERVER['PHP_SELF']) == 'signup.php')
        echo '<script src="./assets/js/_signup.js"></script>';
    echo '<script type="text/javascript" src="./assets/js/bootstrap-datepicker.min.js"></script>';
    echo '<link rel="stylesheet" href="./assets/stylesheets/bootstrap-datepicker3.css"/>';
    if (basename($_SERVER['PHP_SELF']) == 'browse.php')
        echo '<script src="./assets/js/_browseProjects.js"></script>';
    if (basename($_SERVER['PHP_SELF']) == 'login.php')
        echo '<script src="./assets/js/_login.js"></script>';
    if (basename($_SERVER['PHP_SELF']) == 'edit_profile.php')
        echo '<script src="./assets/js/_edit_profile.js"></script>';
    if (basename($_SERVER['PHP_SELF']) == 'freelancers.php')
        echo '<script src="./assets/js/_freelancers.js"></script>';
    if (basename($_SERVER['PHP_SELF']) == 'project.php')
        echo '<script src="./assets/js/_project.js"></script>';
    if (basename($_SERVER['PHP_SELF']) == 'chat.php')
        echo '<script src="./assets/js/_chat.js"></script>';
    if (basename($_SERVER['PHP_SELF']) == 'profile.php')
        echo '<script src="./assets/js/_profile.js"></script>';
    if (basename($_SERVER['PHP_SELF']) == 'addProject.php')
        echo '<script src="./assets/js/_addProject.js"></script>';
    if (basename($_SERVER['PHP_SELF']) == 'dashboard.php')
        echo '<script src="./assets/js/_dashboard.js"></script>';
    ?>

    <link rel="stylesheet" href="./assets/stylesheets/main.css">
    <title>SyrianLancer</title>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <div class="order-md-last">
            <a class="navbar-brand pl-5" href="index.php">SyrianLancer</a>
        </div>
        <div class="order-first">
            <?php if (!isset($_SESSION['userID'])) {
                echo '<button type="button" onClick="document.location.href=\'login.php\'"
        class="btn btn-outline-primary">
           <span class="btn-text"> تسجيل الدخول</span>
           <i class="fas fa-sign-in-alt ml-md-1"></i>
       </button>
       <button type="button" onClick="document.location.href=\'signup.php\'"
        class="btn btn-outline-primary">
           <span class="btn-text">تسجيل حساب</span>
           <i class="fas fa-user-plus ml-md-1"></i>
       </button>';
            } else {
                echo '<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img id="header-prof" src="'. $_SESSION['image'] .'" class="header-profile-img cent" onerror="this.src=\'./assets/images/placeholder.png\'">
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="profile.php">الصفحة الشخصية</a>
                <a class="dropdown-item" href="dashboard.php">السجل المالي</a>
                <a class="dropdown-item" href="edit_profile.php">الإعدادات</a>
              </div><button type="button" onClick="logout()"
            class="btn btn-outline-primary">
               <span class="btn-text">تسجيل الخروج</span>
               <i class="fas fa-sign-out-alt"></i>
           </button>';
            }
            ?>
        </div>
        <button class="navbar-toggler navbar-toggler-right order-sm-last" type="button" data-toggle="collapse" data-target="#nav-items" aria-controls="nav-items" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav-items">
            <ul class="nav navbar-right mt-4 mb-4 mr-2">
                <li><a class="nav-link" href="addProject.php">أضف عمل</a></li>
                <li><a class="nav-link" href="browse.php">تصفح الأعمال</a></li>
                <li><a class="nav-link" href="freelancers.php">تصفح المستقلين</a></li>
            </ul>
        </div>
    </nav>