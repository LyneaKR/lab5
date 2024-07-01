<?php 
    session_start();
    ?>
<!doctype html>
<html lang="ru"  style="scroll-behavior: smooth;">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/vite.svg" />
    <link rel="stylesheet" href="scss/style.css">
    <link rel="stylesheet" href="scss/menu.css">
 
    <script href="/vite-project/"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ресторан glade.</title>
  </head>
  <body>
    <?php 
      $myscl = mysqli_connect('localhost', 'root', '', 'rest');
      $kategor = "SELECT * FROM `typedish`";
      $resulkategor = mysqli_query($myscl, $kategor);

      $top = mysqli_query($myscl,"SELECT `dish`.`title_dish`,
      COUNT(`infoorder`.`id_Dish`) 
        FROM `dish`
        JOIN `infoorder` ON `Dish`.`id_Dish` = `infoorder`.`id_Dish`
        JOIN `order` ON `infoorder`.`id_order` = `order`.`id_order`
        WHERE `order`.`data` >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
        GROUP BY `dish`.`title_dish`
        LIMIT 1;
        ");

        $topertud = mysqli_fetch_assoc($top) ;
        @$dishih = mysqli_query($myscl,"SELECT * FROM `Dish` WHERE `title_dish` = '".$topertud['title_dish']."'");
        $rowdishih = mysqli_fetch_assoc($dishih) ;
    ?>
    <div id="header"></div>
  <section>
      <div class="countainer">
        <div class="best">
          <h2 class="best__title">Блюдо недели</h2>
          <div class="best__group">
            <div class="best__group__left">
              <h3 class="best__group__left__title"><?php
              if (isset($rowdishih) && $rowdishih !== false) {
                echo $rowdishih['title_dish'];
              }
              else {
                echo 'Блюда ещё нет';
              } ?></h3>
              <p class="best__group__left__text"><?php 
              if (isset($rowdishih) && $rowdishih !== false) {
                echo $rowdishih['description'];
              }
              else {
                echo 'Описания ещё нет';
              } ?></p>
            </div>
            <p class="best__group__sent"><?php 
               if (isset($rowdishih) && $rowdishih !== false) {
                echo $rowdishih['sent_dish'];
              }
              else {
                echo 'Скоро';
              } 
           ?></p>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="countainer">
        <div class="bluda">
        <?php
        while ($rowkat = mysqli_fetch_assoc($resulkategor)) {
          $dish = "SELECT * FROM `Dish` JOIN typedish ON Dish.id_typedish = typedish.id_typedish  WHERE typedish='".$rowkat["typedish"]."'";
          $resuldish = mysqli_query($myscl, $dish);
          echo '<div class="bluda__group">';
            echo '<h3 class="bluda__group__title">'.$rowkat["typedish"].'</h3>';
            echo '<div class="bluda__group__bluda">';
              while ($rowlud = mysqli_fetch_assoc($resuldish)) {
             
              echo '<div class="bludo">';
                echo '<div class="bludo__osn">';
                  echo '<img class="bludo__osn__img" src="./public/'.$rowlud['foto'].'">';
                  echo '<div class="bludo__osn__text">';
                    echo '<h4 class="bludo__osn__text__title">'.$rowlud["title_dish"].'</h4>';
                    echo '<p class="bludo__osn__text__info">'.$rowlud['description'].'</p>';
                  echo '</div>';
                echo '</div>';
                echo '<p class="bludo__sent">'.$rowlud['sent_dish'].'</p>';
              echo '</div>';


              }
            echo '</div>';
          echo '</div>';
        }

        ?>
        </div>
      </div>
    </section>
    <div id="footer"></div>

    <script type="module" src="./module/header/headermenu.js"></script>
    <script type="module" src="./main.js"></script>
    <script type="module" src="./module/footer/footer.js"></script>
  </body>
</html>
