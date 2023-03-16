<?php
if(isset($_POST["posalji"]))
{
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);
    $url = "localhost/projekat/novasifra1.php?selector=".$selector."&validator=".bin2hex($token);
    $expires = date("U") + 1800;
    require "../db.con1.php";
    $userEmail = $_POST["email"];
    $sql = "DELETE FROM resetovanje WHERE email_resetovanja=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql))
    {
        echo "There wass an error";
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt,"s",$userEmail);
        mysqli_stmt_execute($stmt);

    }
    

        $sql="INSERT INTO resetovanje (email_resetovanja, token_email , token_sifra,token_expire) VALUES (?,?,?,?) ;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql))
        {
            echo "There was an error";
            exit();
        }
        else{
              $hashedToken = password_hash($token, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt,"ssss",$userEmail,$selector,$hashedToken,$expires);
            mysqli_stmt_execute($stmt);
    
        }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    $to = $userEmail;
    $subject = "Urose resetuj tvoju sifru";
    $message = "Ovde imate link za restovanje vase sifre : " . $url;
    $headers = "From: urosthestrongest@gmail.com" . "\r\n";
    
    mail($to,$subject,$message,$headers);
    header("Location:../zaboravljenasifra1.php?uspesno=uspesno");

}else {
    header("Location:../forma.php");
}

?>