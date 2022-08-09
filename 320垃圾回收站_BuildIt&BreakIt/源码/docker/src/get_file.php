<?php

if(isset($_GET['id'])) {

    $id = intval($_GET['id']);

    if($id <= 0) {
        die('The ID is invalid!');
    }
    else {

        $dbLink = new mysqli('mysql', 'garbage_collection', 'garbage_collection', 'garbage_collection');
        if(mysqli_connect_errno()) {
            die("MySQL connection failed: ". mysqli_connect_error());
        }

        $query = "
            SELECT `mime`, `name`, `size`, `data`
            FROM `file`
            WHERE `id` = {$id}";
        $result = $dbLink->query($query);
        if($result) {

            if($result->num_rows == 1) {

                $row = mysqli_fetch_assoc($result);

                header("Content-Type: ". $row['mime']);
                header("Content-Length: ". $row['size']);
                header("Content-Disposition: attachment; filename=". $row['name']);

                echo $row['data'];
            }
            else {
                echo 'Error! No image exists with that ID.';
            }

            @mysqli_free_result($result);
        }
        else {
            echo "Error! Query failed: <pre>{$dbLink->error}</pre>";
        }
        @mysqli_close($dbLink);
    }
}
else {
    echo 'Error! No ID was passed.';
}
?>
