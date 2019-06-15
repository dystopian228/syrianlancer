function openTab(pageName, elmnt) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].style.backgroundColor = "";
    }
    document.getElementById(pageName).style.display = "block";
    elmnt.style.backgroundColor = "white";
}

function loadProfile(id) {
    $.ajax({
        type: 'GET',
        url: 'src/Controllers/ProfileController.php',
        datatype: 'text',
        data: 'fid=1&id=' + id,
        success: function (response) {
            var JsonObject = $.parseJSON(response);
            var name = JsonObject.first_name + ' ' + JsonObject.last_name;
            var category;
            $('#profile-name').html(name);
            $('#profile-image').attr("src", JsonObject.image);
            category = getCategory(JsonObject.category);
            $('#profile-category').html(category);
            $('#profile-country').html(JsonObject.country);
            var _owner = false;
            if (JsonObject.about_me != null)
                $('#profile-description').html(JsonObject.about_me);
            else
                $('#profile-description').html('لا يوجد بيانات');
            if (id == JsonObject.id) {
                _owner = true;
                $('#edit-profile-col').html('<button id="edit-profile" onclick="window.location.href=\'edit_profile.php\'" class="btn btn-primary ripple pull-left w-50 mb-2">تعديل المعلومات</button>');
            }
            loadOwnedProjects(id, 1, _owner);
            loadWorkedProjects(id, 1, _owner);
        },
        ferror: function (jqXHR, exception) {
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
        }
    })
}

