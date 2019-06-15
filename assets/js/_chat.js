var ownerID = "";
var userID = "";

$(document).ready(function () {


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


    $("#send-message").click(function(){
        var msgContent= $("#message-content").val();
        if(msgContent.length==0){
            $("#text-error").html("لا يمكن إرسال رسالة فارغة.");
        }
        else{
            $("#text-error").html("");
            $("#message-content").val("");

            $.ajax({
                type:'POST',
                url:'src/Controllers/MessagesController.php',
                datatype:'text',
                data:"fid=2&userID="+userID+"&ownerID="+ownerID+"&message="+msgContent+"&freelancer_projects_id="+freelancer_projects,
                success: function(response){
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


});

function fetchMessages() {

    $.ajax({
        type:'POST',
        url:'src/Controllers/MessagesController.php',
        datatype:'text',
        data:"fid=3&userID="+userID+"&ownerID="+ownerID+"&freelancer_projects_id="+freelancer_projects,
        success: function(response){
            $('#messages-content').html('');
            var arr = $.parseJSON(response);
            var tempID = arr[arr.length-1]['senderID'];
            for(var i=0;i<arr.length;i++){
                var color;
                if(arr[i]['senderID']==tempID)
                    color="MEDIUMSEAGREEN";
                else
                    color="darkorange";
                $("#messages-content").append('<div class="msg"><h4><b style="color:'+color+'">'+arr[i]['senderName']+' : </b>'+arr[i]['message']+'</h4><h6 style="text-align:right">'+arr[i]['sentAT']+'</h6> <hr class="mb-4"> </div>');
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

