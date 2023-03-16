<!DOCTYPE html>
<html lang="en">
    <head>
       
        <title>Dodavanje novog vozila kompaniji</title>
    </head>
    <body> <div class="nav-meni"><a href="PretragaPDO.php" id="boja">Pretraga zaposlenog</a>
               <a href="unospodatakaPDO.php" id="boja">Unos podataka zaposlenog</a> 
               <a href="BrisanjePDO.php" id="boja" >Brisanje podataka zaposlenog</a>
               <a href="dodajvozilo.php" id="boja" >Dodavanje novog vozila </a><br><br><br>
               <a href="PROCEDURE.php" >Proverite dali zaposleni ima vozilo</a>
               <a href="svizaposleniprocedura.php">Podaci svih zaposlenih</a>
               <a href="transakcijee.php">Dodelite vozilo zaposlenom</a>
               <a href="logout.php" id="logboja" >Logout</a>
                  <h1 style="text-align:center; background-color: black;color:aliceblue">DODAVANJE NOVOG VOZILA KOMPANIJE</h1>

            </div>
                <style>
                        body{
                    background-image: url("auto.jpg");
                    background-repeat: no-repeat;
                    background-size:cover;
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
        <form style="text-align:center ;border-radius:20px;border:solid black 3px;width:400px;margin:auto;background-color:yellow" action="" method="POST" >
            <label for="Dodavanje Vozila">
                <span><h3 style="color:white;background-color:black;">UNESITE PODATKE VOZILA</h3></span><br>
                TIP VOZILA<br><input type="text" name="TipVoz" maxlength="50"><br><br>
                MARKA VOZILA<br><input type="text" name="MarkaVoz" maxlength="20"><br><br>
                DATUM REGISTRACIJE<br><input type="date" name="DatReg" ><br><br>
                REGISTARSKI BROJ VOZILA<br><input type="text" name="RegBr" maxlength="8"><br><br>
                <input type="submit" value="Dodaj" name="Dodaj">
            </label><br><br>
        </form> 
<?php
$servername = "localhost";//ime servera
$username = "root";//ime korisnika servera
$password = "";//sifra korisnika servera

try {
  $conn = new PDO("mysql:host=$servername;dbname=kompanija", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  
$sql = "INSERT INTO vozilo (Tip_vozila , Marka_vozila , Dat_reg , Reg_Br) VALUES (:Tip_vozila , :Marka_vozila , :Dat_reg , :Reg_Br)";
$stmt = $conn->prepare($sql);
  $stmt->bindParam(':Tip_vozila', $Tip_vozila);
  $stmt->bindParam(':Marka_vozila', $Marka_vozila);
  $stmt->bindParam(':Dat_reg', $Dat_reg);
  $stmt->bindParam(':Reg_Br', $Reg_Br);

 if(isset( $_POST["Dodaj"])) {
 
     
          $Tip_vozila = $_POST["TipVoz"];
          $Marka_vozila = $_POST["MarkaVoz"];
          $Dat_reg =$_POST["DatReg"];
          $Reg_Br = $_POST["RegBr"];
          if($Tip_vozila != "" && $Marka_vozila !="" && isset($Dat_reg)  &&  $Reg_Br !="" ){
          $stmt->execute();
      echo    "<p> <h1  style=text-align:center;color:white;> Uspesno ste dodali novo vozilo u kompaniju!! </h1> </p>";
      var_dump($Dat_reg);
}
else{
      echo "<p> <h1  style=text-align:center;color:white;> Niste dodali novo vozilo u kompaniju! </h1> </p>";
      var_dump($Dat_reg);
      var_dump($Marka_vozila);
      var_dump($Reg_Br);
     
}
}


    // if($_POST["JMBG"] !="")
    // {
    //     $JMBG = $_POST["JMBG"];
    //     $stmt->execute();
    //     $result = $stmt->fetchAll();
    //     foreach($result as $row)
    //     {
    //       echo "Maticni broj: ".$row['JMBG']."<br>";
    //       echo "ime: ".$row['ime']."<br>";
    //       echo "prezime: ". $row['prezime']."<br>";
    //       echo "radna_pozicija: ". $row['radna_pozicija']."<br>";
    //       echo "mesto_prebivalista: ". $row['mesto_prebivalista']."<br>";
    //       echo "telefon: ".$row['telefon']."<br>";    
    //     }              
    // }
    $con=null;
}

 catch(PDOException $e) {
  echo "Konekcija na bazu nije uspela! " . $e->getMessage();
}
 ?>
        