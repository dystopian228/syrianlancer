<?php

    include 'dbh.php';

    $keyterm="";
    $categories="";
    $duration="";
    $balance="";
    $results_per_page=8;

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
        $sqlc = "SELECT DISTINCT projects.name as project_name, projects.description as description, projects.category as category, users.first_name as firstName, users.last_name as lastName
                from projects, users
                WHERE projects.owner_id = users.id
                and projects.deleted=0
                and projects.archived=0";
            
        if (isset($keyterm) ){
            $sqlc = $sqlc ." and (projects.name LIKE CONCAT('%',?,'%') OR projects.description LIKE CONCAT('%',?,'%'))";

        }
        if (isset($balance) ){
            $sqlc=$sqlc . "  and projects.low_balance >= ?";
        }

        if ($categories!=""){
            $sqlc=$sqlc . " and projects.category IN ('$categories')"; 
        }   
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sqlc)) {
                die("Connection Failed: " . $stmt->error);        
            } else {
                if (isset($keyterm) && !isset($balance) )
                    mysqli_stmt_bind_param($stmt, "ss", $keyterm, $keyterm);
                else if (isset($balance) && !isset($keyterm) )
                    mysqli_stmt_bind_param($stmt, "i", $balance);
                else if (isset($keyterm) && isset($balance) )
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


                $sql = "SELECT DISTINCT projects.name as project_name, projects.description as description, projects.category as category, users.first_name as firstName, users.last_name as lastName
                from projects, users
                WHERE projects.owner_id = users.id
                and projects.deleted=0
                and projects.archived=0";
                
            if (isset($keyterm) ){
                $sql = $sql ." and (projects.name LIKE CONCAT('%',?,'%') OR projects.description LIKE CONCAT('%',?,'%'))";    
            }
            if (isset($balance) ){
                $sql=$sql . "  and projects.low_balance >= ?";
            }
            if ($categories!=""){
                $sql=$sql . " and projects.category IN ('$categories')"; 
            }
            
            $sql=$sql . " ORDER BY projects.created_at desc";

            $sql=$sql. " LIMIT ". $this_page_first_result . ", " . $results_per_page;
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                die("Connection Failed: " . $stmt->error);        
            } else {
                if (isset($keyterm) && !isset($balance) )
                    mysqli_stmt_bind_param($stmt, "ss", $keyterm, $keyterm);
                else if (isset($balance) && !isset($keyterm) )
                    mysqli_stmt_bind_param($stmt, "i", $balance);
                else if (isset($keyterm) && isset($balance) )
                    mysqli_stmt_bind_param($stmt, "ssi", $keyterm, $keyterm, $balance);
                mysqli_stmt_execute($stmt);
                $result=mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result) ) {
                        $arr[]=$row;
                    }
                }
                $arr[]=$number_of_pages;
                // $resp->arr=$arr;
                // $resp->pages=$number_of_pages;
                echo json_encode($arr);
            }
        }
        mysqli_close($conn);
    }
?>