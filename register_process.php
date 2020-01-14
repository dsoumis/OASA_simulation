<?php
    require_once('config.php');
?>
<?php
    if(isset($_POST["register"])) {
        session_start();

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $type=$_POST['type'];
        $sql = "SELECT * FROM users WHERE username=?";
        $query = $db->prepare($sql);
        $query->execute([$username]);
        $count=$query->rowCount();


        if($count>0){
            echo "Το όνομα χρήστη που δώσατε υπάρχει ήδη.";
            session_destroy();
            exit();
        }

        $sql = "SELECT * FROM users WHERE email=?";
        $query = $db->prepare($sql);
        $query->execute([$email]);
        $count=$query->rowCount();


        if($count>0){
            echo "Το email που δώσατε υπάρχει ήδη.";
            session_destroy();
            exit();
        }



        $sql = "INSERT INTO users (username, password, email, first_name, surname, telephone,type) VALUES(?,?,?,?,?,?,?)";
        $statementInsert = $db->prepare($sql);
        $result = $statementInsert->execute([$username, $password, $email, $firstname, $lastname, $phone,$type]);

        if ($result) {
            $_SESSION['login']=True;
            $_SESSION['username']=$username;
            echo "ok";
        } else {
            session_destroy();

            echo "Η εγγραφή δεν ολοκληρώθηκε. Παρακαλώ προσπαθήστε αργότερα.";
        }

    }else{
        echo "No data.";

        header("Location: ./");
    }
