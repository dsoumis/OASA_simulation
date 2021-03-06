<!DOCTYPE html>
<html>

<head>
    <title>ΟΑΣΑ-Διαδρομές</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/sidepanel.css">
</head>
<body style="background-image: url('assets/backgroundImage.jpg');background-repeat: no-repeatbackground-attachment: fixed;
  background-size: cover;background-attachment: fixed;background-size: cover;" onload="initialize()">
  <?php
      include 'Navbar.php'
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
  </style>
  <button class="openbtn" onclick="openNav()">&#9776;</button>
  <aygo2><a  href="./routes.php"> Δρομολόγια </aygo2>
  <aygo1><a  href="./"> Αρχική   </aygo1>
  <div id="mySidepanel"  class="sidepanel">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="card" style="background-color: #7bcafd;">
      <div class="card-header" style="background-color: #7bcafd;">
        Λεωφορεία
      </div>
      <div class="card-body" style="background-color: #2E9AFE">
        <form  class="form-inline"  autocomplete="off" method="post">
            <input onkeyup="searchB()" list="resultsB" class="form-control mr-sm-2" name="valueB" type="text" id="valueB" placeholder="Αναζήτηση" aria-label="Αναζήτηση">
            <button id="search_buttonB" class="btn btn-light" type="submit"><img src="assets/search_icon.png" alt="Logo" style="width:18px;"></button>
            <datalist id="resultsB">
            </datalist>
        </form>
      </div>
    </div>
    <div class="card" style="background-color: #7bcafd;">
      <div class="card-header" style="background-color: #7bcafd;">
        Στάσεις
      </div>
      <div class="card-body" style="background-color: #2E9AFE">
        <form  class="form-inline" autocomplete="off" method="post">
            <input  onkeyup="searchS()" list="resultsS" class="form-control mr-sm-2" name="valueS" type="text" id="valueS" placeholder="Αναζήτηση" aria-label="Αναζήτηση">
            <button id="search_buttonS" class="btn btn-light" type="submit"><img src="assets/search_icon.png" alt="Logo" style="width:18px;"></button>
            <datalist id="resultsS">
            </datalist>
        </form>
      </div>
    </div>
    <div class="card" style="background-color: #7bcafd;">
      <div class="card-header" style="background-color: #7bcafd;">
        Περιοχή
      </div>
      <div class="card-body" style="background-color: #2E9AFE">
        <form  class="form-inline" autocomplete="off" method="post">
            <input  onkeyup="searchA()" list="resultsA" class="form-control mr-sm-2" name="valueA" type="text" id="valueA" placeholder="Αναζήτηση" aria-label="Αναζήτηση">
            <button id="search_buttonA" class="btn btn-light" type="submit"><img src="assets/search_icon.png" alt="Logo" style="width:18px;"></button>
            <datalist id="resultsA">
            </datalist>
        </form>
      </div>
    </div>
  </div>
  <div id="OverviewText4">
      <img src="assets/2buses.jpg" />
  </div>
  <rav id="info"><h3>Σε αυτήν την υποσελίδα μπορείτε να βρείτε τα πάντα για τα δρομολόγια του ΟΑΣΑ!Aναζητείστε απο το αριστερό sidepanel,βάσει λεωφορείων,στάσεων και περιοχών.</h3></rav>
  <div class="modal fade" role="dialog" id="infoModal">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h3 id="title" class="modal-title"></h3>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div id="body" class="modal-body">
              </div>
          </div>
      </div>
  </div>
  <script type="text/javascript">
      function infoOpen(e) {
          e.preventDefault();
          const url = decodeURIComponent(window.location.href);
          const n3 = url.lastIndexOf("=") + 1;
          const str2 = url.substring(n3);
          let type,type1;
          if (e.target.id.includes("stop")) {
              document.getElementById('title').innerHTML = ("Λεωφορεία που περνάνε από την στάση : " + e.target.innerHTML);
              type = "ΣΤΑΣΗ";
              type1 = "ΛΕΩΦΟΡΕΙΟ";
          }
          else {
              document.getElementById('title').innerHTML = ("Αλληλουχία στάσεων για το λεωφορείο : " + e.target.name);
              type = "ΛΕΩΦΟΡΕΙΟ";
              type1 = "ΣΤΑΣΗ";

          }
          $.ajax({
              type: 'POST',
              url: 'searchSpecific.php',
              data: {
                  value:e.target.name,
                  type: type
              },
              success: async function (data) {
                  data = JSON.parse(data);
                  const t = document.getElementById('body');
                  while (t.firstChild) {
                      t.removeChild(t.firstChild);
                  }
                  const a = document.createElement("div");
                  a.setAttribute("class", "list-group");
                  a.style.textAlign = "center";
                  t.appendChild(a);
                  for (let i = 0; i < data.length; i++) {
                      const b = document.createElement("a");
                      let textnode;
                      b.setAttribute("class", "list-group-item list-group-item-action list-group-item-light");
                      if (data[i]["amea"] === "1") {
                          textnode = document.createTextNode(data[i][0] + "(Α)");
                          b.setAttribute("href", "./routes.php?search=" + data[i][0] + "(Α)?type=" + type1);
                      }
                      else {
                          textnode = document.createTextNode(data[i][0]);
                          b.setAttribute("href", "./routes.php?search=" + data[i][0] + "?type=" + type1);
                      }
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
    });
}
$(function () {
    $('#search_buttonB').click(function (e) {
          e.preventDefault();
          const value = $('#valueB').val();
          const name = $("#bus0").attr("name");
          window.location="./routes.php?search="+value+"?type="+name;
    });
});
$(function () {
    $('#search_buttonS').click(function (e) {
          e.preventDefault();
          const value = $('#valueS').val();
          const name = $("#stop0").attr("name");
          window.location="./routes.php?search="+value+"?type="+name;
    });
});
$(function () {
    $('#search_buttonA').click(function (e) {
          e.preventDefault();
          const value = $('#valueA').val();
          const name = $("#area0").attr("name");
          window.location="./routes.php?search="+value+"?type="+name;
    });
});
function initialize(){
  $.ajax({
      type: 'POST',
      url: 'search.php',
      data: {
          value: "",
          searchB: true,
          searchS: true,
          searchA:true
      },
      success: async function (data) {
          data = JSON.parse(data);
          const tB = document.getElementById('resultsB');
          const tS = document.getElementById('resultsS');
          const tA = document.getElementById('resultsA');
          for (let i = 0; i < data.length; i++) {
              const a = document.createElement("option");
              if (data[i]["amea"] === "1") a.setAttribute("value", data[i][0] + "(Α)");
              else a.setAttribute("value", data[i][0]);
              if (data[i]["bus_id"] === undefined && data[i]["area"] === undefined) {
                  a.setAttribute("id", "stop" + i);
                  a.setAttribute("name", "stop");
                  tS.appendChild(a);
              }
              else if(data[i]["area"] === undefined){
                  a.setAttribute("id", "bus" + i);
                  a.setAttribute("name","bus");
                  tB.appendChild(a);
              }
              else {
                  a.setAttribute("id", "area" + i);
                  a.setAttribute("name","area");
                  tA.appendChild(a);
              }
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
    const url = decodeURIComponent(window.location.href);
    const n1 = url.indexOf("=") + 1;
    const n2 = url.lastIndexOf("?");
    const n3 = url.lastIndexOf("=") + 1;
    let str1 = url.substring(n1, n2);
    const str2 = url.substring(n3);
    const t = document.getElementById('info');
    let a = document.createElement("h3"),a1,a2;
    let textnode = "";
    if (str2 === "ΛΕΩΦΟΡΕΙΟ") textnode = document.createTextNode("Αλληλουχία στάσεων για το λεωφορείο : " + str1);
    else if(str2==="ΣΤΑΣΗ") textnode = document.createTextNode("Λεωφορεία που περνάνε από την στάση : " + str1);
    else textnode = document.createTextNode("Στάσεις/Λεωφορεία στην περιοχή : " + str1);
    if (str2 === "undefined") {
      while (t.firstChild) {
          t.removeChild(t.firstChild);
      }
        textnode = document.createTextNode("Δεν υπάρχουν αποτελέσματα γι΄αυτό που αναζητήσατε!");
        a.appendChild(textnode);
        t.appendChild(a);
        return;
    } else if (n1 !== 0 && str2 !== "undefined") {
    if (str2 === "ΣΤΑΣΗ" && str1.endsWith("(Α)")) {
      const n=str1.lastIndexOf("(Α)");
      str1=str1.slice(0,n);
    }
    $.ajax({
        type: 'POST',
        url: 'searchSpecific.php',
        data: {
            value:str1,
            type:str2
        },
        success: async function (data) {
          data=JSON.parse(data);
          while (t.firstChild) {
              t.removeChild(t.firstChild);
          }
          if(data.length===0){
              textnode = document.createTextNode("Δεν υπάρχουν αποτελέσματα γι΄αυτό που αναζητήσατε!");
              a.appendChild(textnode);
              t.appendChild(a);
              return;
          }
            a.appendChild(textnode);
            t.appendChild(a);
            var c=document.createElement("hr");
            c.setAttribute("class","mb-3");
            t.appendChild(c);
            if(str2!=="ΠΕΡΙΟΧΗ"){
              a = document.createElement("div");
              a.setAttribute("class", "list-group");
            }
            else {
              a = document.createElement("div");
              a.setAttribute("style","display:flex");
              a1 = document.createElement("div");
              a1.setAttribute("class", "list-group");
              a1.setAttribute("style", "padding: 1em;;flex: 1;width: 50%; height: 50%;float:left");
              a.appendChild(a1);
              a2 = document.createElement("div");
              a2.setAttribute("class", "list-group");
              a2.setAttribute("style", "padding: 1em;;flex: 1;width: 50%; height: 50%;float:right");
              a.appendChild(a2);
            }
            t.appendChild(a);
            for (let i = 0; i < data.length; i++) {
                const b = document.createElement("button");
                b.setAttribute("name", data[i][0]);
                b.onclick = infoOpen;
                b.setAttribute("data-toggle", "modal");
                b.setAttribute("data-target", "#infoModal");
                b.setAttribute("style", "position:relative;margin-bottom: 5%;;left:5%;width:90%;height:90%;");
                b.setAttribute("class", "list-group-item list-group-item-action list-group-item-light");
                if (data[i]["amea"] === "1") textnode = document.createTextNode(data[i][0] + "(Α)");
                else textnode = document.createTextNode(data[i][0]);
                if(data[i]["bus_id"]===undefined) b.setAttribute("id", i+"stop"+i);
                else  b.setAttribute("id", i+"bus"+i);
                b.appendChild(textnode);
                if(str2!=="ΠΕΡΙΟΧΗ") a.appendChild(b);
                else if(data[i]["bus_id"]===undefined){
                  a1.appendChild(b);
                }
                else a2.appendChild(b);
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
}
function openNav() {
  document.getElementById("mySidepanel").style.width = "300px";
}

function closeNav() {
  document.getElementById("mySidepanel").style.width = "0";
}
function searchB() {
  const value = $('#valueB').val();
  $.ajax({
      type: 'POST',
      url: 'search.php',
      data: {
          value: value,
          searchB: true
      },
      success: async function (data) {
          data = JSON.parse(data);
          const t = document.getElementById('resultsB');
          while (t.firstChild) {
              t.removeChild(t.firstChild);
          }
          for (let i = 0; i < data.length; i++) {
              const a = document.createElement("option");
              a.setAttribute("value", data[i][0]);
              a.setAttribute("id", "bus" + i);
              a.setAttribute("name", "ΛΕΩΦΟΡΕΙΟ");
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
function searchS() {
  var value = $('#valueS').val();
  if (value.endsWith("(Α)")) {
    const n=value.lastIndexOf("(Α)");
    value=value.slice(0,n);
  }
  $.ajax({
      type: 'POST',
      url: 'search.php',
      data: {
          value: value,
          searchS: true
      },
      success: async function (data) {
          data = JSON.parse(data);
          const t = document.getElementById('resultsS');
          while (t.firstChild) {
              t.removeChild(t.firstChild);
          }
          for (let i = 0; i < data.length; i++) {
              const a = document.createElement("option");
              if (data[i]["amea"] === "1") a.setAttribute("value", data[i][0] + "(Α)");
              else a.setAttribute("value", data[i][0]);
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
function searchA() {
  const value = $('#valueA').val();
  $.ajax({
      type: 'POST',
      url: 'search.php',
      data: {
          value: value,
          searchA: true
      },
      success: async function (data) {
          data = JSON.parse(data);
          const t = document.getElementById('resultsA');
          while (t.firstChild) {
              t.removeChild(t.firstChild);
          }
          for (let i = 0; i < data.length; i++) {
              const a = document.createElement("option");
              a.setAttribute("value", data[i][0]);
              a.setAttribute("id", "area" + i);
              a.setAttribute("name", "ΠΕΡΙΟΧΗ");
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
