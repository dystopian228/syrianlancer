<?php
require 'header.php';
if(!isset($_GET['id'])){ 
    header("Location: browse.php");
}else {
    echo '<script>loadProject('. $_GET['id'] . ')</script>';
}
?>

<main class="project-main invisible" id="cover">
    <div class="container">
        <div id="project-main-card" class="card p-5 mt-5">

        <div class="row">
        <div class="col-10 d-flex mb-3">
            <img id="project-avatar" src="./assets/images/placeholder.png" class="project-avatar mb-auto mt-auto ml-4">
            <h2 id="project-name" class="primary-dark mb-auto mt-auto"</h2>      
        </div>
        <div class="col-2 pull-2"><button id="edit-project" class="btn btn-primary ripple pull-left w-100">عدل</button></div>
        </div>
        <div class="row">
        <h6 class="card-subtitle col-10 mb-2 ml-2 text-muted"><span id="created_at"></span><span id="owner-name" class="ml-3"></span></h6> 
        </div>

        </div>
        <div class="card p-5 mt-5">
            <h3 class="card-title primary-dark">تفاصيل العمل</h3>
            <hr class="mb-5">
            <div class="card-text">
                <div class="row mb-5">
                    <div class="col-lg-4">
                        <span class="project-detail ml-3 primary-dark"> الميزانية:</span><span id="low-balance">25.00</span> - <span id="high-balance">100.00</span>
                    </div>
                    <div class="col-lg-3">
                        <span class="project-detail ml-3 primary-dark"> متوسط العروض:</span><span id="offer-average">25.00</span>
                    </div>
                    <div class="col-lg-3">
                        <span class="project-detail ml-3 primary-dark"> مدة التنفيذ:</span><span id="duration">25.00</span> 
                    </div>
                    <div class="col-lg-2">
                        <span class="project-detail ml-3 primary-dark"> عدد العروض:</span><span id="offer-count">25.00</span>
                    </div>
                </div>
                <p id="description" class="project-detail card-text">
                    Some quick example text to build on the card title
                    and make up the bulk of the card's content.
                </p>
                <hr>
                <div class="attached-files">
                    الملفات المرفقة: لا يوجد ملفات مرفقة.
                </div>
            </div>
        </div>

        <div id="add-offer-card" class="card p-5 mt-5">
            <h3 class="card-title primary-dark">أضف عرض للعمل</h3>
            <hr class="mb-5">
            <div class="card-text">
            <div id="alert-div">
            </div>
                <div class="row">
                    <div class="col-md-4 mb-4 pr-4 pl-4">
                        <label class="control-label" for="offer-duration"> مدة التسليم (أيام)<span style="color: red;">*</span></label>
                        <input type="number" name="offer-duration" id="offer-duration" class="form-control">
                        <div id="duration-error" class="error"></div>
                    </div>
                    <div class="col-md-4 mb-4 pr-4 pl-4">
                        <label class="control-label" for="price">المبلغ المطلوب<span style="color: red;">*</span></label>
                        <input type="number" name="price" id="price" class="form-control">
                        <div id="price-error" class="error"></div>
                    </div>
                    <div class="col-md-4 mb-4 pl-4 pr-4">
                        <label class="control-label" for="revenue">المبلغ المستحق</label>
                        <input type="number" name="revenue" id="revenue" class="form-control disabled" disabled>
                    </div>
                </div>
                <div class="row mb-4 pr-4 pl-4">
                    <label class="control-label" for="offer-details"> تفاصيل العرض<span style="color: red;">*</span></label>
                    <textarea name="offer-details" rows="10" id="offer-details" class="form-control"></textarea>
                    <div id="text-error" class="error"></div>
                </div>
                <div class="row mb-4 pr-4 pl-4">
                    <div class="col-md-4">
                        <button class="btn btn-primary ripple" id="add-offer" onclick="addOffer()">أضف العرض</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="offers-holder" class="card p-5 mt-5 mb-5">
            <h3 class="card-title primary-dark">العروض المقدمة</h3>
            <hr class="mb-5">
        </div>

    </div>
</main>

<?php
require 'footer.php'
?>