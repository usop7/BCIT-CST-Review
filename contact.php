<?php
  require_once('view/top.php');
 ?>

<div class='content'>

  <div class='white-div'>
    <p class='list_title'>CONTACT ME</p>
    <p class='center'><i>Looking forward to hearing from you!</i></p>
    <form action='contact_process.php' method='post' name='contact' class='center' onsubmit='return check_input()'>
      <p>
        <input type="text" name="name" placeholder="Name" class="input">
      </p>
      <p>
        <input type="email" name="email" placeholder="Email" class="input">
      </p>
      <p>
        <textarea name="msg" rows="9" placeholder="Send me a message and I'll get back to you!"></textarea>
      </p>
      <p>
        <button name="submit" class='btn'>Send</button>
      </p>

    </form>

  </div>

</div>
<script src='js/contact.js'></script>

<?php
  require_once('view/footer.php');
 ?>
