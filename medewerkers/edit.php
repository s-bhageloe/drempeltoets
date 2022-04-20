<?php
include_once '../database.php';

// Connection made
$db = new DB('localhost', 'root', '', 'hotel_ter_duin', 'utf8mb4'); //hier zet je de waardes($..) constructor

$reserveringklantid = $db->selectSpecificKlant($_GET['reserveringklantid']);

if(isset($_POST["submit"])){
    //fieldnames - input fields
    $fieldnames = ['klantnummer', 'naam', 'adres', 'plaats', 'postcode', 'telefoonnummer', 'beginDatum', 'eindDatum', 'kamertype'];

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

        
        $db->updateKlant($_GET['reserveringklantid'], $_POST['naam'], $_POST['adres'], $_POST['plaats'], $_POST['postcode'], $_POST['telefoonnummer'], $_POST['beginDatum'], $_POST['eindDatum'], $_POST['kamertype']);
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
        <input type="hidden" name="klantnummer" value="<?php echo $reserveringklantid['klantnummer'];?>">
        <input type="text" name="naam" value="<?php echo $reserveringklantid['naam'];?>">
        <input type="text" name="adres" value="<?php echo $reserveringklantid['adres'];?>">
        <input type="text" name="plaats" value="<?php echo $reserveringklantid['plaats'];?>">
        <input type="text" name="postcode" value="<?php echo $reserveringklantid['postcode'];?>">
        <input type="text" name="telefoonnummer" value="<?php echo $reserveringklantid['telefoonnummer'];?>">
        <input type="text" name="beginDatum" value="<?php echo $reserveringklantid['beginDatum'];?>">
        <input type="text" name="eindDatum" value="<?php echo $reserveringklantid['eindDatum'];?>">
        <input type="text" name="kamertype" value="<?php echo $reserveringklantid['kamertype'];?>">
        <button type="submit" name="submit">Edit</button>
    </form>
</body>
</html>