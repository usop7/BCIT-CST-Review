<?php
require_once('lib/connect.php');
require_once('config/config.php');
$conn = db_init($config["host"], $config["dbuser"], $config["dbpw"], $config["dbname"]);



function print_term($n) {
  global $conn;

  $sql = "SELECT * FROM course WHERE term = {$n} ORDER BY code";
  $result = mysqli_query($conn, $sql);

  while($row = mysqli_fetch_array($result)) {
    $code = $row['code'];

    // the number of reviews for each course
    $sql_count = "SELECT count(*) FROM list WHERE code = '{$code}' ORDER BY code";
    $result_count = mysqli_query($conn, $sql_count);
    $numofreview = "";
    $row_count = mysqli_fetch_array($result_count);
    if($row_count['count(*)'] > 1) {
      $numofreview = "&nbsp; <small>({$row_count['count(*)']}  reviews)</small>";
    } else if($row_count['count(*)'] == 1) {
      $numofreview = "&nbsp; <small>({$row_count['count(*)']}  review)</small>";
    }

    // print each course
    echo "<p><a href='rate.php?code={$row['code']}'><span class='blue roboto'>{$code}</span>{$numofreview}
    <br>{$row['name']}</a></p>";
  }
}

function print_option($n, $option) {
  global $conn;
  $sql = "SELECT * FROM course WHERE term = {$n} AND other1 LIKE '%$option%'";
  $result = mysqli_query($conn, $sql);
  $count = 0; //to print each option title once
  while($row = mysqli_fetch_array($result)) {
    if($count == 0) {
      echo "<p class='option_title'><b>{$row['other1']}</b></p>";
      $count ++;
    }

    $code = $row['code'];

    // the number of reviews for each course
    $sql_count = "SELECT count(*) FROM list WHERE code = '{$code}'";
    $result_count = mysqli_query($conn, $sql_count);
    $numofreview = "";
    $row_count = mysqli_fetch_array($result_count);
    if($row_count['count(*)'] > 1) {
      $numofreview = "&nbsp; <small>({$row_count['count(*)']}  reviews)</small>";
    } else if($row_count['count(*)'] == 1) {
      $numofreview = "&nbsp; <small>({$row_count['count(*)']}  review)</small>";
    }

    echo "<p><a href='rate.php?code={$row['code']}'><span class='blue roboto'>{$row['code']}</span>{$numofreview}<br>{$row['name']}</a></p>";
  }
  echo "<hr>";
}

?>
