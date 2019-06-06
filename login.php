<?php 
    require 'header.php';
    if(isset($_SESSION['userID'])){ 
        header("Location: profile.php");
    }
?>

<main class="login-main">
    <div class="login-div col-md-6 col-centered">
        <h1 class="mt-5">تسجيل الدخول</h1>
        <p>اسم المستخدم او البريد الالكتروني:</p> 
        <input type="text" name="username" id="username" class="form-control text-box-login" placeholder="أدخل البريد الإلكتروني الخاص بك">
        <p>كلمة المرور:</p> 
        <input type="password" name="password" id="pwd" class="form-control text-box-login" placeholder="أدخل كلمة المرور الخاصة بك"><br>
        <div id="error-div" class="pull-right mt-5"></div>
        <button id="login-button" class="btn btn-outline-primary login-btn mb-5 mt-5" onclick="submitForm()">تسجيل الدخول</button>
    </div>
</main>
    
<?php 
    require 'footer.php';
?>
