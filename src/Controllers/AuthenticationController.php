<?php

include 'dbh.php';


$fid = $_POST['fid'];

if( $fid == 1 ) {
    signupSubmit();    
}


function signupSubmit()
{
    global $conn;

    $userName = $_POST['userName'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $countryID = $_POST['countryID'];
    $birthDate = $_POST['birthDate'];
    $deleted = 0;
    $verified = 0;
    $balance = 0 ; 
    $isfreelancer = 0;
    $image='./assets/images/placeholder.png';


    if (!$conn) {
        die("Connection Failed: " . mysqli_connect_error());
    } else {

        $arr = array();

        $sql = "select email from users where email=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            die("Connection Failed: " . mysqli_connect_error());
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);

            if ($resultCheck > 0)
                $arr['email'] = '1';
            else
                $arr['email'] = '0';
        }
        mysqli_stmt_close($stmt);

        $sql = "select username from users where username=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            die("Connection Failed: " . mysqli_connect_error());
        } else {
            mysqli_stmt_bind_param($stmt, "s", $userName);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);

            if ($resultCheck > 0)
                $arr['userName'] = '1';
            else
                $arr['userName'] = '0';
        }
        mysqli_stmt_close($stmt);

        if ($arr['userName'] == '1' || $arr['email'] == '1') {
            echo json_encode($arr);
        } else {
            $sql = "insert into users (first_name , last_name , username , email , password , birth_date, gender , deleted ,verified ,created_at, country_id , balance ,isfreelancer ,updated_at , image) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                die("Connection Failed: " . mysqli_connect_error());
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                //$dateNow = date("Y") . '-' . date("m") . '-' . date("d");
                $dateNow=date("Y-m-d H:i:s");
                mysqli_stmt_bind_param($stmt, "sssssssiisiiiss", $firstName, $lastName, $userName, $email, $hashedPassword, $birthDate, $gender, $deleted, $verified, $dateNow, $countryID,$balance,$isfreelancer,$dateNow,$image);
                mysqli_stmt_execute($stmt);
                //$arr['success']=mysqli_stmt_error($stmt);
                $arr['success'] = '1';

                echo json_encode($arr);
            }
            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($conn);
}
