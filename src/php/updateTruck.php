<?php

require_once "config.php";
require_once "utils.php";

$session = $_POST["session"];

session_id($session);
session_start();

$auth = $_SESSION["auth"];

if ($auth && validateInput() && isset($_POST['dotID']))
{
    $dotId = $_POST['dotID'];
    $year = $_POST['year'];
    $type = $_POST['type'];
    $make = $_POST['make'];
    $model = $_POST['model'];
    $miles = $_POST['miles'];
    $status = $_POST['status'];
    $maint = $_POST['maintenance'];

    mysqli_report(MYSQLI_REPORT_ALL);
    $connection = new mysqli($hn, $un, $pw, $db);

    if ($connection->connect_error)
    {
        $response['outcome'] = "error";
        $response['err-msg'] = "Could not connect to database";
    }
    else
    {
        $stmt = $connection->prepare("UPDATE vehicles SET dotid=?, year=?, type=?, make=?, model=?, currentmileage=?, status=?, lastmaintenencemileage=? WHERE dotid=?");
        $stmt->bind_param("sssssssss", $dotId, $year, $type, $make, $model, $miles, $status, $maint, $dotId);

        if ($stmt->execute())
        {
            $response['outcome'] = "success";
            $response['err-msg'] = "vehicle id $dotId updated";
        }
        else
        {
            $response['outcome'] = "error";
            $response['err-msg'] = "Could not update vehicle";
        }

        $stmt->close();
    }

    $connection->close();
}
else
{
    $response['outcome'] = "error";
    $response['err-msg'] = "Not authorized or incomplete data";
}

echo json_encode($response);

?>