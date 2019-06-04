<?php

    include 'dbh.php';

    $keyterm="";
    $categories="";
    $duration="";
    $balance="";

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

            $sql = "SELECT DISTINCT projects.name as project_name, projects.description as description, users.name as userName
            from projects, users
            WHERE projects.user_id = users.id
            and projects.deleted=0
            and projects.archived=0";
            
        if (isset($keyterm) )
            $sql = $sql ." and (projects.name LIKE CONCAT('%',?,'%') OR projects.description LIKE CONCAT('%',?,'%'))";

        if (isset($balance) )
            $sql=$sql . "  and projects.low_balance >= ?";

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
                echo json_encode($arr);
            }
        }
            mysqli_close($conn);
?>