<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./stylesheets/bootstrap.min.css" crossorigin="anonymous">
    <script src="./js/jquery3_4.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/main.js"></script>
    <script src="./fontawesome/js/all.js"></script>

    <?php  if (basename($_SERVER['PHP_SELF']) == 'signup.php')
        echo '<script src="./js/_signup.js"></script>';
        ?>
    
    <link rel="stylesheet" href="./stylesheets/main.css">
    <title>SyrianLancer</title>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="order-md-last">
        <a class="navbar-brand pl-5" href="index.php">SyrianLancer</a>
    </div>
    <div class="order-first">
        <button type="button" onClick="document.location.href='login.php'" class="btn btn-outline-primary"> <span class="btn-text"> تسجيل الدخول</span> <i class="fas fa-sign-in-alt ml-md-1"></i></button>
        <button type="button" onClick="document.location.href='signup.php'" class="btn btn-outline-primary"><span class="btn-text">تسجيل حساب</span><i class="fas fa-user-plus ml-md-1"></i></button>
    </div>
        <button class="navbar-toggler navbar-toggler-right order-sm-last" type="button" data-toggle="collapse"
            data-target="#nav-items" aria-controls="nav-items" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav-items">
            <ul class="nav navbar-right mt-4 mb-4 mr-2">
                <li><a class="nav-link" href="#">أضف عمل</a></li>
                <li><a class="nav-link" href="#">تصفح الأعمال</a></li>
                <li><a class="nav-link" href="#">تصفح المستقلين</a></li>
            </ul>
        </div>
    </nav>

