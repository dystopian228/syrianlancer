

function addForm()
{

    $("#error-div").css("color", "red");
    $("#error-div").html("");
    let projectName = $("#pName").val();
    let category = $("#category").val();
    let description= $("#description").val();
    let palance = $("#palance").val();
    let duration = $("#duration").val();

    let _projectName = true;
    let _category = true;
    let _description= true;
    let _palance = true;
    let _duration = true;

    
    if (projectName.trim().length < 8 || projectName.trim().length > 50 || projectName.indexOf(' ') != -1) {
        _projectName = false;
        $("#error-div").append("اسم المشروع يجب أن لا يقل  عن 8 أحرف ولا يزيد على 50 حرف. </br>");
    }

    
    if (description.trim().length < 80 || description.trim().length > 1500 ) {
        _firstName = false;
        $("#error-div").append("توصيف المشروع يجب أن لا يقل عن 80 حرف ولا يزيد على 1500. </br>");

    }
    var project_category;
    if(category.val()=="خدمات استشارية و إدارية")
        project_category="business";
    else if (category.val()=="برمجيات, تصميم مواقع وتطبيقات")
        project_category="design";
    else if(category.val()=="تسويق ومبيعات")
        project_category="marketing"
    else if(category.val()=="تدريب، تعليم ومساعدة عن بعد")
        project_category="training";
    else    project_category="other";
    
    var high_palance;
    var low_palance;
    if(palance.val()=="15-25 ألف")
    {
        high_palance=25;
        low_palance=15;
    }
    else if(palance.val()=="25-50 ألف")
    {
        high_palance=50;
        low_palance=25;
    }
    else if(palance.val()=="50-125 ألف")
    {
        high_palance=125;
        low_palance=50;
    }

    else if(palance.val()=="125-250 ألف")
    {
        high_palance=250;
        low_palance=125;
    }

    else if(palance.val()=="250-400 ألف")
    {
        high_palance=400;
        low_palance=250;
    }

    else if(palance.val()=="400-500 ألف")
    {
        high_palance=500;
        low_palance=400;
    }


    if (_projectName && _category && _description && _palance && _duration) {
        $.ajax({
            type: 'POST',
            url: 'src/Controllers/ProjectController.php',
            datatype: 'text',
            data: "fid=7&projectName=" + projectName.trim() + "&category=" + category + "&description=" + description.trim() + "&high_palance=" + high_palance + "&low_palance=" + low_palance +"&duration=" + duration ,
            success: function (response) {
                //$("#error-div").append(response);

                var JsonArray = $.parseJSON(response);
     
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