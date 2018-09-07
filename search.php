<?php

if(count($_GET) == 0 || trim($_GET['q']) == "" ) {
  header("Location: index.php");
  exit;
} else {

  require_once('view/top.php');
  require_once('lib/connect.php');
  require_once('config/config.php');
  $conn = db_init($config["host"], $config["dbuser"], $config["dbpw"], $config["dbname"]);

  $q = mysqli_real_escape_string($conn, $_GET['q']); // prevent sql input by user

  // store query to database//created date
  date_default_timezone_set("America/Los_Angeles");
  $time = date("Y/m/d/h/i/s");

  $sql = "INSERT INTO search (query, created) VALUES('$q','$time')";
  mysqli_query($conn, $sql);


  $sql = "SELECT * FROM course WHERE name LIKE '%$q%' OR code LIKE '%$q%' ORDER BY id";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);

  echo "<div class='content'>
  <p class='list_title'>Search result for \"$q\"</p>";
  if ($num > 0) {
    while($row = mysqli_fetch_array($result)) {
      //prevent cross scripting attack
      $escaped = array(
        'term' => htmlspecialchars($row['term']),
        'code' => htmlspecialchars($row['code']),
        'name' => htmlspecialchars($row['name'])
      );

      echo "<a href=\"rate.php?code={$escaped['code']}\"><div class='posting'>";
      echo "<span class='blue'>(Term {$escaped['term']})&nbsp; {$escaped['code']}</span><br>{$escaped['name']}</div></a>";

    }
  } else {
    echo "<p class='center'>No result found</p>";
  }



}

?>

 <?php
require_once('view/footer.php');
  ?>
