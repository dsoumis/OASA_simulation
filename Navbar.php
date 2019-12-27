<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #7bcafd;">
    <a class="navbar-brand" href="#"><img src="assets/logo_oasa.png" alt="Logo" style="width:80px;"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Νέα<span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Εισιτήρια
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Αγορά</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Τροποποίηση Αγοράς</a>
                </div>
            </li>
            <li class="nav-item"><a class="nav-link" href="#">Διαδρομές</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Δρομολόγια</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Εργασία</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Παράπονα</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Α.Μ.Ε.Α</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Επικοινωνία</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Βοήθεια</a></li>
        </ul>
        <form class="form-inline my-2 my-lg-0 navbar-nav mr-auto">
            <input class="form-control mr-sm-2" type="search" placeholder="Αναζήτηση" aria-label="Αναζήτηση">
            <button class="btn btn-light" type="submit"><img src="assets/search_icon.png" alt="Logo" style="width:18px;"></button>
        </form>

        <ul class="navbar-nav navbar-right">
            <li class="nav-item">
                <a class="nav-link" href="/eam/Registration.php">Εγγραφή</a>
            </li>
            <li class="nav-item">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#loginModal">Σύνδεση</button>
            </li>
        </ul>
    </div>
</nav>

<div class="modal fade" role="dialog" id="loginModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Σύνδεση Χρήστη</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Όνομα Χρήστη">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Κωδικός Χρήστη">
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-success">ΣΥΝΔΕΣΗ</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/jquery-3.4.1.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>

