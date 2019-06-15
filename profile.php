<?php
require 'header.php';
if(!isset($_SESSION['userID']) && !isset($_GET['member'])){ 
    header("Location: index.php");
}
else {
    if(isset($_GET['id']))
        echo '<script>loadProfile('. $_GET['id'] . ')</script>';
    else
        echo '<script>loadProfile('. $_SESSION['userID'] . ')</script>';
}
?>

<div class="row mt-5 justify-content-center">
    <div id="edit-profile-col" class="col-md-4 p-5"></div>
    <div class="col-md-4 text-center">
        <img id="profile-image" src="./assets/clipart/anonymous.png" class="profile-img cent" onerror="this.src='./assets/images/placeholder.png'">
        <br>
        <div class="container profile-head">
            <h1 id="profile-name">Jane Doe</h1>

            <p class="title"><span id="profile-category">CEO & Founder</span><img class="job ml-2" src="./assets/clipart/briefcase (1).png"></p>
            <p class="area"><span id="profile-country">Damascuse</span><img class="job ml-2" src="./assets/clipart/pin (1).png"></p>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>
<br>
<div class="tab">


    <button class="tablinks" onclick="openTab('Profaile',this)" id="defaultOpen"><b>الملف الشخصي </b></button>
    <button class="tablinks" onclick="openTab( 'projectA', this)"><b>المشاريع التي شارك بها </b></button>
    <button class="tablinks" onclick="openTab('projectB', this)"><b> المشاريع التي طرحها </b></button>

</div>


<div id="Profaile" class="tabcontent">

    <form class="profile-forms">
        <div class="pr">
            <h3 class="profile-section"> <img class="job1" src="./assets/clipart/1006517.png">تعريف بي:</h3>
            <hr>
            <p id="profile-description" class="hello"></p>
            <br>
            </h4>
        </div>
    </form>
</div>

<div id="projectA" class="tabcontent">
    <form class="profile-forms">
        <div class="pr">
            <h3 class="profile-section"><img class="job1" src="./assets/clipart/decision.png">المشاريع التي شارك بها:</h3>
            <hr>
            <div id="worked-projects-holder">
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination d-flex justify-content-end" id="worked-project-pages">
                </ul>
            </nav>
        </div>
    </form>

</div>

<div id="projectB" class="tabcontent">

    <form class="profile-forms">
        <div class="pr">
            <h3 class="profile-section"><img class="job1" src="./assets/clipart/Business_Ideas-128.png">المشاريع التي طرحها:</h3>
            <hr>
            <div id="owned-projects-holder">
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination d-flex justify-content-end" id="owned-project-pages">
                </ul>
            </nav>
        </div>
    </form>
</div>



<script>
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

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>

<?php
require 'footer.php';
?>