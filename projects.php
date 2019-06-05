<?php 
    require 'header.php';
?>

<main class="projects-main">
    <div class="container">
        <h2 class="display-4 mb-5 mt-5">الأعمال المفتوحة</h2>
        <div class="projects-panel">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="business" class="custom-control-input" onChange=search(1) value ="business" id="cat1">
                            <label class="custom-control-label" for="cat1">أعمال وخدمات استشارية وإدارية</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="programming" class="custom-control-input" onChange=search(1) value="programming" id="cat2">
                            <label class="custom-control-label" for="cat2">برمجة، تطوير المواقع والتطبيقات</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="design" class="custom-control-input" onChange=search(1) value="design" id="cat3">
                            <label class="custom-control-label" for="cat3">تصميم وأعمال فنية وإبداعية</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="marketing" class="custom-control-input" onChange=search(1) value="marketing" id="cat4">
                            <label class="custom-control-label" for="cat4">تسويق الكتروني ومبيعات</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="language" class="custom-control-input" onChange=search(1) value="language" id="cat5">
                            <label class="custom-control-label" for="cat5">كتابة، تحرير، ترجمة ولغات</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="training" class="custom-control-input" onChange=search(1) value="training" id="cat6">
                            <label class="custom-control-label" for="cat6">تدريب، تعليم ومساعدة عن بعد</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="other" class="custom-control-input" onChange=search(1) value="other" id="cat7">
                            <label class="custom-control-label" for="cat7">أمور أخرى</label>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 form-inline active-primary active-primary-2 mt-2 mb-3">
                            <i class="fas fa-search ml-1" aria-hidden="true"></i>
                            <input class="form-control form-control-sm ml-3 w-75" type="text" id="keyword-search" placeholder="كلمات مفتاحية" onChange=search(1) aria-label="Search">
                    </div>
                    <div class="col-md-4 mb-3"></div>
                    <div class="col-md-4 mb-3"></div>
                </div>
                <div class="collapse" id="filter-options">
                    <div class="row mb-3">
                        <div class="col-md-4 mb-3">
                            <h5>مدة العمل</h5>
                            <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" value="0-6" onChange=search(1) id="duration1">
                            <label class="custom-control-label"  for="duration1">أقل من أسبوع</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" value="7-30" onChange=search(1) id="duration2">
                            <label class="custom-control-label" for="duration2">من أسبوع إلى شهر</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" value="31-90" onChange=search(1) id="duration3">
                            <label class="custom-control-label" for="duration3">من شهر إلى 3 أشهر</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" value="91-180" onChange=search(1) id="duration4">
                            <label class="custom-control-label" name="90-180" for="duration4">من 3 أشهر إلى 6 أشهر</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" value="181-365" onChange=search(1) id="duration5">
                            <label class="custom-control-label" name="181-365" for="duration5">من 6 أشهر إلى سنة</label>
                        </div>
                        </div>
                        <div class="col-md-8 mb-3">
                            <h5 >مزانية العمل</h5>
                            <div>
                            <div class="d-flex">
                            <output class="pull-right" for="balance-slider" id="balance-value">0</output>
                             </div>
                                <input type="range" class="slider w-75" name="balance" id="balance-slider" onChange=search(1) oninput="outputUpdate(value)" min="0" max="5000" value="0" step="5" data-ui="balance">
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                       </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-8"></div>
                    <div class="col-md-4">
                    <button type="button" class="btn btn-primary ripple" id="more-icon" data-toggle="collapse" data-target="#filter-options" aria-expanded="false" aria-controls="filter-options"><i class="fas fa-caret-down ml-2"></i>خيارات اخرى</button>
                    </div>
                </div>
        </div>
        <div class="projects-deck mb-5" id="project-deck">
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination d-flex justify-content-center" id="project-pages">
            </ul>
        </nav>
    </div>
</main>
    
<?php 
    require 'footer.php';
?>