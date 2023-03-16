 <!DOCTYPE html>
<html lang="en">
    <head>
       
        <title>Brisanje podataka zaposlenog</title>
    </head>
    <body>
    <div class="nav-meni"><a href="PretragaPDO.php" id="boja">Pretraga zaposlenog</a>
               <a href="unospodatakaPDO.php" id="boja">Unos podataka zaposlenog</a> 
               <a href="BrisanjePDO.php" id="boja" >Brisanje podataka zaposlenog</a>
               <a href="dodajvozilo.php" id="boja" >Dodavanje novog vozila </a><br><br><br>
               <a href="PROCEDURE.php" >Proverite dali zaposleni ima vozilo</a>
               <a href="svizaposleniprocedura.php">Podaci svih zaposlenih</a>
               <a href="transakcijee.php">Dodelite vozilo zaposlenom</a>
               <a href="logout.php" id="logboja" >Logout</a>
                  <h1 style="text-align:center; background-color: black;color:aliceblue">OBRISITE ZAPOSLENOG</h1>

            </div>
            <style>
                        body{
                    background-image: url("21.jpg");
                    background-repeat: no-repeat;
                    background-size: cover;
                  }
                 
                 .nav-meni{
                    text-align: center;
                    margin-top: 20px;
                   
                 }   
                .nav-meni a{
                    margin: 15px;
                    padding: 10px;
                    border: solid black 3px;
                    background-color: yellow;
                    text-decoration: none;
                    color: black;
                 }
                 .nav-meni a:hover { 
                   
                    background-color: red;
                    
                 }
                 #boja:hover{
                    background-color: red;
                 }
                 #boja{
                        color: white;
                        background-color: green;
                        border: 3px solid black;
                 }
                 #logboja{
                    color:black;
                    background-color:turquoise;
                    border:2px solid black;
                    border-radius:15px;

                 }
                 #logboja:hover{
                    background-color: blue;
                 }
                </style>
       <br><br>
        <form style="text-align:center;width:300px;margin:auto;background-color:yellow;border:2px solid black;border-radius:15px" action="" method="POST" >
            <label for="JMBG">
                <span style="color:black;"> <b>UNESITE JMBG ZAPOSLENOG KOJI ZELITE DA OBRISETE</b></span><br><br>
                <input type="text" name="JMBG" maxlength="13"><br><br>
                <input type="submit" value="Izbrisi" name="izbrisi">
            </label><br><br> 
        </form> 

<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=kompanija", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "DELETE FROM zaposleni WHERE JMBG= :JMBG ;";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':JMBG', $JMBG);
  if(isset( $_POST["izbrisi"]))
  {
      if($_POST["JMBG"] !="") {
          $JMBG = $_POST["JMBG"];
          $stmt->execute();
          $num_deleted_rows = $stmt->rowCount();
          if($num_deleted_rows>0)
          {
            echo "<h1 style=text-align:center>Uspesno ste obrisali zaposlenog iz baze podataka</h1>";
          }
          else {
            echo "<h1 style=text-align:center>Nema zaposlenog  pod tim JMBG -om!</h1>";
          }
          
      }
  
     $con=null;
  }

} catch(PDOException $e) {
  echo "Konekcija na bazu nije uspela! " . $e->getMessage();
}

?>
