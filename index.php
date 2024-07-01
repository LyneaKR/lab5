<?php 
  session_start();
  // print_r($_SESSION['user'])

    ?>
<!doctype html>
<html lang="ru" style="scroll-behavior: smooth;">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/vite.svg" />
    <link rel="stylesheet" href="scss/style.css">
    <script href="/vite-project/"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ресторан glade.</title>
  </head>
  <body>

   <div id="header"></div>

    <div id="main"></div>
    <div id="onas"></div>
    <div id="povar"></div>
    <div id="bronir"></div>
    <div id="kontakt"></div>
    <div id="footer"></div>

    <script type="module" src="./module/header/headermain.js"></script>
    <script type="module" src="./main.js"></script>
    <script type="module" src="./module/footer/footer.js"></script>
  </body>
</html>
