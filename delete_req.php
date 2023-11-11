<?php
include 'connection/conn.php';

if (isset($_GET['deleteid'])){
    $appointment_ID=$_GET['deleteid'];

    $sql="DELETE FROM `request_form` WHERE `request_ID`='$request_ID'";
    $result=mysqli_query($conn,$sql);
    if($result){
        //echo "Deleted successfully";
        header('Location: pendinga-forms-elements.php');
        die(mysqli_error($conn)); 
    }else{ 
        die(mysqli_error($conn)); 
    }  
}

?>