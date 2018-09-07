<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-120002891-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-120002891-1');
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCIT CST Review</title>
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href="style/style.css?v=2.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </head>
  <body>
    <header>
      <div class="textmenu">
        <span><a href="index.php">HOME</a></span>
        <span><a href="about.php">ABOUT</a></span>
        <span><a href="contact.php">CONTACT</a></span>
      </div>
      <a href="index.php"><img src="img/logo.png" alt="logo" id="logo"></a><br>
      <nav>
        <form action="search.php?q=<?=$_GET['q']?>" method="get">
          <input id="searchbox" type="text" name="q" placeholder="Find a course" >
          <input id="searchbtn" type="submit" value="">
        </form>

      </nav>
      <button id="menubtn">&#9776;</button>
      <div id="menucontent" class="menucontent">
        <a href="index.php"><p>HOME</p></a>
        <a href="about.php"><p>ABOUT</p></a>
        <a href="contact.php"><p>CONTACT</p></a>
      </div>
     </header>


     <article id="article">
