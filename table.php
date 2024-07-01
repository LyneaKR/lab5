<?php 
session_start();

    $stol1 = @$_POST['1stol'];
    $stol2 = @$_POST['2stol'];
    $stol3 = @$_POST['3stol'];
    $stol4 = @$_POST['4stol'];
    $stol5 = @$_POST['5stol'];
    $stol6 = @$_POST['6stol'];
    $stol7 = @$_POST['7stol'];
    $stol8 = @$_POST['8stol'];
    $stol9 = @$_POST['9stol'];
    $stol10 = @$_POST['10stol'];
    $stol11 = @$_POST['11stol'];
    $stol12 = @$_POST['12stol'];
    $stol13 = @$_POST['13stol'];
    $stol14 = @$_POST['14stol'];

    if ($stol1 == 1) {
        $tal = 1;
    }
    elseif ($stol2 == 2) {
        $tal = 2;
    }
    elseif ($stol3 == 3) {
        $tal = 3;
    }
    elseif ($stol4 == 4) {
        $tal = 4;
    }
    elseif ($stol5 == 5) {
        $tal = 5;
    }
    elseif ($stol6 == 6 ) {
        $tal = 6;
    }
    elseif ($stol7 == 7) {
        $tal = 7;
    }
    elseif ($stol8 == 8) {
        $tal = 8;
    }
    elseif ($stol9 == 9) {
        $tal = 9;
    }
    elseif ($stol10 == 10) {
        $tal = 10;
    }
    elseif ($stol11 == 11) {
        $tal = 11;
    }
    elseif ($stol12 == 12) {
        $tal = 12;
    }
    elseif ($stol13 == 13) {
        $tal = 13;
    }
    elseif ($stol14 == 14) {
        $tal = 14;
    }
   
    $data = date ("Y-m-d"); 
    $timer = date('H:i');
    
  
    $time = @$_POST['time'];
    $stol = @$_POST['stol'];
    $emailSes = @$_SESSION['user']['email'];
    $id = @$_SESSION['user']['ID'];


    $sql=  mysqli_connect('localhost', 'root', '', 'rest');
    $provlog = mysqli_query($sql, "SELECT * FROM `user` WHERE email = '$emailSes' ");
    
    
    if ($time == "") {


    }

    elseif ($stol == "") {


    }

    elseif (mysqli_num_rows($provlog) >= 1) {
        $idtable = mysqli_query($sql, "SELECT `id_table` FROM `table` WHERE `num_table` = '$stol'");
        if (mysqli_num_rows($idtable)>0){
            $row = mysqli_fetch_assoc($idtable);
            $idtle = $row['id_table'];
            $sqlinsert =  mysqli_query($sql,"INSERT INTO `tableuser` (`id_user`, `id_table`, `data`, `time`) VALUES ('$id', '$idtle', '$data', '$time')");
            $_SESSION['message']= "Вы успешно забронировали стол №$stol";
            header("Location: ./bronir.php");
        }
        echo 'Гей';
     

    }
    
  

?>


<!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./scss/regaut.css">
        <title>Document</title>
    </head>
    <body style="background-color:#3A3F45; color: #ffffff">
    <section>
      <div class="countainer">
        <div class="auht">
          <div class="auht__left">
            <div class="autorization">
              <h3 class="autorization__title">Забронировать столик в <span class="red">gl</span>ade<span class="row">.</span></h3>
              
              <form class="autorization__form" action="table.php" method="post">
                <input  disabled class="autorization__form__pole" placeholder="<?php echo "Дата брони ". date ("d.m.Y"); ?>" required name="datet" type="text">
                <input min="10:00" max="17:00" class="autorization__form__pole" required name="time"  type="time">
                <input  onkeydown="return false;" value="<?php if (@$tal == "") {echo $stol;} else {echo $tal;} ?>"  class="autorization__form__pole" required  name="stol" type="hidden">
                <button id="rer" class="autorization__form__btn" type="submit">Забронировать</button>
              </form>
            </div>
          </div>
          <div class="auht__right">
            <div class="auht__right__text">
              <h3 class="auht__right__text__title"><span class="red">gl</span>ade<span class="row">.</span></h3>
              <p class="auht__right__text__info">Познакомьтесь с рестораном паназиатской кухни.</p>
            </div>
            <img class="auht__right__img" src="./public/logo.svg" alt="logo">
      </div>
    </section>
    </body>
    </html>