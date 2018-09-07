<?php
if(!isset($_GET['code'])) {
  header("Location: index.php");
  exit;
} else {
  require_once('view/top.php');
  require_once('lib/connect.php');
  require_once('config/config.php');
  $conn = db_init($config["host"], $config["dbuser"], $config["dbpw"], $config["dbname"]);

  $filtered_code = strtoupper(mysqli_real_escape_string($conn, $_GET['code'])); // prevent sql input by user
}
 ?>

<div class="content">

<p class='list_title' id='result_title'></p>
<div id = "form_div">
  <?php
  $sql = "SELECT name FROM course WHERE code = '{$filtered_code}'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);
  // Course code, title
  echo "<p class='list_title'><span class='blue'>{$filtered_code}</span><br>{$row['name']}</p>";
  // Level of difficulty
  $sql_avg = "SELECT AVG(score) FROM list WHERE code = '{$filtered_code}'";
  $result = mysqli_query($conn, $sql_avg);
  $row = mysqli_fetch_array($result);
  //print the average, round to one decimal place (only when there's a data)
  $avg = $row['AVG(score)'] > 0 ? number_format($row['AVG(score)'], 1) : 'N/A';

  echo "<table class='level-table'><tr><td><h3>Level of<br>Difficulty</h3></td>
  <td class='level-result'>{$avg}</td></tr></table><br>";
   ?>

  <div class='share-div'>
    <h3 class='center black'>Share your experience!</h3>
    <form action="create_process.php" method="post" name="rate_form" class="rate_form" onsubmit="return check_input()">
      <input type="hidden" name="code" value="<?=$filtered_code?>">
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
        <p>LEVEL OF DIFFICULTY</p>
      </div>
      <div class='post-detail'>
        <p>
          <input type="test" name="instructor" placeholder="Instructor" class='input'>
        </p>
        <p>
          <textarea name="description" rows="6" placeholder="Share details of your own experience and tips of this course" maxlength="2000"></textarea>
        </p>
        <p class='right'>
          <input type="password" name="password" placeholder="Password" class="password">
          <button class="btn">Submit</button>
        </p>
        <p class='left blue'>
          &nbsp;<small> * Used to edit the post later</small>
        </p>
      </div>
    </form>
  </div> <!-- end of the posting div -->

</div> <!-- end of the form div -->
 <br>

<?php

//check if there's a matching result
$sql = "SELECT code FROM course WHERE code = '{$filtered_code}'";
$count = 0;
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($result)){
  $count++;
}
echo "<script>var count ={$count};</script>";

//print the form and rating list
if($count > 0) {
  $sql = "SELECT * FROM list WHERE code = '{$filtered_code}' ORDER BY id DESC";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);

  if($num ==0) {
    echo "<h3 class='black'>All reviews</h3><br>";
    echo "<p class='center'>No review yet. Be the first one!</p>";
  } else {
    echo "<h3 class='black'>All reviews</h3>";

    while($row = mysqli_fetch_array($result)){
      //level variable
      $level = "";
      switch($row['score']){
        case 1:
          $level = 'Show up & pass';
          $color = 'level-green';
          break;
        case 2:
          $level = 'Easy';
          $color = 'level-green';
          break;
        case 3:
          $level = 'Moderate';
          $color = 'level-orange';
          break;
        case 4:
          $level = 'Tough, a lot of work';
          $color = 'level-orange';
          break;
        case 5:
          $level = 'Hardest, better be prepared';
          $color = 'level-red';
          break;
      }
      // print each posting
      $date = substr($row['created'], 0, 10);
      $escaped_desc = htmlspecialchars($row['description']);
      $escaped_ins = htmlspecialchars($row['instructor']);
      $star = "star{$row['score']}.png";
      echo "<div class='posting'>
      <input type='hidden' name='id' value={$row['id']}>
      <button class='morebtn'></button>
      <span class='date'>$date</span><br>";
      echo "<p><img src='img/{$star}' class='img_star'>
      <br><span class={$color}>{$level}</span>
      <br>Instructor: {$escaped_ins}</p>";
      echo "<pre>{$escaped_desc}</pre></div>";
    };
  }

}

?>

<!-- modal for edit/delete -->
<div id="modal" class="modal">

  <div class='modal-content'>
    <span id='close'>&times;</span>
    <p>Enter the password</p>
    <form id="editform" action="edit.php" method="post" onkeypress="return event.keyCode != 13;">
      <input type="hidden" name="listid" id="listid">
      <p><input type='password' id="password" class='input'></p>
      <p><button id="editbtn" class='smallbtn'>edit</button>
      <button id="deletebtn" class='smallbtn'>delete</button>
      </p>
    </form>
    <p id="check_result">&nbsp;</p>
  </div>
</div>

<script src="js/script.js?v=1"></script>
<script src="js/modal.js"></script>
<script>
  //only shows content when there's a matching code
  if (count != 0) {
    $("#form_div").css("display", "block");
  } else {
    $("#result_title").css("display", "block");
    $("#result_title").html("No course found");
  }

</script>

</div> <!-- end of content -->

 <?php
require_once('view/footer.php');
  ?>
