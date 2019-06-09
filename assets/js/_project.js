let project_id;

function loadProject(id) {
    $.ajax({
        type: 'GET',
        url: 'src/Controllers/ProjectController.php',
        datatype: 'text',
        data: 'fid=2&id=' + id,
        success: function (response) {
            var JsonArray = $.parseJSON(response);
            alert(response);
            if (JsonArray[0].owner == 1) {
                $("#project-main-card").html('<div class="row"><div class="col-10 d-flex mb-3"><img id="project-avatar" src="./assets/images/placeholder.png" class="project-avatar mb-auto mt-auto ml-4"><h2 id="project-name" class="primary-dark mb-auto mt-auto"</h2></div><div class="col-2 pull-2"><button id="edit-project" class="btn btn-primary ripple pull-left w-100">عدل</button></div></div><div class="row"><h6 class="card-subtitle col-10 mb-2 ml-2 text-muted"><span id="created_at"></span><span id="owner-name" class="ml-3"></span></h6></div>');
            } else {
                $("#project-main-card").html('<div class="row"><div class="col-10 d-flex mb-3"><img id="project-avatar" src="./assets/images/placeholder.png" class="project-avatar mb-auto mt-auto ml-4"><h2 id="project-name" class="primary-dark mb-auto mt-auto"</h2></div></div><div class="row"><h6 class="card-subtitle col-10 mb-2 ml-2 text-muted"><span id="created_at"></span><span id="owner-name" class="ml-3"></span></h6></div>');
            }
            project_id = JsonArray[0].id;
            $('#project-name').html(JsonArray[0].name);
            $('#owner-name').html(JsonArray[0].first_name + ' ' + JsonArray[0].last_name);
            var date = new Date(JsonArray[0].created_at);
            $('#created_at').html(getFormattedDate(date));
            $('#low-balance').html(JsonArray[0].low_balance);
            $('#high-balance').html(JsonArray[0].high_balance);
            $('#duration').html(JsonArray[0].duration);
            var avg = JsonArray[0].offersAvg;
            if (avg == undefined) $('#offer-average').html('0');
            else $('#offer-average').html(avg);
            $('#offer-count').html(JsonArray[0].offersNum);
            $('#description').html(JsonArray[0].description);
            var created_at;
            for (var i = 1; i < JsonArray.length; i++) {
                date = new Date(JsonArray[i].created_at);
                created_at = getFormattedDate(date);
                var mainFocus;
                if (JsonArray[i].main_focus == "programming")
                    mainFocus = "برمجة، تطوير المواقع والتطبيقات";
                else if (JsonArray[i].main_focus == "business")
                    mainFocus = "أعمال وخدمات استشارية وإدارية";
                else if (JsonArray[i].main_focus == "marketing")
                    mainFocus = "تسويق الكتروني ومبيعات";
                else if (JsonArray[i].main_focus == "training")
                    mainFocus = "تدريب، تعليم ومساعدة عن بعد";
                else if (JsonArray[i].main_focus == "language")
                    mainFocus = "كتابة، تحرير، ترجمة ولغات";
                else if (JsonArray[i].main_focus == "design")
                    mainFocus = "تصميم وأعمال فنية وإبداعية";
                else
                    mainFocus = "أمور أخرى";
                $('#offers-holder').append('<div class="card-text"><div class="row"><div class="col-sm-10 d-flex mb-3"><img src="' + JsonArray[i].image + '" class="offer-avatar mb-auto mt-auto ml-4"><h5 id="freelancer-' + i + '" class="primary-dark mb-auto mt-auto">' + JsonArray[i].first_name + ' ' + JsonArray[i].last_name + '</h5></div><div class="col-sm-2 pull-sm-2">' + ((JsonArray[0].owner == 1) ? '<button id="choose' + i + '"class="btn btn-primary ripple pull-left w-100 mb-2">اختر هذا العرض</button>' : '') + '<button id="report' + i + '"class="btn btn-danger ripple pull-left w-100">تبليغ عن العرض</button></div></div><h6 class="card-subtitle mb-2 ml-2 text-muted"><small id="created-at-' + i + '" class="ml-3">' + created_at + '</small><small id="focus-' + i + '" class="ml-3">' + mainFocus + '</small></h6><p id="offer-text-' + i + '" class="card-text mt-5 mb-5">' + JsonArray[i].description + '</p><hr></div>')
            }
            if (JsonArray[0].owner == 1)
                $("#add-offer-card").remove();
            $('#cover').removeClass('invisible');
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

function getFormattedDate(date) {
    var year = date.getFullYear();
    var month = (1 + date.getMonth()).toString();
    month = month.length > 1 ? month : '0' + month;
    var day = date.getDate().toString();
    day = day.length > 1 ? day : '0' + day;
    return year + '-' + month + '-' + day;
}


$(function () {
    $("#price").on("change", function () {
        let price = $("#price").val();
        $("#revenue").val(price * 0.1);
    });
});
$(document).ready(function () {
    $(function () {
        $("#edit-project").on("click", function () {
            location.href = 'edit_project.php?fid=4&id=' + project_id;
        });
    });
});


$(function () {
    $("#add-offer").on("click", function () {
        let duration = $("#offer-duration").val();
        let price = $("#price").val();
        let offerText = $("#offer-details").val();

        let _duration = true;
        let _price = true;
        let _offerText = true;

        if (duration > $("#duration").val() || duration == "") {
            $("#duration-error").html("يجب على الفترة ان تكون اقل او تساوي المدة المحددة.");
            _duration = false;
        }

        if (price < $("#low-balance").val() || price > $("#high-balance").val() || price == "") {
            $("#price-error").html("يجب على المبلغ المحدد ان يكون ضمن نطاق الميزانية المحددة");
            _price = false;
        }

        if (offerText.trim().length < 80) {
            $("#text-error").html("يجب ان يكون طول النص غلى الأقل 80 محرف.");
            _offerText = false;
        }

        if (!_price || !_duration || !_offerText) {
            $("#alert-div").html("<div class=\"alert alert-danger mb-5\" role=\"alert\">تأكد من المعلومات المدخلة.</div>");
        } else {
            $.ajax({
                type: 'GET',
                url: 'src/Controllers/ProjectController.php',
                datatype: 'text',
                data: 'fid=3&id=' + project_id + '&duration=' + duration + '&price=' + price + '&offerText=' + offerText,
                success: function (response) {
                    alert(response);
                    var JsonObject = $.parseJSON(response);
                    if (JsonObject.logged == 0) {
                        $("#alert-div").html("<div class=\"alert alert-danger mb-5\" role=\"alert\">يجب تسجيل الدخول لترك عرض.</div>");
                    } else {
                        if (JsonObject.success == 1) {
                            location.reload();
                        } else if (JsonObject.success == 0) {
                            $("#alert-div").html("<div class=\"alert alert-danger mb-5\" role=\"alert\">لا يمكنك إضافة عرض اخر.</div>");
                        }
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
    });
});