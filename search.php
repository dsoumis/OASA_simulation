<?php
    require_once('config.php');
?>
<?php
    if(isset($_POST["searchR"]) || isset($_POST["searchA"]) || isset($_POST["searchS"]) || isset($_POST["searchB"])) {
        session_start();
        $value = $_POST['value'];
        $str='%'.$value.'%';
        $sql="SELECT  bus_id FROM buses WHERE bus_id LIKE ?";
        $query = $db->prepare($sql);
        $query->execute([$str]);
        $count=$query->rowCount();
        $r1=[];
        if(isset($_POST["searchR"]) || isset($_POST["searchB"]))$r1=$query->fetchAll();
        else $r1=[];
        $sql = "SELECT  bus_stop,amea FROM bus_stops WHERE bus_stop LIKE ?";
        $query = $db->prepare($sql);
        $query->execute([$str]);
        $count=$query->rowCount();
        $r2=[];
        if(isset($_POST["searchR"]) || isset($_POST["searchS"]))$r2=$query->fetchAll();
        else $r2=[];
        $sql = "SELECT  DISTINCT area FROM bus_stops WHERE area LIKE ?";
        $query = $db->prepare($sql);
        $query->execute([$str]);
        $count=$query->rowCount();
        $r3=[];
        if(isset($_POST["searchR"]) || isset($_POST["searchA"]))$r3=$query->fetchAll();
        else $r3=[];
        if(isset($_POST["searchR"]) && $value==""){
          $r1=[];
          $r2=[];
          $r3=[];
        }
        echo json_encode(array_merge($r1,$r2,$r3));
    }else{
        echo "No data.";
        header("Location: ./");
    }
?>
