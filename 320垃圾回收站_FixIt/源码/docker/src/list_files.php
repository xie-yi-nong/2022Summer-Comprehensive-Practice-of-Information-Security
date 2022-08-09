<?php

$dbLink = new mysqli('mysql', 'garbage_collection', 'garbage_collection', 'garbage_collection');
if(mysqli_connect_errno()) {
    die("MySQL connection failed: ". mysqli_connect_error());
}

$sql = 'SELECT `id`, `name`, `mime`, `size`, `created` FROM `file`';
$result = $dbLink->query($sql);

if($result) {

    if($result->num_rows == 0) {
        echo '<p>There are no files in the database</p>';
    }
    else {

        echo '<table width="100%" >
                <tr>
                    <td><b>Name</b></td>
                    <td><b>Mime</b></td>
                    <td><b>Size (bytes)</b></td>
                    <td><b>Created</b></td>
                    <td><b>&nbsp;</b></td>
                </tr>';

        while($row = $result->fetch_assoc()) {
            echo "
                <tr>
                    <td>{$row['name']}</td>
                    <td>{$row['mime']}</td>
                    <td>{$row['size']}</td>
                    <td>{$row['created']}</td>
                    <td><a href='get_file.php?id={$row['id']}'>捡垃圾</a></td>
                </tr>";
        }

        echo '</table>';
    }

    $result->free();
}
else
{
    echo 'Error! SQL query failed:';
    echo "<pre>{$dbLink->error}</pre>";
}

$dbLink->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>list</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/static/css/cupcake.css">
</head>
<body background="/static/images/background.jpeg" style="background-repeat:no-repeat;background-attachment:fixed;background-size:100% 100%; ">
    <p style="font-family:arial;font-size:30px;"><a href="index.html">还想丢垃圾</a></p>
    <p style="font-family:arial;font-size:30px;"><a href="logout.php">Log out</a></p>

</body>
</html>
