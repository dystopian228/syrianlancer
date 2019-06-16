<?php 

session_start();
include 'dbh.php'; 

$fid = $_POST['fid'];

if($fid == 1) {
    fetchValues();
}

if($fid == 2) {
    fetchTransaction();
}

if($fid == 3) {
    deposit();
}

if($fid == 4) {
    withdraw();
}

function fetchValues(){
    global $conn;

    if(!$conn){
        die("Connection Failed: " . mysqli_connect_error());
    }else{
        $arr = array();
        $sql_total= 'SELECT users.balance as bal FROM `users` WHERE users.id = '.$_SESSION['userID'];
        $sql_locked='SELECT sum(projects.high_balance) as bal from projects where projects.archived=0 and projects.owner_id='.$_SESSION['userID'];

        $result_total = $conn->query($sql_total); 
        $result_locked = $conn->query($sql_locked);

        while($row = $result_total->fetch_assoc()) {
            $v1 = $row['bal'];
        }

        while($row = $result_locked->fetch_assoc()) {
            $v2 = $row['bal'];
        }

        $arr['total'] = $v1;
        $arr['locked'] =$v2;

        echo json_encode($arr);

        $conn->close();

    }
    
}

function fetchTransaction(){
    global $conn;

    if(!$conn){
        die("Connection Failed: " . mysqli_connect_error());
    }
    else{
        $arr = array(); 
        $sql = "select type , amount ,timestamp  from  transactions where user_id = ".$_SESSION['userID']." order by timestamp desc";

        $result = mysqli_query($conn, $sql);
        
        while ($row = mysqli_fetch_array($result)) {
            $arr[]=$row;
        }
        echo json_encode($arr);

        $conn->close();

    }
    
}

function deposit(){
    global $conn;

    $amount = $_POST['amount'];

    if(!$conn){
        die("Connection Failed: " . mysqli_connect_error());
    }
    else{
        
        $sql= "update users set balance = (balance + ".$amount.") where users.id=".$_SESSION['userID'];
        $dateNow=date("Y-m-d H:i:s");
        $sql_log = "insert into transactions (timestamp , amount , type , user_id) values ('".$dateNow."',".$amount.",1,".$_SESSION['userID'].")";
        if ($conn->query($sql) === TRUE ) {
            echo "1";
        } else {
            echo "0";
        }

        if($conn->query($sql_log) === TRUE) {
            echo "1";
        } else {
            echo "0";
        }

        $conn->close();

    }
}

function withdraw(){
    global $conn;
    $amount = $_POST['amount'];

    if(!$conn){
        die("Connection Failed: " . mysqli_connect_error());
    }
    else{
        
        $sql= "update users set balance = (balance - ".$amount.") where users.id=".$_SESSION['userID'];
        $dateNow=date("Y-m-d H:i:s");
        $sql_log = "insert into transactions (timestamp , amount , type , user_id) values ('".$dateNow."',".$amount.",0,".$_SESSION['userID'].")";
        if ($conn->query($sql) === TRUE ) {
            echo "1";
        } else {
            echo "0";
        }

        if($conn->query($sql_log) === TRUE) {
            echo "1";
        } else {
            echo "0";
        }

        $conn->close();

    }
}


