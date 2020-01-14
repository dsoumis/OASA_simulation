<!DOCTYPE html>

<html>

<head>
    <title>ΟΑΣΑ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/sidepanel.css">
</head>


<body onload="Initialize()">

<style>
body {
    background-image: url('assets/images');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: 100% 100%;
}
</style>
<?php
    include 'Navbar.php'
?>
<style>
rav  {
  color :black;
  background-color:rgba(204, 229, 255, 0.5);
  position: absolute ;
  width: 30%;
  height: 360px;
  left: 28%;
  top: 155px;
  border: 0px solid blue;
  padding: 25px;
  margin: 20px;
}
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
            left: 5%;
            top:  3%;
            border: 0px solid blue;
        }
        aygo2{
            color : white;
            background-color: transparent !important;
            position: absolute ;
            width: 2%;
            height:  2%;
            left: 10%;
            top: 23.7%;
            border: 0px solid blue;
        }
#OverviewText4 {
    position: relative;
}

#OverviewText4 img {
    width: 30%;
    height: 360px;
    position: absolute;
    top: 0px;
    right: 50px;
}
.dropdown-content {
    display: none;
    position: absolute;
    top: 30px;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
}

.center {
  top : 30px;
  right : 200px;
  width: 20%;
  padding: 8px;
}

.dropdown-menu {
    border: none;
}

.dropdown-item{
	position: relative;

}
.back_form {
  justify-content: center;
}
</style>


<button class="openbtn" onclick="openNav()">&#9776;</button>
<aygo2><a  href="./AMEA.php"> ΑΜΕΑ </aygo2>
<aygo1><a  href="./"> Αρχική   </aygo1>
<div id="mySidepanel" class="sidepanel">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="card">
      <div class="card-header" style="background-color: #7bcafd;">
        Aναζητείστε στάσεις Α.Μ.Ε.Α. ανά περιοχή.
      </div>
      <div class="card-body" style="background-color: #2E9AFE">
<form  class="form-inline" autocomplete="off" method="post" >
    <input list="Results" class="form-control mr-sm-2"  id="Value" placeholder="Αναζήτηση" aria-label="Αναζήτηση">
        <button id="Search" class="btn btn-light" type="submit"><img src="assets/search_icon.png" alt="Logo" style="width:18px;"></button>
            <datalist id="Results">
                <option value="Ηλιούπολη"></option>
                <option value="Ίλιον"></option>
                <option value="Περιστέρι"></option>
                <option value="Κάτω Πατήσσια"></option>
            </datalist>
</form>
</div>
</div>
</div>

<div id="OverviewText4">
    <img src="assets/AMEA.png" />
</div>


<rav id="info">Το πρόβλημα της μετακίνησης-μεταφοράς των εμποδιζομένων ατόμων στις σύγχρονες πόλεις
     παραμένει έντονο με αρνητικές συνέπειες στην ποιότητα ζωής λόγω της μη ικανοποιητικής
     πρόσβασης στα ΜΜΜ.<br>Για αυτόν το λόγο προσπαθούμε με κάθε δυνατό τρόπο να δώσουμε
    λύσεις στα προβλήματα των συνανθρώπων μας.<br>
    Σε αυτή τη σελίδα μπορείτε να βρείτε εύκολα τις κατάλληλα διαμορφωμένες στάσεις στη
    περιοχή που σας ενδιαφέρει καθώς και τα λεωφορεία που εξυπηρετούν.</rav>



</script>
<script type="text/javascript">
    $(function () {
        $('#Search').click(function (e) {
              e.preventDefault();
              const value = $('#Value').val();
              window.location="./AMEA.php?search="+value;
        });
    });

    function Initialize(){
        const url=decodeURIComponent(window.location.href);
        const n2=url.lastIndexOf("?");
        const n3=url.lastIndexOf("=")+1;
        const str2=url.substring(n3);
        const t = document.getElementById('info');
        var a=document.createElement("h2");
        var textnode=document.createTextNode("Διαμορφωμένες στάσεις στη περιοχη " + str2);
        if(str2==="undefined"){
            textnode=document.createTextNode("Δεν υπάρχουν αποτελέσματα γι΄αυτό που αναζητήσατε!");
            while (t.firstChild) {
                t.removeChild(t.firstChild);
            }
            a.appendChild(textnode);
            t.appendChild(a);
            return;
        }
        else if(n3!=0 && str2!=="undefined"){
            $.ajax({
                type: 'POST',
                url: 'staseisAMEA.php',
                data: {
                    value:str2,
                    amea : true
                },
                success: async function (data){
                    data=JSON.parse(data);
                    while (t.firstChild) {
                        t.removeChild(t.firstChild);
                    }
                    if(data.length===0){
                        textnode=document.createTextNode("Δεν υπάρχουν αποτελέσματα γι΄αυτό που αναζητήσατε!");
                        a.appendChild(textnode);
                        t.appendChild(a);
                        return;
                    }
                    a.appendChild(textnode);
                    t.appendChild(a);
                    a=document.createElement("ul");
                    a.setAttribute("class","list-group");
                    t.appendChild(a);
                    for(i=0; i<data.length; i++){

                        const b=document.createElement("li");
                        b.setAttribute("style", "position:relative;margin-bottom: 5%;;left:5%;width:90%;height:90%;");
                        b.setAttribute("name",data[i][0]);
                        b.setAttribute("class","list-group-item");
                        textnode=document.createTextNode(data[i][0]);
                        b.appendChild(textnode);
                        a.appendChild(b);
                    }
                },
                error: function (data) {
                    Swal.fire({
                    title: 'ΣΦΑΛΜΑ',
                    text: data,
                    icon: 'error'
                    })
                },
            })

        }
    }
    function openNav() {
        document.getElementById("mySidepanel").style.width = "300px";
    }

    function closeNav() {
        document.getElementById("mySidepanel").style.width = "0";
    }
</script>

</body>
</html>
