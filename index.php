<!DOCTYPE html>
<html>

<head>
    <title>ΟΑΣΑ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/sidepanel.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
          integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
          crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
            integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
            crossorigin=""></script>
    <style>
        #myDIV {
            width: 50%;
            padding: 50px 0;
            text-align: center;
            background-color: #fbfffd;
            margin-top: 20px;
        }

        #mapid {
            height: 130px;
        }
        rav  {
            color :black;
            background-color:rgba(204, 229, 255, 0.5);
            position: absolute ;
            width: 25%;
            height: 350px;
            left: 27%;
            top: 155px;
            border: 0px solid blue;
            padding: 25px;
            margin: 20px;
        }
        #OverviewText4 {
            position: relative;
        }

        #OverviewText4 img {
            width: 35%;
            height: 350px;
            position: absolute;
            top: 50px;
            right: 5%;
        }
    </style>
</head>
<body style="background-image: url('assets/mehe.jpg');background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: 100% 100%;">
<?php
include 'Navbar.php'
?>
<div id="OverviewText4">
    <img src="assets/mpa.jpg" />
</div>
<div id="mySidepanel" class="sidepanel">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="card-header" style="background-color: #7bcafd;">
        Αναζήτηση διαδρομής
    </div>
    <div class="card-body" style="background-color: #2E9AFE">
        <form class="form-inline" autocomplete="off" method="post">
            <input onkeyup="searchSA()" list="resultsSA" class="form-control mr-sm-2" name="valueSA" type="text"
                   id="valueSA" placeholder="Σταθμός αφετηρίας"
                   aria-label="Αναζήτηση">
            <datalist id="resultsSA">
            </datalist>
        </form>
    </div>

    <div class="card-body" style="background-color: #2E9AFE">
        <form class="form-inline" autocomplete="off" method="post">
            <input onkeyup="searchSB()" list="resultsSB" class="form-control mr-sm-2" name="valueSB" type="text"
                   id="valueSB" placeholder="Σταθμός προορισμού"
                   aria-label="Αναζήτηση">
            <datalist id="resultsSB">
            </datalist>
        </form>
    </div>
    <div class="card-header" style="background-color: #7bcafd;">
        <input type="submit" class="btn btn-light" id="searchbtn" value="Αναζήτηση"/>
    </div>
</div>
<button class="openbtn" onclick="openNav()">&#9776;</button>

<rav id="info"><h5>Καλωσήρθατε στη κεντρική ιστοσελίδα του ΟΑΣΑ.</h5><br>
        <h6 id="Htext">
    Το αύριο είναι τώρα. Στην ιστοσελίδα μας μπορειτε εύκολα και
    γρήγορα να βρείτε κάθε διαδρομή που σας ενδιαφέρει για τη
    μετακίνηση στη πόλη μας. <br><br>
    Πλέον μπορείτε να συνδεθείτε στην ιστοσελίδα μας και να μας ακολουθήσετε στο Facebook. Μη χάσετε κανένα νέο.
    </h6>

  </rav>

<div id="myDIV" class="container" style="border-radius: 50px 20px;display: none">
  <ul id="busCombination" class="list-group" >
  </ul>
  <p id="ticketPrice"></p>
  <p id="expectedTime"></p>
  <div id="mapid"></div>
