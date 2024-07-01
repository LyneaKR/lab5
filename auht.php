<?php 
session_start();
if (@$_SESSION["user"] ["email"] != ""){
    header("Location: ./index.php");
}

else {

    if (isset($_POST['g-recaptcha-response'])) {
        $recapcha = $_POST['g-recaptcha-response'];
    
        if (!$recapcha) {
            $_SESSION = "";
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
        else  {
        
            $secretKey = '6Leyof0pAAAAAPhAnbx60nfT8c-xzyp2IzFITu1d';
            $url = "https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey.'&response='.$recapcha;
            $response = file_get_contents($url);
            $responseKey = json_decode($response, true);
        }
    } 


    $email = $_POST["email"];
    $password = $_POST["password"];
    $sql=  mysqli_connect('localhost', 'root', '', 'rest');
    $provlog = mysqli_query($sql, "SELECT * FROM `user` WHERE email = '$email' AND password = '$password'");


    function sanitize_input($email, $password) {
        $email = trim($email);
        $email = htmlspecialchars($email);
        $email = strip_tags($email);
    
        $password = trim($password);
        $password = htmlspecialchars($password);
        $password = strip_tags($password);
    
        return array($email, $password);
    }

    if (mysqli_num_rows($provlog) >= 1)  {
        $pro = mysqli_fetch_assoc($provlog);
        
        $_SESSION ["user"] = [
            "ID" => $pro["id_user"],
            "login" => $pro["username"],
            "email"=> $pro["email"],
            "passw" => $pro["password"],
            "role" => $pro["role"],
        ];
        
        header("Location: ./index.php");
        print_r($pro);
    }

    else {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}


        

        
    ?>

