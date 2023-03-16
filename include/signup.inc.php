<!-- fajl koji preuzima podatke iz forme signup.inc.php -->
<?php
if(isset($_POST["posalji"]))
{
    // uzimamo podatke iz forme preko imena inputa i smestamo u promenjive
    $uid = $_POST["uid"];
    $password = $_POST["password"];
    $repeatpsw = $_POST["repeatpsw"];
    $email = $_POST["email"];

}
//treba da naapravimo signupContr class
include "../classes/db.classes.php";
include "../classes/signup.classes.php";
include "../classes/signupContr.classes.php";

$Signup = new SignupContr($uid,$password,$repeatpsw,$email);
//rukovaoc greskama i sign up
$Signup->signupuser();
// vracanje na frontend stranu
header("Location: ../forma.php");