<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New password</title>
</head>
<body style="background-color:aquamarine">
<?php
$validator = $_GET["validator"];

$token = $_GET["token"];
if (ctype_xdigit($validator) !== false && ctype_xdigit($token) !== false) {
    echo "error";
} else {
    ?>
        <div style="width: 400px;margin:auto;margin-top:70px;text-align:center;border:1px solid black;background-color:aqua">
    <h1>Please enter new password</h1>
    <form action="include/newpassword.inc.php" method="post">
     <input type="hidden" name="validator" value="<?php echo $validator; ?> " >
     <input type="hidden" name="token"  value="<?php  echo $token; ?> ">
      <br><input type="text" name="NewPass" placeholder="New password"><br><br>
      <br><input type="text" name="RptPass" placeholder="Repeat new password"><br><br>
      <input type="submit" name="posalji-novu-sifru" value="Posalji"><br><br>
    </form>
    </div>


</body>
</html>
<?php }?>


