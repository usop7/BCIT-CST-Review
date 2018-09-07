<?php
if(!isset($_POST['listid'])) {
  header("Location: index.php");
  exit;
} else {
  require_once('view/top.php');
  require_once('lib/connect.php');
  require_once('config/config.php');
  $conn = db_init($config["host"], $config["dbuser"], $config["dbpw"], $config["dbname"]);

  $id = $_POST['listid'];

  $sql = "SELECT list.id, list.password, list.code, list.score, list.description, course.name FROM list LEFT JOIN course ON list.code = course.code WHERE list.id = $id";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);
  $escaped_desc = htmlspecialchars($row['description']);
}

?>


<div class="content">
  <p class='list_title'><span class='blue'><?=$row['code']?></span><br><?=$row['name']?></p>

  <form action="edit_process.php" method="post" name="rate_form" class="rate_form" onsubmit="return check_input()">
    <input type="hidden" name="code" value="<?=$row['code']?>">
    <input type="hidden" name="id" value="<?=$row['id']?>">
    <!-- level rating -->
    <input type="hidden" name="score" id="score">
    <div class='rating-level center'>
      <p id='level-text'>&nbsp;</p>
      <div id='div-score'>0</div>
      <div class='level' id='level1' data-value='1'></div>
      <div class='level' id='level2' data-value='2'></div>
      <div class='level' id='level3' data-value='3'></div>
      <div class='level' id='level4' data-value='4'></div>
      <div class='level' id='level5' data-value='5'></div>
    </div>

    <p><input type="password" name="password" placeholder="password" class='input'></p>
    <p><textarea name="description" rows="10" placeholder="Share details of your own experience and tips of this course" maxlength="2000"><?=$escaped_desc?></textarea></p>
    <p><button class="btn">Submit</button></p>
  </form>

</div>

  <script src="js/script.js"></script>
  <script>
    onStar = <?=$row['score']?>;
    level();
  </script>

<?php
require_once('view/footer.php');
 ?>
