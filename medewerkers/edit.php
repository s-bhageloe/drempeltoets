<?php
include_once '../database.php';

// Connection made
$db = new DB('localhost', 'root', '', 'hotel', 'utf8mb4'); //hier zet je de waardes($..) constructor

$klantnummer = $db->selectSpecificKlant($_GET['klantnummer']);

if(isset($_POST["submit"])){
    //fieldnames - input fields
    $fieldnames = ['klantnummer'];

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
        $naam = $_POST['naam'];
        $adres = $_POST['adres'];
        $plaats = $_POST['plaats'];
        $postcode = $_POST['postcode'];
        $telefoonnummer = $_POST['telefoonnummer'];
        $begin_datum = $_POST['begin_datum'];
        $eind_datum = $_POST['eind_datum'];
        
        $db->updateKlant($_GET['klantnummer'], $naam, $adres, $plaats, $postcode, $telefoonnummer, $begin_datum, $eind_datum);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit reservering</title>
</head>
<body>
    <form action="" method="post">
        <input type="hidden" name="klantnummer" value="<?php echo $klantnummer['klantnummer'];?>">
        <input type="text" name="naam" value="<?php echo $klantnummer['naam'];?>">
        <input type="text" name="adres" value="<?php echo $klantnummer['adres'];?>">
        <input type="text" name="plaats" value="<?php echo $klantnummer['plaats'];?>">
        <input type="text" name="postcode" value="<?php echo $klantnummer['postcode'];?>">
        <input type="text" name="begin_datum" value="<?php echo $klantnummer['begin_datum'];?>">
        <input type="text" name="eind_datum" value="<?php echo $klantnummer['eind_datum'];?>">
        <button type="submit" name="submit">Edit</button>
    </form>
</body>
</html>