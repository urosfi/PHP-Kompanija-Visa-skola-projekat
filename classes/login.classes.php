<?php
class Login extends Db
{

    protected function GetUser($uid, $password)
    {
        $stmt = $this->connect()->prepare('SELECT pass    FROM USERS WHERE users_uid=? OR email=? ;');
       

        if (!$stmt->execute(array($uid, $password ))) {
            $stmt = null;
            header("Location:../forma.php?error=stmtfailed");
            exit();
        }
        if($stmt->rowCount() ==0){
            $stmt = null;
            header("location:../forma.php?error=usernotfound");
            exit();

        }
        $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPass = password_verify($password, $pwdHashed[0]["pass"]);

        if($checkPass==false){
            $stmt = null;
            header("location:../forma.php?error=usernotfound");
            exit();

        }
        elseif ($checkPass==true)
        {
            
        $stmt = $this->connect()->prepare("SELECT * FROM USERS WHERE users_uid=? OR email=? AND pass=?;");
        if (!$stmt->execute(array($uid,$uid, $password ))) {
            $stmt = null;
            header("Location:../forma.php?error=stmtfailed");
            exit();
        }
        if($stmt->rowCount() ==0){
            $stmt = null;
            header("location:../forma.php?error=usernotfound");
            exit();  
        }
       
       }
       $user=$stmt->fetchAll(PDO::FETCH_ASSOC);
       session_start();
       $_SESSION["userid"]=$user[0]["users_id"];
       $_SESSION["usersuid"]=$user[0]["users_uid"];
       $stmt = null;

        }
       
    }
