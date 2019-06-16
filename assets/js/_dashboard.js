$(document).ready(function () {
    fetchValues();
    fetchTransactions();
});


function fetchValues(){
    $.ajax({
        type:'POST',
        url:'src/Controllers/FinancialController.php',
        datatype:'text',
        data:"fid=1",
        success:function(response){
            let arr = $.parseJSON(response);
            $("#available-balance").html(arr['total']-arr['locked']);
            $("#locked-balance").html(arr['locked']);
        },
        error:function (jqXHR, exception) {
            var msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connect.\n Verify Network.';
            } else if (jqXHR.status == 404) {
                msg = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                msg = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error.';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            alert(msg);
        }
    });
}

function fetchTransactions(){
    $.ajax({
        type:'POST',
        url:'src/Controllers/FinancialController.php',
        datatype:'text',
        data:"fid=2",
        success:function(response){
            let arr = $.parseJSON(response);
            $("#transactions-content").html('<div class="px-4 pt-4"><h3>عمليات التحويل السابقة </h3><hr></div>');
            for(var i=0;i<arr.length;i++){
                if(arr[i]['type']==1){
                    //deposit
                    $("#transactions-content").append('<div class="mx-2 px-2 mt-3 row"> <h4 class="col-md deposit-label" >إيداع</h4><h4 class="col-md" >'+arr[i]['amount']+'$</h4><h4 class="col-md">'+arr[i]['timestamp']+'</h4></div><hr class="mx-4">');
                    
                    
                }
                else{
                    //withdraw
                    $("#transactions-content").append('<div class="mx-2 px-2 mt-3 row"><h4 class="col-md withdraw-label">سحب</h4><h4 class="col-md" >'+arr[i]['amount']+'$</h4><h4 class="col-md">'+arr[i]['timestamp']+'</h4></div><hr class="mx-4">');

                }
            }
        },
        error:function (jqXHR, exception) {
            var msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connect.\n Verify Network.';
            } else if (jqXHR.status == 404) {
                msg = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                msg = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error.';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            alert(msg);
        }
    });

}

function deposit(){
    let amount = $("#deposit-input").val();
    if(amount==""){
        $("#error-deposit").html("الرجاء ادخال قيمة الرصيد المراد إيداعه.");
    }
    else{
        $.ajax({type:'POST',
        url:'src/Controllers/FinancialController.php',
        datatype:'text',
        data:"fid=3&amount="+amount,
        success:function(response){
            if(response!=11){
                $("#error-deposit").html("حدث خطأ, الرجاء المحاولة لاحقا.");        
            }   
            else{
                $("#error-deposit").html('');                        
                $("#deposit-input").val('');
                fetchValues();
                fetchTransactions();
            }
        },
        error:function (jqXHR, exception) {
            var msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connect.\n Verify Network.';
            } else if (jqXHR.status == 404) {
                msg = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                msg = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error.';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            alert(msg);
        }});
    }
}

function withdraw(){
    let amount = $("#withdraw-input").val();
    if(amount==""){
        $("#error-withdraw").html("الرجاء ادخال قيمة الرصيد المراد سحبه.");
    }
    else{
        $.ajax({type:'POST',
        url:'src/Controllers/FinancialController.php',
        datatype:'text',
        data:"fid=4&amount="+amount,
        success:function(response){
            if(response!=11){
                $("#error-withdraw").html("حدث خطأ, الرجاء المحاولة لاحقا.");        
            }   
            else{
                $("#error-withdraw").html('');                        
                $("#withdraw-input").val('');
                fetchValues();
                fetchTransactions();
            }
        },
        error:function (jqXHR, exception) {
            var msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connect.\n Verify Network.';
            } else if (jqXHR.status == 404) {
                msg = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                msg = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error.';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            alert(msg);
        }});
    }
}

