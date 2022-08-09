<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE");

$mysqli = require __DIR__ . "/database.php";
$name=$_POST['name'];
$pwd=$_POST['password'];
$sql="select * from user where name='$name' and password='$pwd'";

$result = $mysqli->query($sql);
$result1 = $mysqli->query($sql);
$user = $result->fetch_assoc();
$row = $result1->fetch_array();


$query = $mysqli->query("select name from user"); 
$ar=array();

while($rows = $query->fetch_assoc()){ 
	$ar[] = $rows['name']; 
} 

$res=in_array($user['name'],$ar);


if ($res) {
    session_start();
    session_regenerate_id();
    $_SESSION["user_id"] = $user["id"];
    header("Location: upload.php");
    exit;
}else {
    do{
        if(!is_null($row)) {
            for($i=0; $i<count($row); $i++) {
                echo $row[$i];
                echo "<br>";
            }
        }else{
            echo"error!";
        }
    } while( $row = $result->fetch_array() );
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/www/static/css/cupcake.css">
</head>
<body background="/www/static/images/background.jpeg" style="background-repeat:no-repeat;background-attachment:fixed;background-size:100% 100%; ">
    
    <h1>Login</h1>
    
    <?php if ($is_invalid): ?>
        <em>Invalid login</em>
    <?php endif; ?>
    
    <form method="post">
        <label for="name" style="color: lightgray;">name</label>
        <input style="width:300px "type="text" name="name" id="name"
               value="<?= htmlspecialchars($_POST["name"] ?? "") ?>">
        
        <label for="password" style="color: lightgray;">Password</label>
        <input style="width:300px"type="password" name="password" id="password">
    </br>
        <button>Log in</button>
    </form>
    
</body>
</html>
