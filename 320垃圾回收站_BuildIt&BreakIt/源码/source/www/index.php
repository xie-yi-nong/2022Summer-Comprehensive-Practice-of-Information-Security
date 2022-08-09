<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/www/static/css/cupcake.css">
    

</head>
<body background="/www/static/images/background.jpeg" style="background-repeat:no-repeat;background-attachment:fixed;background-size:100% 100%; ">

    <h1 style="font-family:LiSu">垃圾场</h1>
    
    <?php if (isset($user)): ?>
        
        <p style="font-family:arial;font-size:40px;">Hello <?= htmlspecialchars($user["name"]) ?> </p>
        
        
        <form style="font-family:LiSu" action="upload.php" method="post" enctype="multipart/form-data">    
        <input style="font-size:30px;font-family:LiSu;BACKGROUND-COLOR: transparent;border:transparent;color:white"type="submit" value="前往丢垃圾">
        <p style="font-family:arial;font-size:30px;"><a href="logout.php">Log out</a></p>
        </form>
        
    <?php else: ?>
        
        <p style="font-family:arial;font-size:30px;"><a href="login.php">Log in</a> or <a href="signup.html">become a rubbisher</a></p>
        
    <?php endif; ?>


</body>
</html>
