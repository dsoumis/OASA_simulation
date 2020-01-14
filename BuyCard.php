<!DOCTYPE html>
<html>

<head>
    <title>Προσωποποιημένη κάρτα</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body style="background-image: url('assets/backgroundImage.jpg');background-repeat: no-repeatbackground-attachment: fixed;
  background-size: cover;background-attachment: fixed;background-size: cover;" onload="initialize()">

<?php
include 'Navbar.php';
require_once('config.php');
$username = "";
$user = ["first_name" => "", "email" => "", "username" => "", "surname" => "", "telephone" => "", "password" => "", "repassword" => "",'type'=>""];
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
<style>
a {
            color: white;
            text-decoration: underline;
        }
        aygo1{
            color : white;
            background-color: transparent !important;
            position: absolute ;
            width: 2%;
            height: 2%;
            left: -7%;
            top:  -16%;
            border: 0px solid blue;
        }
        aygo2{
            color : white;
            background-color: transparent !important;
            position: absolute ;
            width: 2%;
            height:  2%;
            left: 10%;
            top: 22%;
            border: 0px solid blue;
        }
</style>
<div class="container register" style="border-radius: 50px 50px;">
    <div class="row">
        <div class="col-md-3 register-left">
            <img src="assets/bus.png" alt=""/>
            <h3>Προσωποποιημένη κάρτα ΟΑΣΑ</h3>
            <p>Εκδόστε ή επαναφορτίστε την κάρτα σας για τις μετακινήσεις σας με τον ΟΑΣΑ.</p>

            <label for="no_card">Δεν έχετε κάρτα;</label>
            <input type="submit" id="no_card" name="no_card" onClick="clicked()"
                   value="Αγορά εισιτηρίου"/><br/>

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
                    <h3 class="register-heading">Συμπληρώστε τα στοιχεία σας</h3>
                    <div class="row register-form">

                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Όνομα *" id="firstName"
                                       value="<?php echo $user['first_name'] ?>" required/>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Επίθετο *" id="surName"
                                       value="<?php echo $user['surname'] ?>" required/>
                            </div>
                            <div class="form-group">
                                <p><b>Ανεβάστε Έγγραφο Ταυτοποίησης</b></p>
                                <p>(π.χ αστυνομική ταυτότητα)</p>
                                <input type="file" class="form-control" id="policeId" accept="image/*" required/>
                            </div>
                            <div class="form-group">
                                <p><b>Εισάγετε ημερομηνία γέννησης</b></p>
                                <input type="date" class="form-control" id="birthdate" required/>
                            </div>

                            <div class="form-group">
                                <p><b>Ανεβάστε Φωτογραφία Προφίλ</b></p>
                                <input type="file" class="form-control" accept="image/*" id="profilepic" required/>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Email *" id="email"
                                       value="<?php echo $user['email'] ?>"/>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Διεύθυνση *" value="" id="address"
                                       required/>
                                <input type="text" class="form-control" placeholder="Ταχυδρομικός κώδικας *"
                                       id="postalCode" value="" required/>
                                <input type="text" class="form-control" placeholder="Περιοχή *" id="region" value=""
                                       required/>
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="selectionHolder" required>
                                  <option value="foititis" id="foititis">Φοιτητής</option>
                                  <option value="amea" id="amea">Α.Μ.Ε.Α</option>
                                  <option value="regular" id="regular">Κανονικό</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="PIN *" id="pin" value=""
                                       required/>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Επαλήθευση PIN *" id="repin"
                                       value="" required/>
                            </div>
                            <input type="submit" class="btnRegister" id="createcard" value="Έκδοση Κάρτας"/>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <h3 class="register-heading">Επαναφόρτιση κάρτας</h3>
                    <div class="row register-form">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Ατομικός αριθμός ATH.ENA card"
                                       id="athcard" value="" required/>
                                <img src="assets/athenaCardExample.png" alt=""/>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Χρηματικό Ποσό σε ευρώ"
                                       id="payment" value="" required/>
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
                            <input type="submit" class="btnRegister" id="reload" value="Επαναφόρτιση"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('#createcard').click(function (e) {
            let valid = false;
            const firstName = $('#firstName').val();
            const surName = $('#surName').val();
            const policeId = $('#policeId').val();
            const birthDate = $('#birthdate').val();
            const profilePic = $('#profilepic').val();
            const email = $('#email').val();
            const address = $('#address').val();
            const postal = $('#postalCode').val();
            const region = $('#region').val();
            const holder = $('#selectionHolder').val();
            const pin = $('#pin').val();
            const repin = $('#repin').val();

            if (firstName && surName && policeId && birthDate && profilePic && email && address && postal && region && holder && pin && repin)
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
                if (pin !== repin)
                    Swal.fire({
                        text: 'Το PIN δεν είναι ίδιο με την επαλήθευση PIN.'
                    });
                else {
                    Swal.fire({
                        title: 'ΕΠΙΤΥΧΙΑ',
                        text: 'Η κάρτα σας εκδόθηκε με επιτυχία. Πακαλώ παραλάβετέ τη από τον πλησιέστερο σταθμό.',
                        icon: 'success'
                    }).then(function () {
                        window.location = "index.php";
                    });
                }
            } else {
                Swal.fire({
                    text: 'Παρακαλώ συμπληρώστε όλα τα στοιχεία της φόρμας.'
                });
            }
        });


        $('#reload').click(function (e) {
            let valid = false;
            const athCard = $('#athcard').val();
            const payment = $('#payment').val();
            const payCard = $('#paycard').val();
            const month = $('#month').val();
            const year = $('#year').val();
            const cvv = $('#cvv').val();

            if (athCard && payment && payCard && month && year && cvv)
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
<script>
function() clicked{
  window.location.href='./BuyTickets.php';
}
function initialize(){
  var type="<?php echo $user['type']?>";
  if(type==="") type="regular";
  document.getElementById(type).selected=true;
}
</script>
</body>
<style type="text/css">
    input[type=number] {
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
