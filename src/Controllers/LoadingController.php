<?php 

include 'dbh.php';

$fid=$_GET['fid'];

if($fid==1){
    loadCountries();
}

function loadCountries(){
    global $conn;

    if(!$conn)
    {
        die("Connection Failed: " . mysqli_connect_error());
    }
    else{
        $sSQL= 'SET CHARACTER SET utf8'; 
        mysqli_query($conn,$sSQL);

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