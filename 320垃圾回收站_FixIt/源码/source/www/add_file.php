<?php

if(isset($_FILES['uploaded_file'])) {
    
    if($_FILES['uploaded_file']['error'] == 0) {
        
        $dbLink = new mysqli('localhost', 'root', '', 'files');
        if(mysqli_connect_errno()) {
            die("MySQL connection failed: ". mysqli_connect_error());
        } 
        
        $name = $dbLink->real_escape_string($_FILES['uploaded_file']['name']);
        $mime = $dbLink->real_escape_string($_FILES['uploaded_file']['type']);
        $data = $dbLink->real_escape_string(file_get_contents($_FILES  ['uploaded_file']['tmp_name']));
        $size = intval($_FILES['uploaded_file']['size']); 
        
        $query = "
            INSERT INTO `file` (
                `name`, `mime`, `size`, `data`, `created`
            )
            VALUES (
                '{$name}', '{$mime}', {$size}, '{$data}', NOW()
            )"; 
        
        $result = $dbLink->query($query); 
        
        if($result) {
            echo '<br>';
            echo '<p style="font-family:arial;font-size:30px;font-family:LiSu;">您已成功将垃圾丢入垃圾桶！</p>';
        }
        else {
            echo '<p style="font-family:arial;font-size:30px;font-family:LiSu;">糟糕！没丢进去TT</p>'
               . "<pre>{$dbLink->error}</pre>";
        }
    }
    else {
        echo '<p style="font-family:arial;font-size:30px;">An error accured while the file was being uploaded.</p> '
           . 'Error code: '. intval($_FILES['uploaded_file']['error']);
    } 
    
    $dbLink->close();
}
else {
    echo '<p style="font-family:arial;font-size:30px;font-family:LiSu;">糟糕！没丢进去TT</p>';
} 

echo '<p style="font-family:arial;font-size:30px;font-family:LiSu;">点击 <a href="index.html">这里</a>继续丢垃圾</p>';
?>  

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="http://localhost:3000/源码/source/www/static/css/cupcake.css">
</head>
<body background="http://localhost:3000/源码/source/www/static/images/background.jpeg" style="background-repeat:no-repeat;background-attachment:fixed;background-size:100% 100%; ">
    <p style="font-family:arial;font-size:30px;"><a href="logout.php">Log out</a></p>
</body>
</html>