function loadOwnedProjects(id, page, _owner) {
    $.ajax({
        type: 'GET',
        url: 'src/Controllers/ProjectController.php',
        datatype: 'text',
        data: 'fid=4&id=' + id + "&page=" + parseInt(page),
        success: function (response) {
            var JsonArray = $.parseJSON(response);
            var pages = JsonArray[JsonArray.length - 3];
            var startPage = JsonArray[JsonArray.length - 2];
            var endPage = JsonArray[JsonArray.length - 1];
            var date;
            $('#owned-projects-holder').html("");
            for (var i = 0; i < JsonArray.length - 3; i++) {
                date = new Date(JsonArray[i].created_at);
                $('#owned-projects-holder').append('<div class="row"><div class="col-sm-10"><a class=\"lii\" href ="project.php?fid=2&id=' + JsonArray[i].proj_id + '">' +
                    JsonArray[i].name +
                    '</a>' + (JsonArray[i].firstName == undefined ? '<p><img class="job2" src="./assets/clipart/189061.png">لا يوجد' : '<p><img class="job2" src="./assets/clipart/189061.png"><a href="profile.php?id=' + JsonArray[i].user_id + '">' + JsonArray[i].firstName + ' ' + JsonArray[i].lastName) +
                    '</a><img class="job3" src="./assets/clipart/circular-clock.png">' + getFormattedDate(date) +
                    '<img class="job3" src="./assets/clipart/counterclockwise-rotating-arrow-around-a-clock.png">' + (JsonArray[i].firstName == undefined ? 'في مرحلة تقديم العروض' : (JsonArray[i].completed == 1 ? 'منتهي التنفيذ' : ('قيد التنفيذ'))) +
                    '</p></div><div class="d-flex col-sm-2 pull-left justify-content-center align-self-center">' + (_owner == true ? '<button onclick="location.href = \'chat.php?freelancer_projects=' + JsonArray[i].freelancer_projects_id + '\'" class="btn btn-primary ripple pull-left mb-2"><i class="fas fa-envelope"></i></button>' : '') + '</div></div><hr>');
            }
            if (JsonArray.length > 3) {
                var pagination = document.getElementById("owned-project-pages");
                pagination.innerHTML = "";
                if (page == 1)
                    pagination.innerHTML += "<li class=\"page-item disabled\"><a class=\"owned-page-link\" href=\"#!\" id=\"1\"\"><<<</a></li>"
                else
                    pagination.innerHTML += "<li class=\"page-item\"><a class=\"owned-page-link\" href=\"#!\" id=\"1\"\"><<<</a></li>"
                if (startPage > 1) {
                    pagination.innerHTML += "<li class=\"page-item disabled\"><a class=\"owned-page-link\" href=\"#!\" id=\"" + i + "\">...</a></li>"
                }
                for (var i = startPage; i <= endPage; i++) {
                    if (i == page)
                        pagination.innerHTML += "<li class=\"page-item active\"><a class=\"owned-page-link\" href=\"#!\" id=\"" + i + "\">" + i + "</a></li>"
                    else
                        pagination.innerHTML += "<li class=\"page-item\"><a class=\"owned-page-link\" href=\"#!\" id=\"" + i + "\">" + i + "</a></li>"
                }
                if (endPage < pages) {
                    pagination.innerHTML += "<li class=\"page-item disabled\"><a class=\"owned-page-link\" href=\"#!\" id=\"" + pages + "\">...</a></li>"
                }
                if (page == pages)
                    pagination.innerHTML += "<li class=\"page-item disabled\"><a class=\"owned-page-link\" href=\"#!\" id=\"" + pages + "\">>>></a></li>"
                else
                    pagination.innerHTML += "<li class=\"page-item\"><a class=\"owned-page-link\" href=\"#!\" id=\"" + pages + "\">>>></a></li>"
                $(function () {
                    $(".owned-page-link").on("click", function () {
                        loadOwnedProjects(id, this.id);
                    });
                });
            } else {
                $('#owned-projects-holder').html('<h4 class="text-center font-weight-bold">لا يوجد اية مشاريع</h4>');
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
        }
    })
}

function loadWorkedProjects(id, page, _owner) {
    $.ajax({
        type: 'GET',
        url: 'src/Controllers/ProjectController.php',
        datatype: 'text',
        data: 'fid=5&id=' + id + "&page=" + parseInt(page),
        success: function (response) {
            var JsonArray = $.parseJSON(response);
            var pages = JsonArray[JsonArray.length - 3];
            var startPage = JsonArray[JsonArray.length - 2];
            var endPage = JsonArray[JsonArray.length - 1];
            var date;
            $('#worked-projects-holder').html("");
            for (var i = 0; i < JsonArray.length - 3; i++) {
                date = new Date(JsonArray[i].created_at);
                $('#worked-projects-holder').append('<div class="row"><div class="col-sm-10"><a class=\"lii\" href ="project.php?fid=2&id=' + JsonArray[i].proj_id + '">' +
                    JsonArray[i].name +
                    '</a><p><img class="job2" src="./assets/clipart/189061.png"><a href="profile.php?id=' + JsonArray[i].owner_id + '">' + JsonArray[i].firstName + ' ' + JsonArray[i].lastName +
                    '</a><img class="job3" src="./assets/clipart/circular-clock.png">' + getFormattedDate(date) +
                    '<img class="job3" src="./assets/clipart/counterclockwise-rotating-arrow-around-a-clock.png">' + (JsonArray[i].completed == 1 ? 'منتهي التنفيذ' : ('قيد التنفيذ')) +
                    '</p></div><div class="d-flex col-sm-2 pull-left justify-content-center align-self-center">' + (_owner == true ? '<button onclick="location.href = \'chat.php?freelancer_projects=' + JsonArray[i].freelancer_projects_id + '\'" class="btn btn-primary ripple pull-left mb-2"><i class="fas fa-envelope"></i></button>' : '') + '</div></div><hr>');
            }
            if (JsonArray.length > 3) {
                var pagination = document.getElementById("worked-project-pages");
                pagination.innerHTML = "";
                if (page == 1)
                    pagination.innerHTML += "<li class=\"page-item disabled\"><a class=\"work-page-link\" href=\"#!\" id=\"1\"\"><<<</a></li>"
                else
                    pagination.innerHTML += "<li class=\"page-item\"><a class=\"work-page-link\" href=\"#!\" id=\"1\"\"><<<</a></li>"
                if (startPage > 1) {
                    pagination.innerHTML += "<li class=\"page-item disabled\"><a class=\"work-page-link\" href=\"#!\" id=\"" + i + "\">...</a></li>"
                }
                for (var i = startPage; i <= endPage; i++) {
                    if (i == page)
                        pagination.innerHTML += "<li class=\"page-item active\"><a class=\"work-page-link\" href=\"#!\" id=\"" + i + "\">" + i + "</a></li>"
                    else
                        pagination.innerHTML += "<li class=\"page-item\"><a class=\"work-page-link\" href=\"#!\" id=\"" + i + "\">" + i + "</a></li>"
                }
                if (endPage < pages) {
                    pagination.innerHTML += "<li class=\"page-item disabled\"><a class=\"work-page-link\" href=\"#!\" id=\"" + pages + "\">...</a></li>"
                }
                if (page == pages)
                    pagination.innerHTML += "<li class=\"page-item disabled\"><a class=\"work-page-link\" href=\"#!\" id=\"" + pages + "\">>>></a></li>"
                else
                    pagination.innerHTML += "<li class=\"page-item\"><a class=\"work-page-link\" href=\"#!\" id=\"" + pages + "\">>>></a></li>"
                $(function () {
                    $(".work-page-link").on("click", function () {
                        loadWorkedProjects(id, this.id);
                    });
                });
            } else {
                $('#worked-projects-holder').html('<h4 class="text-center font-weight-bold">لا يوجد اية مشاريع</h4>');
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
        }
    })
}

function getFormattedDate(date) {
    var year = date.getFullYear();
    var month = (1 + date.getMonth()).toString();
    month = month.length > 1 ? month : '0' + month;
    var day = date.getDate().toString();
    day = day.length > 1 ? day : '0' + day;
    return year + '-' + month + '-' + day;
}

function getCategory(category) {
    if (category == 'programming') return 'برمجة، تطوير المواقع والتطبيقات';
    else if (category == 'business') return 'أعمال وخدمات استشارية وإدارية';
    else if (category == 'marketing') return 'تسويق الكتروني ومبيعات';
    else if (category == 'training') return 'تدريب، تعليم ومساعدة عن بعد';
    else if (category == 'language') return 'كتابة، تحرير، ترجمة ولغات';
    else if (category == 'design') return 'تصميم وأعمال فنية وإبداعية';
    else return 'أمور أخرى';
}