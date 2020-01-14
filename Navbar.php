<?php
session_start();
$showUsername='';
if(isset($_SESSION['login'])){
  if($_SESSION['login']==True){
  $showUsername=$_SESSION['username'];
  }
}
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript" src="js/jquery-3.4.1.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #7bcafd">
    <a class="navbar-brand" href="./"><img src="assets/logo_oasa.png" alt="Logo" style="width:80px;"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="./">Νέα<span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownT" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    Εισιτήρια
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownT">
                    <a class="dropdown-item" href="BuyCard.php">Έκδοση/Φόρτιση Προσωποποιημένης κάρτας</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="BuyTickets.php">Αγορά/Φόρτιση Εισιτηρίων</a>
                </div>
            </li>
            <li class="nav-item"><a class="nav-link" href="routes.php">Δρομολόγια</a></li>
            <li class="nav-item"><a class="nav-link" href="./">Εργασία</a></li>
            <li class="nav-item"><a class="nav-link" href="./AMEA.php">Α.Μ.Ε.Α</a></li>
            <li class="nav-item"><a class="nav-link" href="./">Επικοινωνία</a></li>
            <li class="nav-item"><a class="nav-link" href="./Plirofories.php">Βοήθεια</a></li>
        </ul>
        <form class="form-inline my-2 my-lg-0 navbar-nav mr-auto" autocomplete="off" method="post">
            <input onkeyup="searchR()" list="results" class="form-control mr-sm-2" name="value" type="text" id="value"
                   placeholder="Αναζήτηση" aria-label="Αναζήτηση">
            <button id="search" class="btn btn-light" type="submit"><img src="assets/search_icon.png" alt="Logo"
                                                                         style="width:18px;"></button>
            <datalist id="results">
            </datalist>
        </form>

        <ul class="navbar-nav navbar-right">
          <li class="nav-item dropdown" id="signedIn" style="display:none">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownU" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <p>  <?php echo "$showUsername" ?> </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownU">
                  <a class="dropdown-item" href="UpdateProfile.php" >Προβολή Προφίλ</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item"  id="signOut">Αποσύνδεση</a>
                </div>
            </li>
            <li id="signUp" class="nav-item">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#registerModal">Εγγραφή</button>
            </li>
            <li id="login" class="nav-item">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">Σύνδεση</button>
            </li>

        </ul>
    </div>
</nav>
<div class="modal fade" role="dialog" id="registerModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Συμπληρώστε τα στοιχεία σας</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form>
              <div class="modal-body">
                  <div class="form-group">
                    <label for="usernameR"><b>Όνομα Χρήστη</b></label>
                    <input type="text" class="form-control" name="usernameR" id="usernameR" required>
                  </div>
                  <div class="form-group">
                    <label for="emailR"><b>Email</b></label>
                    <input type="email" class="form-control" name="emailR" id="emailR" required>
                  </div>
                  <div class="form-group">
                    <label for="passwordR"><b>Κωδικός Χρήστη</b></label>
                    <input type="password" class="form-control" name="passwordR" id="passwordR" required>
                  </div>
                  <div class="form-group">
                    <label for="repasswordR"><b>Επαλήθευση Κωδικού Χρήστη</b></label>
                    <input type="password" class="form-control" name="repasswordR" id="repasswordR" required>
                  </div>
                  <div class="form-group">
                    <label for="firstnameR"><b>Όνομα</b></label>
                    <input type="text" class="form-control" name="firstnameR" id="firstnameR" required>
                  </div>
                  <div class="form-group">
                    <label for="lastnameR"><b>Επώνυμο</b></label>
                    <input type="text" class="form-control" name="lastnameR" id="lastnameR" required>
                  </div>
                  <div class="form-group">
                    <label for="phoneR"><b>Τηλέφωνο</b></label>
                    <input type="text" class="form-control" name="phoneR" id="phoneR" required>
                  </div>
                  <label for="type"><b>Είδος Δικαιούχου</b></label>
                  <div class="form-group">
                      <select class="form-control" name="type" id="type" required>
                          <option value="foititis">Φοιτητής</option>
                          <option value="amea">Α.Μ.Ε.Α</option>
                          <option value="regular" selected>Κανονικό</option>
                      </select>
                  </div>
              </div>

              <div class="modal-footer">
                  <input class="btn btn-success" type="submit" name="create" id="register" value="Εγγραφή">
              </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" role="dialog" id="loginModal">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Σύνδεση Χρήστη</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form>
              <div class="modal-body">
                  <div class="form-group">
                    <label for="usernameS"><b>Όνομα Χρήστη</b></label>
                    <input type="text" class="form-control" name="usernameS" id="usernameS" required>
                  </div>
                  <div class="form-group">
                    <label for="passwordS"><b>Κωδικός Χρήστη</b></label>
                    <input type="password" class="form-control" name="passwordS" id="passwordS" required>
                  </div>
              </div>

              <div class="modal-footer">
                  <input class="btn btn-primary" type="submit" name="logIn" id="signIn" value="Σύνδεση">
              </div>
              </form>
        </div>
    </div>
