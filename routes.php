<!DOCTYPE html>
<html>

<head>
    <title>ΟΑΣΑ-Διαδρομές</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/routes.css">
</head>
<body style="background-image: url('assets/backgroundImage.jpg');background-repeat: no-repeatbackground-attachment: fixed;
  background-size: cover;background-attachment: fixed;background-size: cover;" onload="initialize()">
  <?php
      include 'Navbar.php'
  ?>
  <div id="mySidepanel" class="sidepanel">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="card">
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
    <div class="card">
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
  </div>
  <button class="openbtn" onclick="openNav()">&#9776;</button>
  <div class="center" id="info" style="position: fixed; top:25%; left: 45%;text-align:center">
  </div>
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
function infoOpen(e){
    e.preventDefault();
    const url=decodeURIComponent(window.location.href);
    const n3=url.lastIndexOf("=")+1;
    const str2=url.substring(n3);
    var type;
    if(str2==="ΣΤΑΣΗ") {
      document.getElementById('title').innerHTML=("Αλληλουχία στάσεων για το λεωφορείο : "+e.target.name);
      type="ΛΕΩΦΟΡΕΙΟ";
    }
    else {
      document.getElementById('title').innerHTML=("Λεωφορεία που περνάνε από την στάση : "+e.target.innerHTML);
      type="ΣΤΑΣΗ";
    }
    $.ajax({
        type: 'POST',
        url: 'searchSpecific.php',
        data: {
            value:e.target.name,
            type:type
        },
        success: async function (data) {
          data=JSON.parse(data);
          const t = document.getElementById('body');
          while (t.firstChild) {
              t.removeChild(t.firstChild);
          }
          const a=document.createElement("div");
          a.setAttribute("class","list-group");
          a.style.textAlign="center"
          t.appendChild(a);
          for(i=0; i<data.length; i++) {
            const b=document.createElement("a");
            var textnode;
            b.setAttribute("class","list-group-item list-group-item-action list-group-item-info");
            if(data[i]["amea"]==="1") {
              textnode=document.createTextNode(data[i][0]+"(Α)");
              b.setAttribute("href","./routes.php?search="+data[i][0]+"(Α)?type="+str2);
            }
            else {
              textnode=document.createTextNode(data[i][0]);
              b.setAttribute("href","./routes.php?search="+data[i][0]+"?type="+str2);
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
function initialize(){
  $.ajax({
      type: 'POST',
      url: 'search.php',
      data: {
          value:"",
          searchB:true,
          searchS:true
      },
      success: async function (data) {
        data=JSON.parse(data);
        const tB = document.getElementById('resultsB');
        const tS = document.getElementById('resultsS');
        for(i=0; i<data.length; i++) {
          const a=document.createElement("option");
          if(data[i]["amea"]==="1") a.setAttribute("value",data[i][0]+"(Α)");
          else a.setAttribute("value",data[i][0]);
          if(data[i]["bus_id"]===undefined) {
            a.setAttribute("id","stop"+i);
            a.setAttribute("name","stop");
            tS.appendChild(a);
          }
          else {
            a.setAttribute("id","bus"+i);
            a.setAttribute("name","bus");
            tB.appendChild(a);
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
  const url=decodeURIComponent(window.location.href);
  const n1 = url.indexOf("=")+1;
  const n2=url.lastIndexOf("?");
  const n3=url.lastIndexOf("=")+1;
  var str1=url.substring(n1,n2);
  const str2=url.substring(n3);
  const t = document.getElementById('info');
  var a=document.createElement("h2");
  var textnode="";
  if(str2==="ΛΕΩΦΟΡΕΙΟ")textnode=document.createTextNode("Αλληλουχία στάσεων για το λεωφορείο : "+str1);
  else textnode=document.createTextNode("Λεωφορεία που περνάνε από την στάση : "+str1);
  if(str2==="undefined"){
    textnode=document.createTextNode("Δεν υπάρχουν αποτελέσματα γι΄αυτό που αναζητήσατε!");
    a.appendChild(textnode);
    t.appendChild(a);
  }

  else if(n1!==0 && str2!=="undefined"){
    if(str2==="ΣΤΑΣΗ" && str1.endsWith("(Α)")){
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
          if(data.length===0){
            textnode=document.createTextNode("Δεν υπάρχουν αποτελέσματα γι΄αυτό που αναζητήσατε!");
            a.appendChild(textnode);
            t.appendChild(a);
            return;
          }
          a.appendChild(textnode);
          t.appendChild(a);
          a=document.createElement("div");
          a.setAttribute("class","list-group");
          t.appendChild(a);
          for(i=0; i<data.length; i++) {
            const b=document.createElement("button");
            b.setAttribute("name",data[i][0]);
            b.onclick=infoOpen;
            b.setAttribute("data-toggle", "modal");
            b.setAttribute("data-target", "#infoModal");
            b.setAttribute("class","list-group-item list-group-item-action list-group-item-info");
            if(data[i]["amea"]==="1") textnode=document.createTextNode(data[i][0]+"(Α)");
            else textnode=document.createTextNode(data[i][0]);
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
          value:value,
          searchB:true
      },
      success: async function (data) {
        data=JSON.parse(data);
        const t = document.getElementById('resultsB');
        while (t.firstChild) {
            t.removeChild(t.firstChild);
        }
        for(i=0; i<data.length; i++) {
          const a=document.createElement("option");
          a.setAttribute("value",data[i][0]);
          a.setAttribute("id","bus"+i);
          a.setAttribute("name","ΛΕΩΦΟΡΕΙΟ");
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
  const value = $('#valueS').val();
  $.ajax({
      type: 'POST',
      url: 'search.php',
      data: {
          value:value,
          searchS:true
      },
      success: async function (data) {
        data=JSON.parse(data);
        const t = document.getElementById('resultsS');
        while (t.firstChild) {
            t.removeChild(t.firstChild);
        }
        for(i=0; i<data.length; i++) {
          const a=document.createElement("option");
          a.setAttribute("value",data[i][0]);
          a.setAttribute("id","stop"+i);
          a.setAttribute("name","ΣΤΑΣΗ");
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
