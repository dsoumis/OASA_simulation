<?php
require_once('config.php');
if (isset($_POST["example"])) {
    session_start();
    $start = $_POST['start'];
    $destination = $_POST['destination'];
    $directions=[];
    if ($start === '15Η ΡΕΦΤΑΣ') {
        $directions = array("4", "3Η ΑΓ.ΝΙΚΟΛΑΟΥ", "5", "1Η ΚΑΤΣΩΝΗ", "2:00");
        echo json_encode($directions);
    } else if ($start === '1Η ΚΑΤΣΩΝΗ') {
        $directions = array("5", "3Η ΑΓ.ΝΙΚΟΛΑΟΥ", "0:57");
        echo json_encode($directions);
    }
    else echo json_encode($directions);
} else {
    echo "No data.";
    header("Location: ./");
}
