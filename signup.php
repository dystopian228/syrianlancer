<?php 
    require 'header.php'
?>

<main class="signup-main">
    <div class="signup-div col-md-6 col-centered">
        <h1 class="mt-5">تسجيل حساب</h1>

        <p>الاسم الأول</p> 
        <input type="text" name="firstName" id="fName" class="form-control text-box-signup" placeholder="">
        <p>الكنية</p> 
        <input type="text" name="lastName" id="lName" class="form-control text-box-signup" placeholder="">
        <p>اسم المستخدم</p> 
        <input type="text" name="username" id="username" class="form-control text-box-signup" placeholder="">
        <p>البريد الإلكتروني</p> 
        <input type="text" name="email" id="email" class="form-control text-box-signup" placeholder="أدخل البريد الإلكتروني الخاص بك">
        <p>كلمة المرور</p> 
        <input type="password" name="password" id="pwd" class="form-control text-box-signup" placeholder="أدخل كلمة المرور الخاصة بك"><br>

        <button id="signup-button" class="btn btn-outline-primary signup-btn mb-5">تسجيل</button>
    </div>
</main>

<?php 
    require 'footer.php'
?>