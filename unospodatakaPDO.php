<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" >
        <title>Unos podatakaa zaposlenog</title>
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
                  <h1 style="text-align:center; background-color: black;color:aliceblue"> UNESITE PODATKE ZAPOSLENOG</h1>

            </div>
            <style>
                        body{
                    background-image: url("12.jpg");
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
        <form style="text-align:center;background-color:yellow;width:300px;margin:auto;border:1px solid black;border-radius:20px" action="" method="POST"  >
            <label for="JMBG">
                <span><b>JMBG zaposlenog</span><br>
                <input type="text" name="JMBG" maxlength="13">
            </label><br><br>
           
            <label for="ime">
                <span><b>Ime:</b></span><br>
                <input type="text" name="ime">
            </label><br><br>
            <label for="prezime">
                <span><b>Prezime:</b></span><br>
                <input type="text" name="prezime">
            </label><br><br>
            <label for="radna_pozicija">
                <span><b>Radna pozicija:</b></span><br>
                <input type="text" name="radna_pozicija">
            </label><br><br>
            <label for="mesto_prebivalista">
                <span><b>Mesto prebivalista:</b></span><br>
                <input type="text" name="mesto_prebivalista">
            </label><br><br>
            <label for="telefon">
                <span><b>Telefon</b></span><br>
                <input type="text" name="telefon">
            </label><br><br>
                <input type="submit" value="Unesi" name="unesi"><br>
        </form> 
<?php
$servername = "localhost";
$username = "root";
$password = "";

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "kompanija";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("neuspela konekcija: " . $conn->connect_error);
    } else {
        $conn = new PDO("mysql:host=$servername;dbname=kompanija", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Uspesna konekcija na bazu!";

        $stmt = $conn->prepare("INSERT INTO zaposleni (JMBG,ime,prezime ,radna_pozicija,mesto_prebivalista,telefon)VALUES  (:JMBG,:ime,:prezime ,:radna_pozicija,:mesto_prebivalista,:telefon)");
        $stmt->bindParam(':JMBG', $JMBG);
        $stmt->bindParam(':ime', $ime);
        $stmt->bindParam(':prezime', $prezime);
        $stmt->bindParam(':radna_pozicija', $radna_pozicija);
        $stmt->bindParam(':mesto_prebivalista', $mesto_prebivalista);
        $stmt->bindParam(':telefon', $telefon);

        if (isset($_POST['unesi'])) {
            if ($_POST['JMBG'] != "" && $_POST['ime'] != "" && $_POST['prezime'] != "" && $_POST['radna_pozicija'] != "" && $_POST['mesto_prebivalista'] != "" && $_POST['telefon'] != "") {
                $JMBG = $_POST['JMBG'];
                $ime = $_POST['ime'];
                $prezime = $_POST['prezime'];
                $radna_pozicija = $_POST['radna_pozicija'];
                $mesto_prebivalista = $_POST['mesto_prebivalista'];
                $telefon = $_POST['telefon'];
                $stmt->execute();
                echo "zaposleni je uspesno dodat u bazu podataka";

            } else
                echo "zaposleni nije dodat u bazu podataka";
        }
        $con = null;
    }



?>