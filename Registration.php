<?php
    require_once('config.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
<div>
    <?php
    if(isset($_POST['create'])){
        if($_POST["password"] === $_POST["repassword"]) {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $username = $_POST['username'];
            $password = $_POST['password'];

            $sql = "INSERT INTO users (username, password, email, first_name, surname, telephone) VALUES(?,?,?,?,?,?)";
            $statementInsert = $db->prepare($sql);
            $result = $statementInsert->execute([$username, $password, $email, $firstname, $lastname, $phone]);
            if ($result) {
                echo "Η εγγραφή σας ολοκληρώθηκε με επιτυχία.";
                sleep(2);
                header("Location: /eam/");
                exit();
            } else {
                echo "Η εγγραφή δεν ολοκληρώθηκε. Παρακαλώ προσπαθήστε αργότερα.";
            }

            echo $firstname . " " . $lastname;
        }else{
            echo "Παρακαλώ ελέγξτε τον κωδικό σας.";
        }
    }
    ?>
</div>

<div>
    <form action="Registration.php" method="post">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <h1>Εγγραφή Χρήστη</h1>
                    <p>Παρακαλώ συμπληρώστε την παρακάτω φόρμα</p>
                    <hr class="mb-3">
                    <label for="firstname"><b>Όνομα</b></label>
                    <input type="text" class="form-control" name="firstname" id required>

                    <label for="lastname"><b>Επώνυμο</b></label>
                    <input type="text" class="form-control" name="lastname" required>

                    <label for="email"><b>Email</b></label>
                    <input type="email" class="form-control" name="email" required>

                    <label for="phone"><b>Τηλέφωνο</b></label>
                    <input type="text" class="form-control" name="phone" required>

                    <label for="username"><b>Όνομα Χρήστη</b></label>
                    <input type="text" class="form-control" name="username" required>

                    <label for="password"><b>Κωδικός Χρήστη</b></label>
                    <input type="password" class="form-control" name="password" required>

                    <label for="repassword"><b>Επαλήθευση Κωδικού Χρήστη</b></label>
                    <input type="password" class="form-control" name="repassword" required>
                    <hr class="mb-3">
                    <input class="btn btn-primary" type="submit" name="create" id="register" value="Εγγραφή">
                </div>
            </div>
        </div>
    </form>
</div>

<script src="js/jquery-3.4.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript">
    $(function () {
        Swal.fire({
            title: 'Hello World',
            text: 'this is sweet',
            icon: 'success'
        })
    });
</script>
</body>
</html>

