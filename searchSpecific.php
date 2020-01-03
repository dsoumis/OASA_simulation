<?php
    require_once('config.php');
?>
<?php
    if(isset($_POST["type"])) {
        session_start();
        $value = $_POST['value'];
        $sql="";
        if($_POST["type"]=="ΛΕΩΦΟΡΕΙΟ") $sql="SELECT  bus_stops.bus_stop FROM bus_stops,buses_stops,buses
        WHERE bus_stops.bus_stop=buses_stops.bus_stop AND buses.bus_id=buses_stops.bus
        AND buses.bus_id=?";
        else $sql="SELECT  buses.bus_id FROM bus_stops,buses_stops,buses
        WHERE bus_stops.bus_stop=buses_stops.bus_stop AND buses.bus_id=buses_stops.bus
        AND bus_stops.bus_stop=?";
        $query = $db->prepare($sql);
        $query->execute([$value]);
        $count=$query->rowCount();
        $r=$query->fetchAll();
        echo json_encode($r);
    }else{
        echo "No data.";
        header("Location: ./");
    }
?>
