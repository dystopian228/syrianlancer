<?php

    session_start();
    include 'dbh.php';

    if(isset($_GET['fid']))
        $fid=$_GET['fid'];
    else if(isset($_POST['fid']))
        $fid=$_POST['fid'];

    if($fid==1){
        loadProjects();
    }
    if($fid==2){
        loadProject();
    }
    if($fid==3){
        postOffer();
    }

    function loadProjects(){
        global $conn;

        $keyterm="";
        $categories="";
        $duration="";
        $balance="";
        $results_per_page=8;
        $num_of_links=2;

        if(isset($_GET['keyword'])) {
            $keyterm=$_GET['keyword'];
        }
        if(isset($_GET['categories'])) {
            $categories=$_GET['categories'];
        }
        if(isset($_GET['duration'])) {
            $duration=$_GET['duration'];
        }
        if(isset($_GET['balance'])) {
            $balance=$_GET['balance'];
        }
        $cats=array();

        foreach (explode(',', $categories) as $cat) {
            array_push($cats, substr($cat, 0));
        }

        
        if (!$conn) {
                die("Connection Failed: " . mysqli_connect_error());
        } else {
            $arr=array();
            $catarr=implode(',', $cats);
            $sqlc = "SELECT DISTINCT projects.id as proj_id, projects.name as project_name, SUBSTRING(projects.description, 1, 80) as description, projects.category as category, users.first_name as firstName, users.last_name as lastName, (SELECT COUNT(offers.id) FROM offers where proj_id = offers.id) as offerCount
                    from projects, users
                    WHERE projects.owner_id = users.id
                    and projects.deleted=0
                    and projects.archived=0
                    and (SELECT count(*)
                        from offers, freelancer_projects
                        where offers.id = freelancer_projects.offer_id
                        and offers.project_id = projects.id
                        and freelancer_projects.completed = 0
                        and freelancer_projects.dropped=0) < 1";
                
            if ($keyterm!=""){
                $sqlc = $sqlc ." and (projects.name LIKE CONCAT('%',?,'%') OR projects.description LIKE CONCAT('%',?,'%'))";

            }
            if ($balance!="" ){
                $sqlc=$sqlc . "  and projects.low_balance >= ?";
            }
            $catarr=implode("','", $cats);
            if ($categories!=""){
                $sqlc=$sqlc . " and projects.category IN ('$catarr')"; 
            }
            $duration_low="";
            $duration_high="";
            if($duration!=""){
                $durs=array();
                foreach (explode(',', $duration) as $dur) {
                    array_push($durs, substr($dur, 0));
                }
                $sqlc=$sqlc . " and ( ";
                $cnt=0;
                foreach($durs as $dura){
                    if($dura=="0-6")
                    {
                        $duration_low=0;
                        $duration_high=6;
                    }
                    if($dura=="7-30")
                    {
                        $duration_low=7;
                        $duration_high=30;
                    }
                    if($dura=="31-90")
                    {
                        $duration_low=31;
                        $duration_high=90;
                    }
                    if($dura=="91-180")
                    {
                        $duration_low=91;
                        $duration_high=180;
                    }
                    if($dura=="181-365")
                    {
                        $duration_low=181;
                        $duration_high=365;
                    }
                    if($cnt==0)
                        $sqlc=$sqlc . "projects.duration BETWEEN $duration_low and $duration_high";
                    else
                        $sqlc=$sqlc . " OR projects.duration BETWEEN $duration_low and $duration_high";
                    $cnt++;
                } 
                $sqlc=$sqlc . ")";
            }
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sqlc)) {
                    die("Connection Failed: " . $stmt->error);        
                } else {
                    if ($keyterm!="" && $balance=="")
                        mysqli_stmt_bind_param($stmt, "ss", $keyterm, $keyterm);
                    else if ($keyterm=="" && $balance!="")
                        mysqli_stmt_bind_param($stmt, "i", $balance);
                    else if ($keyterm!="" && $balance!="")
                        mysqli_stmt_bind_param($stmt, "ssi", $keyterm, $keyterm, $balance);
                    mysqli_stmt_execute($stmt);
                    $result=mysqli_stmt_get_result($stmt);

                    $number_of_results = mysqli_num_rows($result);
                    $number_of_pages = ceil($number_of_results/$results_per_page);

                    if(!isset($_GET['page'])) {
                        $page = 1;
                    } else {
                        $page = $_GET['page'];
                    }

                    $this_page_first_result = ($page-1)*$results_per_page;


                    $sql = "SELECT DISTINCT projects.id as proj_id, projects.name as project_name, SUBSTRING(projects.description, 1, 80) as description, projects.category as category, users.first_name as firstName, users.last_name as lastName, (SELECT COUNT(offers.id) FROM offers, projects where proj_id = offers.id) as offerCount
                    from projects, users
                    WHERE projects.owner_id = users.id
                    and projects.deleted=0
                    and projects.archived=0
                    and (SELECT count(*)
                        from offers, freelancer_projects
                        where offers.id = freelancer_projects.offer_id
                        and offers.project_id = projects.id
                        and freelancer_projects.completed = 0
                        and freelancer_projects.dropped=0) < 1";
                    
                if ($keyterm!=""){
                    $sql = $sql ." and (projects.name LIKE CONCAT('%',?,'%') OR projects.description LIKE CONCAT('%',?,'%'))";    
                }
                if ($balance!=""){
                    $sql=$sql . "  and projects.low_balance >= ?";
                }
                $catarr=implode("','", $cats);
                if ($categories!=""){
                    $sql=$sql . " and projects.category IN ('$catarr')"; 
                }
                if($duration!=""){
                    $durs=array();
                    foreach (explode(',', $duration) as $dur) {
                        array_push($durs, substr($dur, 0));
                    }
                    $sql=$sql . " and ( ";
                    $cnt=0;
                    foreach($durs as $dura){
                        if($dura=="0-6")
                        {
                            $duration_low=0;
                            $duration_high=6;
                        }
                        if($dura=="7-30")
                        {
                            $duration_low=7;
                            $duration_high=30;
                        }
                        if($dura=="31-90")
                        {
                            $duration_low=31;
                            $duration_high=90;
                        }
                        if($dura=="91-180")
                        {
                            $duration_low=91;
                            $duration_high=180;
                        }
                        if($dura=="181-365")
                        {
                            $duration_low=181;
                            $duration_high=365;
                        }
                        if($cnt==0)
                            $sql=$sql . "projects.duration BETWEEN $duration_low and $duration_high";
                        else
                            $sql=$sql . " OR projects.duration BETWEEN $duration_low and $duration_high";
                        $cnt++;
                    } 
                    $sql=$sql . ")";
                }
                
                $sql=$sql . " ORDER BY projects.created_at desc";

                $sql=$sql. " LIMIT ". $this_page_first_result . ", " . $results_per_page;
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    die("Connection Failed: " . $stmt->error);        
                } else {
                    if ($keyterm!="" && $balance=="")
                    mysqli_stmt_bind_param($stmt, "ss", $keyterm, $keyterm);
                else if ($keyterm=="" && $balance!="")
                    mysqli_stmt_bind_param($stmt, "i", $balance);
                else if ($keyterm!="" && $balance!="")
                    mysqli_stmt_bind_param($stmt, "ssi", $keyterm, $keyterm, $balance);
                    mysqli_stmt_execute($stmt);
                    $result=mysqli_stmt_get_result($stmt);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result) ) {
                            $arr[]=$row;
                        }
                    }
                    $arr[]=$number_of_pages;
                    $start=(($page - $num_of_links) > 0) ? $page-$num_of_links : 1;
                    $end=(($page + $num_of_links) < $number_of_pages) ? $page+$num_of_links : $number_of_pages;
                    $arr[]=$start;
                    $arr[]=$end;
                    // $resp->arr=$arr;
                    // $resp->pages=$number_of_pages;
                    echo json_encode($arr);
                }
            }
            mysqli_close($conn);
        }
    }


    function loadProject() {
        global $conn;

        $project_id=$_GET['id'];
        if (!$conn) {
            die("Connection Failed: " . mysqli_connect_error());
        } else {
            $arr=array();
            $sql="SELECT projects.*, users.first_name, users.last_name, users.image, count(offers.id) as offersNum, CAST(avg(offers.price) as decimal(18,2)) as offersAvg from projects, users, offers where projects.id= ? and projects.owner_id = users.id and projects.id = offers.project_id";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                die("Connection Failed: " . $stmt->error);        
            } else {
                mysqli_stmt_bind_param($stmt, "i", $project_id);
                mysqli_stmt_execute($stmt);
                $result=mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result) ) {
                        if(isset($_SESSION['userID'])){
                            if($row['owner_id'] == $_SESSION['userID'])
                            {
                                $row['owner']=1;
                            }
                            else
                            {
                                $row['owner']=0;
                            }
                        }
                        else
                        {
                            $row['owner']=0;
                        }
                        $arr[]=$row;

                    }
                }
            }

            $sqlo="SELECT offers.user_id, offers.price, offers.duration, offers.description, offers.created_at, users.first_name, users.last_name, users.main_focus, users.image from offers, users where project_id= ? and users.id=offers.user_id";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sqlo)) {
                die("Connection Failed: " . $stmt->error);        
            } else {
                mysqli_stmt_bind_param($stmt, "i", $project_id);
                mysqli_stmt_execute($stmt);
                $result=mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) > 0) { 
                    while ($row = mysqli_fetch_assoc($result) ) {
                        $row['offer_own']=1;
                        if(isset($_SESSION['userID'])){
                            if ($_SESSION['userID']==$row['user_id'])
                            {
                                $row['offer_own']=1;
                            }
                            else
                            {
                                $row['offer_own']=0;
                            }
                        }
                        else
                        {
                            $row['offer_own']=0;
                        }
                        $arr[]=$row;
                    }
                }
            }

            echo json_encode($arr);
        }
        mysqli_close($conn);
    }

    function postOffer(){
        
        global $conn;
        $arr=array();
        $project_id = $_GET['id'];
        $duration = $_GET['duration'];
        $price = $_GET['price'];
        $offerText = $_GET['offerText'];
        $deleted = 0;
        if(!isset($_SESSION['userID']))
        {
            $arr['logged']=0;
        }
        else {
            $arr['logged']=1;
            $user_id=$_SESSION['userID'];
            if (!$conn) {
                die("Connection Failed: " . mysqli_connect_error());
            } else {
                $sqlCheck="SELECT * FROM offers WHERE user_id = ?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sqlCheck)) {
                    die("Connection Failed: " . $stmt->error);
                } else {
                    mysqli_stmt_bind_param($stmt, "i", $user_id);
                    mysqli_stmt_execute($stmt) or die($stmt->error);
                    $result=mysqli_stmt_get_result($stmt);
                    if (mysqli_num_rows($result) > 0) { 
                        $arr['success']=0;
                    }
                    else {
                        mysqli_stmt_close($stmt);
                        $sql = "INSERT INTO offers (price, duration, created_at, updated_at, deleted, description, project_id, user_id) values (?,?,?,?,?,?,?,?)";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            die("Connection Failed: " . $stmt->error);
                        } else {
                            $dateNow=date("Y-m-d H:i:s");
                            mysqli_stmt_bind_param($stmt, "iissisii", $price, $duration, $dateNow, $dateNow, $deleted, $offerText, $project_id, $user_id);
                            mysqli_stmt_execute($stmt) or die($stmt->error);
                            $arr['success']=1;
                        } 
                        mysqli_stmt_close($stmt);
                    }
                    
                }
            }
            mysqli_close($conn);
        } 
        echo json_encode($arr);
    } 
?>