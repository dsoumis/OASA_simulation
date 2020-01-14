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
        rav  {
            color :white;
            display: inline;
            background-color:rgba(0, 51, 51, 0.5);
            position: absolute ;
            width: 48%;
            height: 350px;
            left: 5%;
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
            width: 30%;
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
         <a  href="./BuyCard.php">Εδώ μπορείτε εύκολα και γρήγορα να εκδώσετε το εισητήριο σας ή να
        επαναφορτίσετε τη καρτα σας.</a>
        <a  href="./routes.php">Μπορείτε να περιηγηθείτε σε όλες τις διαδρομές που σας προσφέρει <br> ο ΟΑΣΑ</a>
        <a  href="./"> καθώς και να αναζητήσετε τη συντομότερη διαδρομή για να φτάσετε στον προορισμό σας.<br> </a>
        <a  href="./AMEA.php">Ακόμα, σεβόμενοι απόλυτα τις ανάγκες κάθε πολίτη ξεχωριστά, δίνουμε <br>
        με απλό τρόπο τη δυνατότητα να ενημερωθείτε για όλες τις στάσεις <br>
        που πληρούν τα Ευρωπαικά πρότυπα συμβατότητα για άτομα με ειδικες <br>
        ανάγκες. </a></rav>

        <aygo2><a  href="./Plirofories.php"> Βοήθεια </aygo2>
        <aygo1><a  href="./"> Αρχική  </aygo1>
</body>


</html>
