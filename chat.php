<?php

echo '<script> 
    var freelancer_projects = "'.$_GET['freelancer_projects'].'" 
</script>'; 

include 'header.php';

if(!isset($_SESSION['userID']))
{
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
                </div>
            </div>
            <?php 
                if(isset($_POST['freelancer_projects']))
                    echo '<p>Project</p>'; 
                if(isset($_POST['receiver']))
                    echo '<p>Personal</p>';
            ?>
        </div>


        <div class="col-md-12 mt-5 chat-panel">
            <h3 class="card-title primary-dark">الرسائل السابقة</h3>
            <hr class="mb-5">
            <div id="messages-content">
                <!-- 
                <div>
                    <h6>اسم</h6> 
                    <br>
                    <h4>
                        محتوى الرسالة
                    </h4>
                    <h6 style="text-align:left">TIMESTAMP</h6>
                    <hr class="mb-5">
                </div>
            -->
            </div>
        </div>

    </div>

</div>





<?php
include 'footer.php';
?>