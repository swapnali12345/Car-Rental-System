<?php
    require_once ('session.php');
    require_once ('included_functions.php');
    verify_login();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Feedback Form </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="form.css" >
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
                <li><a href="reserve.php">Reserve</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li class="active"><a href="feedback.php">Feedback</a></li>
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
        <div class="row " style="margin-top: 10%">
            <div class="col-md-6 col-md-offset-3 form-container">
                <center><h2>Feedback</h2></center>
                <form role="form" action="thanks.php" method="post" id="reused_form">
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <label>How do you rate your overall experience?</label>
                            <p>
                                <label class="radio-inline">
                                    <input type="radio" name="experience" id="radio_experience" value="bad" >
                                    Bad
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="experience" id="radio_experience" value="average" >
                                    Average
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="experience" id="radio_experience" value="good" checked>
                                    Good
                                </label>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <label for="comments"> Comments:</label>
                            <textarea class="form-control" type="textarea" name="comments" id="comments" placeholder="Your Comments" maxlength="6000" rows="7" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <button type="submit" class="btn btn-lg btn-warning btn-block" name="submitFeedback">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</div>


</body>
</html>

