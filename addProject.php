<?php
require 'header.php';
if(!isset($_SESSION['userID'])){ 
    header("Location: signup.php");
}
?>
<main class="addProject-main">
    <div id="addP-form" class="addProject-div col-md-6 col-centered ">
        <h1 class="mt-5 mb-5">أضف مشروع</h1>
        </h1>
        <div class="row">
            <div class="col-md-6">
                <p>عنوان المشروع</p>
                <input type="text" name="pName" id="pName" class="form-control text-box-addProject" placeholder="">
                <label for="pName" class="margin-bottom-addProject">أدخل عنوانا لمشروعك</label>
                
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-6 mb-4">
                <p>المهارات المطلوبة</p>
                <select  id="category" name="category" class="form-control text-box-addProject">
                    <option value="business">خدمات استشارية و إدارية</option>
                    <option value="programming"> برمجيات, تصميم مواقع وتطبيقات</option>
                    <option value="marketing">تسويق ومبيعات</option>
                    <option value="language"> كتابة وترجمة</option>
                    <option value="training"> تدريب, و تعليم عن بعد</option>
                    <option value="other"> أمور أخرى</option>
                </select>
                <label for="category" class="margin-bottom-addProject">حدد المهارات المطلوبة لأداء مشروعك</label>
            </div>
            <div class="col-md-6">
                <p>مدة التسليم</p>
                <input type="number" id="duration" class="form-control " placeholder="">
                <label for="duration" class="margin-bottom-addProject">أدخل المدة الزمنية الكافية لعمل المشروع</label>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 md-form">
                <p>وصف المشروع</p>
                <textarea id="description" id ="description" class="form-control text-box-addProject" length="200" rows="8"></textarea>
                <label for="description" class="margin-bottom-addProject">أكتب توصيفا لمشروعك</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <p>احد الأدنى للميزانية</p>
                <input type="number" id="low-balance" class="form-control " placeholder="">
                <label for="low-balance" class="margin-bottom-addProject">أدخل الحد الأدنى للميزانية</label>
            </div>
            <div class="col-md-6">
                <p>احد الأعلى للميزانية</p>
                <input type="number" id="high-balance" class="form-control " placeholder="">
                <label for="high-balance" class="margin-bottom-addProject">أدخل الحد الأعلى للميزانية</label>
            </div>
        </div>
        
        <div id="error-div" class="pull-right mt-5"></div>


        <button id="addProject-button" class="btn btn-outline-primary addProject-btn mb-5 mt-5" onclick="addForm()">اضافة</button>
    </div>

</main>

<?php
require 'footer.php'
?>