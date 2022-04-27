<?php

require_once "config.php";

$session = $_POST["session"];

session_id($session);
session_start();

$auth = $_SESSION["auth"];

if (isset($_POST['dotID']) && $auth)
{
    $dotID = $_POST['dotID'];

    $connection = new mysqli($hn, $un, $pw, $db);

    if ($connection->connect_error)
    {
        $response['outcome'] = "error";
        $response['err-msg'] = "Could not connect to database";
    }
    else
    {
        $stmt = $connection->prepare("DELETE FROM vehicles WHERE dotid=?"); //modify as needed
        $stmt->bind_param("s", $dotID);

        if ($stmt->execute())
        {
            $response['outcome'] = "success";
            $response['err-msg'] = "vehicle id $dotID deleted";
        }
        else
        {
            $response['outcome'] = "error";
            $response['err-msg'] = "could not delete vehicle";
        }

        $stmt->close();
    }

    $connection->close();
}
else
{
    $response['outcome'] = "error";
    $response['err-msg'] = "Not authorized";
}

echo json_encode($response);

?>