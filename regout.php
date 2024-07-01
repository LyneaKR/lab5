<?php 
    session_start();
    if (@$_SESSION["user"] ["email"] != ""){
      header("Location: ./account.php");
  }
?>
<!doctype html>
<html lang="ru"  style="scroll-behavior: smooth;">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/vite.svg" />
    <link rel="stylesheet" href="scss/style.css">
    <link rel="stylesheet" href="scss/regaut.css">
    <script href="/vite-project/"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Ресторан glade.</title>
  </head>
  <body>

    <div id="header"></div>
    <?php
      if (isset($_SESSION['message'])) {
        echo "<p class='auht__right__text__info'>".$_SESSION['message']."</p>";
        unset($_SESSION['message']);
      }
    ?>
    <div id="reg"></div>
    <div id="auht"></div>

    <div id="footer"></div>

    <script type="module" src="./module/header/headermain.js"></script>
    <script type="module" src="./main.js"></script>

    <script type="module" src="./module/footer/footer.js"></script>
  </body>
</html>
