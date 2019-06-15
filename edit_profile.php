<?php
require 'header.php';
if(!isset($_SESSION['userID'])){ 
    header("Location: index.php");
}
?>
<main class="edit-profile-main">
    <div class="container">
    <h3 class="display-4 mb-5 mt-5">تعديل المعلومات الشخصية</h3>
    <div class="projects-panel mb-3 ml-5 mr-5">
        <div id="alert-div">
        </div>
        <div class="image-upload center">
            <label for="image-input">
                <img id="profile-avatar" src="" class="profile-img cent mb-5" onerror="this.src='./assets/images/placeholder.png'">
            </label>
            <input type="file" name="image" id="image-input">
        </div>
        <div class="profile-edit-info">
                <div class="row ml-5 mr-5">
                    <div class="col-md-6 mb-4">
                        <label class="control-label" for="firstName">الأسم الأول<span style="color: red;">*</span></label>
                        <input type="text" name="first_name" id="firstName" class="form-control">
                        <div id="first-name-error" class="error"></div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="control-label" for="lastName">الكنية<span style="color: red;">*</span></label>
                        <input type="text" name="last_name" id="lastName" class="form-control">
                        <div id="last-name-error" class="error"></div>
                    </div>
                </div>
                <div class="row ml-5 mr-5">
                    <div class="col-md-6 mb-4">
                        <label class="control-label" for="country">البلد<span style="color: red;">*</span></label>
                        <select name="country" id="country" class="form-control gender-select">
                        </select>
                        <div id="country-error" class="error"></div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="control-label" for="birthDate">تاريخ الميلاد<span style="color: red;">*</span></label>
                        <input class="form-control" id="birthDate" name="date" placeholder="YYYY-MM-DD" type="text"/>
                        <div id="birthdate-error" class="error"></div>
                    </div>
                </div>
                <div class="row ml-5 mr-5">
                    <div class="col-md-6 mb-4">
                        <label class="control-label" for="gender">الجنس<span style="color: red;">*</span></label>
                        <select name="gender" id="gender" class="form-control gender-select">
                            <option value="female">أنثى</option>
                            <option value="male">ذكر</option>
                        </select>
                        <div id="gender-error" class="error"></div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="control-label" for="mainFocus">مجال العمل</label>
                        <select name="mainFocus" id="mainFocus" class="form-control gender-select">
                        <option value="business">أعمال وخدمات استشارية وإدارية</option>
                        <option value="marketing">تسويق الكتروني ومبيعات</option>
                        <option value="programming">برمجة، تطوير المواقع والتطبيقات</option>
                        <option value="language">كتابة، تحرير، ترجمة ولغات</option>
                        <option value="design">تصميم وأعمال فنية وإبداعية</option>
                        <option value="training">تدريب، تعليم ومساعدة عن بعد</option>
                        <option value="business">أمور أخرى</option>
                        </select>
                        <div id="mainFocus-error" class="error"></div>
                    </div>
                </div>
                <div class="row ml-5 mr-5">
                    <div class="col-md-12 mb-4">
                    <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" value=0 id="isFreelancer">
                            <label class="custom-control-label"  for="isFreelancer">مستقل؟ <small> (ستعرض صفحتك على صفحة تصفح المستقلين ان كنت مختار هذا الخيار)</small></label>
                        </div>
                    </div>
                </div>
                <div class="row ml-5 mr-5">
                    <div class="col-md-12 mb-4 mt-4">
                    <a href="#!" data-toggle="collapse" data-target="#password-change" aria-expanded="false" aria-controls="password-change">تغيير كلمة السر</a>
                    </div>
                </div>
                <div class="collapse mx-4" id="password-change">
                    <div class="row ml-5 mr-5">
                        <div class="col-md-12 mb-4">
                            <label class="control-label" for="current-password">كلمة السر الحالية</label>
                            <input type="password" name="current-password" id="current-password" class="form-control">
                            <div id="current-pass-error" class="error"></div>
                        </div>
                    </div>
                    <div class="row ml-5 mr-5">
                        <div class="col-md-12 mb-4">
                            <label class="control-label" for="new-password">كلمة السر الجديدة</label>
                            <input type="password" name="new-password" id="new-password" class="form-control">
                            <div id="new-pass-error" class="error"></div>
                        </div>
                    </div>
                    <div class="row ml-5 mr-5">
                        <div class="col-md-12 mb-4">
                            <label class="control-label" for="confirm-password">تأكيد كلمة السر</label>
                            <input type="password" name="confirm-password" id="confirm-password" class="form-control">
                            <div id="confirm-pass-error" class="error"></div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button id="edit-button" class="btn btn-primary ripple mb-5 mt-5 p-3" onclick="editForm()">تثبيت المعلومات</button>
                </div>
        </div>
    </div>
    </div>
</main>
<?php
require 'footer.php';
?>