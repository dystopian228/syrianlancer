$(document).ready(function () {

    //Populate countries list with items 
    $.ajax({
        type: 'GET',
        url: 'src/Controllers/LoadingController.php',
        datatype: 'text',
        data: "fid=1",
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

    //Populate user data fields. 
    $.ajax({
        type: 'GET',
        url: 'src/Controllers/ProfileController.php',
        datatype: 'text',
        data: "fid=1",
        success: function (response) {
            var JsonObject = $.parseJSON(response);
            $("#profile-avatar").attr("src", JsonObject.image);
            $("#firstName").val(JsonObject.first_name);
            $("#lastName").val(JsonObject.last_name);
            $("#country").val(JsonObject.country_id);
            $("#birthDate").val(JsonObject.birth_date);
            $("#gender").val(JsonObject.gender);
            $("#mainFocus").val(JsonObject.main_focus);
            if (JsonObject.isfreelancer == 1)
                $("#isFreelancer").prop('checked', true);
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


    //Upload Image Script 
    $(document).on('change', '#image-input', function () {
        var img = document.getElementById("image-input").files[0];
        var imgName = img.name;
        var imgExt = imgName.split('.').pop().toLowerCase();
        if ($.inArray(imgExt, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
            $("#alert-div").html("<div class=\"alert alert-danger mb-5\" role=\"alert\">صيغة الملف غير صحيحة , الصيغ المسموحة : (gif, png, jpg, jpeg).</div>");
        } else {
            var imgSize = img.size;
            if (imgSize > 2000000) {
                $("#alert-div").html("<div class=\"alert alert-danger mb-5\" role=\"alert\">حجم الصورة المدخلة أكبر من الحد المسموح (2MB).</div>");
            } else {
                var formData = new FormData();
                formData.append("file", img);
                formData.append("idd", "Ali");
                $.ajax({
                    url: 'src/Controllers/ImagesController.php',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (response) {
                        var arr = $.parseJSON(response);
                        if (arr['sql'] == 1 && arr['img'] == 1) {
                            $("#alert-div").html("<div class=\"alert alert-success mb-5\" role=\"alert\">تم تعديل صورتك الشخصية بنجاح.</div>");
                            $("#profile-avatar").attr("src", arr['img_location']);

                        } else {
                            $("#alert-div".html("<div class=\"alert alert-danger mb-5\" role=\"alert\">حصل خطأ. الرجاء المعاودة لاحقا.</div>"))
                        }
                    }
                });
            }
        }
    });

});

function editForm() {

    let firstName = $("#firstName").val();
    let lastName = $("#lastName").val();
    let country = $("#country").val();
    let gender = $("#gender").val();
    let birthDate = $("#birthDate").val();
    let currentPassword = $("#current-password").val();
    let newPassword = $("#new-password").val();
    let confirmPassword = $("#confirm-password").val();
    let mainFocus = $("#mainFocus").val();
    let isFreelancer = 0;
    if ($("#isFreelancer").prop("checked"))
        isFreelancer = 1;


    let _firstName = true;
    let _lastName = true;
    let _country = true;
    let _gender = true;
    let _mainFocus = true;
    let _birthDate = true;
    let _passwordChange = false;
    let _newPassword = true;
    let _confirmPassword = true;
    let _passError = false;

    if (firstName.trim().length < 3) {
        _firstName = false;
        $("#first-name-error").html("الاسم الاول يجب ان يتكون من ثلاثة احرف على الأقل.");

    }

    if (lastName.trim().length < 3) {
        _lastName = false;
        $("#last-name-error").html("الكنية يجب ان تتكون من ثلاثة احرف على الأقل.");

    }

    if (birthDate.length < 10) {
        _birthDate = false;
        $("#birthdate-error").html("الرجاء إدخال تاريخ الميلاد.");
    }

    if (country < 1 && country > 22) {
        _country = false;
        $("#birthdate-error").html("الرجاء اختيار البلد.");
    }

    if (gender > 2 && gender < 1) {
        _gender = false;
        $("#gender-error").html("الرجاء اختيار الجنس.");

    }

    if (newPassword.length > 0 && newPassword.length < 6) {
        _newPassword = false;
        $("#new-pass-error").html("كلمة السر يجب ان تتكون من ستة أحرف على الأقل.");
        if (currentPassword.length <= 0) {
            $("#current-pass-error").html("أدخل كلمة المرور الحالية.");
            _passError = true;
        }
        _passError = true;
    } else {
        if (confirmPassword != newPassword) {
            _confirmPassword = false;
            $("#confirm-pass-error").html("كلمة المرور غير متطابقة.");
            if (currentPassword.length <= 0) {
                $("#current-pass-error").html("أدخل كلمة المرور الحالية.");
                _passError = true;
            }
            _passError = true;
        } else {
            if (newPassword.length != 0)
                _passwordChange = true;
        }

    }
    if (_passwordChange && currentPassword.length >= 0 && currentPassword.length < 6) {
        $("#current-pass-error").html("تأكد من كلمة المرور الحالية.");
        _passError = true;
    }

    if (_birthDate && _firstName && _lastName && _country && _gender) {
        if (_passwordChange && !_passError) {
            data = "fid=2&firstName=" + firstName.trim() + "&lastName=" + lastName.trim() + "&birth_date=" + birthDate + "&newPassword=" + newPassword + "&currentPassword=" + currentPassword + "&birthDate=" + birthDate + "&countryID=" + country + "&gender=" + gender + "&main_focus=" + mainFocus + "&isfreelancer=" + isFreelancer;
        } else {
            data = "fid=2&firstName=" + firstName.trim() + "&lastName=" + lastName.trim() + "&birth_date=" + birthDate + "&countryID=" + country + "&gender=" + gender + "&main_focus=" + mainFocus + "&isfreelancer=" + isFreelancer;
        }
        if (!_passError) {
            $.ajax({
                type: 'POST',
                url: 'src/Controllers/ProfileController.php',
                datatype: 'text',
                data: data,
                success: function (response) {
                    $("#alert-div").html("");
                    var JsonArray = $.parseJSON(response);
                    if (JsonArray['success'] == '1') {
                        $("#alert-div").html("<div class=\"alert alert-success mb-5\" role=\"alert\">تم تعديل معلوماتك بنجاح.</div>");
                    } else if (JsonArray['failure'] == '1') {
                        $("#alert-div").html("<div class=\"alert alert-danger mb-5\" role=\"alert\">حصل خطأ. تأكد من صحة المعلومات المدخلة.</div>");
                        $("#current-pass-error").html("كلمة المرور الحالية غير صحيحة.");
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
                    $("#alert-div".html("<div class=\"alert alert-danger mb-5\" role=\"alert\">حصل خطأ. الرجاء المعاودة لاحقا.</div>"))
                }
            });
        }
    }

}