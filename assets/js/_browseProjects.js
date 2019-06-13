function search(page) {
    //Fetch categories
    let cat1 = $('#cat1');
    let cat2 = $('#cat2');
    let cat3 = $('#cat3');
    let cat4 = $('#cat4');
    let cat5 = $('#cat5');
    let cat6 = $('#cat6');
    let cat7 = $('#cat7');

    var cats = new Array(cat1, cat2, cat3, cat4, cat5, cat6, cat7);
    var categories = "";

    //Check which categories are ticked.
    var count = 0;
    for (i = 0; i < cats.length; i++) {
        if (cats[i].is(":checked")) {
            if (count == 0) {
                categories = cats[i].val();
                count++;
            } else {
                categories += "," + cats[i].val();
                count++;
            }

        }
    }

    //Fetch durations
    let duration1 = $('#duration1');
    let duration2 = $('#duration2');
    let duration3 = $('#duration3');
    let duration4 = $('#duration4');
    let duration5 = $('#duration5');

    var durs = new Array(duration1, duration2, duration3, duration4, duration5);
    var durations = "";

    //Check which durations are ticked.
    var count = 0;
    for (i = 0; i < durs.length; i++) {
        if (durs[i].is(":checked")) {
            if (count == 0) {
                durations = durs[i].val();
                count++;
            } else {
                durations += "," + durs[i].val();
                count++;
            }
        }
    }

    //Get keyword and balance.
    var keyword = $('#keyword-search').val();
    var balance = $('#balance-slider').val();

    //Send Ajax request.
    $.ajax({
        type: 'GET',
        url: 'src/Controllers/ProjectController.php',
        datatype: 'text',
        data: "fid=1&keyword=" + keyword + "&categories=" + categories + "&duration=" + durations + "&balance=" + balance + "&page=" + parseInt(page),
        success: function (response) {
            alert(response);
            var JsonArray = $.parseJSON(response);
            var pages = JsonArray[JsonArray.length - 3];
            var startPage = JsonArray[JsonArray.length - 2];
            var endPage = JsonArray[JsonArray.length - 1];
            var deck = document.getElementById("project-deck");
            var ct = 0;
            var count = 1;
            var cnt = 1;
            deck.innerHTML = "";
            var cato;
            for (var i = 0; i < JsonArray.length - 3; i++) {
                if (JsonArray[i].category == "business") {
                    cato = "أعمال وخدمات استشارية وإدارية";
                } else if (JsonArray[i].category == "programming") {
                    cato = "برمجة، تطوير المواقع والتطبيقات";
                } else if (JsonArray[i].category == "marketing") {
                    cato = "تسويق الكتروني ومبيعات";
                } else if (JsonArray[i].category == "language") {
                    cato = "كتابة، تحرير، ترجمة ولغات";
                } else if (JsonArray[i].category == "design") {
                    cato = "تصميم وأعمال فنية وإبداعية";
                } else if (JsonArray[i].category == "training") {
                    cato = "تدريب، تعليم ومساعدة عن بعد";
                } else if (JsonArray[i].category == "other") {
                    cato = "أمور أخرى";
                }

                if (ct == 0) {
                    if (i == (JsonArray.length - 1)) {
                        deck.innerHTML += "<div class=\"card-deck mt-5\" id=\"project-deck-" + cnt + "\"><div class=\"card project-card\" onclick=\"location.href = \'project.php?fid=2&id=" + JsonArray[i].proj_id + "'\"> < div class = \"card-img-top project-banner d-flex flex-wrap align-content-center justify-content-center\">" + JsonArray[i].project_name + "</div><div class=\"card-body project-info\"><div class=\"d-flex justify-content-between mb-3\"><a href=\"#!\" class=\"float-right\">" + JsonArray[i].firstName + " " + JsonArray[i].lastName + "</a><a href=\"#!\" class=\"float-left\">" + cato + "</a></div><div class=\"d-flex justify-content-between mb-3\"><a href=\"#!\" class=\"float-right\">" + JsonArray[i].offerCount + " عروض" + "</a><button type=\"button\" class=\"btn btn-primary ripple float-left\" data-toggle=\"collapse\" data-target=\"#project-descript-" + count + "\" aria-expanded=\"false\" aria-controls=\"project-descript-" + count + "\"><i class=\"fas fa-caret-down ml-2\"></i>المزيد</button></div><div class=\"collapse\" id=\"project-descript-" + count + "\"><p class=\"card-text text-center\">" + JsonArray[i].description + "...</p></div></div></div><div class=\"card project-card invisible\"></div></div>";
                    } else
                        deck.innerHTML += "<div class=\"card-deck mt-5\" id=\"project-deck-" + cnt + "\"><div class=\"card project-card\" onclick=\"location.href = \'project.php?fid=2&id=" + JsonArray[i].proj_id + "'\"><div class=\"card-img-top project-banner d-flex flex-wrap align-content-center justify-content-center\">" + JsonArray[i].project_name + "</div><div class=\"card-body project-info\"><div class=\"d-flex justify-content-between mb-3\"><a href=\"#!\" class=\"float-right\">" + JsonArray[i].firstName + " " + JsonArray[i].lastName + "</a><a href=\"#!\" class=\"float-left\">" + cato + "</a></div><div class=\"d-flex justify-content-between mb-3\"><a href=\"#!\" class=\"float-right\">" + JsonArray[i].offerCount + " عروض" + "</a><button type=\"button\" class=\"btn btn-primary ripple float-left\" data-toggle=\"collapse\" data-target=\"#project-descript-" + count + "\" aria-expanded=\"false\" aria-controls=\"project-descript-" + count + "\"><i class=\"fas fa-caret-down ml-2\"></i>المزيد</button></div><div class=\"collapse\" id=\"project-descript-" + count + "\"><p class=\"card-text text-center\">" + JsonArray[i].description + "...</p></div></div></div>";
                    ct = ct + 1;
                    cnt++;
                } else if (ct == 1) {
                    document.getElementById("project-deck-" + (cnt - 1)).innerHTML += "<div class=\"card project-card\" onclick=\"location.href = \'project.php?fid=2&id=" + JsonArray[i].proj_id + "'\"><div class=\"card-img-top project-banner d-flex flex-wrap align-content-center justify-content-center\">" + JsonArray[i].project_name + "</div><div class=\"card-body project-info\"><div class=\"d-flex justify-content-between mb-3\"><a href=\"#!\" class=\"float-right\">" + JsonArray[i].firstName + " " + JsonArray[i].lastName + "</a><a href=\"#!\" class=\"float-left\">" + cato + "</a></div><div class=\"d-flex justify-content-between mb-3\"><a href=\"#!\" class=\"float-right\">" + JsonArray[i].offerCount + " عروض" + "</a><button type=\"button\" class=\"btn btn-primary ripple float-left\" data-toggle=\"collapse\" data-target=\"#project-descript-" + count + "\" aria-expanded=\"false\" aria-controls=\"project-descript-" + count + "\"><i class=\"fas fa-caret-down ml-2\"></i>المزيد</button></div><div class=\"collapse\" id=\"project-descript-" + count + "\"><p class=\"card-text text-center\">" + JsonArray[i].description + "...</p></div></div></div></div>";
                    ct = 0;
                }
                count++;
            }

            //Pagination: Display the page we're standing at plus two pages after (if plausable), and two pages befor (if plausable).
            //And add Last and First page buttons.
            var pagination = document.getElementById("project-pages");
            pagination.innerHTML = "";
            if (page == 1)
                pagination.innerHTML += "<li class=\"page-item disabled\"><a class=\"page-link\" href=\"#!\" id=\"1\"\"><<<</a></li>"
            else
                pagination.innerHTML += "<li class=\"page-item\"><a class=\"page-link\" href=\"#!\" id=\"1\"\"><<<</a></li>"
            if (startPage > 1) {
                pagination.innerHTML += "<li class=\"page-item disabled\"><a class=\"page-link\" href=\"#!\" id=\"" + i + "\">...</a></li>"
            }
            for (var i = startPage; i <= endPage; i++) {
                if (i == page)
                    pagination.innerHTML += "<li class=\"page-item active\"><a class=\"page-link\" href=\"#!\" id=\"" + i + "\">" + i + "</a></li>"
                else
                    pagination.innerHTML += "<li class=\"page-item\"><a class=\"page-link\" href=\"#!\" id=\"" + i + "\">" + i + "</a></li>"
            }
            if (endPage < pages) {
                pagination.innerHTML += "<li class=\"page-item disabled\"><a class=\"page-link\" href=\"#!\" id=\"" + pages + "\">...</a></li>"
            }
            if (page == pages)
                pagination.innerHTML += "<li class=\"page-item disabled\"><a class=\"page-link\" href=\"#!\" id=\"" + pages + "\">>>></a></li>"
            else
                pagination.innerHTML += "<li class=\"page-item\"><a class=\"page-link\" href=\"#!\" id=\"" + pages + "\">>>></a></li>"
            $(function () {
                $(".page-link").on("click", function () {
                    search(this.id);
                });
            });
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
    });
}


//Function to continue updating slider label as it changes.
function outputUpdate(vol) {
    document.querySelector('#balance-value').value = vol;
}


//Fetch all available projects as page loads.
$(document).ready(function () {
    search(1);
});