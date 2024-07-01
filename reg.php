<?php 

session_start();
if (@$_SESSION["user"] ["email"] != ""){
    header("Location: ./index.php");
}

else {

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $repass = $_POST["reppassword"];
    $sql=  mysqli_connect('localhost', 'root', '', 'rest');

    $provemail= mysqli_query($sql, "SELECT * FROM `user` WHERE email = '$email'");
    
    function sanitize_input($username, $email, $password, $repass) {

        $username = trim($username);
        $username = htmlspecialchars($username);
        $username = strip_tags($username);
        
        $email = trim($email);
        $email = htmlspecialchars($email);
        $email = strip_tags($email);
    
        $password = trim($password);
        $password = htmlspecialchars($password);
        $password = strip_tags($password);

        $repass = trim($repass);
        $repass = htmlspecialchars($repass);
        $repass = strip_tags($repass);
        
        return array($username, $email, $password, $repass);
    }
    
    if ($email == "") {
    
    
    }
    
    elseif ($username == "") {
    
    
    }


    elseif ($password != $repass) {
        $_SESSION['message']= "Пароли не совпадают";
        header("Location: " . $_SERVER['HTTP_REFERER']);
      
    }
    
    elseif (strlen ($password) <6) {
        $_SESSION['message']= "Слишком короткий пароль";
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
    
    
    elseif (mysqli_num_rows($provemail) >=1) {
        $_SESSION['message']= "Такая почта уже зарегистрирована";
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
    
    
    elseif ($sql == false) {
        $_SESSION['message']= "Ошибка при подключении к БД";
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
    
    
    else {
        $sqlinsert = "INSERT INTO `user`(`username`,`email`, `password`) VALUES ('$username', '$email', '$password')";
        $result = mysqli_query($sql, $sqlinsert);
        $_SESSION['message']= "Вы успешно зарегистрировались";
        header("Location: ./regout.php");
    }

}

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body style="background-color:#3A3F45; color: #ffffff">
        
    </body>
    </html>