</div>
<script type="text/javascript">
    $('#searchbtn').click(function (e) {
        e.preventDefault();

        const startH = $('#valueSA').val();
        const destinationH = $('#valueSB').val();
        $.ajax({
            type: 'POST',
            url: 'directions_example.php',
            data: {
                start: startH,
                destination: destinationH,
                example: true
            },
            success: async function (data) {
                data = JSON.parse(data);
                if(data.length===0) {
                  var c=document.getElementById("info");
                  while (c.firstChild) {
                      c.removeChild(c.firstChild);
                  }
                  c=document.createElement("h2");
                  var textNode=document.createTextNode("Δεν υπάρχουν αποτελέσματα γι΄αυτό που αναζητήσατε!");
                  c.appendChild(textNode);
                  document.getElementById("info").appendChild(c);
                  return;
                }
                document.getElementById("myDIV").style.display = "block";
                if ( $( "#OverviewText4" ).length ){
                  $("#OverviewText4").empty();
                  $("#OverviewText4").remove();
                }
                if ( $( "#info" ).length ){
                  $("#info").empty();
                  $("#info").remove();
                }
                var t = document.getElementById('busCombination');
                while (t.firstChild) {
                    t.removeChild(t.firstChild);
                }
                for (let i = 0; i < data.length - 1; i += 2) {
                    if (i === 0)
                        $("#busCombination").append('<li class="list-group-item list-group-item-action" data-toggle="list" role="tab">' +
                            'Επιβιβαστείτε στη στάση ' + startH + ' στο λεωφορείο ' + data[i] + ' μέχρι τη στάση ' + data[i + 1] + ' </li>');
                    else
                        $("#busCombination").append('<li class="list-group-item list-group-item-action" data-toggle="list" role="tab">' +
                            'Επιβιβαστείτε στη στάση ' + data[i - 1] + ' στο λεωφορείο ' + data[i] + ' μέχρι τη στάση ' + data[i + 1] + ' </li>');
                }
                const hour_minutes = data[data.length - 1].split(':');
                const total_time = (parseInt(hour_minutes[0]) * 60) + parseInt(hour_minutes[1]);
                document.getElementById("ticketPrice").innerHTML = "Το εισιτήριο κοστίζει: " + Math.ceil(total_time / 90) * 1.20 +
                    "€ (ή μειωμένο " + Math.ceil(total_time / 90) * 0.6 + "€).";
                if (hour_minutes[0] === '0')
                    document.getElementById("expectedTime").innerHTML = "Εκτιμώμενος χρόνος: " + hour_minutes[1] + " λεπτά.";
                else if (hour_minutes[1] === '00')
                    document.getElementById("expectedTime").innerHTML = "Εκτιμώμενος χρόνος: " + hour_minutes[0] + " ώρες.";
                else
                    document.getElementById("expectedTime").innerHTML = "Εκτιμώμενος χρόνος: " + hour_minutes[0] + " ώρες και " + hour_minutes[1] + " λεπτά.";


                const mymap = L.map('mapid').setView([37.983810, 23.727539], 11);
                L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibG9zZXRlbG8iLCJhIjoiY2s1MWRheWc1MHQydTNybTVjYjk0Y2N6cSJ9.EMa2HmYsIusVepBz_ksnkA', {
                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                        '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                    maxZoom: 18,
                    id: 'mapbox/streets-v11',
                    accessToken: 'pk.eyJ1IjoibG9zZXRlbG8iLCJhIjoiY2s1MWRheWc1MHQydTNybTVjYjk0Y2N6cSJ9.EMa2HmYsIusVepBz_ksnkA'
                }).addTo(mymap);
                const marker = L.marker([37.983810, 23.727539]).addTo(mymap);
                marker.bindPopup("<b>Αγίου Νικολάου</b><br>Λεωφορεία: 4,5").openPopup();
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

    function openNav() {
        document.getElementById("mySidepanel").style.width = "300px";
    }

    function closeNav() {
        document.getElementById("mySidepanel").style.width = "0";
    }

    function searchSA() {
        const value = $('#valueSA').val();
        $.ajax({
            type: 'POST',
            url: 'search.php',
            data: {
                value: value,
                searchS: true
            },
            success: async function (data) {
                data = JSON.parse(data);
                const t = document.getElementById('resultsSA');
                while (t.firstChild) {
                    t.removeChild(t.firstChild);
                }
                for (let i = 0; i < data.length; i++) {
                    const a = document.createElement("option");
                    a.setAttribute("value", data[i][0]);
                    a.setAttribute("id", "stop" + i);
                    a.setAttribute("name", "ΣΤΑΣΗ");
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

    function searchSB() {
        const value = $('#valueSB').val();
        $.ajax({
            type: 'POST',
            url: 'search.php',
            data: {
                value: value,
                searchS: true
            },
            success: async function (data) {
                data = JSON.parse(data);
                const t = document.getElementById('resultsSB');
                while (t.firstChild) {
                    t.removeChild(t.firstChild);
                }
                for (let i = 0; i < data.length; i++) {
                    const a = document.createElement("option");
                    a.setAttribute("value", data[i][0]);
                    a.setAttribute("id", "stop" + i);
                    a.setAttribute("name", "ΣΤΑΣΗ");
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
</body>
</html>
