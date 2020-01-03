<!DOCTYPE html>
<html>

<head>
    <title>Εισιτήρια ΟΑΣΑ</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>

<?php
include 'Navbar.php';
require_once('config.php');
$username = "";
$user = ["first_name" => "", "email" => "", "username" => "", "surname" => "", "telephone" => "", "password" => "", "repassword" => "",];
if (isset($_SESSION['login'])) {
    if ($_SESSION['login'] == True) {
        $username = $_SESSION['username'];
        $sql = "SELECT * FROM users WHERE username=?";
        $query = $db->prepare($sql);
        $query->execute([$username]);
        $user = $query->fetch();
    }
}
?>
<div class="container register">
    <div class="row">
        <div class="col-md-3 register-left">
            <img src="assets/bus.png" alt=""/>
            <h3>Εισιτήρια ΟΑΣΑ</h3>
            <p>Εκδόστε ή επαναφορτίστε τα εισιτήριά σας για τις μετακινήσεις σας με τον ΟΑΣΑ.</p>
        </div>
        <div class="col-md-9 register-right">
            <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                       aria-controls="home" aria-selected="true">Έκδοση</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                       aria-controls="profile" aria-selected="false">Φόρτιση</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <h3 class="register-heading">Αγορά εισιτηρίου</h3>
                    <div class="row register-form">

                        <div class="col-md-6">
                            <div class="form-group">
                                <select class="form-control" id="selectionHolder" required>
                                    <option disabled selected hidden>Κατηγορία Δικαιούχου</option>
                                    <option>Φοιτητής</option>
                                    <option>Α.Μ.Ε.Α</option>
                                    <option>Καμία από τις παραπάνω</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" placeholder="Πλήθος εισιτηρίων" id="quantity"
                                       name="quantity" min="1" value="1" required/>
                                <label for="cost">Κόστος:</label>
                                <input type="number" disabled id="cost" name="cost" value="0" required/>€
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <img src="assets/visa.png" alt=""/>
                                <img src="assets/masterCard.png" alt=""/>
                                <input type="number" class="form-control" placeholder="Αριθμός πιστωτικής κάρτας"
                                       id="paycard" value="" required/>
                                <label for="month">Μήνας λήξης:</label>
                                <input type="number" id="month" name="month" class="form-control"
                                       placeholder="π.χ Απρίλιος: 4" required>
                                <label for="year">Χρόνος λήξης:</label>
                                <input type="number" id="year" name="year" class="form-control" placeholder="π.χ: 2020"
                                       required>
                                <input type="number" class="form-control" placeholder="CVV" id="cvv" required/>
                            </div>
                            <input type="submit" class="btnRegister" id="buyticket" value="Αγορά εισιτηρίου"/>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <h3 class="register-heading">Επαναφόρτιση εισιτηρίου</h3>
                    <div class="row register-form">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Ατομικός αριθμός εισιτηρίου"
                                       id="ticket" value="" required/>
                                <img src="assets/ticketExample.png" alt=""/>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Χρηματικό Ποσό σε ευρώ"
                                       id="paymentre" value="" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <img src="assets/visa.png" alt=""/>
                                <img src="assets/masterCard.png" alt=""/>
                                <input type="number" class="form-control" placeholder="Αριθμός πιστωτικής κάρτας"
                                       id="paycardre" value="" required/>
                                <label for="month">Μήνας λήξης:</label>
                                <input type="number" id="monthre" name="month" class="form-control"
                                       placeholder="π.χ Απρίλιος: 4" required>
                                <label for="year">Χρόνος λήξης:</label>
                                <input type="number" id="yearre" name="year" class="form-control"
                                       placeholder="π.χ: 2020" required>
                                <input type="number" class="form-control" placeholder="CVV" id="cvvre" required/>
                            </div>
                            <input type="submit" class="btnRegister" id="reload" value="Επαναφόρτιση"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/jquery-3.4.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript">
    $(function () {
        $('#selectionHolder').change(function (e) {
            e.preventDefault();
            const holder = $('#selectionHolder').val();
            const quantity = $('#quantity').val();
            if (holder === 'Α.Μ.Ε.Α' || holder === 'Φοιτητής')
                document.getElementById('cost').value = quantity * 0.6;
            else
                document.getElementById('cost').value = quantity * 1.2;
        });
        $('#quantity').change(function (e) {
            e.preventDefault();
            const holder = $('#selectionHolder').val();
            const quantity = $('#quantity').val();
            if (holder === 'Α.Μ.Ε.Α' || holder === 'Φοιτητής') {
                const payment = (parseInt(quantity) * 6) / 10;
                document.getElementById('cost').value = payment.toString();
            } else {
                const payment = (parseInt(quantity) * 12) / 10;
                document.getElementById('cost').value = payment.toString();
            }
        });

        $('#buyticket').click(function (e) {
            let valid = false;

            const holder = $('#selectionHolder').val();
            const quantity = $('#quantity').val();
            const cost = $('#cost').val();
            const payCard = $('#paycard').val();
            const month = $('#month').val();
            const year = $('#year').val();
            const cvv = $('#cvv').val();
            if (holder !== null && quantity > 0 && payCard && month && year && cvv)
                valid = true;

            if (valid) {
                e.preventDefault();
                <?php
                //// the message
                //$msg = "Η κάρτα για τον Ταδε Ταδε εκδόθηκε με επιτυχία.";
                //// use wordwrap() if lines are longer than 70 characters
                //$msg = wordwrap($msg,70);
                //// send email
                //mail("jimsoumis@gmail.com","ΕΚΔΟΣΗ ATH.ENA CARD",$msg);
                //?>
                console.log('edw' + parseFloat(document.getElementById('cost').value));
                if (quantity === '1') {
                    Swal.fire({
                        title: 'ΕΠΙΤΥΧΙΑ',
                        text: 'Το εισιτήριο σας εκδόθηκε με επιτυχία καταβάλοντας το ποσό των ' + cost + '€. Πακαλώ παραλάβετέ το από τον πλησιέστερο σταθμό.',
                        icon: 'success'
                    }).then(function () {
                        window.location = "index.php";
                    });
                } else {
                    Swal.fire({
                        title: 'ΕΠΙΤΥΧΙΑ',
                        text: 'Τα ' + quantity + ' εισιτήρια σας εκδόθηκαν με επιτυχία καταβάλοντας το ποσό των ' + cost + '€. Πακαλώ παραλάβετέ τα από τον πλησιέστερο σταθμό.',
                        icon: 'success'
                    }).then(function () {
                        window.location = "index.php";
                    });
                }

            } else {
                if (!holder)
                    Swal.fire({
                        text: 'Παρακαλώ επιλέξτε κατηγορία δικαιούχου.'
                    });
                else
                    Swal.fire({
                        text: 'Παρακαλώ συμπληρώστε όλα τα στοιχεία της φόρμας.'
                    });
            }
        });


        $('#reload').click(function (e) {
            let valid = false;
            const ticket = $('#ticket').val();
            const payment = $('#paymentre').val();
            const payCard = $('#paycardre').val();
            const month = $('#monthre').val();
            const year = $('#yearre').val();
            const cvv = $('#cvvre').val();

            if (ticket && payment && payCard && month && year && cvv)
                valid = true;
            if (valid) {
                e.preventDefault();
                <?php
                //// the message
                //$msg = "Η κάρτα για τον Ταδε Ταδε εκδόθηκε με επιτυχία.";
                //// use wordwrap() if lines are longer than 70 characters
                //$msg = wordwrap($msg,70);
                //// send email
                //mail("jimsoumis@gmail.com","ΕΚΔΟΣΗ ATH.ENA CARD",$msg);
                //?>

                Swal.fire({
                    title: 'ΕΠΙΤΥΧΙΑ',
                    text: 'Η κάρτα σας επαναφορτίστηκε με επιτυχία με το χρηματικό ποσό των ' + payment + ' ευρώ.',
                    icon: 'success'
                }).then(function () {
                    window.location = "index.php";
                });

            } else {
                Swal.fire({
                    text: 'Παρακαλώ συμπληρώστε όλα τα στοιχεία της φόρμας.'
                });
            }
        });
    });
