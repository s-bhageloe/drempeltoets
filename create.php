<?php
include_once 'database.php';

// Connection made
$db = new DB('localhost', 'root', '', 'hotel', 'utf8mb4'); //hier zet je de waardes($..) constructor

if(isset($_POST["submit"])){
    //fieldnames - input fields
    $fieldnames = ['klant'];

    //Var boolean
    $err = false;

    //Looping
    foreach ($fieldnames as $fieldname) {
        //if fieldname is empty -> $err = true
        if (empty($_POST[$fieldname])) {
            $err = true;
        }
    }


    if ($err) {
        echo "All fields are required!";
    } else {
        $name = $_POST['klant'];
        
        $db->createKlant($klantnummer, $naam, $adres, $plaats, $postcode, $telefoonnummer, $begin_datum, $eind_datum);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add klant</title>
</head>
<body>
<form class="formRes" method="post" action="create.php">
           <br> <div>
                <input type="text" name="username" placeholder="Naam" required/>
                <input type="text" name="adres" placeholder="Adres" required/> <br>
            </div>  <br>
            <div> 
                <input type="date" name="date" placeholder="Begin datum" required/>
                <input type="date" name="date" placeholder="Eind datum" required/> <br>
            </div> <br>
            <div>
                <select id="keuze_verblijf" name="keuze_verblijf" required>
                  <option value="">Plaats</option>
                  <option value="Amsterdam">Amsterdam</option>
                  <option value="Rotterdam">Rotterdam</option>
                  <option value="Scheveningen">Scheveningen</option>
                  <option value="Den Haag">Den Haag</option>
                  <option value="Geertruide">Geertruide</option>
                  <option value="Ede">Ede</option>
                  <option value="Tiel">Tiel</option>
                  <option value="Arnhem">Arnhem</option>
                  <option value="Bergen">Bergen</option>
                  <option value="Hoofddorp">Hoofddorp</option>
                </select>
                <input type="text" name="postcode" placeholder="Postcode" required/>
              </div> <br>
              <input type="number" name="phonenumber" placeholder="Telefoonnummer" required/>
              </div> <br>
                <button type="submit" name="submit" class="btn btn-primary">Reserveer</button><br> <br> <br>
        </form>
</body>
</html>