<?php
    session_start();
    $id = $_SESSION["user"] ["ID"];

    $email = $_POST["email"];
    $message = $_POST["message"];

    $sql=  mysqli_connect('localhost', 'root', '', 'rest');


    if ($id == "") {
    }

    
    elseif ($email == "") {
    }


    elseif ($message == "") {
    }

    else {
        $sqlinsert = "INSERT INTO `message`(`id_user`,`email`, `message`) VALUES ('$id', '$email', '$message')";
        $result = mysqli_query($sql, $sqlinsert);

        header("Location: ./account.php");
    }



?>