$(document).ready(function () {

    //Populate countries list with items 
    $.ajax({
        type: 'GET',
        url: 'includes/_signup_load.php',
        datatype: 'text',
        data: "",
        success: function (response) {
            var JsonArray = $.parseJSON(response);
            for (var i = 0; i < JsonArray.length; i++) {
                $("#country").append('<option value="' + (i + 1) + '">' + JsonArray[i] + '</option>');
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


    //Password hide/show button
    $("#show_hide_password a").on('click', function (event) {
        event.preventDefault();
        if ($('#show_hide_password input').attr("type") == "text") {
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password SVG').attr('data-icon', 'eye');
        } else if ($('#show_hide_password input').attr("type") == "password") {
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password SVG').attr('data-icon', 'eye-slash');
        }
    });

    //Birth Date datepicker sript
    $(document).ready(function () {
        var date_input = $('input[name="date"]'); //our date input has the name "date"
        var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
        var options = {
            format: 'yyyy-mm-dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
            endDate: "today"
        };
        date_input.datepicker(options);
    });

});

function validateForm() {

}

function submitForm() {

    $("#error-div").css("color", "red");
    $("#error-div").html("");


    //Values
    let userName = $("#username").val();
    let lastName = $("#lName").val();
    let firstName = $("#fName").val();
    let password = $("#pwd").val();
    let email = $("#email").val();
    let birthDate = $("#date").val();
    let country = $("#country").val();
    let gender = $("#gender").val();

    //Flags 
    let _userName = true;
    let _email = true;
    let _firstName = true;
    let _lastName = true;
    let _password = true;
    let _birthDate = true;

    if (userName.trim().length < 3 || userName.indexOf(' ') != -1) {
        _userName = false;
        $("#error-div").append("اسم المستخدم يجب أن يكون كلمة واحدة طولها ثلاثة أحرف على الأقل. </br>");
    }

    if (firstName.trim().length < 3) {
        _firstName = false;
        $("#error-div").append("الاسم الاول يجب ان يتكون من ثلاثة احرف على الأقل. </br>");

    }

    if (lastName.trim().length < 3) {
        _lastName = false;
        $("#error-div").append("الكنية يجب ان تتكون من ثلاثة احرف على الأقل. </br>");

    }

    if (birthDate.length < 10) {
        _birthDate = false;
        $("#error-div").append("الرجاء إدخال تاريخ الميلاد. </br>");

    }

    if (password.length < 6) {
        _password = false;
        $("#error-div").append("كلمة السر يجب ان تتكون من ستة أحرف على الأقل. </br>");

    }

    if (!emailIsValid(email.trim())) {
        _email = false;
        $("#error-div").append("البريد الإلكتروني غير صالح. </br>");

    }

    if (_userName && _email && _birthDate && _firstName && _lastName && _password) {
        $.ajax({
            type: 'POST',
            url: 'includes/_signup_submit.php',
            datatype: 'text',
            data: "userName=" + userName + "&email=" + email + "&firstName=" + firstName + "&lastName=" + lastName + "&password=" + password + "&birthDate=" + birthDate + "&countryID=" + country + "&gender=" + gender,
            success: function (response) {
                //$("#error-div").append(response);

                var JsonArray = $.parseJSON(response);
     
                //$("#error-div").append(JsonArray['success'] );
                if (JsonArray['userName'] == '1')
                    $("#error-div").append('اسم المستخدم المدخل غير متوفر , الرجاء إدخال اسم آخر. </br>');
                if (JsonArray['email'] == '1')
                    $("#error-div").append('البريد الالكتروني المدخل تابع لحساب اخر, الرجاء إدخال بريد إلكتروني جديد أو <a href="./login.php">تسجيل الدخول</a> </br>');
                if (JsonArray['success'] == '1') {
                    $("#reg-form").hide(250);
                    $("#reg-done").show(250);
                    
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

function emailIsValid(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)
}