<?php
if(isset($_POST['login'])){
  require("config.php");
  session_start();
  $username = $_POST['username'];
  $password = $_POST['password'];
  $sql = "SELECT * FROM users WHERE username=? OR email=?";
  $query = $db->prepare($sql);
  $query->execute([$username,$username]);
  $count=$query->rowCount();
  if ($count>0) {
      $sql = "SELECT * FROM users WHERE username=? AND password=?";
      $query = $db->prepare($sql);
      $query->execute([$username,$password]);
      $count=$query->rowCount();
      if($count==0){
        $sql = "SELECT * FROM users WHERE email=? AND password=?";
        $query = $db->prepare($sql);
        $query->execute([$username,$password]);
        $count=$query->rowCount();
        if($count>0){
          $_SESSION['login']=True;
          $_SESSION['username']=$username;
          echo "ok";
        }
        else {
          echo "Λάθος κωδικός χρήστη!";
        }
      }
      else {
        $_SESSION['login']=True;
        $_SESSION['username']=$username;
        echo "ok";
      }
  }
  else {
    session_destroy();
    echo "Το όνομα χρήστη που δώσατε δεν υπάρχει!";
  }
}
else{
  echo "No data.";
  header("Location: ./");
}
