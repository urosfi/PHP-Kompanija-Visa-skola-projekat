<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RecoveryPassword</title>
</head>
<body >
    <?php
$selector=$_GET["selector"];
$validator=$_GET["validator"];
if(empty($selector)|| empty($validator))
{
        echo "could not validate  your request";



}else 
{


    if(ctype_xdigit($selector) !==false && ctype_xdigit($validator) !==false ){
?>
  <form action="include/reset-password-inc.php" method="post">
    <input type="hidden" name="selector" value="<?php echo $selector; ?>;">
    <input type="hidden" name="validator" value="<?php echo $validator; ?>;">
         Nova sifra<br><input type="password" name="pwd"><br><br>
         Nova sifra<br><input type="password" name="pwd-repeat"><br><br>

         <input type="submit" name="reset-password-submit">
    </form>
 



<?php





    }
}
?>
    
  
    
    
    
</body>
</html>