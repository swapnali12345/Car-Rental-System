<?php
	function redirect_to($new_location) {
		header("Location: " . $new_location);
		exit;
	}
	
	function db_connection() {
		$mysqli = new mysqli('localhost', 'id12978371_admin', 'admin', 'id12978371_rental');
		if($mysqli->connect_errno) {
			die("Could not connect to server!<br />");
		}
		return $mysqli;
	}

	function new_header($name="Default", $urlLink="") {
		echo "<head>";
		echo "	<title>$name</title>";
		echo "	<link rel='stylesheet' href='css/normalize.css'>";
		echo "	<link rel='stylesheet' href='css/foundation.css'>";
	  
		echo "	<script src='js/vendor/modernizr.js'></script>";
		echo "</head>";
		echo "<body>";
		echo "<div class='contain-to-grid sticky'>";
		echo "<nav class='top-bar' data-topbar data-options='sticky_on: large'>";
		echo "<ul class='title-area'>";
		echo "<li class='name'>";
		echo "  <h1 align='left'><a href='http://turing.cs.olemiss.edu/~tnnguye1/".$urlLink."'>".$name."</a></h1>";
		echo "</li>";
		echo "</ul>";
		echo "</nav>";
		echo "</div>";
		echo "<body>";
	}
	
	function print_alert($name="") {
		echo "<br />";
		echo "<div class='row'>";
		echo "<div data-alert class='alert-box info round'>".$name;
		echo "</div>";
		echo "</div>";
		
	}

	function password_encrypt($password) {
		$hash_format = "$2y$10$";   // Use Blowfish with a "cost" of 10
    	$salt_length = 22; 					// Blowfish salts should be 22-characters or more
    	$salt = generate_salt($salt_length);
    	$format_and_salt = $hash_format . $salt;
    	$hash = crypt($password, $format_and_salt);
    	return $hash;
	}

	function generate_salt($length) {
    	$unique_random_string = md5(uniqid(mt_rand(), true));

    	$base64_string = base64_encode($unique_random_string);

    	$modified_base64_string = str_replace('+', '.', $base64_string);

    	$salt = substr($modified_base64_string, 0, $length);

    	return $salt;
	}

	function password_check($password, $existing_hash) {
    	$hash = crypt($password, $existing_hash);
    	if ($hash === $existing_hash) {
    	    return true;
    	}
    	else {
    	    return false;
    	}
	}

    // return vehicle availablity given VIN number
    function vehicleAvailable($vin, $mysqli){
        $query = "SELECT * FROM Vehicles NATURAL JOIN Status WHERE VIN = '".$vin."'";
        $result = $mysqli->query($query);
        $row = $result->fetch_assoc();
        $availablity = $row['status_description'];
        if($availablity == 'Available'){
            return true;
        }
        else{
            return false;
        }
    }

    // return vehicle Type (Category) given VIN number
    function getCategory($vin, $mysqli){
        $query = "SELECT * FROM Vehicles NATURAL JOIN Type WHERE VIN = '".$vin."'";
        $result = $mysqli->query($query);
        $row = $result->fetch_assoc();
        $type = $row['type_name'];
        return $type;
    }

    function getDailyRate($vin, $mysqli){
        $query = "SELECT * FROM Vehicles NATURAL JOIN Type WHERE VIN = '".$vin."'";
        $result = $mysqli->query($query);
        $row = $result->fetch_assoc();
        $cost = $row['daily_rate'];
        return $cost;
    }

    function getCapacity($vin, $mysqli){
        $query = "SELECT * FROM Vehicles NATURAL JOIN Type WHERE VIN = '".$vin."'";
        $result = $mysqli->query($query);
        $row = $result->fetch_assoc();
        $capacity = $row['capacity'];
        return $capacity;
    }

    // Get Vehicle Full Name
    function getVehicleName($vin, $mysqli){
        $query = "SELECT * FROM Vehicles WHERE VIN = '".$vin."'";
        $result = $mysqli->query($query);
        $row = $result->fetch_assoc();
        $name = $row['make']." ".$row['model']." ".$row['year'];
        return $name;
    }

    function getVehicleWithTypeQuery($type){
        $query = "SELECT * FROM Vehicles NATURAL JOIN Type WHERE type_name = '".$type."'";
        return $query;
    }

    // return true if successfully update, false if not successfully updated.
    function updateCarStatus($vin, $mysqli){
        $query = "SELECT * FROM Vehicles ";
        $query .= "JOIN Reservation ON Vehicles.VIN = Reservation.VIN ";
        $query .= "JOIN Status ON Vehicles.statusID = Status.statusID ";
        $result = $mysqli->query($query);
        if($result->num_rows > 0){
            $query = "UPDATE Vehicles SET statusID = 'CAR-2' WHERE VIN = '".$vin."'";
            $result = $mysqli->query($query);
            if(result){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            $query = "UPDATE Vehicles SET statusID = 'CAR-1' WHERE VIN = '".$vin."'";
            $result = $mysqli->query($query);
            if(result){
                return true;
            }
            else{
                return false;
            }
        }
    }
?>
