<?php

session_start();

include 'dbh.php';

if ($_POST['fid'] == '1') {
    getUserIDs();
}
if ($_POST['fid'] == '2') {
    sentMessage();
}
if ($_POST['fid'] == '3') {
    fetchMessages();
}
if ($_POST['fid'] == '4'){
    checkReceiver();
}

function getUserIDs()
{
    global $conn;

    if (!$conn) {
        die("Connection Failed: " . mysqli_connect_error());
    } else {
        $freelancer_projects_id = $_POST['freelancer_projects_id'];
        $arr = array();

        $sql = 'select projects.owner_id as ownerID , offers.user_id as userID 
        from offers , projects , freelancer_projects 
        WHERE offers.project_id = projects.id and freelancer_projects.offer_id = offers.id and freelancer_projects.id =' . $freelancer_projects_id;

        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result)) {
            $arr['userID'] = $row['userID'];
            $arr['ownerID'] = $row['ownerID'];
        }

        echo json_encode($arr);
    }
    mysqli_close($conn);
}


function sentMessage()
{
    global $conn;

    $userID = $_POST['userID'];
    $ownerID = $_POST['ownerID'];

    $senderID = "";
    $receiverID = "";
    $message = $_POST['message'];
    $dateNow = date("Y-m-d H:i:s");
    $freelancer_projects_id = $_POST['freelancer_projects_id'];


    if ($_SESSION['userID'] == $userID) {
        $senderID = $userID;
        $receiverID = $ownerID;
    } else if ($_SESSION['userID'] == $ownerID) {
        $senderID = $ownerID;
        $receiverID = $userID;
    }

    if (!$conn) {
        die("Connection Failed: " . mysqli_connect_error());
    } else {
        $sql = "INSERT INTO messages (content , sent_at , sender_id , receiver_id , freelancer_project_id) VALUES (?,?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            die("Connection Failed: " . mysqli_connect_error());
        } else {
            mysqli_stmt_bind_param($stmt, "ssiii", $message, $dateNow, $senderID, $receiverID, $freelancer_projects_id);
            mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}

function fetchMessages()
{
    global $conn;

    if (!$conn) {
        die("Connection Failed: " . mysqli_connect_error());
    } else {
        $arr = array();

        $userID = $_POST['userID'];
        $ownerID = $_POST['ownerID'];
        $freelancer_projects_id = $_POST['freelancer_projects_id'];


        $sql = "SELECT messages.sender_id as senderID , messages.content as message , users.username as senderName , messages.sent_at as sentAT 
        FROM messages , users 
        where messages.sender_id = users.id and  
        ( (messages.sender_id = " . $userID . " AND messages.receiver_id = " . $ownerID . ") OR (messages.sender_id = " . $ownerID . " AND messages.receiver_id = " . $userID . ") )
        and messages.freelancer_project_id = " . $freelancer_projects_id." 
        order by sentAT desc";

        $result = mysqli_query($conn, $sql);
        
        while ($row = mysqli_fetch_array($result)) {
            $arr[]=$row;
        }

        echo json_encode($arr);
    }
    mysqli_close($conn);
}

function checkReceiver(){
    global $conn; 
    
    $userID = $_POST['userID'];
    $freelancer_projects_id = $_POST['freelancer_projects_id'];

    $state=true;

    if($_SESSION['userID'] != $userID) {
        $state = false;
    }

    if(!$conn){
        die("Connection Failed: " . mysqli_connect_error());
    }else{
        $arr = array(); 

        $sql = 'select completed , dropped from freelancer_projects where id = '.$freelancer_projects_id;

        $result = mysqli_query($conn, $sql);
        
        while ($row = mysqli_fetch_array($result)) {
            if($row['completed']==1 || $row['dropped']==1){
                $state =false;
            }
        }

        if($state == true){
            echo 1; 
        }
        else{
            echo 0;
        }

        $conn->close();

    }
}