<?php 
    require 'header.php';
?>

<main class="login-main">
    <div class="login-div col-md-6 col-centered">
        <h1 class="mt-5">تسجيل الدخول</h1>
        <p>البريد الإلكتروني:</p> 
        <input type="text" name="username" id="username" class="form-control text-box-login" placeholder="أدخل البريد الإلكتروني الخاص بك">
        <p>كلمة المرور:</p> 
        <input type="password" name="password" id="pwd" class="form-control text-box-login" placeholder="أدخل كلمة المرور الخاصة بك"><br>
        <button id="login-button" class="btn btn-outline-primary login-btn mb-5">تسجيل الدخول</button>
    </div>
</main>
    
<?php 
    require 'footer.php';
?>
