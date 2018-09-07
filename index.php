<?php
require_once('view/top.php');
require_once('lib/print.php');
require_once('lib/connect.php');
require_once('config/config.php');
$conn = db_init($config["host"], $config["dbuser"], $config["dbpw"], $config["dbname"]);
 ?>

<div class="banner">
  <h1>BCIT CST Review</h1>
  <p>Your reviews and tips will help upcoming <br>students to survive from CST!</p>
</div>

<div class="accordion_list">

  <?php
  for ($i = 1; $i < 5; $i++){
    echo "<button class='accordion'>Term $i</button>";
    echo "<div class='panel'>";
    if($i < 3) {
      print_term($i);
    } else {
      print_option($i, "common");
      print_option($i, "Artificial");
      print_option($i, "Client");
      print_option($i, "Cloud");
      print_option($i, "Combined");
      print_option($i, "Database");
      print_option($i, "Communications");
      print_option($i, "Digital");
      print_option($i, "Information");
      print_option($i, "Technical");
    }
    echo "</div>";
  }
   ?>

</div>
<script src="js/accordion.js"></script>


 <?php
require_once('view/footer.php');
  ?>
