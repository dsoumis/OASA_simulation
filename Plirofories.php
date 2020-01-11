<!DOCTYPE html>
<html>
<head>
    <title>ΟΑΣΑ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/routes.css">
</head>

<body onload="Initialize()">
    <?php
        include 'Navbar.php'
    ?>
    <style>
        body {
            background-image: url('assets/images');
            background-repeat: no-repeat;
            background-attachment: fixed; 
            background-size: 100% 100%;
        }
        aygo1{
            color : white;
            background-color: transparent !important;
            position: absolute ;
            width: 400px;
            height: 400px;
            left: -20px;
            top: 50px;
            border: 0px solid blue;
            padding: 50px;
            margin: 20px;
        }
        aygo2{
            color : white;
            background-color: transparent !important;
            position: absolute ;
            width: 400px;
            height: 400px;
            left: 70px;
            top: 59px;
            border: 0px solid blue;
            padding: 50px;
            margin: 20px;
        }
        rav  {
            color :white;
            display: inline;
            background-color:rgba(0, 51, 51, 0.5);
            position: absolute ;
            width: 420px;
            height: px;
            left: 250px;
            top: 150px;
            border: 0px solid blue;
            padding: 10px;
            margin: 20px;
        }
        a {
            color: white;
            text-decoration: underline;
        }
        a2{
            color: white;
        }
        #OverviewText4 {
            position: relative;
        }
        #OverviewText4 img {
            width: 400px;
            height: 350px;
            position: absolute;
            top: 40px;
            right: 150px;
        }
    </style>
    <div id="OverviewText4">
        <img src="assets/OASAPHOTO.jpg" />
    </div>
    
    <rav>   Καλωσορίσατε στην διαδικτυακή σελίδα του ΟΑΣΑ. <br>
         <a class="nav-link" href="./">Εδώ μπορείτε εύκολα και γρήγορα να εκδώσετε το εισητήριο σας ή να 
        επαναφορτίσετε τη καρτα σας.</a>  
        <a class="nav-link" href="./directions.php">Μπορείτε να περιηγηθείτε σε όλες τις διαδρομές που σας προσφέρει <br> ο ΟΑΣΑ</a> 
        <a class="nav-link" href="./routes.php"> καθώς και να αναζητήσετε τη συντομότερη διαδρομή για να φτάσετε στον προορισμό σας.<br> </a>
        <a class="nav-link" href="./AMEA.php">Ακόμα, σεβόμενοι απόλυτα τις ανάγκες κάθε πολίτη ξεχωριστά, δίνουμε <br>
        με απλό τρόπο τη δυνατότητα να ενημερωθείτε για όλες τις στάσεις <br>
        που πληρούν τα Ευρωπαικά πρότυπα συμβατότητα για άτομα με ειδικες <br>
        ανάγκες. </a></rav>
        <aygo1><a class="nav-link" href="./"> Αρχική > </aygo1>
        <aygo2> Βοήθεια </aygo2>
</body>


</html>