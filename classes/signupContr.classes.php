<?php
class SignupContr extends Signup
{

    private $uid;
    private $password;
    private $repeatpsw;
    private $email;

    public function __construct($uid, $password, $repeatpsw, $email)
    {
        $this->uid = $uid;
        $this->password = $password;
        $this->repeatpsw = $repeatpsw;
        $this->email = $email;
    }

    public function signupuser(){
      if($this->emptyinput()==false)
      {
            header("Location:../forma.php?error=emptyinput");
            exit();
      }
      if($this->invalidUID()==false)
      {
            header("Location:../forma.php?error=nepravilanUsername");
            exit();
      }
      if($this->invalidEmail()==false)
      {
            header("Location:../forma.php?error=nepravilanEmail");
            exit();
      }
      if($this->pswOK()==false)
      {
            header("Location:../forma.php?error=nepravilnaSifra");
            exit();
      }
      if($this->passwordMatch()==false)
      {
            header("Location:../forma.php?error=SifreNisuIste");
            exit();
      }
      if($this->ProveriKorisnika()==false)
      {
            header("Location:../forma.php?error=KorisnikJevecregistrova");
            exit();
      }
        $this->setUser( $this->uid, $this->password, $this->email);
      

    }

    private function emptyinput()
    {
        
        if (empty($this->uid) || empty($this->password) || empty($this->repeatpsw) || empty($this->email)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    private function invalidUID()
    {
       
        if ( !preg_match("/^[a-z]+$/" , $this->uid))  {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    private function invalidEmail()
    {
       
        if (!filter_var($this->email,FILTER_VALIDATE_EMAIL)  ) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }


    private function pswOK()
    {
       
        if ( !ctype_alnum($this->password) )  {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function passwordMatch()
    {
      
        if ( $this->password !==$this->repeatpsw)  {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    
    private function ProveriKorisnika()
    {
      
        if (!$this->checkuser($this->uid,$this->email))  {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    
  

}