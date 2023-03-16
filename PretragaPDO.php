<!DOCTYPE html>
<html lang="en">
    <head>
       
        <title>Pretraga podataka zaposlenog</title>
    </head>
    <body> <div class="nav-meni"><a href="PretragaPDO.php" id="boja">Pretraga zaposlenog</a>
               <a href="unospodatakaPDO.php" id="boja">Unos podataka zaposlenog</a> 
               <a href="BrisanjePDO.php" id="boja" >Brisanje podataka zaposlenog</a>
               <a href="dodajvozilo.php" id="boja" >Dodavanje novog vozila </a><br><br><br>
               <a href="PROCEDURE.php" >Proverite dali zaposleni ima vozilo</a>
               <a href="svizaposleniprocedura.php">Podaci svih zaposlenih</a>
               <a href="transakcijee.php">Dodelite vozilo zaposlenom</a>
               <a href="logout.php" id="logboja" >Logout</a>
                
              
                  <h1 style="text-align:center; background-color: black;color:aliceblue"> PRONADJITE ZAPOSLENOG</h1>

            </div>
            <style>
                        body{
                    background-image: url("1.jpg");
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
                <span style="color:black;"><b>UNESITE JMBG ZAPOSLENOG</b></span><br><br>
                <input type="text" name="JMBG" maxlength="13"><br><br>
                <input type="submit" value="Pronadji" name="pronadji">
            </label><br><br>
        </form> 
<?php
$servername = "localhost";//ime servera
$username = "root";//ime korisnika servera
$password = "";//sifra korisnika servera

try {
  $conn = new PDO("mysql:host=$servername;dbname=kompanija", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT * FROM zaposleni WHERE JMBG= :JMBG";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':JMBG', $JMBG);
if(isset( $_POST["pronadji"]))
{
    if($_POST["JMBG"] !="")
    {
        $JMBG = $_POST["JMBG"];
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach($result as $row)
        {
          echo "Maticni broj: ".$row['JMBG']."<br>";
          echo "ime: ".$row['ime']."<br>";
          echo "prezime: ". $row['prezime']."<br>";
          echo "radna_pozicija: ". $row['radna_pozicija']."<br>";
          echo "mesto_prebivalista: ". $row['mesto_prebivalista']."<br>";
          echo "telefon: ".$row['telefon']."<br>";    
        }     
        $con=null;         
    }else{

      echo "<p> <h2  style=text-align:center> Ne postoji zaposleni pod tim JMBG -om! </h2> </p>";
    }
   
}

} catch(PDOException $e) {
  echo "Konekcija na bazu nije uspela! " . $e->getMessage();
}
 ?>
        