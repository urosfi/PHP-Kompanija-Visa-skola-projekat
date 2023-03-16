<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGNUP</title>
</head>
<body>
    <h1> Welcome!!! </h1>
    <div class="sve">

   <div class="SIGNUP">
    
    <p>Don 't have an account yet? Sign up here!</p>
    <h4 style="background-color: rgba(0, 0, 0, 0.998);color: white;">Sign Up</h4>
    <form action="/projekat/include/signup.inc.php" method="post">
        <input type="text"  name="uid" placeholder="Username"><br><br>
        <input type="password"  name="password" placeholder="Password"><br><br>
        <input type="password"  name="repeatpsw" placeholder="Repaeat password"><br><br>
        <input type="text"  name="email" placeholder="Email"><br><br>
        <button type="submit" name="posalji">Posalji</button>
    </form>
  </div>
  <div class="Login">
  
  <?php
  
if(isset($_GET["uspesnapromena"])){
       if($_GET["uspesnapromena"]=="uspesnapromena")
       {
      echo "<h3 style='color:red'>Uspesno ste promenili vasu sifru ! <br>Molim vas ulogujte se!</h3>";

       }

   }
   if(isset($_GET["error"])){
    if($_GET["error"]=="usernotfound")
    {
   echo "<h3 style='color:red'>Ne postoji korisnik sa tim podacima! <br>Molimo pokusajte ponovo!</h3>";

    }

}

    ?>
    
    <p>Already have account? Please Login here!</p>
    <h4 style="background-color: rgb(0, 0, 0);color: white;">Login</h4>
    <form action="/projekat/include/login.inc.php" method="post">
        <input type="text"  name="uid" placeholder="Username"><br><br>
        <input type="password"  name="password" placeholder="Password"><br><br>
        <button type="submit" name="posalji">Posalji</button>
    </form>
  </div>
  
  <!-- ovde kreiramo formu koja ce zapoceti recovery proces -->
  <a style="display:block;color:black" href="zaboravljenasifra.php"><h1>Forgot your password???</h1></a>
</div>


<style>
    body{
        background-image: url("Web_150DPI-20190927_10th_Floor_Conference_Room_2_v1-1120x630.jpg");
         background-size:cover;
    }
    .SIGNUP{
        display: inline-block;
  border: 1px solid rgb(2, 2, 2);
  padding: 1rem 1rem;
  vertical-align: middle;
  height: 300px;
  background-color: rgba(0, 255, 255, 0.597);
    }
    .Login{
 
   margin: 50px;
  display: inline-block;
  border: 1px solid rgb(0, 0, 0);
  padding: 1rem 1rem;
  vertical-align: middle;
  height: 300px;
  background-color: #f7e51e86;
    }
    .sve{
        border: 1px solid black;
  margin: 20px;
  padding:20px;
  text-align: center;
  background-color: rgba(128, 128, 128, 0.346);
  
    }
    h1{
        text-align: center;
        background-color: rgba(0, 0, 255, 0.637);
        color: white;
    }
    ::placeholder {
      color:black;
      opacity: 0.9;

    }
    




</style>
</body>
</html>