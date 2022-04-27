<?php
require_once "config.php";

$session = $_POST["session"];
$date = $_POST["date"];

session_id($session);
session_start();

$auth = $_SESSION["auth"];

$maintenances = [];

if($auth) {

    $connection = new mysqli($hn, $un, $pw, $db);
    
    if ($connection->connect_error) {
        $response['outcome'] = "error";
        $response['err-msg'] = "Could not connect to database";
    } else {
        $stmt = $connection->prepare("SELECT * FROM maintenance WHERE checkin >= ?");
        $stmt->bind_param("s", $date);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $rows = $result->num_rows;
            if ($rows >= 1) {
                foreach ($result as $maintenance) {
                    $maintenances[] = $maintenance;
                    $response['outcome'] = "success";
                    $response['maintenances'] = $maintenances;
                }
            } else {
                $response['outcome'] = "error";
                $response['err-msg'] = "No vehicles found";
            }
        } else {
            $response['outcome'] = "error";
            $response['err-msg'] = "Could not get vehicles";
        }
        $stmt->close();
    }
    
    $connection->close();
    
} else {
    $response['outcome'] = "error";
    $response['err-msg'] = "Not authorized";
}

echo json_encode($response);

?>