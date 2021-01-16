<!DOCTYPE html>
<html>
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <link href="signin.css" rel="stylesheet">
<body>

<?php
echo "My first PHP script!";

$resID = 'RES9283';

?>

    <p style="color: #8c8c8c">You can download the transaction details here as pdf <?php  echo $resID.'.pdf';?> <a href="./" class="btn btn-danger" download="<?php echo $resID.'.pdf';?>">Download</a>



</body>
</html>