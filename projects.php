<?php 
    require 'header.php';
?>

<main class="projects-main">
    <div class="container">
        <h2 class="display-4 mb-5 mt-5">الأعمال المفتوحة</h2>
        <div class="projects-panel">
            <form action="">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="cat1">
                            <label class="custom-control-label" for="cat1">أعمال وخدمات استشارية وإدارية</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="cat2">
                            <label class="custom-control-label" for="cat2">برمجة، تطوير المواقع والتطبيقات</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="cat3">
                            <label class="custom-control-label" for="cat3">تصميم وأعمال فنية وإبداعية</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="cat4">
                            <label class="custom-control-label" for="cat4">تسويق الكتروني ومبيعات</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="cat5">
                            <label class="custom-control-label" for="cat5">كتابة، تحرير، ترجمة ولغات</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="cat6">
                            <label class="custom-control-label" for="cat6">تدريب، تعليم ومساعدة عن بعد</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="cat7">
                            <label class="custom-control-label" for="cat7">أمور أخرى</label>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 form-inline active-primary active-primary-2 mt-2 mb-3">
                            <i class="fas fa-search ml-1" aria-hidden="true"></i>
                            <input class="form-control form-control-sm ml-3 w-75" type="text" placeholder="كلمات مفتاحية" aria-label="Search">
                    </div>
                    <div class="col-md-4 mb-3"></div>
                    <div class="col-md-4 mb-3">
                        <button type="button" class="btn btn-primary ripple" data-toggle="collapse" data-target="#filter-options" aria-expanded="false" aria-controls="filter-options"><i class="fas fa-caret-down ml-2"></i>خيارات اخرى</button>
                    </div>
                </div>
                <div class="collapse" id="filter-options">
                    <div class="row mb-3">
                        <div class="col-md-4 mb-3">
                            <h5>مدة العمل</h5>
                            <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="duration1">
                            <label class="custom-control-label" for="duration1">أقل من أسبوع</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="duration2">
                            <label class="custom-control-label" for="duration2">من أسبوع إلى شهر</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="duration3">
                            <label class="custom-control-label" for="duration3">من شهر إلى 3 أشهر</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="duration4">
                            <label class="custom-control-label" for="duration4">من 3 أشهر إلى 6 أشهر</label>
                        </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <h5>مزانية العمل</h5>
                            <input type="range" class="slider" id="balance-slider">
                        </div>
                        <div class="col-md-4 mb-3">
                            <h5>المهارات المطلوبة</h5>
                            <input class="form-control form-control-sm ml-3 w-100" type="text" placeholder="المهارة" aria-label="Search">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="projects-deck mb-5">
            <div class="card-deck mt-5">
                <div class="card project-card">
                    <div class="card-img-top project-banner d-flex flex-wrap align-content-center justify-content-center">مشروع تطبيق أندرويد</div>
                    <div class="card-body project-info">
                    <div class="d-flex justify-content-between mb-3">
                            <a href="#!" class="float-right">علي علاء الدين</a>
                            <a href="#!" class="float-left">تدريب، تعليم ومساعدة عن بعد</a>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                            <a href="#!" class="float-right">0 عروض</a>
                            <button type="button" class="btn btn-primary ripple float-left" data-toggle="collapse" data-target="#project-descript-1" aria-expanded="false" aria-controls="project-descript-1"><i class="fas fa-caret-down ml-2"></i>المزيد</button>
                    </div>
                    <div class="collapse" id="project-descript-1">
                        <p class="card-text text-center">
                            Some quick example text to build on the card title
                            and make up the bulk of the card's content.
                        </p>
                    </div>
                    </div>
                </div>
                <div class="card project-card">
                    <div class="card-img-top project-banner d-flex flex-wrap align-content-center justify-content-center">مشروع تطبيق أندرويد</div>
                    <div class="card-body project-info">
                        <div class="d-flex justify-content-between mb-3">
                            <a href="#!" class="float-right">مرهف شاكر</a>
                            <a href="#!" class="float-left">برمجة، تطوير المواقع والتطبيقات</a>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <a href="#!" class="float-right">8 عروض</a>
                            <button type="button" class="btn btn-primary ripple float-left" data-toggle="collapse" data-target="#project-descript-2" aria-expanded="false" aria-controls="project-descript-2"><i class="fas fa-caret-down ml-2"></i>المزيد</button>
                        </div>
                        <div class="collapse" id="project-descript-2">
                            <p class="card-text" >
                                Some quick example text to build on the card title
                                and make up the bulk of the card's content.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-deck mt-5">
                <div class="card project-card">
                    <div class="card-img-top project-banner d-flex flex-wrap align-content-center justify-content-center">مشروع تطبيق أندرويد</div>
                    <div class="card-body project-info">
                    <div class="d-flex justify-content-between mb-3">
                            <a href="#!" class="float-right">فاطمة الزهراء</a>
                            <a href="#!" class="float-left">تدريب، تعليم ومساعدة عن بعد</a>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <a href="#!" class="float-right">9 عروض</a>
                            <button type="button" class="btn btn-primary ripple float-left" data-toggle="collapse" data-target="#project-descript-3" aria-expanded="false" aria-controls="project-descript-3"><i class="fas fa-caret-down ml-2"></i>المزيد</button>
                        </div>
                        <div class="collapse" id="project-descript-3">
                            <p class="card-text" >
                                Some quick example text to build on the card title
                                and make up the bulk of the card's content.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card project-card">
                    <div class="card-img-top project-banner d-flex flex-wrap align-content-center justify-content-center">مشروع تطبيق أندرويد</div>
                    <div class="card-body project-info">
                        <div class="d-flex justify-content-between mb-3">
                            <a href="#!" class="float-right">مرهف شاكر</a>
                            <a href="#!" class="float-left">برمجة، تطوير المواقع والتطبيقات</a>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <a href="#!" class="float-right">8 عروض</a>
                            <button type="button" class="btn btn-primary ripple float-left" data-toggle="collapse" data-target="#project-descript-4" aria-expanded="false" aria-controls="project-descript-4"><i class="fas fa-caret-down ml-2"></i>المزيد</button>
                        </div>
                        <div class="collapse" id="project-descript-4">
                            <p class="card-text" >
                                Some quick example text to build on the card title
                                and make up the bulk of the card's content.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
    
<?php 
    require 'footer.php';
?>