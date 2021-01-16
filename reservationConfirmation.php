<?php
    require_once ('session.php');
    require_once ('included_functions.php');
    require_once ('tcpdf_min/tcpdf.php');

    verify_login();
    $mysqli = db_connection();

    // Reservation info
    $resID = $_POST['resID'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $length = $_POST['length'];
    $feeID = $_POST['feeID'];
    $code = $_POST['code'];
    $total = $_POST['totalCost'];
    $VIN = $_POST['vin'];
    $tranid = str_replace('RES', 'TRAN', $resID);
    $foo = 0.0655 * $_POST['totalCost'];
    $tax = number_format((float)$foo, 2, '.', '');
    $custID = $_SESSION['userID'];
    $insuranceID = $_POST['insuranceID'];

    $cardnumber = $_POST['cardnumber'];
    $cardtype = $_POST['cardtype'];
    $cardname = $_POST['cardname'];
    $expiration = $_POST['expiration'];
    $exp_date = substr($expiration, -2, 2);
    $exp_month = substr($expiration, 0, 2);
    $cvv = $_POST['securitycode'];

    $query = "INSERT INTO Reservation VALUES (";
    $query .= "'".$resID."', ";
    $query .= "'".$start."', ";
    $query .= "'".$end."', ";
    $query .= "".$length.", ";
    $query .= "'".$feeID."', ";
    $query .= "'".$code."', ";
    $query .= "'".$total."', ";
    $query .= "'".$VIN."', ";
    $query .= "'RES-1', ";
    $query .= "'".$custID."', ";
    $query .= "'".$insuranceID."')";
    $result = $mysqli->query($query);
    if($result){
        #redirect_to("account.php");
    }

    $query = "INSERT INTO CreditCard VALUES (";
    $query .= "'".$cardnumber."', ";
    $query .= "'".$cardtype."', ";
    $query .= "'".$cardname."', ";
    $query .= "'".$exp_month."', ";
    $query .= "'".$exp_date."', ";
    $query .= "'".$cvv."')";
    $result = $mysqli->query($query);
    if($result){
        #redirect_to("account.php");
    }

    $query = "INSERT INTO Transaction VALUES (";
    $query .= "'".$tranid."', ";
    $query .= "'".$feeID."', ";
    $query .= "'".$tax."', ";
    $query .= "'".$total."', ";
    $query .= "'".date("Y-m-d")."', ";
    $query .= "'".$cardnumber."', ";
    $query .= "'".$resID."')";
    $result = $mysqli->query($query);
    if($result){
        #redirect_to("account.php");
    }
    $message = send_mail($resID, $mysqli);

    $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $obj_pdf->SetCreator(PDF_CREATOR);
    $obj_pdf->SetTitle("Reservation Details");
    $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
    $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $obj_pdf->SetDefaultMonospacedFont('helvetica');
    $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);
    $obj_pdf->setPrintHeader(false);
    $obj_pdf->setPrintFooter(false);
    $obj_pdf->SetAutoPageBreak(TRUE, 10);
    $obj_pdf->SetFont('helvetica', '', 12);
    $obj_pdf->AddPage();
    $obj_pdf->writeHTML($message);
    $filename = $resID.".pdf";
    $obj_pdf->Output($_SERVER['DOCUMENT_ROOT'].$filename, 'F');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Confirmation</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <link href="signin.css" rel="stylesheet">

    <style>
        .navbar .navbar-collapse {
            text-align: center;
        }

    </style>
</head>

<body>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Besoins Car Rental</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Home</a></li>
                <li><a href="explore.php">Explore</a></li>
                <li class="active"><a href="reserve.php">Reserve</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
            <?php
            if(logged_in()){
                echo "<ul class='nav navbar-nav navbar-right'>";
                echo "<li><a href='account.php'><span class='glyphicon glyphicon-user'></span> My Account</a></li>";
                echo "<li><a href='signout.php'><span class='glyphicon glyphicon-log-out'></span> Logout</a></li>";
                echo "</ul>";
            }
            else{
                echo "<ul class='nav navbar-nav navbar-right'>";
                echo "<li><a href='signup.php'><span class='glyphicon glyphicon-user'></span> Sign Up</a></li>";
                echo "<li><a href='signin.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>";
                echo "</ul>";
            }
            ?>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <br/><br/>
    <div class="page-header">
        <h1><div class="text-center" style="color: darkred">Hourra!!!</div></h1>
    </div>
    <br/>

    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6" style="font-size: 20px; text-align: center">
            <h1>Your reservation has been made!</h1>
            <br>
            <p style="color: #8c8c8c">You can download the transaction details here as pdf <a href="<?php echo './'.$resID.'.pdf';?>" class="btn btn-danger" download="<?php echo $resID.'.pdf';?>">Download</a>
            <p style="color: #8c8c8c">We have sent you a mail with your reservation details or you can view on <a href="account.php">myAccount</a></p>
            <p style="color: #8c8c8c">Thank you for choosing Besoins Car Rental and we look forward to seeing you soon <span class="glyphicon glyphicon-thumbs-up"></span> and please give your feedback <a href="feedback.php">here <span class="glyphicon glyphicon-comment"></span></a></p>

        </div>
        <div class="col-lg-3"></div>
    </div>
</div>


<script>
    $(document).ready(function() {
        if (window.history && window.history.pushState) {

            $(window).on('popstate', function() {
                var hashLocation = location.hash;
                var hashSplit = hashLocation.split("#!/");
                var hashName = hashSplit[1];

                if (hashName !== '') {
                    var hash = window.location.hash;
                    if (hash === '') {
                        alert('Back button was pressed.');
                        window.location='explore.php';
                        return false;
                    }
                }
            });

            window.history.pushState('forward', null, './#forward');
        }
    });
</script>
