<?php
if (isset($_POST["reset-password-submit"])) {
    $selector = $_POST["selector"];
    $validator = $_POST["validator"];

    $password = $_POST["pwd"];

    $passwordRepeat = $_POST["pwd-repeat"];

    if (empty($password) || empty($passwordRepeat)) {
        header("Location:../create-new-password?newpwd=empty");
        exit();
    } else if ($password != $passwordRepeat) {
        header("Location:../create-new-password.php?newpwd-pwdnotsame");
        exit();
    }
    
    require "../db.con1.php";
    $sql = "SELECT  * FROM resetovanje WHERE  token_email=? AND token_expire >= ? ;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        
        echo "There was an error";
        exit();
    } else {
        $currentDate = date("U");
        mysqli_stmt_bind_param($stmt,"ss", $selector,$currentDate);
        
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        

        if (!$row = mysqli_fetch_assoc($result)) {
            echo "nedd to resumbit request";
            var_dump($row);
            print_r($row);
            exit();


        } else {
            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $row['token_sifra']);


            if ($tokenCheck === false) {
                echo "You need to re-submit your request.";
                exit();
            } elseif ($tokenCheck === true) {

                $tokenEmail = $row["email_resetovanja"];
                $sql = "SELECT * FROM users   WHERE  email=?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {

                    echo "There was an error";
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if (!$row = mysqli_fetch_assoc($result)) {
                        echo "there was an error";
                        exit();

                    } else {
                        $sql = "UPDATE users SET pass=? WHERE email=? ";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {

                            echo "There was an error";
                            exit();
                        } else {
                            $newpwdHash = password_hash($password, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "ss", $newpwdHash, $tokenEmail);
                            mysqli_stmt_execute($stmt);


                        }
                    }
                }

            }
        }
    }
}
else{

header("Location:../forma.php");
    
}
   
    



?>