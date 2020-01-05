<?php
require_once('config.php');
if (isset($_POST["example"])) {
    session_start();
    $start = $_POST['start'];
    $destination = $_POST['destination'];
    //$sql = "SELECT * FROM users WHERE username=?";
    if ($start === '15I REFTAS') {
        $directions = array("4", "3I AG.NIKOLAOU", "5", "1I KATSONI", "2:00");
        echo json_encode($directions);
    } elseif ($start === '1I KATSONI') {
        $directions = array("5", "3I AG.NIKOLAOU", "0:57");
        echo json_encode($directions);
    }
} else {
    echo "No data.";
    header("Location: ./");
}