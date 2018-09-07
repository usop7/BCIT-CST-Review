<?php
if(!isset($_POST['id'])) {
  header("Location: index.php");
  exit;
} else {
  require_once('lib/connect.php');
  require_once('config/config.php');
  $conn = db_init($config["host"], $config["dbuser"], $config["dbpw"], $config["dbname"]);

  // extracting only strings to prevent injection attack
  $filtered = array(
    'password' => mysqli_real_escape_string($conn, $_POST['password']),
    'description' => mysqli_real_escape_string($conn, $_POST['description'])
  );

  $sql = "
      UPDATE list SET
        password = '{$filtered['password']}',
        score = '{$_POST['score']}',
        description = '{$filtered['description']}'
      WHERE id = {$_POST['id']}
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
