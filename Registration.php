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
<?php
include 'Navbar.php'
?>


<div>
    <form action="Registration.php" method="post">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <h1>Εγγραφή Χρήστη</h1>
                    <p>Παρακαλώ συμπληρώστε την παρακάτω φόρμα</p>
                    <hr class="mb-3">
                    <label for="firstname"><b>Όνομα</b></label>
                    <input type="text" class="form-control" name="firstname" id="firstname" required>

                    <label for="lastname"><b>Επώνυμο</b></label>
                    <input type="text" class="form-control" name="lastname" id="lastname" required>

                    <label for="email"><b>Email</b></label>
                    <input type="email" class="form-control" name="email" id="email" required>

                    <label for="phone"><b>Τηλέφωνο</b></label>
                    <input type="text" class="form-control" name="phone" id="phone" required>

                    <label for="username"><b>Όνομα Χρήστη</b></label>
                    <input type="text" class="form-control" name="username" id="username" required>

                    <label for="password"><b>Κωδικός Χρήστη</b></label>
                    <input type="password" class="form-control" name="password" id="password" required>

                    <label for="repassword"><b>Επαλήθευση Κωδικού Χρήστη</b></label>
                    <input type="password" class="form-control" name="repassword" id="repassword" required>
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
        $('#register').click(function (e) {




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
                        url: 'register_process.php',
                        data: {
                            firstname: firstName,
                            lastname: lastname,
                            email: email,
                            phone: phone,
                            username: username,
                            password: password
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
                                text: 'Η εγγραφή σας δεν ολοκληρώθηκε. Παρακαλώ προσπαθήστε αργότερα.',
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

