<?php
include_once 'database.php';

// Connection made
$db = new DB('localhost', 'root', '', 'hotel_ter_duin', 'utf8mb4'); //hier zet je de waardes($..) constructor

if(isset($_POST["submit"])){
    print_r($_POST);
    //fieldnames - input fields
    $fieldnames = ['naam', 'adres', 'plaats', 'postcode', 'telefoonnummer', 'kamertype'];

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
        
        $db->createKlant($_POST['naam'], $_POST['adres'], $_POST['plaats'], $_POST['postcode'], $_POST['telefoonnummer'], $_POST['kamertype']);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Reserveren</title>
</head>
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
<form class="formRes" method="post" action="reserveren.php">
           <br> <div>
                <input type="text" name="naam" placeholder="Naam" required/>
                <input type="text" name="adres" placeholder="Adres" required/> <br>
            </div>  <br>
                    <!-- dropdown met kamers die naar database gestuurd worden -->
            <div>
                <select id="plaats" name="plaats" required> 
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
            </div> <br>
            <div>
            <select id="kamertype" name="kamertype" required> 
                  <option value="">Kamertype</option>
                  <option value="Gezin">Suite</option>
                  <option value="Twee persoons">Twee persoonskamer</option>
                  <option value="Een persoons">Een persoonskamer</option>
                </select>
            </div>
                <input type="text" name="postcode" placeholder="Postcode" required/>
              </div> <br>
              <input type="number" name="telefoonnummer" placeholder="Telefoonnummer" required/>
              </div> <br>
                <button type="submit" name="submit" class="btn btn-primary">Reserveer</button><br> <br> <br>
        </form>
</body>
</html>