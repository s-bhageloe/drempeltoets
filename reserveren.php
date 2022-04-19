<?php
include_once 'database.php';

// Connection made
$db = new DB('localhost', 'root', '', 'hotel', 'utf8mb4'); //hier zet je de waardes($..) constructor

if(isset($_POST["submit"])){
    //fieldnames - input fields
    $fieldnames = ['reservering'];

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
        $name = $_POST['reservering'];
        
        $db->createReservering($beginDatum, $eindDatum);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand/logo -->
  <a class="navbar-brand" href="index.php">
    <img src="hotel.jpg" alt="logo" style="width:40px;">
  </a>
  
  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="reserveren.php">Reserveer hier!</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="medewerkers/loginMedewerkers.php">Inloggen medewerkers</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="contact.php">Contactpagina</a>
    </li>
  </ul>
</nav>

  <div id="horizontal">
    <div class="bar">
  </div>


          <form class="formRes" method="post" action="reservering.php">
           <br> <div>
                <input type="text" name="username" placeholder="Naam" required/>
                <input type="text" name="adres" placeholder="Adres" required/> <br>
            </div>  <br>
            <div> 
                <input type="date" name="date" placeholder="Begin datum" required/>
                <input type="date" name="duur" placeholder="Eind datum" required/> <br>
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