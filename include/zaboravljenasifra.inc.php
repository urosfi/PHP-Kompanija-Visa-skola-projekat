

<?php


if(isset($_POST["posalji"])  )
   
{  
    
    $email = $_POST["email"];
    if( $email !="" && filter_var($email,FILTER_VALIDATE_EMAIL)){

    
    $validator = base64_encode(random_bytes(8));
    $token=random_bytes(32);
    $url = "localhost/projekat/novasifra.php?validator=" .$validator." &token=".base64_encode($token);
    $tokenHash = password_hash($token,PASSWORD_DEFAULT);
    $tokenexpired = date("U") + 3600;
  
  
    try {
        $host = "localhost";
        $dbname = "kompanija";
        $username = "root";
        $password = "";
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    echo "Connected to $dbname at $host successfully.";

    
    $sql = "DELETE  FROM resetovanje WHERE  email_resetovanja=:email_resetovanja";
    $stmt= $conn->prepare($sql);
    $stmt->bindParam(':email_resetovanja', $email );
    $stmt->execute();
    
    $sql = "INSERT INTO  resetovanje (email_resetovanja	,token_email,token_sifra,token_expire)  VALUES (:email_resetovanja,:token_email,:token_sifra,:token_expire) ";
    $stmt= $conn->prepare($sql);
    $stmt->bindParam(':email_resetovanja', $email );
    $stmt->bindParam(':token_email', $validator );
    $stmt->bindParam(':token_sifra', $tokenHash );
    $stmt->bindParam(':token_expire', $tokenexpired );
    $stmt->execute();
    $to = "urosfi@yahoo.com";
    $subject = "Urose resetuj tvoju sifru";
    $txt = "Ovde imate link za restovanje vase sifre : " . $url;
    $headers = "From: urosthestrongest@gmail.com" . "\r\n";
    
    mail($to,$subject,$txt,$headers);
    
    header("Location:../zaboravljenasifra.php?uspesno=uspesno");


    
    } catch (PDOException $pe) {
    die ("Could not connect to the database $dbname:  " . $pe->getMessage());
    }

}
    else{
        echo "Niste dobro uneli email";
        
    }
 

}






?>