<?php
    require_once ('session.php');
    require_once ('included_functions.php');
    verify_login();
    $mysqli = db_connection();

    $comments = $_POST["comments"];
    $experience = $_POST["experience"];

    $query = "INSERT INTO Feedback VALUES (";
    $query .= "'".$_SESSION['userID']."', ";
    $query .= "'".$experience."', ";
    $query .= "'".$comments."')";
    $result = $mysqli->query($query);
    if($result){
        redirect_to("index.php");
    }
?>