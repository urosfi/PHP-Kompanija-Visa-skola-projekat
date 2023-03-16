<?php
class LoginContr extends Login
{

    private $uid;
    private $password;
 

    public function __construct($uid, $password)
    {
        $this->uid = $uid;
        $this->password = $password;
      
    }
    public function Loginuser(){
        if($this->emptyinput()==false)
        {
              header("Location:../forma.php?error=emptyinput");
              exit();
        }
        $this->GetUser( $this->uid, $this->password);
      

    }

    private function emptyinput()
    {
        
        if (empty($this->uid) || empty($this->password) ) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
  

}