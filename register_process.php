<?php
    require_once('config.php');
?>
<?php
    if(isset($_POST)) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE username=?";
        $query = $db->prepare($sql);
        $query->execute([$username]);
        $count=$query->rowCount();

        if($count>1){
            echo "Το όνομα χρήστη που δώσατε υπάρχει ήδη.";
            exit();
        }

        $sql = "SELECT * FROM users WHERE email=?";
        $query = $db->prepare($sql);
        $query->execute([$email]);
        $count=$query->rowCount();

        if($count>1){
            echo "Το email που δώσατε υπάρχει ήδη.";
            exit();
        }



        $sql = "INSERT INTO users (username, password, email, first_name, surname, telephone) VALUES(?,?,?,?,?,?)";
        $statementInsert = $db->prepare($sql);
        $result = $statementInsert->execute([$username, $password, $email, $firstname, $lastname, $phone]);

        if ($result) {
            echo "ok";
        } else {
            echo "Η εγγραφή δεν ολοκληρώθηκε. Παρακαλώ προσπαθήστε αργότερα.";
        }

    }else{
        echo "No data.";
    }