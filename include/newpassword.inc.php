<?php
if(isset ($_POST["posalji-novu-sifru"]))
{
    $validator = $_POST["validator"];
    
    $token = $_POST["token"];
   
    $NewPass= $_POST["NewPass"];
   
   
    $RptPass=$_POST["RptPass"];
    $HashPass = password_hash($NewPass,PASSWORD_DEFAULT);
    $token_expire = date("U");
    if ( $NewPass == $RptPass) {
    $host = "localhost";
    $dbname = "kompanija";
    $username = "root";
    $password = "";
    
        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            echo "Connected to $dbname at $host successfully.";
    
            $sql = "SELECT  * FROM resetovanje WHERE  token_email=:token_email AND token_expire >= :token_expire ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':token_email', $validator);
            $stmt->bindParam(':token_expire', $token_expire);
            $stmt->execute();
            $result = $stmt -> fetch(PDO::FETCH_ASSOC);
            $email = $result["email_resetovanja"];
            $tokenBin = base64_decode($token) ;
            $rez = $result['token_sifra'];

            $PassCheck = password_verify($tokenBin, $rez );
           if($PassCheck)
           {
            $sql = "UPDATE  users SET pass=:pass  WHERE  email=:email ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':pass', $HashPass);
            $stmt->bindParam(':email', $email);

            if($stmt->execute()){
                    echo "Uspesno ste promenili sifru";
                    header("Location:../forma.php?uspesnapromena=uspesnapromena");
            }
            else {
                    echo "Niste uspeli da promenite sifru";
            }


           }

    
        } catch (PDOException $pe) {
            die("Could not connect to the database $dbname:  " . $pe->getMessage());
        }
    
    }
            else{
                echo "Niste dobro uneli email";
               
            }
        
    

}






?>