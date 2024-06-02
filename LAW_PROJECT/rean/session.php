<?php   
session_start()
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    $_SESSION ['username'] = "TOLA12345";
    echo $_SESSION ['username'];

    if (!isset($_SESSION ['username'])) {
        echo "not login";

    }else{
        echo"you are login";
    }
    
    
    ?>
</body>
</html>