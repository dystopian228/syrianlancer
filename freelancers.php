<?php
require 'header.php';
?>

<div class="freelancers-main container">

    <div class=" mb-5 mt-5">
        <h2 class="display-4 mb-5">وظّف مستقلين</h2>
        <div class="freelancers-panel">
            <div class="row">
                <div class="col-md-6">
                    <h3 class='mb-4'>الاسم</h3>
                    <div class="col-md-12 form-inline active-primary active-primary-2 mt-2 mb-3">
                        <i class="fas fa-search ml-1" aria-hidden="true"></i>
                        <input class="form-control form-control-sm ml-3 w-75" type="text" id="name-search" placeholder="اسم المستقل" onChange=search(1) aria-label="Search">
                    </div>
                </div>
                <div class="col-md-6">
                    <h3 class='mb-4'>التقييم</h3>
                    <div class="row">
                        <div class="mb-3 col-md-3 custom-control custom-radio">
                            <input type="radio" checked="true" name="rating" class="custom-control-input" onChange=search(1) value="0" id="rating-all">
                            <label class="custom-control-label" for="rating-all">الكل</label>
                        </div>
                        <div class="mb-3 col-md-3 custom-control custom-radio">
                            <input type="radio" name="rating" class="custom-control-input" onChange=search(1) value="3" id="rating-3">
                            <label class="custom-control-label" for="rating-3">+3</label>
                        </div>
                        <div class="mb-3 col-md-3 custom-control custom-radio">
                            <input type="radio" name="rating" class="custom-control-input" onChange=search(1) value="4" id="rating-4">
                            <label class="custom-control-label" for="rating-4">+4</label>
                        </div>
                        <div class="mb-3 col-md-3 custom-control custom-radio">
                            <input type="radio" name="rating" class="custom-control-input" onChange=search(1) value="5" id="rating-5">
                            <label class="custom-control-label" for="rating-5">5</label>
                        </div>
                    </div>
                </div>
                </div>

                <h3 class='mb-4 mt-4'>مجال العمل</h3>
                <div class="row">
                        <div class="mb-3 col-md-4 custom-control custom-radio">
                            <input type="radio" checked="true" name="main_focus" class="custom-control-input" onChange=search(1) value="" id="main_focus_all">
                            <label class="custom-control-label" for="main_focus_all">الكل</label>
                        </div>
                        <div class="mb-3 col-md-4 custom-control custom-radio">
                            <input type="radio" name="main_focus" class="custom-control-input" onChange=search(1) value="business" id="main_focus1">
                            <label class="custom-control-label" for="main_focus1">أعمال وخدمات استشارية وإدارية</label>
                        </div>
                        <div class="mb-3 col-md-4 custom-control custom-radio">
                            <input type="radio" name="main_focus" class="custom-control-input" onChange=search(1) value="programming" id="main_focus2">
                            <label class="custom-control-label" for="main_focus2">برمجة، تطوير المواقع والتطبيقات</label>
                        </div>
                        <div class="mb-3 col-md-4 custom-control custom-radio">
                            <input type="radio" name="main_focus" class="custom-control-input" onChange=search(1) value="design" id="main_focus3">
                            <label class="custom-control-label" for="main_focus3">تصميم وأعمال فنية وإبداعية</label>
                        </div>
                        <div class="mb-3 col-md-4 custom-control custom-radio">
                            <input type="radio" name="main_focus" class="custom-control-input" onChange=search(1) value="marketing" id="main_focus4">
                            <label class="custom-control-label" for="main_focus4">تسويق الكتروني ومبيعات</label>
                        </div>
                        <div class="mb-3 col-md-4 custom-control custom-radio">
                            <input type="radio" name="main_focus" class="custom-control-input" onChange=search(1) value="language" id="main_focus5">
                            <label class="custom-control-label" for="main_focus5">كتابة، تحرير، ترجمة ولغات</label>
                        </div>
                        <div class="mb-3 col-md-4 custom-control custom-radio">
                            <input type="radio" name="main_focus" class="custom-control-input" onChange=search(1) value="training" id="main_focus6">
                            <label class="custom-control-label" for="main_focus6">تدريب، تعليم ومساعدة عن بعد</label>
                        </div>
                        <div class="mb-3 col-md-4 custom-control custom-radio">
                            <input type="radio" name="main_focus" class="custom-control-input" onChange=search(1) value="other" id="main_focus7">
                            <label class="custom-control-label" for="main_focus7">أمور أخرى</label>
                        </div>
                    </div>
        </div>
    </div>

    <div class="mb-5 container">
        <div class="row" id="freelancers-deck">

        </div>
    </div>


    <nav aria-label="Page navigation example">
        <ul class="pagination d-flex justify-content-center" id="freelancers-pages">

        </ul>
    </nav>

</div>

<?php
require 'footer.php';
?>