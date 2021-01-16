<?php
    require_once ('session.php');
    require_once ('included_functions.php');
    if(adminLogged_in()){
        redirect_to("reporting.php");
        exit;
    }
    $mysqli = db_connection();

    if (isset($_POST["signinButton"])){
        if (isset($_POST["inputEmail"]) && $_POST["inputEmail"] !== "" &&
            isset($_POST["inputPassword"]) && $_POST["inputPassword"] !== ""){
            $username = $_POST["inputEmail"];
            $password = $_POST["inputPassword"];

            if (($username == "admin") && ($password == "admin")) {
                $_SESSION["userID"] = $username;
                redirect_to("reporting.php");
            }
            else{
                $_SESSION["message"] = "Email/Password Not Found";
                redirect_to("adminSignin.php");
            }

        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Log In</title>
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

<nav class="navbar navbar-default navbar-static-top">
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
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="signin.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            </ul>
        </div>
    </div>
</nav>

<?php
    if (($output = message()) !== null) {
        echo "<br/>";
        echo "<div class='container'>";
        echo "<div class='row'>";
        echo "<div class='col-lg-2'></div>";
        echo "<div class='col-lg-8'>";
        echo        $output;
        echo "</div>";
        echo "<div class='col-lg-2'></div>";
        echo "</div>";
        echo "</div>";
}
?>

<div class="container">
    <form action="adminSignin.php" method="post" class="form-adminSignin">
        <fieldset>
            <h2 class="form-signin-heading">Admin sign in to see the dashboard</h2>
            <div class="form-group">
                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="text" name="inputEmail" class="form-control" placeholder="Username" required autofocus>
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" name="inputPassword" class="form-control" placeholder="Password" required>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="signinButton">Sign In</button>
        </fieldset>
    </form>
        <a href="signin.php" style="display: block;text-align: center;font-size: 19px;"><span class="glyphicon glyphicon-user"></span>
 User SignIn</a>
</div> <!-- /container -->


</body>
</html>
