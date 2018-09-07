<?php
if(!isset($_POST['id'])) {
  header("Location: index.php");
  exit;
} else {
  require_once('lib/connect.php');
  require_once('config/config.php');
  $conn = db_init($config["host"], $config["dbuser"], $config["dbpw"], $config["dbname"]);

  $id =  $_POST['id'];
  $job = $_POST['job'];
  $pw = $_POST['password'];

  $sql = "SELECT * FROM list WHERE id = $id";
  $result = mysqli_query($conn, $sql);
  if ($row = mysqli_fetch_array($result)) {
    //check password
    if($pw !== $row['password']){
      echo "wrong password";
    } else {
      switch($job){
        case "deletebtn":
          $sql_del = "DELETE FROM list WHERE id = $id";
          mysqli_query($conn, $sql_del);
          echo "deleted";
          break;
        case "editbtn":
          echo "edit";
          break;
      }
    }

  }


}

?>
