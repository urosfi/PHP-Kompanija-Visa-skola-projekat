<!DOCTYPE html>
<html lang="en">
    <head>
       
        <title>Proverite dali zaposleni koristi vozilo</title>
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
                  <h1 style="text-align:center; background-color: black;color:aliceblue"> PROVERITE DA LI ZAPOSLENI IMA VOZILO</h1>

            </div>
            <style>
                        body{
                    background-image: url("22.jpg");
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
        <form style="text-align:center;background-color:yellow;width:300px;margin:auto;border:1px solid black;border-radius:20px" action="" method="POST" >
            <label for="jmbg">
                <span style="color:black;">JMBG </span><br><br>
                <input type="text" name="jmbg" maxlength="13"><br><br>
                <input type="submit" value="Pronadji" name="pronadji"><br>
            </label><br><br>
        </form> 
<?php
$servername = "localhost";//ime servera
$username = "root";//ime korisnika servera
$password = "";//sifra korisnika servera

try {
    $conn = new PDO("mysql:host=$servername;dbname=kompanija", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
    
    $sql1 = "DROP PROCEDURE IF EXISTS get_vozilo_id";
    $sql2 = "CREATE PROCEDURE get_vozilo_id(
        in jmbg CHAR(13), out vozilo char(100))
        BEGIN
            DECLARE voz char;
            SELECT vozilo_id INTO voz FROM zaposleni_vozilo WHERE zaposleni_jmbg = jmbg;
           SELECT Reg_Br INTO vozilo FROM vozilo WHERE  voz= id_vozila;
        END;
        ";
    $conn->exec($sql1);
    $conn->exec($sql2);

   
    $sql3 = "CALL get_vozilo_id(:jmbg, @vozilo_id)";
    $stmt = $conn->prepare($sql3);
    $stmt->bindParam(":jmbg", $jmbg);
    if(isset($_POST['pronadji']))
    {
        $jmbg = $_POST['jmbg'];

    
   
    $stmt->execute();
    $stmt->closeCursor();
    
     $stmt = $conn->query("SELECT @vozilo_id as vozilo_id");//u vozilo id smesti vozilo id
    foreach($stmt as $row){
        if($row['vozilo_id']){
                echo "<p style='text-align:center;color:white;background-color:black;font-size:30px'> Zaposleni sa maticnim brojem(JMBG):  <span style='color:red;background-color:white'border:1px solid black>: " .$jmbg ."</span> Koristi vozilo registarskih oznaka : <span style='color:red;background-color:white'border:1px solid black>" .$row['vozilo_id'];
        }else{
                echo "<h1 style=text-align:center> Zaposleni sa " . $jmbg . " ne koristi vozilo! </h1>";
        }
       
    }
}
    $conn=null;

} catch(PDOException $e) {
  echo "Konekcija na bazu nije uspela! " . $e->getMessage();
}
 ?>
        