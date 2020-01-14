<?php
    require_once('config.php');
?>
<?php
    if(isset($_POST["amea"])) {
        session_start();
        $value=$_POST["value"];
        $sql="";
        $sql= "SELECT bus_stop FROM bus_stops WHERE  area=? AND amea=1";
        $query = $db->prepare($sql);
        $query->execute([$value]);
        $count=$query->rowCount();
        $r=$query->fetchAll();
        echo json_encode($r);
    }
    else{
        echo "No data.";
        header("Location: ./");
    }
?>
