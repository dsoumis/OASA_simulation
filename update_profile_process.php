<?php
require_once('config.php');
?>
<?php

if(isset($_POST['update'])) {

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $type=$_POST['type'];
    $prev_username = $_POST['prev_username'];
    $sql = "UPDATE users SET username=?, password=?, email=?, first_name=?, surname=?, telephone=?,type=? WHERE username=?";
    $statementInsert = $db->prepare($sql);
    $result = $statementInsert->execute([$username, $password, $email, $firstname, $lastname, $phone,$type, $prev_username]);
    if ($result) {
        echo "ok";
    } else {
        echo "Η τροποποίηση δεν ολοκληρώθηκε. Παρακαλώ προσπαθήστε αργότερα.";
    }

}else{
    echo "No data.";

    header("Location: ./");

}
