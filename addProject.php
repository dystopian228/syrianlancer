<?php
require 'header.php';
if(isset($_SESSION['userID'])){ 
    header("Location: profile.php");
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
                <select  id="skills" class=" border border-warning text-box-addProject skills-select">
                    <option value="">خدمات استشارية و إدارية</option>
                    <option value=""> برمجيات, تصميم مواقع وتطبيقات</option>
                    <option value="">تسويق ومبيعات</option>
                    <option value=""> كتابة وترجمة</option>
                    <option value=""> أمور أخرى</option>
                </select>
                <label for="inputEmail4MD" class="margin-bottom-addProject">حدد المهارات المطلوبة لأداء مشروعك</label>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 md-form">
                <p>وصف المشروع</p>
                <textarea id="textarea-char-counter" class="border border-warning  md-textarea text-box-addProject " length="200" rows="8"></textarea>
                <label for="inputEmail4MD" class="margin-bottom-addProject">أكتب توصيفا لمشروعك</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <p>الميزانية</p>
                <input type="text"  id="pName" class="border border-warning form-control  " placeholder="">
                <label for="inputEmail4MD" class="margin-bottom-addProject">أدخل ميزانية تتناسب مع مشروعك</label>
            </div>
    
            <div class="col-md-6">
                <p>مدة التسليم</p>
                <input type="text"  id="pName" class="border border-warning form-control " placeholder="">
                <label for="inputEmail4MD" class="margin-bottom-addProject">أدخل المدة الزمنية الكافية لعمل المشروع</label>
            </div>
        </div>
        
        <button id="addProject-button" class="btn btn-outline-primary addProject-btn mb-5 mt-5" onclick="submitForm()">اضافة</button>
    </div>

</main>

<?php
require 'footer.php'
?>