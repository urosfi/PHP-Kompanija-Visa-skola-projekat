<!-- fajl ka kojem saljemo podatke iz forme  login.inc.php-->
<?php
if(isset($_POST["posalji"]))
{
    // uzimamo podatke iz forme preko imena inputa i smestamo u promenjive
    $uid = $_POST["uid"];
    $password = $_POST["password"];
    

}
//treba da naapravimo signupContr class
include "../classes/db.classes.php";
include "../classes/login.classes.php";
include "../classes/login-contr.classses.php";

$login = new LoginContr($uid,$password);
//rukovaoc greskama i sign up
$login->Loginuser();
// vracanje na frontend stranu
header("Location: ../PretragaPDO.php");