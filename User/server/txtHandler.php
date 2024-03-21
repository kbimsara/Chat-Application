<?php
require_once '../../config.php';

ob_start();
session_start();
$user_id = $_SESSION["email"];
// $data = $_SESSION["data"];

// Check if the POST data is set
if (isset($_POST["text"], $_POST["sender"], $_POST["group_id"])) {
    // Assign POST data to variables
    $txt = $_POST["text"];
    $sender = $_POST["sender"];
    $group_id = $_POST["group_id"];

    // Generate unique txt_id
    // $txt_id = rand(1, 999) . "txt_id" . rand(1, 9999);
    // $txt_id = gen();

    $id;

    while (1) {
        $colName = "text_id";
        $x = 15 - strlen($colName) - 2; //5
        $z = (10 ** $x) - 1;

        // Generate unique txt_id
        $id = rand(1, 99) . $colName . rand(1, $z);

        $sql = "SELECT * FROM text WHERE $colName = '$id';";
        $result = mysqli_query($Connector, $sql);

        if (mysqli_num_rows($result) > 0) {
            continue;
        } else {
            break;
        }
    }
    $txt_id=$id;

    // Prepare and execute SQL query
    $query_insert = "INSERT INTO `text` (`text_id`,`group_id`, `text`, `sender`) VALUES ('$txt_id', '$group_id', '$txt','$sender')";
    $query_run = mysqli_query($Connector, $query_insert);
} else {
    // Send error response if POST data is not set
    echo "Error: POST data not set";
}


function gen()
{

    require_once '../../config.php';

    $id;

    while (1) {
        $colName = "text_id";
        $x = 15 - strlen($colName) - 2; //5
        $z = (10 ** $x) - 1;

        // Generate unique txt_id
        $id = rand(1, 99) . $colName . rand(1, $z);

        $sql = "SELECT * FROM text WHERE $colName = '$id';";
        $result = mysqli_query($Connector, $sql);

        if (mysqli_num_rows($result) > 0) {
            continue;
        } else {
            return $id;
            break;
        }
    }
}
