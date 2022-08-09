<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="/www/static/css/cupcake.css">
</head>
<body background="/www/static/images/background.jpeg" style="background-repeat:no-repeat;background-attachment:fixed;background-size:100% 100%; ">
    <br>
    <form method="post" action="" enctype="multipart/form-data">
    <!--enctype="multipart/form-data"这样服务器就会知道，我们要传递一个文件,
--这样服务器可以知道上载的文件带有常规的表单信息。-->
    <!--表单默认使用application/x-www-form-urlencoded来提交数据。-->    
        <input style="color:grey;font-size:20px;font-family:LiSu;width:300px;"type="file" name="file"/>   
        <input style="color:white;font-size:30px;background-color:transparent;border:transparent;text-decoration:underline;font-family:LiSu"type="submit" value="丢垃圾"/>
<!--服务器端的$_FILES[][]的第一个中括号值要与类型为file的name="file"的值保持一致-->
    </form>
    <p style="font-size:25px;font-family:LiSu;">
        <p style="font-family:arial;font-size:30px;"><a href="logout.php">Log out</a></p>
    </p>
</body>









<?php

header("Content-type:text/html;charset=utf-8");

if (!is_dir("uploadFiles/")) {
    mkdir("uploadFiles/");
}
if($_FILES['file']['name'] == ''){
    die('请上传文件');
}
if (file_exists("uploadFiles/" . $_FILES["file"]["name"])) {
    echo "文件已存在";
} else {
    move_uploaded_file($_FILES["file"]["tmp_name"], "/uploadFiles/" . $_FILES["file"]["name"]);
    echo '<p style="font-family:arial;font-size:30px;font-family:LiSu;">您已成功将垃圾丢入垃圾桶！</p>';
    echo "文件路径：uploadFiles/".$_FILES["file"]["name"];
}

?>
