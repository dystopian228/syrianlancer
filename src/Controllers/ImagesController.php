<?php



if($_FILES["file"]["name"] != '')
{
    $arr = array();
    $test = explode(".",$_FILES["file"]["name"]);
	$ext = end($test);
	$name = generateRandomString().'.'.$ext;
    $location = '../../assets/images/uploaded/'.$name;
    $DBLocation = './assets/images/uploaded/'.$name;
    move_uploaded_file($_FILES["file"]["tmp_name"],$location);
    $arr['img']=1;
    $arr['img_location']=$DBLocation;
    session_start();
    include 'dbh.php';

    if(!$conn){
        die("Connection Failed: " . mysqli_connect_error());
    }
    else{
        
        $sql = "UPDATE users SET image = '".$DBLocation."' WHERE id = ".$_SESSION['userID'];
        if ($conn->query($sql) === TRUE) {
            $arr['sql']=1;
            $_SESSION['image']=$DBLocation;
        } else {
            $arr['sql']=0;
        }
        

        echo json_encode($arr);

    }
    
    mysqli_closE($conn);
}




function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}