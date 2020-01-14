<?php
    require_once('config.php');
?>
<?php
    if(isset($_POST["type"])) {
        session_start();
        $value = $_POST['value'];
        $sql="";
        $r=[];
        if($_POST["type"]=="ΛΕΩΦΟΡΕΙΟ") {
          $sql="SELECT  DISTINCT bus_stops.bus_stop,bus_stops.amea FROM bus_stops,buses_stops,buses
          WHERE bus_stops.bus_stop=buses_stops.bus_stop AND buses.bus_id=buses_stops.bus
          AND buses.bus_id=?";
          $query = $db->prepare($sql);
          $query->execute([$value]);
          $count=$query->rowCount();
          $r=$query->fetchAll();
        }
        else if($_POST["type"]=="ΣΤΑΣΗ") {
          $sql="SELECT DISTINCT buses.bus_id FROM bus_stops,buses_stops,buses
          WHERE bus_stops.bus_stop=buses_stops.bus_stop AND buses.bus_id=buses_stops.bus
          AND bus_stops.bus_stop=?";
          $query = $db->prepare($sql);
          $query->execute([$value]);
          $count=$query->rowCount();
          $r=$query->fetchAll();
        }
        else {
          $sql="SELECT  DISTINCT buses.bus_id FROM bus_stops,buses_stops,buses
          WHERE bus_stops.bus_stop=buses_stops.bus_stop AND buses.bus_id=buses_stops.bus
          AND bus_stops.area=?";
          $query = $db->prepare($sql);
          $query->execute([$value]);
          $count=$query->rowCount();
          $r=$query->fetchAll();
          $sql="SELECT  DISTINCT bus_stops.bus_stop,bus_stops.amea FROM bus_stops,buses_stops,buses
          WHERE bus_stops.bus_stop=buses_stops.bus_stop AND buses.bus_id=buses_stops.bus
          AND bus_stops.area=?";
          $query = $db->prepare($sql);
          $query->execute([$value]);
          $count=$query->rowCount();
          $r=array_merge($r,$query->fetchAll());
        }
        echo json_encode($r);
    }else{
        echo "No data.";
        header("Location: ./");
    }
?>
