<?php

include_once '../database.php';


session_start();
if(!isset($_SESSION['gebruikersnaam'])) {
    // echo '<h1>Gebruiker is ingelogd</h1>';


    header('Location: loginMedewerkers.php');


}


print_r($_SESSION['gebruikersnaam']);
// else{
// Connection made
$db = new DB('localhost', 'root', '', 'hotel_ter_duin', 'utf8mb4'); //hier zet je de waardes($..) constructor

$reservering = $db->showReservering();


//     // User not loggedin
//     header('Location: overzicht_artikelen.php');
//     print "niet ingelogd";
// }


//Looping through array `users`
// foreach ($users as $user) {
//     echo $user["name"];
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- JQuery Datatables Plugin  -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
</head>
<body>
    <main>
    <main class="container mt-4 mb-4">
        <a class="btn btn-warning mr-2 btn-sm" href="logout.php">Log out</a>
        <table class="table table-striped" id="overzicht">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ReserveringsID</th>
                    <th scope="col">Naam</th>
                    <th scope="col">Adres</th>
                    <th scope="col">Plaats</th>
                    <th scope="col">Postcode</th>
                    <th scope="col">Telefoonnummer</th>
                    <th scope="col">Begin Datum</th>
                    <th scope="col">Eind Datum</th>
                    <th scope="col">Kamertype</th>
                    <th></th>
                    <th></th>

                </tr>
            </thead>
            <tbody> 
                <!-- users are rows and user is a single row  -->
                <?php foreach ($reservering as $reserveer): ?>
                    <tr>
                        <td><?php echo $reserveer["reserveringklantid"]; ?></td>
                        <td><?php echo $reserveer["naam"];?></td>
                        <td><?php echo $reserveer["adres"];?></td>
                        <td><?php echo $reserveer["plaats"];?></td>
                        <td><?php echo $reserveer["postcode"];?></td>
                        <td><?php echo $reserveer["telefoonnummer"];?></td>
                        <td><?php echo $reserveer["beginDatum"];?></td>
                        <td><?php echo $reserveer["eindDatum"];?></td>
                        <td><?php echo $reserveer["kamertype"];?></td>
                        <td class="noExl">
                            <a class="btn btn-primary mr-2 btn-sm" href="edit.php?reserveringklantid=<?php echo $reserveer["reserveringklantid"]; ?>">Edit</a>
                        </td>      
                        <td class="noExl">
                            <a class="btn btn-danger mr-2 btn-sm" href="delete.php?reserveringklantid=<?php echo $reserveer["reserveringklantid"]; ?>">Delete</a>
                        </td> 
                    </tr>
                <?php endforeach; ?>     
            </tbody>
        </table>
    </main>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

    <script>
        $('#overzicht').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'print'
        ]
    } );
    </script>
</body>
</html>