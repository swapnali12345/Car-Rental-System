<?php

	session_start();
	
	function message() {
		if (isset($_SESSION["message"])) {
			$output = "<div class='alert alert-danger text-center' role='alert'><strong>".$_SESSION["message"]."</strong></div>";
			
			$_SESSION["message"] = null;
			
			return $output;
		}
		else {
			return null;
		}
	}

	function errors() {
		if (isset($_SESSION["errors"])) {
			$errors = $_SESSION["errors"];
			
			$_SESSION["errors"] = null;
			
			return $errors;
		}
	}

    function verify_login(){
        if(!isset($_SESSION["userID"]) && $_SESSION["userID"] === NULL){
            $_SESSION["message"] = "You must sign in first before accessing this page!!!";
            header("Location: signin.php");
            exit;
        }
    }

    function verify_adminLogin(){
        if((!isset($_SESSION["userID"]) && $_SESSION["userID"] === NULL ) || $_SESSION["userID"] !== "admin"){
            $_SESSION["message"] = "You must sign in first before accessing this page!!!";
            header("Location: adminSignin.php");
            exit;
        }
    }

    function logged_in(){
        if(!isset($_SESSION["userID"]) && $_SESSION["userID"] === NULL){
            return false;
        }
        else{
            return true;
        }
    }

    function adminLogged_in(){
        if((!isset($_SESSION["userID"]) && $_SESSION["userID"] === NULL) || $_SESSION["userID"] !== "admin"){
            return false;
        }
        else{
            return true;
        }
    }

    function verify_admin(){
        if(isset($_SESSION["userID"]) && $_SESSION["userID"] !== NULL && $_SESSION["userID"] === "admin"){
            redirect_to("index.php");
        }
    }

    function send_mail($resID, $mysqli){
        $ID = $_SESSION['userID'];
        $query = "SELECT * FROM Customer ";
        $query .= "WHERE custID = '".$ID."' LIMIT 1";

        $result = $mysqli->query($query);
        $rows = $result->fetch_assoc();

        $to = $rows['email'];
        $subject = "Car Reservation Details - Besoins Car Rental Service";

        $reservationQuery = "SELECT * FROM Customer ";
        $reservationQuery .= "NATURAL JOIN Reservation ";
        $reservationQuery .= "JOIN Vehicles ON Reservation.VIN = Vehicles.VIN ";
        $reservationQuery .= "JOIN Status ON Reservation.statusID = Status.statusID ";
        $reservationQuery .= "JOIN Insurance ON Reservation.insuranceID = Insurance.insuranceID ";
        $reservationQuery .= "JOIN Fee ON Reservation.feeID = Fee.feeID ";
        $reservationQuery .= "JOIN Discount ON Reservation.code = Discount.code ";
        $reservationQuery .= "WHERE custID = '".$ID."' AND Reservation.resID = '".$resID."' ORDER BY pickup_date DESC";
        $results = $mysqli->query($reservationQuery);
        $row = $results->fetch_assoc();

        $message  = "<h4 >Dear ".$row['fname']." ".$row['lname'].",</h4>";
        $message .=  "<h4 style='color: #c9302c'>Reservation Number: ".substr($row['resID'],3,4)."&nbsp;&nbsp;&nbsp;</h4>";
        $message .=  "<table class='table table-hover'>";
        $message .=  "<tbody>";
        $message .=  "<tr><td><strong>Vehicle</strong></td><td>".$row['make']." ".$row['model']." ".$row['year']."</td></tr>";
        $message .=  "<tr><td><strong>Pick-up Date</strong></td><td>".$row['pickup_date']."</td></tr>";
        $message .=  "<tr><td><strong>Drop-off Date</strong></td><td>".$row['dropoff_date']."</td></tr>";
        $message .=  "<tr><td><strong>Rental Length</strong></td><td>".$row['rentalLength']." days</td></tr>";
        $message .=  "<tr><td><strong>Fee</strong></td><td>".$row['fee_description']."</td></tr>";
        $message .=  "<tr><td><strong>Insurance</strong></td><td>".$row['name']."</td></tr>";
        $message .=  "<tr><td><strong>Discount</strong></td><td>".$row['discount_description']."</td></tr>";
        $message .=  "<tr><td><strong>Estimated Total</strong></td><td>$".$row['estimate_total']."</td></tr>";
        if($row['status_description'] == 'Reserved'){
            $message .=  "<tr><td><strong>Status</strong></td><td style='color: #5cb85c'>".$row['status_description']."</td></tr>";
        }
        elseif($row['status_description'] == 'Cancelled'){
            $message .=  "<tr><td><strong>Status</strong></td><td style='color: red'>".$row['status_description']."</td></tr>";
        }
        else{
            $message .=  "<tr><td><strong>Status</strong></td><td style='color: blue'>".$row['status_description']."</td></tr>";
        }
        $message .=  "</tbody>";
        $message .=  "</table>";
        $message .=  "<br>";
        $message .= "<h4>Thank you for booking with us!!!</h4>";
        $message .= "<p>Best Regards,</p>";
        $message .= "<p>Besoins Car Rental</p>";


        $header = "From:rentalcarservices2@gmail.com \r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";

        mail($to,$subject,$message,$header);
        return $message;
    }
	
?>