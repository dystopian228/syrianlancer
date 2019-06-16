<?php

echo '<script> 
    var freelancer_projects = "' . $_GET['freelancer_projects'] . '"; 
</script>';

include 'header.php';

if (!isset($_SESSION['userID'])) {
    header("Location: index.php");
}

?>



<div class="container-fluid chat-main">

    <div class="row m-5">

        <div class="col-md-12 chat-panel">
            <h3 class="card-title primary-dark">أرسل رسالة</h3>
            <hr class="mb-5">
            <div class="row mb-4 pr-4 pl-4">
                <textarea name="message-content" rows="10" id="message-content" class="form-control"></textarea>
                <div id="text-error" class="error"></div>
            </div>
            <div class="row mb-4 pr-4 pl-4">
                <div class="col-md-4">
                    <button class="btn btn-primary ripple" id="send-message">إرسال</button>
                    <button class="btn btn-primary ripple" id="handover-expand" style="display:none">تسليم المشروع</button>
                </div>
            </div>
            <div id="handover-div" class="m-3 p-3 row" style="display:none;background-color:rgba(255,255,255,0.6)">
             
     
                <div class="col-md-6">
                    <h4 class="mt-2">ارفع ملفات المشروع</h4>
                    <label class="btn btn-info">
                        تصفح الملفات <input type="file" style="display: none;">
                    </label>
                </div>

                <div class="col-md-6">
                    <label for="notes" >
                        <h4>ملاحظات إضافية</h4>
                    </label>
                    <input type="text" name="notes" id="notes" class="form-control">
                    <p id="notes-error" style="color:darkred;"></p>
                    <br>
                </div>


                <button class="btn btn-primary ripple" id="handover-project">تسليم</button>
            </div>

        </div>


        <div class="col-md-12 mt-5 chat-panel">
            <h3 class="card-title primary-dark">الرسائل السابقة</h3>
            <hr class="mb-5">
            <div id="messages-content">
               
            </div>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="handoverModal" tabindex="-1" role="dialog" aria-labelledby="handovermodal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title pull-right" id="handovermodal">هل أنت متأكد ان هذه الرسالة تحتوي على جميع المعلومات اللازمة لتسليم المشروع؟</h5>
                    <button type="button" class="close pull-left" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary ml-2" data-dismiss="modal">اغلق</button>
                    <button type="button" class="btn btn-primary" id="confirm-handover">متأكد</button>
                </div>
            </div>
        </div>
    </div>
</div>





<?php
include 'footer.php';
?>