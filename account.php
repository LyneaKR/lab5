<?php
session_start();
// print_r($_SESSION['user']);
if (@$_SESSION["user"] ["email"] == ""){
    header("Location: ./index.php");
}


$username = $_SESSION['user']['login'];
$id = $_SESSION['user']['ID'];
$role = $_SESSION['user']['role'];
?>
<!doctype html>
<html lang="ru"  style="scroll-behavior: smooth;">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/vite.svg" />
    <link rel="stylesheet" href="scss/style.css">
    <link rel="stylesheet" href="scss/account.css">
  
    <script href="/vite-project/"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ресторан glade.</title>
  </head>
  <body>

    <div id="header"></div>
    <section id="acc">
      <div class="countainer">
        <div class="account">
          <div class="account__items">
            <div class="account__items__left">
              <div class="account__items__left__profil">
                <div class="profil">
                  <p class="profil__name"><?php echo $username; 
                  ?></p>
                  <p class="profil__id">ID: <span class="profil__idd"><?php 
                  if ($role == 2) {
                    echo '<a class="profil__id" href="./panel.php">Адм Панел</a>';
                  }
                  else {
                    echo $id;
                  }
                  ?></span></p>
                </div>
                <div class="redakt">
                  <div class="button">
                    <a href="./logout.php" class="btn">Выход</a>
                  </div>
                  <div class="button">
                      <a id="qwer" class="btn qwer">Поддержка</a>
                    <div id="myModal" class="modal">
                      <div class="modal__content">
                        <span class="close"></span>
                        <h2 class="modal__title">Обратная связь</h2>
                        <form method="post" action="message.php" class="fomik">
                          <input class="fomik__pole" type="email" placeholder="Почта" id="email" name="email" required>
                          <input class="fomik__poler" type="text" placeholder="Ваше сообщнение" id="" name="message" required>
                          <button class="fomik__btn" type="submit">Отправить</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="account__items__left__broni">
                <h3 class="account__items__left__broni__text">Активные брони</h3>
                <?php 
                    $id = $_SESSION['user']['ID'];
                    $myscl = mysqli_connect('localhost', 'root', '', 'rest');
                    $info = "SELECT * FROM `tableuser` WHERE `id_user` = '$id';";
                    $resulinfo = mysqli_query($myscl, $info);

                    $getus = @$_POST["id_user"];
                    $getustime = @$_POST["time"];
                    $del = "DELETE FROM `tableuser` WHERE `id_user` = '$getus' AND `time` = '$getustime' ";

                    if( isset( $_POST['udal'] ) ) {
                      $end = mysqli_query($myscl, $del);
                      header("Location: ./account.php");
                      exit;
                    };
                    while ($rowifo = mysqli_fetch_assoc($resulinfo)) {
                    echo '<div class="account__items__left__broni__activ">';
                      echo '<div class="info">';
                        echo '<p class="info__people">'.$rowifo["persons"].'чел</p>';
                        echo '<p class="info__date">'.$rowifo['data'].'</p>';
                        echo '<p class="info__time">'.$rowifo['time'].'</p>';
                      echo '</div>';
                      echo '<form id="exit" method="post">';
                        echo "<input type='hidden' name='id_user' value= '" . $id . "' />";
                        echo "<input type='hidden' name='time' value= '" . $rowifo['time'] . "' />";
                        echo '<button style="background-color: rgba(0, 0, 0, 0);cursor: pointer;" type="submit" name="udal" onclick="submitdel()">
                              <img class="infoimg" src="./public/x.svg" alt="X">
                              </button>';
                      echo '</form>';
                    echo '</div>';
                    }
                  ?>
              </div>
            </div>


            <div class="account__items__right">
              <div class="account__items__right__top">
                <div class="account__items__right__top__text">
                  <h3 class="account__items__right__top__text__title"><span class="red">gl</span>ade<span class="row">.</span></h3>
                  <p class="account__items__right__top__text__info">Узнай многое о блюдах азитской кухни, а так же попробуй много нового.</p>
                </div>
                <img class="account__items__right__top__img" src="./public/logo.svg" alt="logo">
              </div>
              <div class="account__items__right__bottom">
                <div class="account__items__right__bottom__text">
                  <h3 class="account__items__right__bottom__text__title"><span class="red">gl</span>ade<span class="row">.</span></h3>
                  <p class="account__items__right__bottom__text__info">Отслеживай активные брони на столики!</p>
                </div>
                <img class="account__items__right__bottom__img" src="./public/Vector.svg" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div id="footer"></div>
    
    <script src="./module/account/account.js"></script>
    <script type="module" src="./module/header/headermain.js"></script>
    <!-- <script type="module" src="./main.js"></script> -->
     <script>
      function submitdel() {
        document.getElementById('exit').submit();
      } 
     </script>
    <script type="module" src="./module/footer/footer.js"></script>
  </body>
</html>