</script>
</body>
<style type="text/css">
    #paycard, #month, #year, #cvv, #paycardre, #monthre, #yearre, #cvvre {
        -moz-appearance: textfield;
    }

    .register {
        background: -webkit-linear-gradient(left, #3931af, #00c6ff);
        margin-top: 3%;
        padding: 3%;
    }

    .register-left {
        text-align: center;
        color: #fff;
        margin-top: 4%;
    }

    .register-left input {
        border: none;
        border-radius: 1.5rem;
        padding: 2%;
        width: 60%;
        background: #f8f9fa;
        font-weight: bold;
        color: #383d41;
        margin-top: 30%;
        margin-bottom: 3%;
        cursor: pointer;
    }

    .register-right {
        background: #f8f9fa;
        border-top-left-radius: 10% 50%;
        border-bottom-left-radius: 10% 50%;
    }

    .register-left img {
        margin-top: 15%;
        margin-bottom: 5%;
        width: 25%;
        -webkit-animation: mover 2s infinite alternate;
        animation: mover 1s infinite alternate;
    }

    @-webkit-keyframes mover {
        0% {
            transform: translateY(0);
        }
        100% {
            transform: translateY(-20px);
        }
    }

    @keyframes mover {
        0% {
            transform: translateY(0);
        }
        100% {
            transform: translateY(-20px);
        }
    }

    .register-left p {
        font-weight: lighter;
        padding: 12%;
        margin-top: -9%;
    }

    .register .register-form {
        padding: 10%;
        margin-top: 10%;
    }

    .btnRegister {
        float: right;
        margin-top: 10%;
        border: none;
        border-radius: 1.5rem;
        padding: 2%;
        background: #0062cc;
        color: #fff;
        font-weight: 600;
        width: 50%;
        cursor: pointer;
    }

    .register .nav-tabs {
        margin-top: 3%;
        border: none;
        background: #0062cc;
        border-radius: 1.5rem;
        width: 28%;
        float: right;
    }

    .register .nav-tabs .nav-link {
        padding: 2%;
        height: 34px;
        font-weight: 600;
        color: #fff;
        border-top-right-radius: 1.5rem;
        border-bottom-right-radius: 1.5rem;
    }

    .register .nav-tabs .nav-link:hover {
        border: none;
    }

    .register .nav-tabs .nav-link.active {
        width: 100px;
        color: #0062cc;
        border: 2px solid #0062cc;
        border-top-left-radius: 1.5rem;
        border-bottom-left-radius: 1.5rem;
    }

    .register-heading {
        text-align: center;
        margin-top: 8%;
        margin-bottom: -15%;
        color: #495057;
    }
</style>
</html>
