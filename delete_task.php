<?php session_start();

include("config.php");

if(isset($_POST['ID'])){

    $ID = $_POST['ID'];

    $query = "DELETE FROM `tasks` WHERE ID = $ID";
    
    $query_result = mysqli_query( $con, $query );

    if($query_result){
        $_SESSION['status'] = "Successfully Deleted!";
        $_SESSION['status_code'] = "success";
        header("Location: index.php");
        exit();
    }else{
        $_SESSION['status'] = "Delete Failed";
        $_SESSION['status_code'] = "error";
        header("Location: index.php");
        exit();
    }
}

?>