<?php
class Signup extends Db
{
   public function checkuser($uid,$email){
        $stmt = $this->connect()->prepare('SELECT users_uid FROM USERS where users_uid = ? OR email= ? ;' );

        if(!$stmt->execute(array($uid,$email))){
            $stmt = null;
            header("Location:../forma.php?error=stmtfailedd");
            exit();
        }
       
        if($stmt->rowCount() >0){
            $resultCheck = false;
        }
            else{
                $resultCheck=true;
                }
        return $resultCheck;    
       }
    protected function setUser($uid, $password, $email)
    {
        $stmt = $this->connect()->prepare("INSERT INTO USERS (users_uid	,pass,email) VALUES (?,?,?);");
        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

        if (!$stmt->execute(array($uid, $hashedPwd, $email))) {
            $stmt = null;
            header("Location:../forma.php?error=stmtfailed");
            exit();
        }

    }
}