<?php 
    session_start();
    
    if (@$_SESSION["user"] ["email"] == ""){
      header("Location: ./regout.php");
  }

?>
<!doctype html>
<html lang="ru"  style="scroll-behavior: smooth;">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/vite.svg" />
    <link rel="stylesheet" href="scss/style.css">
    <link rel="stylesheet" href="scss/bronir.css">
    <script href="/vite-project/"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ресторан glade.</title>
  </head>
  <body>
 
    <div id="header"></div>
    <section>
      <div class="countainer">
        <div class="bronir">
          <h2 class="bronir__title">Бронирование столиков</h2> 
          <?php
            if (isset($_SESSION['message'])) {
              echo "<p class='bronir__title'>".$_SESSION['message']."</p>";
              unset($_SESSION['message']);
            }
            $cout = 1;
            $sql = mysqli_connect('localhost', 'root', '', 'rest');
            $resulstol = mysqli_query($sql, "SELECT * FROM `table` WHERE `num_table` = '$cout'");

          ?>
            <div class="bronir__group">
              <div class="bronir__group__items">
                  <div class="rad">
                    <?php 
                      while ($rowstol = mysqli_fetch_assoc($resulstol)) {
                        if ( $rowstol['status'] == "з") {
                          echo '<form action="./table.php" id="reservation'.$rowstol['num_table'].'-form" method="post">';
                          echo '<a style="filter: brightness(0) saturate(100%) invert(42%) sepia(50%) saturate(5439%) hue-rotate(340deg) brightness(97%) contrast(98%);" ><input type="hidden" value="'.$rowstol['num_table'].'" name="'.$rowstol['num_table'].'stol"><img class="rad__img" src="./public/'.$rowstol['num_table'].'stol.svg" alt="stol"></input></a>';
                          echo '</form>';
                        $cout++;
                        $resulstol = mysqli_query($sql, "SELECT * FROM `table` WHERE `num_table` = '$cout'");
                        }

                        elseif ($rowstol['status'] == "с") {
                          echo '<form action="./table.php" id="reservation'.$rowstol['num_table'].'-form" method="post">';
                          echo '<a onclick="submitForm'.$rowstol['num_table'].'()"><input type="hidden" value="'.$rowstol['num_table'].'" name="'.$rowstol['num_table'].'stol"><img class="rad__img" src="./public/'.$rowstol['num_table'].'stol.svg" alt="stol"></input></a>';
                          echo '</form>';
                          $cout++;
                          $resulstol = mysqli_query($sql, "SELECT * FROM `table` WHERE `num_table` = '$cout'");
                        }
                        
                        if ($cout >3) {
                          break;
                        }
                      }
                    ?>

                  </div>
                  <div class="rad">
                  <?php 
                      while ($rowstol = mysqli_fetch_assoc($resulstol)) {
                        if ( $rowstol['status'] == "з") {
                          echo '<form action="./table.php" id="reservation'.$rowstol['num_table'].'-form" method="post">';
                          echo '<a style="filter: brightness(0) saturate(100%) invert(42%) sepia(50%) saturate(5439%) hue-rotate(340deg) brightness(97%) contrast(98%);" ><input type="hidden" value="'.$rowstol['num_table'].'" name="'.$rowstol['num_table'].'stol"><img class="rad__img" src="./public/'.$rowstol['num_table'].'stol.svg" alt="stol"></input></a>';
                          echo '</form>';
                        $cout++;
                        $resulstol = mysqli_query($sql, "SELECT * FROM `table` WHERE `num_table` = '$cout'");
                        }

                        elseif ($rowstol['status'] == "с") {
                          echo '<form action="./table.php" id="reservation'.$rowstol['num_table'].'-form" method="post">';
                          echo '<a onclick="submitForm'.$rowstol['num_table'].'()"><input type="hidden" value="'.$rowstol['num_table'].'" name="'.$rowstol['num_table'].'stol"><img class="rad__img" src="./public/'.$rowstol['num_table'].'stol.svg" alt="stol"></input></a>';
                          echo '</form>';
                          $cout++;
                          $resulstol = mysqli_query($sql, "SELECT * FROM `table` WHERE `num_table` = '$cout'");
                        }
                        
                        if ($cout >3) {
                          break;
                        }
                      }
                    ?>
                  </div>
                  <div class="rad">
                  <?php 
                      while ($rowstol = mysqli_fetch_assoc($resulstol)) {
                        if ( $rowstol['status'] == "з") {
                          echo '<form action="./table.php" id="reservation'.$rowstol['num_table'].'-form" method="post">';
                          echo '<a style="filter: brightness(0) saturate(100%) invert(42%) sepia(50%) saturate(5439%) hue-rotate(340deg) brightness(97%) contrast(98%);" ><input type="hidden" value="'.$rowstol['num_table'].'" name="'.$rowstol['num_table'].'stol"><img class="rad__img" src="./public/'.$rowstol['num_table'].'stol.svg" alt="stol"></input></a>';
                          echo '</form>';
                        $cout++;
                        $resulstol = mysqli_query($sql, "SELECT * FROM `table` WHERE `num_table` = '$cout'");
                        }

                        elseif ($rowstol['status'] == "с") {
                          echo '<form action="./table.php" id="reservation'.$rowstol['num_table'].'-form" method="post">';
                          echo '<a onclick="submitForm'.$rowstol['num_table'].'()"><input type="hidden" value="'.$rowstol['num_table'].'" name="'.$rowstol['num_table'].'stol"><img class="rad__img" src="./public/'.$rowstol['num_table'].'stol.svg" alt="stol"></input></a>';
                          echo '</form>';
                          $cout++;
                          $resulstol = mysqli_query($sql, "SELECT * FROM `table` WHERE `num_table` = '$cout'");
                        }
                        
                        if ($cout >7) {
                          break;
                        }
                      }
                    ?>
                  </div>
                </div>
                <div class="bronir__group__items">
                  <div class="rad">
                  <?php 
                      while ($rowstol = mysqli_fetch_assoc($resulstol)) {
                        if ( $rowstol['status'] == "з") {
                          echo '<form action="./table.php" id="reservation'.$rowstol['num_table'].'-form" method="post">';
                          echo '<a style="filter: brightness(0) saturate(100%) invert(42%) sepia(50%) saturate(5439%) hue-rotate(340deg) brightness(97%) contrast(98%);" ><input type="hidden" value="'.$rowstol['num_table'].'" name="'.$rowstol['num_table'].'stol"><img class="rad__img" src="./public/'.$rowstol['num_table'].'stol.svg" alt="stol"></input></a>';
                          echo '</form>';
                        $cout++;
                        $resulstol = mysqli_query($sql, "SELECT * FROM `table` WHERE `num_table` = '$cout'");
                        }

                        elseif ($rowstol['status'] == "с") {
                          echo '<form action="./table.php" id="reservation'.$rowstol['num_table'].'-form" method="post">';
                          echo '<a onclick="submitForm'.$rowstol['num_table'].'()"><input type="hidden" value="'.$rowstol['num_table'].'" name="'.$rowstol['num_table'].'stol"><img class="rad__img" src="./public/'.$rowstol['num_table'].'stol.svg" alt="stol"></input></a>';
                          echo '</form>';
                          $cout++;
                          $resulstol = mysqli_query($sql, "SELECT * FROM `table` WHERE `num_table` = '$cout'");
                        }
                        
                        if ($cout >9) {
                          break;
                        }
                      }
                    ?>
                  </div>
                  <div class="rad">
                  <?php 
                      while ($rowstol = mysqli_fetch_assoc($resulstol)) {
                        if ( $rowstol['status'] == "з") {
                          echo '<form action="./table.php" id="reservation'.$rowstol['num_table'].'-form" method="post">';
                          echo '<a style="filter: brightness(0) saturate(100%) invert(42%) sepia(50%) saturate(5439%) hue-rotate(340deg) brightness(97%) contrast(98%);" ><input type="hidden" value="'.$rowstol['num_table'].'" name="'.$rowstol['num_table'].'stol"><img class="rad__img" src="./public/'.$rowstol['num_table'].'stol.svg" alt="stol"></input></a>';
                          echo '</form>';
                        $cout++;
                        $resulstol = mysqli_query($sql, "SELECT * FROM `table` WHERE `num_table` = '$cout'");
                        }

                        elseif ($rowstol['status'] == "с") {
                          echo '<form action="./table.php" id="reservation'.$rowstol['num_table'].'-form" method="post">';
                          echo '<a onclick="submitForm'.$rowstol['num_table'].'()"><input type="hidden" value="'.$rowstol['num_table'].'" name="'.$rowstol['num_table'].'stol"><img class="rad__img" src="./public/'.$rowstol['num_table'].'stol.svg" alt="stol"></input></a>';
                          echo '</form>';
                          $cout++;
                          $resulstol = mysqli_query($sql, "SELECT * FROM `table` WHERE `num_table` = '$cout'");
                        }
                        
                        if ($cout >12) {
                          break;
                        }
                      }
                    ?>
                    </div>
                  <div class="rad">
                  <?php 
                      while ($rowstol = mysqli_fetch_assoc($resulstol)) {
                        if ( $rowstol['status'] == "з") {
                          echo '<form action="./table.php" id="reservation'.$rowstol['num_table'].'-form" method="post">';
                          echo '<a style="filter: brightness(0) saturate(100%) invert(42%) sepia(50%) saturate(5439%) hue-rotate(340deg) brightness(97%) contrast(98%);" ><input type="hidden" value="'.$rowstol['num_table'].'" name="'.$rowstol['num_table'].'stol"><img class="rad__img" src="./public/'.$rowstol['num_table'].'stol.svg" alt="stol"></input></a>';
                          echo '</form>';
                        $cout++;
                        $resulstol = mysqli_query($sql, "SELECT * FROM `table` WHERE `num_table` = '$cout'");
                        }

                        elseif ($rowstol['status'] == "с") {
                          echo '<form action="./table.php" id="reservation'.$rowstol['num_table'].'-form" method="post">';
                          echo '<a onclick="submitForm'.$rowstol['num_table'].'()"><input type="hidden" value="'.$rowstol['num_table'].'" name="'.$rowstol['num_table'].'stol"><img class="rad__img" src="./public/'.$rowstol['num_table'].'stol.svg" alt="stol"></input></a>';
                          echo '</form>';
                          $cout++;
                          $resulstol = mysqli_query($sql, "SELECT * FROM `table` WHERE `num_table` = '$cout'");
                        }
                        
                        if ($cout >14) {
                          break;
                        }
                      }
                    ?>
                  </div>
              </div>
            </div>
        </div>
      </div>
    </section>
    <div id="footer"></div>
    <script src="./talel.js"></script>
    <script type="module" src="./module/header/headerbronir.js"></script>
    <script type="module" src="./main.js"></script>
    <script type="module" src="./module/footer/footer.js"></script>

  </body>
</html>
