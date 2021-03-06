<?php
    require_once ('session.php');
    require_once ('included_functions.php');
    verify_login();
    $mysqli = db_connection();

    if(!isset($_SESSION["userID"])) {
        $_SESSION["message"] = "You must login in first!";
        redirect_to("signin.php");
    }
    else{
        $ID = $_SESSION['userID'];
    }

    if(isset($_POST["delete"])){
        $password = $_POST["confirm_pw"];
        $query = "SELECT * FROM Customer WHERE custID = '".$ID."'";
        $result = $mysqli->query($query);
        $row = $result->fetch_assoc();

        if (password_check($password, $row['hashed_pw'])) {
            $deleteQuery = "DELETE FROM Customer WHERE custID = '".$ID."'";
            $result = $mysqli->query($deleteQuery);
            if($result){
                $_SESSION["userID"] = NULL;
                $_SESSION["email"] = NULL;
                $_SESSION["message"] = "Your account has been deleted.";
                redirect_to("signin.php");
            }
            else{
                $_SESSION["message"] = "Your account can't be deleted.";
                redirect_to("account.php");
            }
        }
        else{
            $_SESSION["message"] = "Your account can't be deleted. You entered the wrong password";
            redirect_to("account.php");
        }
    }
    else{
        $_SESSION["userID"] = NULL;
        $_SESSION["email"] = NULL;
        $_SESSION["message"] = "You have been logged out!";
        redirect_to("signin.php");
    }
?>