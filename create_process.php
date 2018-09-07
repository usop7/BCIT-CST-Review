<?php
if(!isset($_POST['code'])) {
  header("Location: index.php");
  exit;
} else {
  require_once('lib/connect.php');
  require_once('config/config.php');
  $conn = db_init($config["host"], $config["dbuser"], $config["dbpw"], $config["dbname"]);

  // extracting only strings to prevent injection attack
  $filtered = array(
    'password' => mysqli_real_escape_string($conn, $_POST['password']),
    'instructor' => mysqli_real_escape_string($conn, $_POST['instructor']),
    'description' => mysqli_real_escape_string($conn, $_POST['description'])
  );

  //created date
  date_default_timezone_set("America/Los_Angeles");
  $time = date("Y/m/d/h/i/s");

  $sql = "
      INSERT INTO list
      (password, code, score, description, instructor, created)
      VALUES(
        '{$filtered['password']}',
        '{$_POST['code']}',
        '{$_POST['score']}',
        '{$filtered['description']}',
        '{$filtered['instructor']}',
        '$time'
        )
        ";
  $result = mysqli_query($conn, $sql);
  if($result === false){
    echo "Sorry! there's a problem in the server<br>";
    echo "<a href='rate.php?term={$_POST['code']}'>Go back</a>";
    error_log(mysqli_error($conn));
  } else {
    header("Location: rate.php?code={$_POST['code']}");
  }
}

 ?>
