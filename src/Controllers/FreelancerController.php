<?php

include 'dbh.php';

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
} else {
    $arr = array();
    $name = $_GET['name'] . '%';
    $rating = $_GET['ratingValue'];
    $mainFocus = $_GET['mainFocus'].'%';
    $page = $_GET['page'];
    $pageLimit = $_GET['pageLimit'];

    $sql = "SELECT distinct users.id as userID , concat(users.first_name,' ',users.last_name) as name ,users.main_focus as mainFocus, image,
    (SELECT COALESCE(AVG(freelancer_projects.rating),0) FROM freelancer_projects,`offers` WHERE offers.user_id=users.id AND offers.id=freelancer_projects.offer_id and (freelancer_projects.completed=1 or freelancer_projects.dropped=1)) as rating
    FROM users
    WHERE
    users.isfreelancer=1
    and
    (SELECT COALESCE(AVG(freelancer_projects.rating),0) FROM freelancer_projects,`offers` WHERE offers.user_id=users.id AND offers.id=freelancer_projects.offer_id and (freelancer_projects.completed=1 or freelancer_projects.dropped=1)) >= ?
    AND 
    concat(users.first_name,' ',users.last_name) like ?
    AND
    users.main_focus like ?";



    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die("Connection Failed: " . mysqli_connect_error());
    } else {
        mysqli_stmt_bind_param($stmt, "dss", $rating, $name,$mainFocus );
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $tempCounter = mysqli_num_rows($result);
    }

    mysqli_stmt_close($stmt);
    $sql = $sql . " limit ?,?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die("Connection Failed: " . mysqli_connect_error());
    } else {
        $start_index = ($page - 1) * $pageLimit;
        mysqli_stmt_bind_param($stmt, "dssii", $rating, $name,$mainFocus, $start_index, $pageLimit);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            while ($row = mysqli_fetch_array($result)) {
                $arr[] = $row;
            }
            $arr[] = mysqli_num_rows($result);
        } else {
            $arr[] = 0;
        }
        $arr[] = $tempCounter;
        echo json_encode($arr);
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
