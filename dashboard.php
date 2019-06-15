<?php
include 'header.php';
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
            <button id="deposit-button" class="btn btn-success ripple pull-left w-100">
                إضافة رصيد 
            </button>
        </div>


        <div class="col-md card m-3 p-4 dashboard-panel">

            <h1>سحب الرصيد المتوفر</h1>
            <hr>
            <p>تحويل مبلغ محدد من الرصيد المتوفر الى حسابك البنكي.</p>
            <button id="withdraw-button" class="btn btn-info ripple pull-left w-100">
                سحب الرصيد المتوفر
            </button>
            

        </div>


    </div>


    <div class="row card dashboard-panel   ">
        <div class="p-2 l">
            <h3>عمليات التحويل السابقة </h3>
            <hr>
        </div>

        <div class="m-2 p-2 ">
            <h3></h3>
            <hr>
        </div>

    </div>

</div>


<?php

include 'footer.php';

?>