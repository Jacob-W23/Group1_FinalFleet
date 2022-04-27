<?php


function validateInput()
{
    $fields = array('dotID', 'year', 'type', 'make', 'model', 'miles', 'status', 'maintenance');
    foreach ($fields as $field)
    {
        if (!isset($_POST[$field]))
        {
            return false;
        }
    }

    return true;
}


?>