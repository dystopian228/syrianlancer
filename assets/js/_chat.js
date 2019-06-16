var ownerID = "";
var userID = "";

$(document).ready(function () {

    $('#offerModal').modal('show');


    //freelancer_project 
    $.ajax({
        type: 'POST',
        url: 'src/Controllers/MessagesController.php',
        datatype: 'text',
        data: 'fid=1&freelancer_projects_id=' + freelancer_projects,
        success: function (response) {
            let arr = $.parseJSON(response);
            userID = arr['userID'];
            ownerID = arr['ownerID'];
            checkReceiver();
        },
        error: function (jqXHR, exception) {
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

    fetchMessages()
    setInterval(function () {
        fetchMessages();
    }, 2000);


    $("#send-message").click(function () {
        var msgContent = $("#message-content").val();
        if (msgContent.length == 0) {
            $("#text-error").html("لا يمكن إرسال رسالة فارغة.");
        } else if (msgContent.length > 1000) {
            $("#text-error").html("لا يجب أن يتجاوز طول الرسالة 1000 حرف.");
        } else {
            $("#text-error").html("");
            $("#message-content").val("");

            $.ajax({
                type: 'POST',
                url: 'src/Controllers/MessagesController.php',
                datatype: 'text',
                data: "fid=2&userID=" + userID + "&ownerID=" + ownerID + "&message=" + msgContent + "&freelancer_projects_id=" + freelancer_projects,
                success: function (response) {
                    $("#text-error").html(response);
                },
                error: function (jqXHR, exception) {
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
    });
    nameFlag = false;
    $("#handover-expand").click(function () {
        $("#send-message").toggle();
        nameFlag = !nameFlag;
        if (!nameFlag) {
            $("#handover-expand").html('تسليم المشروع');

        } else {
            $("#handover-expand").html('إرسال رسالة عادية');

        }
        $("#handover-div").toggle("fast", function () {});
    });

    $("#handover-project").click(function(){
        var msgContent = $("#message-content").val();
        if (msgContent.length == 0) {
            $("#text-error").html("لا يمكن إرسال رسالة فارغة.");
        } else if (msgContent.length > 1000) {
            $("#text-error").html("لا يجب أن يتجاوز طول الرسالة 1000 حرف.");
        } else {
            var noteContent = $("#notes").val();
            if(noteContent.length == 0 ){
                $("#notes-error").html("لا يمكن إدخال ملاحظة فارغة.");
            }else if (noteContent.length > 1000){
                $("#notes-error").html("لا يجب ان تتجاوز الملاحظة 1000 حرف.");
            }else{
                $('#handoverModal').modal('show');
            }
        }
    });

    $("#confirm-handover").click(function() { 
        var message = $("#message-content").val(); 
        var notes = $("#notes").val();

        $.ajax({
            type: 'POST',
                url: 'src/Controllers/ProjectController.php',
                datatype: 'text',
                data: "fid=8&freelancer_projects_id="+freelancer_projects+"&message="+message+"&notes="+notes+"&ownerID="+ownerID,
                success:function (response){
                    alert(response);
                    $('#handoverModal').modal('hide');
                    location.reload();
                },error:  function (jqXHR, exception) {
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
    });

});



function fetchMessages() {

    $.ajax({
        type: 'POST',
        url: 'src/Controllers/MessagesController.php',
        datatype: 'text',
        data: "fid=3&userID=" + userID + "&ownerID=" + ownerID + "&freelancer_projects_id=" + freelancer_projects,
        success: function (response) {
            $('#messages-content').html('');
            var arr = $.parseJSON(response);
            var tempID = arr[arr.length - 1]['senderID'];
            for (var i = 0; i < arr.length; i++) {
                var color;
                if (arr[i]['senderID'] == tempID)
                    color = "MEDIUMSEAGREEN";
                else
                    color = "darkorange";
                $("#messages-content").append('<div class="msg"><h4><b style="color:' + color + '">' + arr[i]['senderName'] + ' : </b>' + arr[i]['message'] + '</h4><h6 style="text-align:right">' + arr[i]['sentAT'] + '</h6> <hr class="mb-4"> </div>');
                //'<div><h6>'+arr[i]['senderName']+'</h6><br><h4>'+arr[i]['message']+'</h4><h6 style="text-align:left">'+arr[i]['sentAT']+'</h6> <hr class="mb-5"> </div>'
            }
        },
        error: function (jqXHR, exception) {
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

function checkReceiver() {
    $.ajax({
        type: 'POST',
        url: 'src/Controllers/MessagesController.php',
        datatype: 'text',
        data: 'fid=4&userID=' + userID + '&freelancer_projects_id=' + freelancer_projects,
        success: function (response) {
            if (response == 1) {
                $("#handover-expand").css("display", "inline");
            }
        },
        error: function (jqXHR, exception) {
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