</div>
<script type="text/javascript">
function searchR() {
  var value = $('#value').val();
  if(value.endsWith("(Α)")){
    const n=value.lastIndexOf("(Α)");
    value=value.slice(0,n);
  }
  $.ajax({
      type: 'POST',
      url: 'search.php',
      data: {
          value:value,
          searchR:true
      },
      success: async function (data) {
        data=JSON.parse(data);
        const t = document.getElementById('results');
        while (t.firstChild) {
            t.removeChild(t.firstChild);
        }
        for(i=0; i<data.length; i++) {
          const a=document.createElement("option");
          a.setAttribute("id",i);
          if(data[i]["amea"]==="1") a.setAttribute("value",data[i][0]+"(Α)");
          else a.setAttribute("value",data[i][0]);
          if(data[i]["bus_id"]===undefined && data[i]["area"]===undefined) a.setAttribute("name","ΣΤΑΣΗ");
          else if(data[i]["area"]===undefined) a.setAttribute("name","ΛΕΩΦΟΡΕΙΟ");
          else  a.setAttribute("name","ΠΕΡΙΟΧΗ");
          t.appendChild(a);
        }
      },
      error: function (data) {
          Swal.fire({
              title: 'ΣΦΑΛΜΑ',
              text: data,
              icon: 'error'
          })
      },
  });
}
</script>
<script type="text/javascript">
    $(function () {
        $('#search').click(function (e) {
              e.preventDefault();
              const value = $('#value').val();
              const name = $("#0").attr("name");

              window.location="./routes.php?search="+value+"?type="+name;
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#signOut').click(function (e) {
                    $.ajax({
                        type: 'POST',
                        url: 'signOut.php',
                        data: {
                            logout:true
                        },
                        success: async function (data) {
                          if(data === 'ok')
                              Swal.fire({
                                  title: 'ΕΠΙΤΥΧΙΑ',
                                  text: 'Αποσυνδεθήκατε επιτυχώς!',
                                  icon: 'success'
                              }).then(function() {
                                  const str=window.location.pathname;
                                  if(str.endsWith("UpdateProfile.php")) window.location="./";
                                  else {
                                    document.getElementById("navbarDropdownU").innerHTML="";
                                    document.getElementById("login").style.display = "block";
                                    document.getElementById("signUp").style.display = "block";
                                    document.getElementById("signedIn").style.display = "none";
                                  }
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
                                text: data,
                                icon: 'error'
                            })
                        },
                    });


        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#signIn').click(function (e) {



            const valid = this.form.checkValidity();
            if(valid){
                e.preventDefault();
                const username = $('#usernameS').val();
                const password = $('#passwordS').val();
                    $.ajax({
                        type: 'POST',
                        url: 'signIn.php',
                        data: {
                            username: username,
                            password: password,
                            login:true
                        },
                        success: async function (data) {
                          if(data === 'ok')
                              Swal.fire({
                                  title: 'ΕΠΙΤΥΧΙΑ',
                                  text: 'Η συνδεση σας ολοκληρώθηκε!',
                                  icon: 'success'
                              }).then(function() {
                                  document.getElementById("navbarDropdownU").innerHTML=username;
                                  document.getElementById("login").style.display = "none";
                                  document.getElementById("signUp").style.display = "none";
                                  document.getElementById("signedIn").style.display = "block";
                                  $('#loginModal').modal('hide');
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
                                text: 'Τα στοιχεία που δώσατε είναι λανθασμένα!',
                                icon: 'error'
                            })
                        },
                    });
            }else{
                Swal.fire({
                    text: 'Παρακαλώ συμπληρώστε όλα τα στοιχεία σας.'
                });
            }


        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#register').click(function (e) {


            const valid = this.form.checkValidity();
            if(valid){

                e.preventDefault();
                const firstName = $('#firstnameR').val();
                const lastname = $('#lastnameR').val();
                const email = $('#emailR').val();
                const phone = $('#phoneR').val();
                const username = $('#usernameR').val();
                const password = $('#passwordR').val();
                const repassword = $('#repasswordR').val();
                const type = $('#type').val();
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
                            password: password,
                            type:type,
                            register:true
                        },
                        success: async function (data) {
                            if(data === 'ok')
                                Swal.fire({
                                    title: 'ΕΠΙΤΥΧΙΑ',
                                    text: 'Η εγγραφή σας ολοκληρώθηκε.',
                                    icon: 'success'
                                }).then(function() {
                                    document.getElementById("navbarDropdownU").innerHTML=username;
                                    document.getElementById("login").style.display = "none";
                                    document.getElementById("signUp").style.display = "none";
                                    document.getElementById("signedIn").style.display = "block";
                                    $('#registerModal').modal('hide');
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
<script type="text/javascript">
    const str="<?php echo $showUsername ?>";
    if(str!="") {
      document.getElementById("login").style.display = "none";
      document.getElementById("signUp").style.display = "none";
      document.getElementById("signedIn").style.display = "block";
    }
</script>
