$(document).ready(function () {
    search(1);
});

function search(page) {

    let ratingValue = $("input[name='rating']:checked").val();
    let mainFocus = $("input[name='main_focus']:checked").val();
    let name = $("#name-search").val();
    let pageLimit = 9;

    $.ajax({
        type: 'GET',
        url: 'src/Controllers/FreelancerController.php',
        datatype: 'text',
        data: "name=" + name + "&ratingValue=" + ratingValue + "&page=" + page + "&pageLimit=" + pageLimit + "&mainFocus=" + mainFocus,
        success: function (response) {
            $("#freelancers-deck").html("");
            var jsonArr = $.parseJSON(response);
            if (jsonArr[jsonArr.length - 2] == 0) {
                $("#freelancers-deck").html("<h3>عذرا, لا يوجد معلومات لعرضها.</h3>");
                $("#freelancers-pages").html("");
            } else {
                //populate the "freelancers-deck" div with freelancers cards
                for ($i = 0; $i < jsonArr.length - 2; $i++) {
                    //$("#freelancers-deck").append(jsonArr[$i]['userID']+"<br><br>");
                    let userID = jsonArr[$i]['userID'];
                    let name = jsonArr[$i]['name'];
                    let rating = jsonArr[$i]['rating'];
                    let focus = jsonArr[$i]['mainFocus'];
                    let focusVal = "<br>";


                    switch (focus) {
                        case 'business':
                            focusVal = "أعمال وخدمات استشارية وإدارية";
                            break;
                        case 'programming':
                            focusVal = "برمجة، تطوير المواقع والتطبيقات";
                            break;
                        case 'design':
                            focusVal = "تصميم وأعمال فنية وإبداعية";
                            break;
                        case 'marketing':
                            focusVal = "تسويق الكتروني ومبيعات";
                            break;
                        case 'language':
                            focusVal = "كتابة، تحرير، ترجمة ولغات";
                            break;
                        case 'training':
                            focusVal = "تدريب، تعليم ومساعدة عن بعد";
                            break;
                        case 'other':
                            focusVal = "أمور أخرى";
                            break;

                    }

                    $("#freelancers-deck").append('<div class="col-md-4 p-2 freelancer-card "><div class="card "><div class="card-body text-center"><div><img class="freelancers-img-style" src="./assets/images/placeholder.png" alt="card image" /></div><h4 class="mt-3 card-title">' + name + '</h4><p class="card-text my-4">' + focusVal + '</p><div class="star-ratings-sprite my-3"><span style="width:' + ((rating * 100) / 5) + '%" class="star-ratings-sprite-rating"></span></div><button class="btn btn-primary ripple" onclick="location.href = \'profile.php?id=' + userID + '\';"><i class="ml-2 fas fa-user-alt"></i>الصفحة الشخصية</button></div></div></div>');
                }

                //draw the page navigator  
                numberOfLinks = 2;
                pages = Math.ceil(jsonArr[jsonArr.length - 1] / pageLimit);
                startPage = ((page - numberOfLinks) > 0) ? (page - numberOfLinks) : 1;
                endPage = ((page + numberOfLinks) < pages) ? (page + numberOfLinks) : pages;
                var pagination = document.getElementById("freelancers-pages");
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