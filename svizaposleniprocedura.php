<!DOCTYPE html>
<html lang="en">
    <head>
       
        <title>Podaci svih zaposlenih</title>
    </head>
    <body> <div class="nav-meni"><a href="PretragaPDO.php" id="boja">Pretraga zaposlenog</a>
               <a href="unospodatakaPDO.php" id="boja">Unos podataka zaposlenog</a> 
               <a href="BrisanjePDO.php" id="boja" >Brisanje podataka zaposlenog</a>
               <a href="dodajvozilo.php" id="boja" >Dodavanje novog vozila </a><br><br><br>
               <a href="PROCEDURE.php" >Proverite dali zaposleni ima vozilo</a>
               <a href="svizaposleniprocedura.php">Podaci svih zaposlenih</a>
               <a href="transakcijee.php">Dodelite vozilo zaposlenom</a>
               <a href="logout.php" id="logboja" >Logout</a>
                  <h1 style="text-align:center; background-color: black;color:aliceblue"> PODACI SVIH ZAPOSLENIH</h1>

            </div>
            <style>
                        body{
                    background-color: aquamarine;
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
                 table, td {
                 border: 2px solid black;
                 border-collapse: collapse;
                 padding: 5px;
                 background-color: white;
                 margin: 10px;
                }
                th{
                    background-color: red;
                    border: 3px solid black;
                }
                </style>
       <br><br>
 
<?php
$servername = "localhost";
$username = "root";
$password = "";

    try{
        $conn = new PDO("mysql:host=$servername;dbname=kompanija", $username, $password);
        
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
    $sql1 = "DROP PROCEDURE IF EXISTS spisak_zaposlenih";
    $sql2 = "CREATE PROCEDURE spisak_zaposlenih() BEGIN SELECT * FROM zaposleni  ;END;";
    $conn->exec($sql1);
    $conn->exec($sql2);
   
    $sql3 = "CALL spisak_zaposlenih()";
    $stmt= $conn->query($sql3);
    ?>
    
    <div style="display:flex;text-align:center;justify-content:space-evenly; ">
    <div style="justify-content:flex-start">
     <table> 
        <tr><h1 style="text-align:center;background-color:coral;margin:10px">PODACI SVIH ZAPOSLENIH</h1></tr>
        <tr> 
        <th>JMBG</th>
        <th>IME</th>
        <th>PREZIME</th>
        <th>RADNA POZICIJA</th>
        <th>MESTO PREBIVALISTA</th>
        <th>TELEFON</th>
         </tr>
    <?php foreach ($stmt as $row) { ?>
         <tr> 
         <td><?php echo $row["JMBG"]; ?></td>
         <td><?php echo $row["ime"] ;?></td>
         <td><?php echo $row["prezime"] ;?></td>
         <td><?php echo $row["radna_pozicija"]; ?> </td>
         <td><?php echo $row["mesto_prebivalista"]; ?></td>
         <td><?php echo $row["telefon"];}; ?></td>
          </tr>
         </table>
         </div>
    <?php
    

    $stmt->closeCursor();
    $sql1 = "DROP PROCEDURE IF EXISTS spisak_vozila";
    $sql2 = "CREATE PROCEDURE spisak_vozila() BEGIN SELECT * FROM vozilo  ;END;";
    $conn->exec($sql1);
    $conn->exec($sql2);
    $sql3 = "CALL spisak_vozila()";
    $stmt= $conn->query($sql3);

    ?>


    <div style="justify-content:flex-start">
<table> 

    
<tr>
    <h1 style="text-align:center;background-color:coral;margin:10px">PODACI SVIH VOZILA</h1>
</tr>
<tr> 
<th>TIP VOZILA</th>
<th>MARKA VOZILA</th>
<th>DATUM REGISTRACIJE</th>
<th>REGISTARSKI BROJ</th>
 </tr>
       <tr> 
	 <?php foreach ($stmt as $row) { ?>
	 <td> <?php echo $row["Tip_vozila"]; ?> </td>
	 <td> <?php echo $row["Marka_vozila"]; ?> </td>
	 <td> <?php echo $row["Dat_reg"]; ?> </td>
	 <td> <?php echo $row["Reg_Br"]; ?> </td>
      </tr>



<?php }?>


</table>


<?php
$stmt = $conn->query("SELECT Reg_Br,zaposleni_jmbg FROM vozilo, zaposleni_vozilo WHERE id_vozila = vozilo_id ");
     $rows = $stmt->fetchAll();
     ?>
    </div></div>
<div style="margin:auto;width:500px;text-align:center;">
<table style="margin:auto;width:500px">
    <h1 style="text-align:center;background-color:coral;margin:10px">Vozila koja su trenutno dodeljena radnicima</h1>
<tr> 
<th>JMBG Radnika</th>
<th>Registarski broj </th>

 </tr>
<tr> 
<?php foreach ($rows as $row) { ?>
<td> <?php echo $row["zaposleni_jmbg"]; ?> </td>
<td> <?php echo $row["Reg_Br"]; ?> </td>
 </tr>
 </table>
 </div>
 </div>
 
   <?php
     }
    }catch(PDOException $e){
     
    
    }
?>

