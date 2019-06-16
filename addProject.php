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
                <input type="text" name="pName" id="pName" class="border border-warning form-control text-box-addProject" placeholder="">
                <label for="inputEmail4MD" class="margin-bottom-addProject">أدخل عنوانا لمشروعك</label>
                
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-6 mb-4">
                <p>المهارات المطلوبة</p>
                <select  id="category" name="category" class=" border border-warning text-box-addProject skills-select">
                    <option value="business">خدمات استشارية و إدارية</option>
                    <option value="programming"> برمجيات, تصميم مواقع وتطبيقات</option>
                    <option value="marketing">تسويق ومبيعات</option>
                    <option value="language"> كتابة وترجمة</option>
                    <option value="training"> تدريب, و تعليم عن بعد</option>
                    <option value="other"> أمور أخرى</option>
                </select>
                <label for="inputEmail4MD" class="margin-bottom-addProject">حدد المهارات المطلوبة لأداء مشروعك</label>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 md-form">
                <p>وصف المشروع</p>
                <textarea id="description" id ="description" class="border border-warning  md-textarea text-box-addProject " length="200" rows="8"></textarea>
                <label for="inputEmail4MD" class="margin-bottom-addProject">أكتب توصيفا لمشروعك</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <p>الميزانية</p>
                <select  id="palance" name="palance" class=" border border-warning text-box-addProject form-control skills-select">
                    <option value="15-25 ألف">15-25 ألف</option>
                    <option value="25-50 ألف"> 25-50 ألف</option>
                    <option value="50-125 ألف">50-125 ألف</option>
                    <option value="125-250 ألف"> 125-250 ألف</option>
                    <option value="250-400 ألف"> 250-400 ألف</option>
                    <option value="400-500 ألف"> 400-500 ألف</option>
                </select>
               
                <label for="inputEmail4MD" class="margin-bottom-addProject">اختر ميزانية تتناسب مع مشروعك</label>
            </div>
    
            <div class="col-md-6">
                <p>مدة التسليم</p>
                <input type="number" id="duration" class="border border-warning form-control " placeholder="">
                <label for="inputEmail4MD" class="margin-bottom-addProject">أدخل المدة الزمنية الكافية لعمل المشروع</label>
            </div>
        </div>
        
        <button id="addProject-button" class="btn btn-outline-primary addProject-btn mb-5 mt-5" onclick="addForm()">اضافة</button>
    </div>

</main>

<?php
require 'footer.php'
?>