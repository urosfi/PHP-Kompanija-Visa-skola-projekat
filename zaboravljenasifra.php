<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RecoveryPassword</title>
</head>
<body style="background-color:aqua">
    <div style="text-align: center;background-color:aquamarine;border:1px solid black">
    <h1 >Dobrodosli na stranicu za resetovanje vase lozinke!</h1>
    <h2>Molim vas unesite vas email za resetovanje lozinke!</h2>
    <form action="include/zaboravljenasifra.inc.php" method="post">
         Email<br><input type="text" name="email" placeholder="Email"><br><br>
         <input type="submit" name="posalji" value="Posalji">
    </form>
    <?php
   if(isset($_GET["uspesno"])){
       if($_GET["uspesno"]=="uspesno")
       {
            echo "<h2>Uspesno poslato! <br>Proverite vas email!</h2>";

       }

   }
    ?>
   

    
    </div>
    
    
</body>
</html>