<!DOCTYPE html>


<html>
<head>
    <title>User Update</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body style="background-image: url('assets/backgroundImage.jpg');background-repeat: no-repeatbackground-attachment: fixed;
  background-size: cover;background-attachment: fixed;background-size: cover;" onload="initialize()">
<?php
include 'Navbar.php';
require_once('config.php');
$username="";
$user=["first_name"=>"","email"=>"","username"=>"","surname"=>"","telephone"=>"","password"=>"",'type'=>""];
if(isset($_SESSION['login'])){
  if($_SESSION['login']==True){
    $username=$_SESSION['username'];
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
            width: 5%;
            height: 5%;
            left: 5%;
            top:  3%;
            border: 0px solid blue;
        }
        aygo2{
            color : white;
            background-color: transparent !important;
            position: absolute ;
            width: 5%;
            height:  5%;
            left: 5%;
            top: 21.1%;
            border: 0px solid blue;
        }
        a {
            color: white;
            text-decoration: underline;
        }
</style>

<div >

    <form>
        <div class="container" style="border-radius: 50px 50px;position:absolute;top:25%;left:25%;text-align:center;width:50%;background-color:#7bcafd">
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
                    <label for="type"><b>Είδος Δικαιούχου</b></label>
                    <div class="form-group">
                        <select class="form-control" name="type" id="typeR" required>
                            <option value="foititis" id="foititis">Φοιτητής</option>
                            <option value="amea" id="amea">Α.Μ.Ε.Α</option>
                            <option value="regular" id="regular">Κανονικό</option>
                        </select>
                    </div>
                    <label for="username"><b>Όνομα Χρήστη</b></label>
                    <input type="text" class="form-control" name="username" id="username" value=<?php echo $user['username'] ?> required>

                    <label for="password"><b>Κωδικός Χρήστη</b></label>
                    <input type="password" class="form-control" name="password" id="password" value=<?php echo $user['password'] ?> required>

                    <label for="repassword"><b>Επαλήθευση Κωδικού Χρήστη</b></label>
                    <input type="password" class="form-control" name="repassword" id="repassword" value=<?php echo $user['password'] ?> required>
                    <hr class="mb-3">
                    <input class="btn btn-primary" type="submit" name="create" id="update" value="Τροποποίηση">
        </div>
    </form>
</div>
<aygo2><a  href="./UpdateProfile.php"> Προφίλ </aygo2>
<aygo1><a  href="./"> Αρχική   </aygo1>
<script type="text/javascript">

  const str1="<?php echo $username?>";
  if(str1==="") window.location="./";

</script>
<script type="text/javascript">
    $(function () {
        const prev_username = $('#username').val();
        $('#update').click(function (e) {
            const valid = this.form.checkValidity();
            if (valid) {
                e.preventDefault();
                const firstName = $('#firstname').val();
                const lastname = $('#lastname').val();
                const email = $('#email').val();
                const phone = $('#phone').val();
                const username = $('#username').val();
                const password = $('#password').val();
                const repassword = $('#repassword').val();
                const type=$('#typeR').val();
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
                            prev_username: prev_username,
                            type:type,
                            update:true
                        },
                        success: async function (data) {
                            if (data === 'ok')
                                Swal.fire({
                                    title: 'ΕΠΙΤΥΧΙΑ',
                                    text: 'Η εγγραφή σας ολοκληρώθηκε.',
                                    icon: 'success'
                                }).then(function () {
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
<script>
function initialize(){
  var type="<?php echo $user['type']?>";
  if(type==="") type="regular";
  document.getElementById(type).selected=true;
}
</script>
</body>
</html>
