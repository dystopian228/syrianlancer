<?php 
session_start();
include 'dbh.php';

$fid=$_GET['fid'];

if($fid==1){
    loadCountries();
}
if($fid==2){
    loadUser();
}

function loadCountries(){
    global $conn;

    if(!$conn)
    {
        die("Connection Failed: " . mysqli_connect_error());
    }
    else{

        $sql = 'select name from countries';
        $result = mysqli_query($conn,$sql);
            
        $arr = array() ;
        
        if(mysqli_num_rows($result)>0)
        {
            while($row = mysqli_fetch_array($result) )
            {
                $arr[]=$row['name'];
            }
        }

        echo json_encode($arr);

    }

    mysqli_close($conn);

}

function loadUser() {
    global $conn;

    if(!$conn)
    {
        die("Connection Failed: " . mysqli_connect_error());
    }
    else{
        $sql = 'select first_name, last_name, gender, birth_date, image, country_id 
        from users
        where users.id='. $_SESSION['userID'];
        $result = mysqli_query($conn,$sql);
        $arr = array() ;
        
        if(mysqli_num_rows($result)>0)
        {
            while($row = mysqli_fetch_assoc($result) )
            {
                $arr=$row;
            }
        }

        echo json_encode($arr);
    }
    mysqli_close($conn);
}