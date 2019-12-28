<?php
require_once('config.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Update</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
<?php
include 'Navbar.php'
?>

<?php
$username = "dsoumis";
$sql = "SELECT * FROM users WHERE username=?";
$query = $db->prepare($sql);
$query->execute([$username]);
$user = $query->fetch();
?>

<div>
    <form>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <h1>Επεξεργασία Προφίλ</h1>
                    <p>Τροποποιήστε τα στοιχεία σας.</p>
                    <hr class="mb-3">
                    <label for="firstname"><b>Όνομα</b></label>
                    <input type="text" class="form-control" name="firstname" id="firstname" value=<?php echo $user['first_name'] ?> required>

                    <label for="lastname"><b>Επώνυμο</b></label>
                    <input type="text" class="form-control" name="lastname" id="lastname" value=<?php echo $user['surname'] ?> required>

                    <label for="email"><b>Email</b></label>
                    <input type="email" class="form-control" name="email" id="email" value=<?php echo $user['email'] ?> required>

                    <label for="phone"><b>Τηλέφωνο</b></label>
                    <input type="text" class="form-control" name="phone" id="phone" value=<?php echo $user['telephone'] ?> required>

                    <label for="username"><b>Όνομα Χρήστη</b></label>
                    <input type="text" class="form-control" name="username" id="username" value=<?php echo $user['username'] ?> required>

                    <label for="password"><b>Κωδικός Χρήστη</b></label>
                    <input type="password" class="form-control" name="password" id="password" value=<?php echo $user['password'] ?> required>

                    <label for="repassword"><b>Επαλήθευση Κωδικού Χρήστη</b></label>
                    <input type="password" class="form-control" name="repassword" id="repassword" value=<?php echo $user['password'] ?> required>
                    <hr class="mb-3">
                    <input class="btn btn-primary" type="submit" name="create" id="update" value="Τροποποίηση">
                </div>
            </div>
        </div>
    </form>
</div>

<script src="js/jquery-3.4.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript">
    $(function () {
        const prev_username = $('#username').val();
        $('#update').click(function (e) {
            const valid = this.form.checkValidity();
            if(valid){
                e.preventDefault();

                const firstName = $('#firstname').val();
                const lastname = $('#lastname').val();
                const email = $('#email').val();
                const phone = $('#phone').val();
                const username = $('#username').val();
                const password = $('#password').val();
                const repassword = $('#repassword').val();

                if(password!==repassword)
                    Swal.fire({
                        text: 'Ο κωδικός χρήστη δεν είναι ίδιος με τον κωδικό επαλήθευσης.'
                    });
                else {

                    $.ajax({
                        type: 'POST',
                        url: 'update_profile_process.php',
                        data: {
                            firstname: firstName,
                            lastname: lastname,
                            email: email,
                            phone: phone,
                            username: username,
                            password: password,
                            prev_username: prev_username
                        },
                        success: async function (data) {
                            if(data === 'ok')
                                Swal.fire({
                                    title: 'ΕΠΙΤΥΧΙΑ',
                                    text: 'Η εγγραφή σας ολοκληρώθηκε.',
                                    icon: 'success'
                                }).then(function() {
                                    window.location = "index.php";
                                });
                            else if (data !== 'ok')
                                Swal.fire({
                                    title: 'ΣΦΑΛΜΑ',
                                    text: data,
                                    icon: 'error'
                                });
                        },
                        error: function (data) {
                            Swal.fire({
                                title: 'ΣΦΑΛΜΑ',
                                text: 'Η τροποποίησή σας δεν ολοκληρώθηκε. Παρακαλώ προσπαθήστε αργότερα.',
                                icon: 'error'
                            })
                        },
                    });
                }
            }else{
                Swal.fire({
                    text: 'Παρακαλώ συμπληρώστε όλα τα στοιχεία της φόρμας.'
                });
            }
        });
    });
</script>
</body>
</html>
