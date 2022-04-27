<?php

require_once "config.php";
require_once "utils.php";

$session = $_POST["session"];

session_id($session);
session_start();

$auth = $_SESSION["auth"];

if (validateInput() && $auth) {
    $dotId = $_POST['dotID'];
    $year = $_POST['year'];
    $type = $_POST['type'];
    $make = $_POST['make'];
    $model = $_POST['model'];
    $miles = $_POST['miles'];
    $status = $_POST['status'];
    $maint = $_POST['maintenance'];

    $connection = new mysqli($hn, $un, $pw, $db);

    if ($connection->connect_error) {
        $response['status'] = "error";
        $response['err-msg'] = "Could not connect to database";
    } else {
        $stmt = $connection->prepare("INSERT INTO vehicles VALUES(?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssss", $dotId, $year, $type, $make, $model, $miles, $status, $maint);

        if ($stmt->execute()) {
            $id = $connection->insert_id;
            $response['outcome'] = "success";
            $response['err-msg'] = "vehicle inserted as id $dotId";
        } else {
            $response['outcome'] = "error";
            $response['err-msg'] = "vehicle could not be inserted";
        }

        $stmt->close();
    }

    $connection->close();
} else {
    $response['outcome'] = "error";
    $response['err-msg'] = "Not authorized or incomplete data";
}

echo json_encode($response);

?>