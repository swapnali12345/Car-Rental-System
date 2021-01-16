<?php
    require_once ('session.php');
    require_once ('included_functions.php');
    verify_login();
    $mysqli = db_connection();

    if(isset($_GET['id'])){
        $resID = $_GET['id'];
        $query = "DELETE FROM Reservation WHERE resID = '".$resID."'";
        $result = $mysqli->query($query);

        if($result){
            $_SESSION["message"] = "RESERVATION NUMBER ".substr($resID,3,4)." HAS BEEN DELETED.";
            redirect_to("account.php");
        }
        else{
            $_SESSION["message"] = "ERROR! CAN'T DELETE RESERVATION NUMBER ".substr($resID,3,4);
            redirect_to("account.php");
        }
    }
    elseif(isset($_GET['cancelid'])){
        $resID = $_GET['cancelid'];
        $query = "UPDATE Reservation SET statusID ='RES-2' WHERE resID = '".$resID."'";
        $result = $mysqli->query($query);

        if($result){
            $_SESSION["message"] = "RESERVATION NUMBER ".substr($resID,3,4)." HAS BEEN CANCELLED.";
            redirect_to("account.php");
        }
        else{
            $_SESSION["message"] = "ERROR! CAN'T CANCEL RESERVATION NUMBER ".substr($resID,3,4);
            redirect_to("account.php");
        }
    }
?>