function submitForm() {
    $("#error-div").css("color", "red");
    $("#error-div").html("");

    let username = $("#username").val();
    let password = $("#pwd").val();

    let _username = true;
    let _password = true;

    if (username.trim().length < 3 || username.indexOf(' ') != -1) {
        _username = false;
        $("#error-div").append('اسم المستخدم او البريد الالكتروني المدخل غير صالح. <br/>');
    }

    if (password.length < 6) {
        _password = false;
        $("#error-div").append('كلمة السر المدخلة غير صالحة.<br/>');
    }

    if (_username && _password) {
        $.ajax({
            type: 'POST',
            url: 'src/Controllers/AuthenticationController.php',
            datatype: 'text',
            data: 'fid=2&username='+username+"&password="+password,
            success: function (response) {
                var JsonArray = $.parseJSON(response);
                //alert("user " + JsonArray['user'] ); 
                //alert("pwd "+JsonArray['password']);
                if(JsonArray['user'] == 0){
                    $("#error-div").append('اسم المستخدم او البريد الالكتروني المدخل خاطئ. <br/>');
                }
                if(JsonArray['password'] == 0){
                    $("#error-div").append('كلمة السر المدخلة غير صحيحة. <br/>');
                }
                if(JsonArray['user']==1 && JsonArray['password']==1){
                    $(location).attr('href', './index.php')

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
}