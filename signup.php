<?php
require 'header.php'
?>

<main class="signup-main">
    <div class="signup-div col-md-6 col-centered ">
        <h1 class="mt-5 mb-5">تسجيل حساب</h1>

        <div class="row">
            <div class="col-md-6">
                <p>الاسم الأول</p>
                <input type="text" name="firstName" id="fName" class="form-control text-box-signup" placeholder="">
            </div>
            <div class="col-md-6">
                <p>الكنية</p>
                <input type="text" name="lastName" id="lName" class="form-control text-box-signup" placeholder="">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <p>اسم المستخدم</p>
                <input type="text" name="username" id="username" class="form-control text-box-signup" placeholder="">
            </div>
            <div class="col-md-6 mb-4" >
                <p>تاريخ الميلاد</p>
                <input class="form-control" id="date" name="date" placeholder="MM/DD/YYYY" type="text" />
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-6 mb-4">
                <p>الجنس</p>
                <select name="gender" id="gender" class="form-control gender-select">
                    <option value="male">أنثى</option>
                    <option value="female">ذكر</option>
                </select>
            </div>
            <div class="col-md-6 mb-4">
                <p>البلد</p>
                <select name="country" id="country" class="form-control gender-select">
                </select>
            </div>
        </div>
        <p>البريد الإلكتروني</p>
        <input type="text" name="email" id="email" class="form-control text-box-signup" placeholder="أدخل البريد الإلكتروني الخاص بك">
        <p>كلمة المرور</p>
        <div class="input-group" id="show_hide_password" style="direction:ltr">
            <div class="input-group-prepend">
                <a href="" class="input-group-text"><i class="fas fa-eye" aria-hidden="false"></i></a>
            </div>
            <input type="password" name="password" id="pwd" class="form-control text-box-signup" style="direction:rtl" placeholder="أدخل كلمة المرور الخاصة بك">
        </div>
       
            <button id="signup-button" class="btn btn-outline-primary signup-btn mb-5 mt-5">تسجيل</button>
        </div>
</main>


<?php
require 'footer.php'
?>