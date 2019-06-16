function addForm() {

    $("#error-div").css("color", "red");
    $("#error-div").html("");
    let projectName = $("#pName").val();
    let category = $("#category").val();
    let description = $("#description").val();
    let duration = $("#duration").val();
    var high_balance = $('#high-balance').val();
    var low_balance = $('#low-balance').val();

    let _projectName = true;
    let _category = true;
    let _description = true;
    let _low_balance = true;
    let _high_balance = true;
    let _duration = true;


    if (projectName.trim().length < 8 || projectName.trim().length > 50) {
        _projectName = false;
        $("#error-div").append("اسم المشروع يجب أن لا يقل  عن 8 أحرف ولا يزيد على 50 حرف. </br>");
    }


    if (description.trim().length < 80 || description.trim().length > 1500) {
        _firstName = false;
        $("#error-div").append("توصيف المشروع يجب أن لا يقل عن 80 حرف ولا يزيد على 1500. </br>");
    }

    if (duration < 1 || duration > 356) {
        _duration = false;
        $("#error-div").append("مدة التسليم يجب أن لا يقل عن 1 يوم ولا يزيد على 356 يوم. </br>");
    }

    if (low_balance < 15000 || high_balance < 15000) {
        _low_balance = false;
        _high_balance = false;
        $("#error-div").append("الميزانية يجب أن لا يقل عن 15000. </br>");
    }
    var project_category;
    if (category == "خدمات استشارية و إدارية")
        project_category = "business";
    else if (category == "برمجيات, تصميم مواقع وتطبيقات")
        project_category = "design";
    else if (category == "تسويق ومبيعات")
        project_category = "marketing"
    else if (category == "تدريب، تعليم ومساعدة عن بعد")
        project_category = "training";
    else project_category = "other";


    if (_projectName && _category && _description && _high_balance && _low_balance && _duration) {
        $.ajax({
            type: 'POST',
            url: 'src/Controllers/ProjectController.php',
            datatype: 'text',
            data: "fid=7&projectName=" + projectName.trim() + "&category=" + category + "&description=" + description.trim() + "&high_palance=" + high_balance + "&low_palance=" + low_balance + "&duration=" + duration,
            success: function (response) {
                //$("#error-div").append(response);
                var JsonArray = $.parseJSON(response);
                if (JsonArray.success == '1') {
                    location.href = "project.php?fid=2&id=" + JsonArray.id;
                } else {
                    $("#error-div").append("ليس معك رصيد كافي.</br>");
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