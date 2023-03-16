<!DOCTYPE html>
<html lang="en">
    <head>
       
        <title>Dodela vozila</title>
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
                  <h1 style="text-align:center; background-color: black;color:aliceblue">Dodelite vozilo zaposlenom</h1>

            </div>
            <style>
                        body{
                    background-image: url("auto.jpg");
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
        <form style="text-align:center;border:1px solid  black;width:250px;margin:auto;background-color:aqua" action="" method="POST" >
            <label for="jmbg">
            <h3>JMBG</h3> <input type="text" name="jmbg"  ><br style="color:aliceblue;background-color:black;">
            <h3>Registarski broj</h3> <input type="text" name="regbroj"  ><br style="color:aliceblue;background-color:black;"><br>
                <input type="submit" value="Dodeli auto" name="dodeli">
            </label><br><br>
        </form> 
<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=kompanija", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Uspesna konekcija na bazu!";

    $conn->beginTransaction();
    $sql = "SELECT JMBG FROM zaposleni WHERE JMBG=:jmbg";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":jmbg", $jmbg);
    if(isset($_POST['dodeli']))
    {
        $jmbg = $_POST['jmbg'];
        
    }
    
    $stmt->execute();
    $num = $stmt->rowCount();
 
    $JMBG = $stmt->fetchColumn();
    if($JMBG==0 && $JMBG !=""){
        echo "<h1 style=text-align:center;color:white> Nema radnika sa unetim JMBG om!! </h1>";
    }
    $stmt->closeCursor();

    
    $sql = "SELECT id_vozila FROM vozilo WHERE Reg_Br=:Reg_Br";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":Reg_Br", $Reg_Br);
    if(isset($_POST['dodeli']))
    {
        
    $Reg_Br = $_POST['regbroj'];
        
    }
    
    var_dump($Reg_Br);
    
    $stmt->execute();
    $num = $stmt->rowCount();
   
    $id_vozila= (int)$stmt->fetchColumn();//selektovace id i dobavice ga u jednu kolonu
    if($id_vozila==0 && $id_vozila =""){
        echo "<h1 style=text-align:center;color:white> Nema vozila sa tim registarskim brojem! </h1>";
    }
    $stmt->closeCursor();

    $sql = "SELECT * FROM zaposleni_vozilo WHERE zaposleni_jmbg=:zaposleni_jmbg ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":zaposleni_jmbg", $JMBG);
    $stmt->execute();
    if($stmt->rowCount()>0){
        echo "<h1 style=text-align:center;color:white> Radnik vec ima vozilo</h1>";
        exit();
    }
  else{

    $sql = "INSERT INTO  zaposleni_vozilo (zaposleni_jmbg,vozilo_id,Datum_izdavanja) values (:zaposleni_jmbg,:vozilo_id,:Datum_izdavanja)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":zaposleni_jmbg", $jmbg);
    $stmt->bindParam(":vozilo_id",$id_vozila );
    $Datum_izdavanja = Date("Y.m.d");
    $stmt->bindParam(":Datum_izdavanja",$Datum_izdavanja);
    $stmt->execute();
    $conn->commit();
    if($jmbg  !="" && $Reg_Br !="" ){
  
    
        echo "<h1 style=text-align:center;color:white> Uspesno dodeljeno vozilo </h1>";
    } else{
        echo "<h1 style=text-align:center;color:white>Neuspesna dodela vozila <h1>";
    }
    
    $stmt->closeCursor();
    
    


  }


    
    
} catch(PDOException $e) {
    $conn->rollBack();//objekat klase exception cuvamo u $e
  echo "Konekcija na bazu nije uspela! " . $e->getMessage();
}
 ?>
        