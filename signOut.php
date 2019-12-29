<?php
    if(isset($_POST["logout"])){
      session_start();
      session_destroy();
      echo "ok";
    }
    else {
      header("Location: ./");
    }
?>
