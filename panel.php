<?php
session_start();
ob_start();
if ($_SESSION ["user"] ["role"] != 2) {
    header("Location: ./index.php");
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./scss/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ</title>
</head>
<body>
    <style>
   
        td {
            border-bottom: 2px solid #ffffff;
            border-right: 2px solid #ffffff;
            padding: 10px;  
            max-width: 300px;
            flex-wrap: wrap;
            word-break:break-all;
        }

        h1 {
            font-weight:400; 
            color:#ffffff ;
            font-size: 45px;
            text-align: center;
            margin: 40px;  
        }

        table {
            background-color: #ffffff; 
            border-top: 2px solid #ffffff; 
            border-right: 2px solid #ffffff;
            margin: 0 auto;
            border-radius: 10px;
            text-align: center;
        }
        
        input {
            background-color: #F44336; 
            color:white;
            padding: 10px;
            cursor: pointer;
            border-radius: 10px;
     
        }

        .iputfor {
            margin-top: 20px;
            text-align: center;
      

        }

        .pole {
            padding: 10px ;
			padding-left: 10px;
			font-weight: 400;
			font-size: 15px;
			color: #efefef;
			background-color: #8b919a;
			border-radius: 10px;
            margin-right: 5px;
        }
    </style>

    <div id="header"></div>
  
    <?php
    $myscl = mysqli_connect('localhost', 'root', '', 'rest');
    ?>

    <div  id="user">
    <?php 
 
        @$username = $_POST['username'];
        @$emailuser = $_POST['emailuser'];
        @$passworduser = $_POST['passworduser'];
        @$roluser = $_POST['roluser'];
        @$iduser = $_POST['id'];
        $users = "SELECT * FROM `user`";
        $resultuser = mysqli_query($myscl, $users);

        $getususer = @$_POST["id_user"];


    ?>

    <h1 > Админ панель Люди</h1>
    <table >
        <tr>
            <td >ID</td>
            <td >Имя пользователя</td>
            <td >Почта</td>
            <td >Пароль</td>
            <td >Роль</td>
            <td >Удаление</td>
            <td >Редактирование</td>
        </tr>

            <?php 
            if( isset( $_POST['udaluser'] ) ) {
                $deluser = "DELETE FROM `user` WHERE id_user = ";
                $end = mysqli_query($myscl, $deluser . $getususer);
                @header("Location: ./panel.php");
            };
            
            if( isset( $_POST['dopavkauser'] ) ) {
                $dopuser = " INSERT INTO `user` (`username`, `email`, `password`, `role`) VALUES ('$username', '$emailuser', '$passworduser', '$roluser');";
                $end = mysqli_query($myscl, $dopuser);
                @header("Location: ./panel.php");
                

            };

            if( isset( $_POST['redaktusered'] ) ) {
                $checkuser = "SELECT * FROM `user` WHERE `id_user` = '$iduser'";
                $variauser = mysqli_fetch_assoc(mysqli_query($myscl, $checkuser));
                if (@$username == '') {

                    @$username = $variauser['username'];
                }
                if (@$emailuser == '') {

                    @$emailuser = $variauser['email'];
                }
                if (@$passworduser == '') {

                    @$passworduser = $variauser['password'];
                }
                if (@$roluser == '') {

                    @$roluser = $variauser['role'];
                }
                $redaktuser = "UPDATE `user` SET `username` = '$username', `email` = '$emailuser', `password` = '$passworduser', `role` = '$roluser' WHERE `user`.`id_user` = '$iduser';";
             
                $end = mysqli_query($myscl, $redaktuser);

                header("Location: ./panel.php");
            };

                while ($rowuser = mysqli_fetch_assoc($resultuser)) {
                    echo "<tr>";
                        echo "<td>";
                    echo $rowuser["id_user"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowuser["username"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowuser["email"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowuser["password"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowuser["role"];
                        echo "</td>";
                        echo "<td>";
                    echo 
                    "<form method='POST'>
                        <input type='hidden' name='id_user' value= '" . $rowuser["id_user"] . "' />
                        <input type='submit' name='udaluser' value='Удалить'>
                    </form>";
                        echo "</td>";
                    echo "<td>";
                    echo 
                    "<form method='POST'>
                        <input type='hidden' name='id_user' value= '" . $rowuser["id_user"] . "' />
                        <input type='submit' name='redaktuser' value='Редактировать'>
                    </form>";
                    echo "</tr>";

                }

            ?>

    </table>
    <?php 
   if (isset($_POST['dopavuser'])) { 
    echo " 
        <div class='dopavkafor'> 
            <form class=iputfor method='post' action=''> 
                <input class='pole' type='text' name='username' placeholder='ФИО'> 
                <input class='pole' type='email' name='emailuser' placeholder='Email'> 
                <input class='pole' type='password' name='passworduser' placeholder='Пароль'> 
                <input class='pole' type='text' name='roluser' placeholder='Роль'> 
                <input type='submit' name='dopavkauser' value='Сохранить'> 
                <input type='submit' name='hide' value='Скрыть'> 
            </form> 
        </div> 
    "; 
} else { 
     
    echo " 
    <form class='iputfor' method='post'> 
        <input class='dopavka' type='submit' name='dopavuser' value='Добавить'> 
    </form> 
    "; 
}

if (isset($_POST['redaktuser'])) { 
    echo " 
        <div class='redaktuser'> 
            <form class=iputfor method='post' action=''> 
                <input class='pole' type='text' name='username' placeholder='ФИО'> 
                <input class='pole' type='email' name='emailuser' placeholder='Email'> 
                <input class='pole' type='password' name='passworduser' placeholder='Пароль'> 
                <input class='pole' type='text' name='roluser' placeholder='Роль'> 
                <input class='pole' type='hidden' value='$getususer' name='id' placeholder='Роль'> 
                <input type='submit' name='redaktusered' value='Сохранить'> 
                <input type='submit' name='hide' value='Скрыть'> 
            </form> 
        </div> 
    "; 
}
        ?>
    </div>

    <div  id="waiter">
    <?php 
 
        @$fio_waiter = $_POST['fio_waiter'];
        @$gender = $_POST['gender'];
        @$age = $_POST['age'];
        @$idwaiter = $_POST['idwaiter'];
        $waiter = "SELECT * FROM `waiter`";
        $resultwaiter = mysqli_query($myscl, $waiter);

        $getuswaiter = @$_POST["id_waiter"];


    ?>

    <h1 > Админ панель официанты</h1>
    <table>
        <tr>
            <td >ID</td>
            <td >ФИО</td>
            <td >Пол</td>
            <td >Возраст</td>
            <td >Удаление</td>
            <td >Редактирование</td>
        </tr>

            <?php 
            if( isset( $_POST['udalwaiter'] ) ) {
                $delwaiter = "DELETE FROM `waiter` WHERE id_waiter = '$getuswaiter' ";
                $end = mysqli_query($myscl, $delwaiter );
                @header("Location: ./panel.php");
            };
            
            if( isset( $_POST['dopavkawaiter'] ) ) {
                $dopwaiter = " INSERT INTO `waiter` (`fio_waiter`, `gender`, `age`) VALUES ('$fio_waiter', '$gender', '$age');";
                $end = mysqli_query($myscl, $dopwaiter);
                @header("Location: ./panel.php");
            };

            if( isset( $_POST['redaktwaitered'] ) ) {
                $checkwaiter = "SELECT * FROM `waiter` WHERE `id_waiter` = '$idwaiter'";
                $variawaiter = mysqli_fetch_assoc(mysqli_query($myscl, $checkwaiter));
                if (@$fio_waiter == '') {

                    @$fio_waiter = $variawaiter['fio_waiter'];
                }
                if (@$gender == '') {

                    @$gender = $variawaiter['gender'];
                }
                if (@$age == '') {

                    @$age = $variawaiter['age'];
                }

                $redaktwaiter = "UPDATE `waiter` SET `fio_waiter` = '$fio_waiter', `gender` = '$gender', `age` = '$age' WHERE `waiter`.`id_waiter` = '$idwaiter';";
                $end = mysqli_query($myscl, $redaktwaiter);
              
                header("Location: ./panel.php");
            };

                while ($rowwaiter = mysqli_fetch_assoc($resultwaiter)) {
             
                    echo "<tr>";
                        echo "<td>";
                    echo $rowwaiter["id_waiter"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowwaiter["fio_waiter"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowwaiter["gender"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowwaiter["age"];
          
                        echo "</td>";
                        echo "<td>";
                    echo 
                    "<form method='POST'>
                        <input type='hidden' name='id_waiter' value= '" . @$rowwaiter["id_waiter"] . "' />
                        <input type='submit' name='udalwaiter' value='Удалить'>
                    </form>";
                        echo "</td>";
                    echo "<td>";
                    echo 
                    "<form method='POST'>
                        <input type='hidden' name='id_waiter' value= '" . $rowwaiter["id_waiter"] . "' />
                        <input type='submit' name='redaktwaiter' value='Редактировать'>
                    </form>";
                    echo "</tr>";
            
                }

            ?>

    </table>
    <?php 
   if (isset($_POST['dopavkawait'])) { 
    echo " 
        <div class='dopavkafor' '> 
            <form  class=iputfor method='post' action=''> 
                <input class='pole' type='text' name='fio_waiter' placeholder='ФИО'> 
                <input class='pole' type='text' name='gender' placeholder='Пол'> 
                <input class='pole' type='text' name='age' placeholder='Возраст'> 
                <input type='submit' name='dopavkawaiter' value='Сохранить'> 
                <input type='submit' name='hide' value='Скрыть'> 
            </form> 
        </div> 
    "; 
} else { 
     
    echo " 
    <form class='iputfor' method='post'> 
       <input class='dopavka' type='submit' name='dopavkawait' value='Добавить'>
    </form> 
    "; 
}

if (isset($_POST['redaktwaiter'])) { 
    echo " 
        <div class='redaktuser'> 
            <form class=iputfor method='post' action=''> 
                <input class='pole' type='text' name='fio_waiter' placeholder='ФИО'> 
                <input class='pole' type='text' name='gender' placeholder='Пол'> 
                <input class='pole' type='text' name='age' placeholder='Возраст'> 
                <input class='pole' type='hidden' value='$getuswaiter' name='idwaiter' placeholder='Роль'> 
                <input type='submit' name='redaktwaitered' value='Сохранить'> 
                <input type='submit' name='hide' value='Скрыть'> 
            </form> 
        </div> 
    "; 
}
        ?>
    </div>

    <div  id="typedish">
    <?php 
 
        @$typedish = $_POST['typedish'];
        @$idtypedish = $_POST['idtypedish'];
        $typedishbd = "SELECT * FROM `typedish`";
        $resulttypedish = mysqli_query($myscl, $typedishbd);

        $getustypedish = @$_POST["id_typedish"];


    ?>

    <h1 > Админ панель Типа блюд</h1>
    <table>
        <tr>
            <td >ID</td>
            <td >Тип блюда</td>
            <td >Удаление</td>
            <td >Редактирование</td>
        </tr>

            <?php 
      
            if( isset( $_POST['udaltypedish'] ) ) {
                $deltypedish = "DELETE FROM `typedish` WHERE id_typedish = '$getustypedish' ";
                $end = mysqli_query($myscl, $deltypedish);
                header("Location: ./panel.php");

            };

            
            if( isset( $_POST['dopavkatypedished'] ) ) {
                $doptypedish = "INSERT INTO `typedish` (`typedish`) VALUES ('$typedish');";
                $end = mysqli_query($myscl, $doptypedish);
                @header("Location: ./panel.php");
            };

            if( isset( $_POST['redakttypedished'] ) ) {
                $checktypedish = "SELECT * FROM `typedish` WHERE `id_typedish` = '$idtypedish'";
                $variatypedish = mysqli_fetch_assoc(mysqli_query($myscl, $checktypedish));
                if (@$typedish == '') {

                    @$typedish = $variatypedish['typedish'];
                }
                $redakttypedish = "UPDATE `typedish` SET `typedish` = '$typedish' WHERE `typedish`.`id_typedish` = '$idtypedish';";
                $end = mysqli_query($myscl, $redakttypedish);
              
                header("Location: ./panel.php");
            };

                while ($rowtypedish = mysqli_fetch_assoc($resulttypedish)) {
                    echo "<tr>";
                        echo "<td>";
                    echo $rowtypedish["id_typedish"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowtypedish["typedish"];
                        echo "</td>";
                        echo "<td>";
                    echo 
                    "<form method='POST'>
                        <input type='hidden' name='id_typedish' value= '" . $rowtypedish["id_typedish"] . "' />
                        <input type='submit' name='udaltypedish' value='Удалить'>
                    </form>";
                        echo "</td>";
                    echo "<td>";
                    echo 
                    "<form method='POST'>
                        <input type='hidden' name='id_typedish' value= '" . $rowtypedish["id_typedish"] . "' />
                        <input type='submit' name='redakttypedish' value='Редактировать'>
                    </form>";
                    echo "</tr>";

                }

            ?>

    </table>
    <?php 
   if (isset($_POST['dopavkatypedish'])) { 
    echo " 
        <div class='dopavkafor'> 
            <form  class='iputfor' method='post' action=''> 
                <input class='pole' type='text' name='typedish' placeholder='Тип блюда'> 
                <input type='submit' name='dopavkatypedished' value='Сохранить'> 
                <input type='submit' name='hide' value='Скрыть'> 
            </form> 
        </div> 
    "; 
} else { 
     
    echo " 
    <form class='iputfor' method='post'> 
       <input class='dopavka' type='submit' name='dopavkatypedish' value='Добавить'>
    </form> 
    "; 
}

if (isset($_POST['redakttypedish'])) { 
    echo " 
        <div class='redaktuser'> 
            <form class=iputfor method='post' action=''> 
                <input class='pole' type='text' name='typedish' placeholder='Тип блюда'> 
                <input class='pole' type='hidden' value='$getustypedish' name='idtypedish'> 
                <input type='submit' name='redakttypedished' value='Сохранить'> 
                <input type='submit' name='hide' value='Скрыть'> 
            </form> 
        </div> 
    "; 
}

        ?>
    </div>

    <div  id="tableuser">
    <?php 
        @$dataset = date ("Y-m-d");
        @$id_usert = $_POST['id_user'];
        @$id_tablet = $_POST['id_table'];
        @$timet = $_POST['time'];
        @$datat = $_POST['data'];
        @$idtableuser = $_POST['idtableuser'];
        $tableuser = "SELECT * FROM `tableuser`";
        $resulttableuser = mysqli_query($myscl, $tableuser);

        $getustableuser = @$_POST["id_tableuser"];


    ?>

    <h1 > Админ панель Активных броней столиков</h1>
    <table>
        <tr>
            <td >ID</td>
            <td >id_user</td>
            <td >id_table</td>
            <td >Дата</td>
            <td >Время</td>
            <td >Кол-во Персон</td>
            <td >Удаление</td>
            <td >Редактирование</td>
        </tr>

            <?php 
      
            if( isset( $_POST['udaltableuser'] ) ) {
                $deltableuser = "DELETE FROM `tableuser` WHERE id_tableuser = '$getustableuser' ";
                $end = mysqli_query($myscl, $deltableuser);
                header("Location: ./panel.php");

            };

            
            if( isset( $_POST['dopavkatableusered'] ) ) {
                $doptableuser = "INSERT INTO `tableuser` (`id_user`,`id_table`,`data`, `time`) VALUES ('$id_usert','$id_tablet','$datat', '$timet');";
                $end = mysqli_query($myscl, $doptableuser);
                @header("Location: ./panel.php");
            };

            if( isset( $_POST['redakttableusered'] ) ) {
                $checktableuser = "SELECT * FROM `tableuser` WHERE `id_tableuser` = '$idtableuser'";
                $variatableuser = mysqli_fetch_assoc(mysqli_query($myscl, $checktableuser));
                if (@$id_usert == '') {
                    @$id_usert = $variatableuser['id_user'];
                }
                if (@$id_tablet == '') {
                    @$id_tablet = $variatableuser['id_table'];
                }
                if (@$datat == '') {
                    @$datat = $variatableuser['data'];
                }
                if (@$timet == '') {
                    @$timet = $variatableuser['time'];
                }

                $redakttableuser = "UPDATE `tableuser` SET `id_user` = '$id_usert',  `id_table` = '$id_tablet', `data` = '$datat', `time` = '$timet'  WHERE `tableuser`.`id_tableuser` = '$idtableuser';";
                $end = mysqli_query($myscl, $redakttableuser);
              
                header("Location: ./panel.php");
            };

                while ($rowtableuser = mysqli_fetch_assoc($resulttableuser)) {
                    echo "<tr>";
                        echo "<td>";
                    echo $rowtableuser["id_tableuser"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowtableuser["id_user"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowtableuser["id_table"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowtableuser["data"];
                            echo "</td>";
                        echo "<td>";
                    echo $rowtableuser["time"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowtableuser["persons"];
                        echo "</td>";
                        echo "<td>";
                    echo 
                    "<form method='POST'>
                        <input type='hidden' name='id_tableuser' value= '" . $rowtableuser["id_tableuser"] . "' />
                        <input type='submit' name='udaltableuser' value='Удалить'>
                    </form>";
                        echo "</td>";
                    echo "<td>";
                    echo 
                    "<form method='POST'>
                        <input type='hidden' name='id_tableuser' value= '" . $rowtableuser["id_tableuser"] . "' />
                        <input type='submit' name='redakttableuser' value='Редактировать'>
                    </form>";
                    echo "</tr>";

                }

            ?>

    </table>
    <?php 
   if (isset($_POST['dopavkatableuser'])) { 
    echo " 
        <div class='dopavkafor'> 
            <form  class='iputfor' method='post' action=''> 
                <input class='pole' type='text' name='id_user' placeholder='ID Клиента'> 
                <input class='pole' type='text' name='id_table' placeholder='ID Столика'> 
                <input class='pole' type='hidden' value='$dataset' name='data'> 
                <input min='10:00' max='17:00' class='pole' type='time' name='time' > 
                <input type='submit' name='dopavkatableusered' value='Сохранить'> 
                <input type='submit' name='hide' value='Скрыть'> 
            </form> 
        </div> 
    "; 
} else { 
     
    echo " 
    <form class='iputfor' method='post'> 
       <input class='dopavka' type='submit' name='dopavkatableuser' value='Добавить'>
    </form> 
    "; 
}

if (isset($_POST['redakttableuser'])) { 
    echo " 
        <div class='redaktuser'> 
            <form class=iputfor method='post' action=''> 
                <input class='pole' type='text' name='id_user' placeholder='ID Клиента'> 
                <input class='pole' type='text' name='id_table' placeholder='ID Столика'> 
                <input class='pole' type='date' value='$dataset' name='data'> 
                <input min='10:00' max='17:00' class='pole' type='time' name='time' > 
                <input class='pole' type='hidden' value='$getustableuser' name='idtableuser'> 
                <input type='submit' name='redakttableusered' value='Сохранить'> 
                <input type='submit' name='hide' value='Скрыть'> 
            </form> 
        </div> 
    "; 
}

        ?>
    </div>

    <div id="table">
    <?php 

        @$id_table = $_POST['id_table'];
        @$num_table = $_POST['num_table'];
        @$id_waitert = $_POST['id_waiter'];
        @$status = $_POST['status'];
        @$personst = $_POST['persons'];
        @$idtable = $_POST['idtable'];
        $table = "SELECT * FROM `table`";
        $resulttable = mysqli_query($myscl, $table);

        $getustable = @$_POST["id_table"];


    ?>

    <h1 > Админ панель столиков</h1>
    <table>
        <tr>
            <td >ID</td>
            <td >num_table</td>
            <td >id_waiter</td>
            <td >Статус</td>
            <td >Кол-во Персон</td>
            <td >Удаление</td>
            <td >Редактирование</td>
        </tr>

            <?php 
      
            if( isset( $_POST['udaltable'] ) ) {
                $deltable = "DELETE FROM `table` WHERE id_table = '$getustable' ";
                $end = mysqli_query($myscl, $deltable);
                header("Location: ./panel.php#tablerr");

            };

            
            if( isset( $_POST['dopavkatabled'] ) ) {
                $doptable = "INSERT INTO `table` (`num_table`,`id_waiter`,`status`, `persons`) VALUES ('$num_table','$id_waitert','$status', '$persons');";
                $end = mysqli_query($myscl, $doptable);
                @header("Location: ./panel.php");
            };

            if( isset( $_POST['redakttabled'] ) ) {
                $checktable = "SELECT * FROM `table` WHERE `id_table` = '$idtable'";
                $variatable = mysqli_fetch_assoc(mysqli_query($myscl, $checktable));
                if (@$num_table == '') {
                    @$num_table = $variatable['num_table'];
                }
                if (@$id_waitert == '') {
                    @$id_waitert = $variatable['id_waiter'];
                }
                if (@$status == '') {
                    @$status = $variatable['status'];
                }
                if (@$personst == '') {
                    @$personst = $variatable['persons'];
                }

                $redakttable = "UPDATE `table` SET `num_table` = '$num_table',  `id_waiter` = '$id_waitert', `status` = '$status', `persons` = '$personst'  WHERE `table`.`id_table` = '$idtable';";
                $end = mysqli_query($myscl, $redakttable);
              
                header("Location: ./panel.php");
            };

                while ($rowtable = mysqli_fetch_assoc($resulttable)) {
                    echo "<tr>";
                        echo "<td>";
                    echo $rowtable["id_table"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowtable["num_table"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowtable["id_waiter"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowtable["status"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowtable["persons"];
                        echo "</td>";
                        echo "<td>";
                    echo 
                    "<form method='POST'>
                        <input type='hidden' name='id_table' value= '" . $rowtable["id_table"] . "' />
                        <input type='submit' name='udaltable' value='Удалить'>
                    </form>";
                        echo "</td>";
                    echo "<td>";
                    echo 
                    "<form method='POST'>
                        <input type='hidden' name='id_table' value= '" . $rowtable["id_table"] . "' />
                        <input type='submit' name='redakttable' value='Редактировать'>
                    </form>";
                    echo "</tr>";

                }

            ?>

    </table>
    <?php 
   if (isset($_POST['dopavkatable'])) { 
    echo " 
        <div class='dopavkafor'> 
            <form  class='iputfor' method='post' action=''> 
                <input class='pole' type='text' name='num_table' placeholder='Номер столика'> 
                <input class='pole' type='text' name='id_waiter' placeholder='ID Оффицанта'> 
                <input class='pole' type='text' name='status' placeholder='Статус стола'> 
                <input class='pole' type='text' name='persons' placeholder='Кол-во Персон'> 
                <input type='submit' name='dopavkatabled' value='Сохранить'> 
                <input type='submit' name='hide' value='Скрыть'> 
            </form> 
        </div> 
    "; 
} else { 
     
    echo " 
    <form class='iputfor' method='post'> 
       <input class='dopavka' type='submit' name='dopavkatable' value='Добавить'>
    </form> 
    "; 
}

if (isset($_POST['redakttable'])) { 
    echo " 
        <div class='redaktuser'> 
            <form class=iputfor method='post' action=''> 
                <input class='pole' type='text' name='num_table' placeholder='Номер столика'> 
                <input class='pole' type='text' name='id_waiter' placeholder='ID Оффицанта'> 
                <input class='pole' type='text' name='status' placeholder='Статус стола'> 
                <input class='pole' type='text' name='persons' placeholder='Кол-во Персон'> 
                <input class='pole' type='hidden' value='$getustable' name='idtable'> 
                <input type='submit' name='redakttabled' value='Сохранить'> 
                <input type='submit' name='hide' value='Скрыть'> 
            </form> 
        </div> 
    "; 
}

        ?>
    </div>

    <div  id="order">
    <?php 
        @$dataseto = date ("Y-m-d");
        @$id_usero = $_POST['id_user'];
        @$id_tableo = $_POST['id_table'];
        @$datao = $_POST['data'];
        @$sento = $_POST['sent'];
        @$cost_priceo = $_POST['cost_price'];
        @$profito = $_POST['profit'];
        @$idtableorder = $_POST['idtableorder'];
        $order = "SELECT * FROM `order`";
        $resultorder = mysqli_query($myscl, $order);

        $getusorder = @$_POST["id_order"];


    ?>

    <h1 > Админ панель заказов</h1>
    <table>
        <tr>
            <td >ID</td>
            <td >id_user</td>
            <td >id_table</td>
            <td >Дата</td>
            <td >Цена</td>
            <td >Себестоимость_Заказа</td>
            <td >Выручка</td>
            <td >Удаление</td>
            <td >Редактирование</td>
        </tr>

            <?php 
      
            if( isset( $_POST['udalorder'] ) ) {
                $delorder = "DELETE FROM `order` WHERE id_order = '$getusorder' ";
                $end = mysqli_query($myscl, $delorder);
                header("Location: ./panel.php");

            };

            
            if( isset( $_POST['dopavkaordered'] ) ) {
                $doporder = "INSERT INTO `order` (`id_user`,`id_table`,`data`) VALUES ('$id_usero','$id_tableo','$datao');";
                $end = mysqli_query($myscl, $doporder);
                @header("Location: ./panel.php");
            };

            if( isset( $_POST['redaktordered'] ) ) {
                $checkorder = "SELECT * FROM `order` WHERE `id_order` = '$idtableorder'";
                $variaorder = mysqli_fetch_assoc(mysqli_query($myscl, $checkorder));
                if (@$id_usero == '') {
                    @$id_usero = $variaorder['id_user'];
                }
                if (@$id_tableo == '') {
                    @$id_tableo = $variaorder['id_table'];
                }
                if (@$datao == '') {
                    @$datao = $variaorder['data'];
                }
                if (@$sento == '') {
                    @$sento = $variaorder['sent'];
                }
                if (@$cost_priceo == '') {
                    @$cost_priceo = $variaorder['cost_price'];
                }
                if (@$profito == '') {
                    @$profito = $variaorder['profit'];
                }

                $redaktorder = "UPDATE `order` SET `id_user` = '$id_usero',  `id_table` = '$id_tableo', `data` = '$datao', `sent` = '$sento', `cost_price` = '$cost_priceo', `profit` = '$profito'  WHERE `order`.`id_order` = '$idtableorder';";
                print_r($redaktorder);
                $end = mysqli_query($myscl, $redaktorder);
           
                // header("Location: ./panel.php");
            };

                while ($roworder= mysqli_fetch_assoc($resultorder)) {
                    echo "<tr>";
                        echo "<td>";
                    echo $roworder["id_order"];
                        echo "</td>";
                        echo "<td>";
                    echo $roworder["id_user"];
                        echo "</td>";
                        echo "<td>";
                    echo $roworder["id_table"];
                        echo "</td>";
                        echo "<td>";
                    echo $roworder["data"];
                            echo "</td>";
                        echo "<td>";
                    echo $roworder["sent"];
                        echo "</td>";
                        echo "<td>";
                    echo $roworder["cost_price"];
                        echo "</td>";
                        echo "<td>";
                    echo $roworder["profit"];
                            echo "</td>";
                        echo "<td>";
                    echo 
                    "<form method='POST'>
                        <input type='hidden' name='id_order' value= '" . $roworder["id_order"] . "' />
                        <input type='submit' name='udalorder' value='Удалить'>
                    </form>";
                        echo "</td>";
                    echo "<td>";
                    echo 
                    "<form method='POST'>
                        <input type='hidden' name='id_order' value= '" . $roworder["id_order"] . "' />
                        <input type='submit' name='redaktrder' value='Редактировать'>
                    </form>";
                    echo "</tr>";

                }

            ?>

    </table>
    <?php 
   if (isset($_POST['dopavkaorder'])) { 
    echo " 
        <div class='dopavkafor'> 
            <form  class='iputfor' method='post' action=''> 
                <input class='pole' type='text' name='id_user' placeholder='ID Клиента'> 
                <input class='pole' type='text' name='id_table' placeholder='ID Столика'> 
                <input class='pole' type='date' value='$dataset' name='data'> 
                <input type='submit' name='dopavkaordered' value='Сохранить'> 
                <input type='submit' name='hide' value='Скрыть'> 
            </form> 
        </div> 
    "; 
} else { 
     
    echo " 
    <form class='iputfor' method='post'> 
       <input class='dopavka' type='submit' name='dopavkaorder' value='Добавить'>
    </form> 
    "; 
}

if (isset($_POST['redaktrder'])) { 
    echo " 
        <div class='redaktuser'> 
            <form class=iputfor method='post' action=''> 
                <input class='pole' type='text' name='id_user' placeholder='ID Клиента'> 
                <input class='pole' type='text' name='id_table' placeholder='ID Столика'> 
                <input class='pole' type='date' value='$dataset' name='data'> 
                <input class='pole' type='text' name='sent' placeholder='Цена заказа'> 
                <input class='pole' type='text' name='cost_price' placeholder='Себестоимость'> 
                <input class='pole' type='text' name='profit' placeholder='Выручка'> 
                <input class='pole' type='hidden' value='$getusorder' name='idtableorder'> 
                <input type='submit' name='redaktordered' value='Сохранить'> 
                <input type='submit' name='hide' value='Скрыть'> 
            </form> 
        </div> 
    "; 
}

        ?>
    </div>

    <div  id="message">
    <?php 
 
        @$id_userm = $_POST['id_user'];
        @$emailm = $_POST['email'];
        @$message = $_POST['message'];
        @$idmessage = $_POST['idmessage'];
        $messagetable = "SELECT * FROM `message`";
        $resultmessage = mysqli_query($myscl, $messagetable);

        $getusmessage = @$_POST["id_message"];


    ?>

    <h1 > Админ панель Сообщений</h1>
    <table>
        <tr>
            <td >ID</td>
            <td >id_user</td>
            <td >Почта</td>
            <td >Сообщение</td>
            <td >Удаление</td>
            <td >Редактирование</td>
        </tr>

            <?php 
      
            if( isset( $_POST['udalmessage'] ) ) {
                $delmessage = "DELETE FROM `message` WHERE id_message = '$getusmessage' ";
                $end = mysqli_query($myscl, $delmessage);
                header("Location: ./panel.php");

            };

            
            if( isset( $_POST['dopavkamessaged'] ) ) {
                $dopmessage = "INSERT INTO `message` (`id_user`,`email`,`message`) VALUES ('$id_userm','$emailm','$message');";
                $end = mysqli_query($myscl, $dopmessage);
                @header("Location: ./panel.php");
            };

            if( isset( $_POST['redaktmessaged'] ) ) {
                $checkmessage = "SELECT * FROM `message` WHERE `id_message` = '$idmessage'";
                $variamessage = mysqli_fetch_assoc(mysqli_query($myscl, $checkmessage));
                if (@$id_userm == '') {

                    @$id_userm = $variamessage['id_user'];
                }
                if (@$emailm == '') {

                    @$emailm = $variamessage['email'];
                }
                if (@$message == '') {

                    @$message = $variamessage['message'];
                }
                $redaktmessage = "UPDATE `message` SET `id_user` = '$id_userm', `email` = '$emailm', `message` = '$message' WHERE `message`.`id_message` = '$idmessage';";
                $end = mysqli_query($myscl, $redaktmessage);
              
                header("Location: ./panel.php");
            };

                while ($rowmessage = mysqli_fetch_assoc($resultmessage)) {
                    echo "<tr>";
                        echo "<td>";
                    echo $rowmessage["id_message"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowmessage["id_user"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowmessage["email"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowmessage["message"];
                        echo "</td>";
                        echo "<td>";
                    echo 
                    "<form method='POST'>
                        <input type='hidden' name='id_message' value= '" . $rowmessage["id_message"] . "' />
                        <input type='submit' name='udalmessage' value='Удалить'>
                    </form>";
                        echo "</td>";
                    echo "<td>";
                    echo 
                    "<form method='POST'>
                        <input type='hidden' name='id_message' value= '" . $rowmessage["id_message"] . "' />
                        <input type='submit' name='redaktmessage' value='Редактировать'>
                    </form>";
                    echo "</tr>";

                }

            ?>

    </table>
    <?php 
   if (isset($_POST['dopavkamessage'])) { 
    echo " 
        <div class='dopavkafor'> 
            <form  class='iputfor' method='post' action=''> 
                <input class='pole' type='text' name='id_user' placeholder='ИД Пользователя'> 
                <input class='pole' type='email' name='email' placeholder='Почта'> 
                <input class='pole' type='text' name='message' placeholder='Сообщение'> 
                <input type='submit' name='dopavkamessaged' value='Сохранить'> 
                <input type='submit' name='hide' value='Скрыть'> 
            </form> 
        </div> 
    "; 
} else { 
     
    echo " 
    <form class='iputfor' method='post'> 
       <input class='dopavka' type='submit' name='dopavkamessage' value='Добавить'>
    </form> 
    "; 
}

if (isset($_POST['redaktmessage'])) { 
    echo " 
        <div class='redaktuser'> 
            <form class=iputfor method='post' action=''> 
                <input class='pole' type='text' name='id_user' placeholder='ИД Пользователя'> 
                <input class='pole' type='email' name='email' placeholder='Почта'> 
                <input class='pole' type='text' name='message' placeholder='Сообщение'> 
                <input class='pole' type='hidden' value='$getusmessage' name='idmessage'> 
                <input type='submit' name='redaktmessaged' value='Сохранить'> 
                <input type='submit' name='hide' value='Скрыть'> 
            </form> 
        </div> 
    "; 
}

        ?>
    </div>

    <div  id="ingredient">
    <?php 
 
        @$ingredienti = $_POST['ingredienti'];
        @$cost_pricei = $_POST['cost_pricei'];
        @$idingredient = $_POST['idingredient'];
        $ingredienttable = "SELECT * FROM `ingredient`";
        $resultingredient = mysqli_query($myscl, $ingredienttable);

        $getusingredient = @$_POST["id_ingredienti"];


    ?>

    <h1 > Админ панель Ингредиентов</h1>
    <table>
        <tr>
            <td >ID</td>
            <td >Ингредиент</td>
            <td >Себестоимость (за 100гр)</td>
            <td >Удаление</td>
            <td >Редактирование</td>
        </tr>

            <?php 
      
            if( isset( $_POST['udalingredient'] ) ) {
                $delingredient = "DELETE FROM `ingredient` WHERE id_ingredient = '$getusingredient' ";
                $end = mysqli_query($myscl, $delingredient);
                header("Location: ./panel.php");

            };

            
            if( isset( $_POST['dopavkaingrediented'] ) ) {
                $dopingredient = "INSERT INTO `ingredient` (`ingredient`,`cost_price`) VALUES ('$ingredienti','$cost_pricei');";
                $end = mysqli_query($myscl, $dopingredient);
                @header("Location: ./panel.php");
            };

            if( isset( $_POST['redaktingrediented'] ) ) {
                $checkingredient = "SELECT * FROM `ingredient` WHERE `id_ingredient` = '$idingredient'";
                $variaingredient = mysqli_fetch_assoc(mysqli_query($myscl, $checkingredient));
                if (@$ingredienti == '') {

                    @$ingredienti = $variaingredient['ingredient'];
                }
                if (@$cost_pricei == '') {

                    @$cost_pricei = $variaingredient['cost_price'];
                }
                $redaktingredient = "UPDATE `ingredient` SET `ingredient` = '$ingredienti', `cost_price` = '$cost_pricei' WHERE `ingredient`.`id_ingredient` = '$idingredient';";
                $end = mysqli_query($myscl, $redaktingredient);

                header("Location: ./panel.php");
            };

                while ($rowingredient = mysqli_fetch_assoc($resultingredient)) {
                    echo "<tr>";
                        echo "<td>";
                    echo $rowingredient["id_ingredient"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowingredient["ingredient"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowingredient["cost_price"];
                        echo "</td>";
                        echo "<td>";
                    echo 
                    "<form method='POST'>
                        <input type='hidden' name='id_ingredienti' value= '" . $rowingredient["id_ingredient"] . "' />
                        <input type='submit' name='udalingredient' value='Удалить'>
                    </form>";
                        echo "</td>";
                    echo "<td>";
                    echo 
                    "<form method='POST'>
                        <input type='hidden' name='id_ingredienti' value= '" . $rowingredient["id_ingredient"] . "' />
                        <input type='submit' name='redaktingredient' value='Редактировать'>
                    </form>";
                    echo "</tr>";

                }

            ?>

    </table>
    <?php 
   if (isset($_POST['dopavkaingredient'])) { 
    echo " 
        <div class='dopavkafor'> 
            <form  class='iputfor' method='post' action=''> 
                <input class='pole' type='text' name='ingredienti' placeholder='Ингредиент'> 
                <input class='pole' type='text' name='cost_pricei' placeholder='Себестоимость (за 100гр)'> 
                <input type='submit' name='dopavkaingrediented' value='Сохранить'> 
                <input type='submit' name='hide' value='Скрыть'> 
            </form> 
        </div> 
    "; 
} else { 
     
    echo " 
    <form class='iputfor' method='post'> 
       <input class='dopavka' type='submit' name='dopavkaingredient' value='Добавить'>
    </form> 
    "; 
}

if (isset($_POST['redaktingredient'])) { 
    echo " 
        <div class='redaktuser'> 
            <form class=iputfor method='post' action=''> 
                <input class='pole' type='text' name='ingredienti' placeholder='Ингредиент'> 
                <input class='pole' type='text' name='cost_pricei' placeholder='Себестоимость (за 100гр)'> 
                <input class='pole' type='hidden' value='$getusingredient' name='idingredient'> 
                <input type='submit' name='redaktingrediented' value='Сохранить'> 
                <input type='submit' name='hide' value='Скрыть'> 
            </form> 
        </div> 
    "; 
}

        ?>
    </div>

    <div  id="infoorder">
    <?php 
 
        @$id_orderif = $_POST['id_orderif'];
        @$id_dishif = $_POST['id_dishif'];
        @$sent_dishif = $_POST['sent_dishif'];
        @$cost_pricedishif = $_POST['cost_pricedishif'];
        @$profitif = $_POST['profitif'];

        @$idinfoorder = $_POST['idinfoorder'];
        $infoorder = "SELECT * FROM `infoorder`";
        $resultinfoorder = mysqli_query($myscl, $infoorder);

        $getusinfoorder = @$_POST["id_infoorder"];


    ?>

    <h1 > Админ панель Информации о заказах</h1>
    <table>
        <tr>
            <td >ID</td>
            <td >ID Заказа</td>
            <td >ID Блюда</td>
            <td >Цена Блюда</td>
            <td >Себестоимость Блюда</td>
            <td >Выручка с Блюда</td>
            <td >Удаление</td>
            <td >Редактирование</td>
        </tr>

            <?php 
      
            if( isset( $_POST['udalinfoorder'] ) ) {
                $delinfoorder = "DELETE FROM `infoorder` WHERE id_infoorder = '$getusinfoorder' ";
                $end = mysqli_query($myscl, $delinfoorder);
                header("Location: ./panel.php");

            };

            
            if( isset( $_POST['dopavkainfoordered'] ) ) {
                $dopinfoorder = "INSERT INTO `infoorder` (`id_order`,`id_Dish`) VALUES ('$id_orderif','$id_dishif');";
                $end = mysqli_query($myscl, $dopinfoorder);
                @header("Location: ./panel.php");
            };

            if( isset( $_POST['redaktinfoordered'] ) ) {
                $checkinfoorder = "SELECT * FROM `infoorder` WHERE `id_infoorder` = '$idinfoorder'";
                $variainfoorder = mysqli_fetch_assoc(mysqli_query($myscl, $checkinfoorder));
                if (@$id_orderif == '') {

                    @$id_orderif = $variainfoorder['id_order'];
                }
                if (@$id_dishif == '') {

                    @$id_dishif = $variainfoorder['id_Dish'];
                }
      
              
                $redaktinfoorder = "UPDATE `infoorder` SET `id_order` = '$id_orderif', `id_Dish` = '$id_dishif' WHERE `infoorder`.`id_infoorder` = '$idinfoorder';";
                $end = mysqli_query($myscl, $redaktinfoorder);
                header("Location: ./panel.php");
            };

                while ($rowinfoorder = mysqli_fetch_assoc($resultinfoorder)) {
                    echo "<tr>";
                        echo "<td>";
                    echo $rowinfoorder["id_infoorder"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowinfoorder["id_order"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowinfoorder["id_Dish"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowinfoorder["sent_dish"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowinfoorder["cost_pricedish"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowinfoorder["profit"];
                        echo "</td>";
                        echo "<td>";
                    echo 
                    "<form method='POST'>
                        <input type='hidden' name='id_infoorder' value= '" . $rowinfoorder["id_infoorder"] . "' />
                        <input type='submit' name='udalinfoorder' value='Удалить'>
                    </form>";
                        echo "</td>";
                    echo "<td>";
                    echo 
                    "<form method='POST'>
                        <input type='hidden' name='id_infoorder' value= '" . $rowinfoorder["id_infoorder"] . "' />
                        <input type='submit' name='redaktinfoorder' value='Редактировать'>
                    </form>";
                    echo "</tr>";

                }

            ?>

    </table>
    <?php 
   if (isset($_POST['dopavkainfoorder'])) { 
    echo " 
        <div class='dopavkafor'> 
            <form  class='iputfor' method='post' action=''> 
                <input class='pole' type='text' name='id_orderif' placeholder='ИД Заказа'> 
                <input class='pole' type='text' name='id_dishif' placeholder='ИД Блюда'> 
                <input type='submit' name='dopavkainfoordered' value='Сохранить'> 
                <input type='submit' name='hide' value='Скрыть'> 
            </form> 
        </div> 
    "; 
} else { 
     
    echo " 
    <form class='iputfor' method='post'> 
       <input class='dopavka' type='submit' name='dopavkainfoorder' value='Добавить'>
    </form> 
    "; 
}

if (isset($_POST['redaktinfoorder'])) { 
    echo " 
        <div class='redaktuser'> 
            <form class=iputfor method='post' action=''> 
                <input class='pole' type='text' name='id_orderif' placeholder='ИД Заказа'> 
                <input class='pole' type='text' name='id_dishif' placeholder='ИД Блюда'> 
               
                <input class='pole' type='hidden' value='$getusinfoorder' name='idinfoorder'> 
                <input type='submit' name='redaktinfoordered' value='Сохранить'> 
                <input type='submit' name='hide' value='Скрыть'> 
            </form> 
        </div> 
    "; 
}

        ?>
    </div>

    <div  id="Dishingredient">
    <?php 
        @$id_dishing = $_POST['id_dishing'];
        @$id_ingredienting = $_POST['id_ingredienting'];
        @$quantity_graming = $_POST['quantity_graming'];

        @$idDishingredient = $_POST['idDishingredient'];
        $Dishingredient = "SELECT * FROM `Dishingredient`";
        $resultdishingredient = mysqli_query($myscl, $Dishingredient);

        $getusdishing = @$_POST["id_dishingredient"];


    ?>

    <h1 > Админ панель ингредиентов Блюд</h1>
    <table>
        <tr>
            <td >ID</td>
            <td >ID Блюда</td>
            <td >ID Ингредиента</td>
            <td >Кол-во Грамм</td>
            <td >Себестоимость Блюда</td>
            <td >Удаление</td>
            <td >Редактирование</td>
        </tr>

            <?php 
      
            if( isset( $_POST['udaldishingredient'] ) ) {
                $delDIshingredient = "DELETE FROM `DIshingredient` WHERE `id_DIshingredient` = '$getusdishing' ";
                $end = mysqli_query($myscl, $delDIshingredient);
                header("Location: ./panel.php");
            };

            
            if( isset( $_POST['dopavkadishingrediented'] ) ) {
                $dopdishingredient= "INSERT INTO `DIshingredient` (`id_Dish`,`id_ingredient`,`quantity_gram`) VALUES ('$id_dishing','$id_ingredienting','$quantity_graming');";
                $end = mysqli_query($myscl, $dopdishingredient);
                @header("Location: ./panel.php");
            };

            if( isset( $_POST['redaktdishingrediented'] ) ) {
                $checkDIshingredient = "SELECT * FROM `DIshingredient` WHERE `id_DIshingredient` = '$idDishingredient'";
                $variaDIshingredient = mysqli_fetch_assoc(mysqli_query($myscl, $checkDIshingredient));
                if (@$id_dishing == '') {

                    @$id_dishing = $variaDIshingredient['id_Dish'];
                }
                if (@$id_ingredienting == '') {

                    @$id_ingredienting = $variaDIshingredient['id_ingredient'];
                }
                if (@$quantity_graming == '') {

                    @$quantity_graming = $variaDIshingredient['quantity_gram'];
                }
      
              
                $redaktDIshingredient = "UPDATE `DIshingredient` SET `id_Dish` = '$id_dishing', `id_ingredient` = '$id_ingredienting', `quantity_gram` = '$quantity_graming' WHERE `DIshingredient`.`id_DIshingredient` = '$idDishingredient';";
                $end = mysqli_query($myscl, $redaktDIshingredient);
                header("Location: ./panel.php");
            };

                while ($rowdishing = mysqli_fetch_assoc($resultdishingredient)) {
                    echo "<tr>";
                        echo "<td>";
                    echo $rowdishing["id_DIshingredient"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowdishing["id_Dish"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowdishing["id_ingredient"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowdishing["quantity_gram"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowdishing["cost"];
                        echo "</td>";
                        echo "<td>";
                    echo 
                    "<form method='POST'>
                        <input type='hidden' name='id_dishingredient' value= '" . $rowdishing["id_DIshingredient"] . "' />
                        <input type='submit' name='udaldishingredient' value='Удалить'>
                    </form>";
                        echo "</td>";
                        echo "<td>";
                    echo 
                    "<form method='POST'>
                        <input type='hidden' name='id_dishingredient' value= '" . $rowdishing["id_DIshingredient"] . "' />
                        <input type='submit' name='redaktdishingredient' value='Редактировать'>
                    </form>";
                    echo "</td>";
                    echo "</tr>";

                }

            ?>

    </table>
    <?php 
   if (isset($_POST['dopavkadishingredient'])) { 
    echo " 
        <div class='dopavkafor'> 
            <form  class='iputfor' method='post' action=''> 
                <input class='pole' type='text' name='id_dishing' placeholder='ИД Блюда'> 
                <input class='pole' type='text' name='id_ingredienting' placeholder='ИД Ингредиента'> 
                <input class='pole' type='text' name='quantity_graming' placeholder='Кол-во Граммов'> 
                <input type='submit' name='dopavkadishingrediented' value='Сохранить'> 
                <input type='submit' name='hide' value='Скрыть'> 
            </form> 
        </div> 
    "; 
} else { 
     
    echo " 
    <form class='iputfor' method='post'> 
       <input class='dopavka' type='submit' name='dopavkadishingredient' value='Добавить'>
    </form> 
    "; 
}

if (isset($_POST['redaktdishingredient'])) { 
    echo " 
        <div class='redaktuser'> 
            <form class=iputfor method='post' action=''> 
                <input class='pole' type='text' name='id_dishing' placeholder='ИД Блюда'> 
                <input class='pole' type='text' name='id_ingredienting' placeholder='ИД Ингредиента'> 
                <input class='pole' type='text' name='quantity_graming' placeholder='Кол-во Граммов'> 
                <input class='pole' type='hidden' value='$getusdishing' name='idDishingredient'> 
                <input type='submit' name='redaktdishingrediented' value='Сохранить'> 
                <input type='submit' name='hide' value='Скрыть'> 
            </form> 
        </div> 
    "; 
}

        ?>
    </div>

    <div  id="Dish">
    <?php 
        @$title_dish = $_POST['title_dish'];
        @$id_typedishish = $_POST['id_typedishish'];
        @$country = $_POST['country'];
        @$veganish = $_POST['veganish'];
        @$sent_dishish = $_POST['sent_dishish'];
        @$foto = $_POST['foto'];
        @$description = $_POST['description'];
        @$idDish = $_POST['idDish'];
        $Dishtable = "SELECT * FROM `Dish`";
        $resultdish = mysqli_query($myscl, $Dishtable);

        $getusdish = @$_POST["id_dishish"];


    ?>

    <h1 > Админ панель Блюд</h1>
    <table>
        <tr>
            <td >ID</td>
            <td >ID Блюда</td>
            <td >ID Ингредиента</td>
            <td >Кол-во Грамм</td>
            <td >Себестоимость Блюда</td>
            <td >Удаление</td>
            <td >Редактирование</td>
        </tr>

            <?php 
      
            if( isset( $_POST['udaldishish'] ) ) {
                $delDish = "DELETE FROM `Dish` WHERE `id_Dish` = '$getusdish' ";
                $end = mysqli_query($myscl, $delDish);
                header("Location: ./panel.php");
            };

            
            if( isset( $_POST['dopavkadished'] ) ) {
                $dopdish= "INSERT INTO `Dish` (`title_dish`,`id_typedish`,`country`, `vegan`, `sent_dish`, `foto`, `description`) VALUES ('$title_dish','$id_typedishish','$country','$veganish','$sent_dishish','$foto','$description');";
                $end = mysqli_query($myscl, $dopdish);
                @header("Location: ./panel.php");
            };

            if( isset( $_POST['redaktdished'] ) ) {
                $checkdish = "SELECT * FROM `Dish` WHERE `id_Dish` = '$idDish'";
                $variaDish = mysqli_fetch_assoc(mysqli_query($myscl, $checkdish));
                if (@$title_dish == '') {

                    @$title_dish = $variaDish['title_dish'];
                }
                if (@$id_typedishish == '') {

                    @$id_typedishish = $variaDish['id_typedish'];
                }
                if (@$country == '') {

                    @$country = $variaDish['country'];
                }
                if (@$veganish == '') {

                    @$veganish = $variaDish['vegan'];
                }
                if (@$sent_dishish == '') {

                    @$sent_dishish = $variaDish['sent_dish'];
                }
                if (@$foto == '') {

                    @$foto = $variaDish['foto'];
                }
                if (@$description == '') {

                    @$description = $variaDish['description'];
                }

              
                $redaktDIshingredient = "UPDATE `Dish` SET `title_dish` = '$title_dish', `id_typedish` = '$id_typedishish', `country` = '$country', `vegan` = '$veganish', `sent_dish` = '$sent_dishish', `foto` = '$foto', `description` = '$description' WHERE `Dish`.`id_dish` = '$idDish';";
                $end = mysqli_query($myscl, $redaktDIshingredient);
                header("Location: ./panel.php");
            };

                while ($rowdishish = mysqli_fetch_assoc($resultdish)) {
                    echo "<tr>";
                        echo "<td>";
                    echo $rowdishish["id_dish"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowdishish["title_dish"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowdishish["id_typedish"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowdishish["country"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowdishish["vegan"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowdishish["sent_dish"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowdishish["cost_pricedish"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowdishish["foto"];
                        echo "</td>";
                        echo "<td>";
                    echo $rowdishish["description"];
                        echo "</td>";
                        echo "<td>";
                    echo 
                    "<form method='POST'>
                        <input type='hidden' name='id_dishish' value= '" . $rowdishish["id_dish"] . "' />
                        <input type='submit' name='udaldishish' value='Удалить'>
                    </form>";
                        echo "</td>";
                        echo "<td>";
                    echo 
                    "<form method='POST'>
                        <input type='hidden' name='id_dishish' value= '" . $rowdishish["id_dish"] . "' />
                        <input type='submit' name='redaktdish' value='Редактировать'>
                    </form>";
                    echo "</td>";
                    echo "</tr>";

                }

            ?>

    </table>
    <?php 
   if (isset($_POST['dopavkadish'])) { 
    echo " 
        <div class='dopavkafor'> 
            <form  class='iputfor' method='post' action=''> 
                <input class='pole' type='text' name='title_dish' placeholder='Название блюда'> 
                <input class='pole' type='text' name='id_typedishish' placeholder='ИД Типа Блюда'> 
                <input class='pole' type='text' name='country' placeholder='Страна'> 
                <input class='pole' type='text' name='veganish' placeholder='Вегетерианское?'> 
                <input class='pole' type='text' name='sent_dishish' placeholder='Цена блюда'> 
                <input class='pole' type='text' name='foto' placeholder='Навазние фото'> 
                <input class='pole' type='text' name='description' placeholder='Короткое описание'> 
                <input type='submit' name='dopavkadished' value='Сохранить'> 
                <input type='submit' name='hide' value='Скрыть'> 
            </form> 
        </div> 
    "; 
} else { 
     
    echo " 
    <form class='iputfor' method='post'> 
       <input class='dopavka' type='submit' name='dopavkadish' value='Добавить'>
    </form> 
    "; 
}

if (isset($_POST['redaktdish'])) { 
    echo " 
        <div class='redaktuser'> 
            <form class=iputfor method='post' action=''> 
                <input class='pole' type='text' name='title_dish' placeholder='Название блюда'> 
                <input class='pole' type='text' name='id_typedishish' placeholder='ИД Типа Блюда'> 
                <input class='pole' type='text' name='country' placeholder='Страна'> 
                <input class='pole' type='text' name='veganish' placeholder='Вегетерианское?'> 
                <input class='pole' type='text' name='sent_dishish' placeholder='Цена блюда'> 
                <input class='pole' type='text' name='foto' placeholder='Навазние фото'> 
                <input class='pole' type='text' name='description' placeholder='Короткое описание'> 
                <input class='pole' type='hidden' value='$getusdish' name='idDish'> 
                <input type='submit' name='redaktdished' value='Сохранить'> 
                <input type='submit' name='hide' value='Скрыть'> 
            </form> 
        </div> 
    "; 
}

        ?>
    </div>

    <div id="footer"></div>
    <script type="module" src="./module/header/headermain.js"></script>
    <script type="module" src="./main.js"></script>
    <script type="module" src="./module/footer/footer.js"></script>
    <?php ob_end_flush();?>
    </body>
</body>
</html>