<?php
include 'header.php';

if(!isset($_SESSION['userID']))
    header("Location: index.php");
?>



<div class="container dashboard-main ">

    <div class="row mx-5 mt-5 ">

        <div class="col-md card m-3 p-4 dashboard-panel">

            <h1>الرصيد المتوفر</h1>
            <hr>
            <h1 class="text-center"><span id="available-balance">0</span>$</h1>
        </div>

        <div class="col-md card m-3 p-4 dashboard-panel">

            <h1>الرصيد المعلق</h1>
            <hr>
            <h1 class="text-center"><span id="locked-balance">0</span>$</h1>
        </div>

    </div>


    <div class="row mx-5 mb-2 ">

        <div class="col-md card m-3 p-4 dashboard-panel">

            <h1>إضافة رصيد</h1>
            <hr>
            <p>تحويل مبلغ محدد من حسابك البنكي الى الرصيد المتوفر.</p>
            <input type="number" name="deposit-input" id="deposit-input" class="my-2 form-control" placeholder="أدخل المبلغ المراد إيداعه .." min="0" step="1">
            <p id="error-deposit" style="color:red"></p>
            <button id="deposit-button" class="btn btn-success ripple pull-left w-100" onclick="deposit()">
                إضافة رصيد 
            </button>
        </div>


        <div class="col-md card m-3 p-4 dashboard-panel">

            <h1>سحب الرصيد المتوفر</h1>
            <hr>
            <p>تحويل مبلغ محدد من الرصيد المتوفر الى حسابك البنكي.</p>
            <input type="number" name="withdraw-input" id="withdraw-input" class="my-2 form-control" placeholder="أدخل المبلغ المراد سحبه .." min="0" step="1" >
            <p id="error-withdraw" style="color:red"></p>
            <button id="withdraw-button" class="btn btn-info ripple pull-left w-100" onclick="withdraw()">
                سحب الرصيد المتوفر
            </button>
            

        </div>


    </div>


    <div class=" card dashboard-panel   " id="transactions-content">
        <div class="px-4 pt-4">
            <h3>عمليات التحويل السابقة </h3>
            <hr>
        </div>

        

       
        <div class="mx-2 px-2 mt-3 row">
            <h4 class="col-md withdraw-label">سحب</h4>
            <h4 class="col-md" >50.00$</h4>
            <h4 class="col-md">12-12-2019 20:00:00</h4>
        </div>
        <hr class="mx-4">

        <div class="mx-2 px-2 mt-3 row">
            <h4 class="col-md deposit-label" >إيداع</h4>
            <h4 class="col-md" >50.00$</h4>
            <h4 class="col-md">12-12-2019 20:00:00</h4>
        </div>
        <hr class="mx-4">
        </div>



</div>


<?php

include 'footer.php';

?>