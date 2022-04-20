<?php
class DB{
    private $host;
    private $user;
    private $pass;
    private $db;
    private $charset;
    private $pdo;

    public function __construct($host, $user, $pass, $db, $charset){
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->db = $db;
        $this->charset = $charset; 
        
     

        try{
            $dsn = 'mysql:host='. $this->host.';dbname='.$this->db.';charset='.$this->charset;
            $this->pdo = new PDO($dsn, $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->pdo;
        }
        catch(\PDOException $e){
            echo "Connection Failed: ".$e->getMessage();
        }

      
    }

        /**
     * Preparing the query to prevent sql injections
     * @return the rows from table `account`
     */
    public function showReservering(){
        try {
            $query = "SELECT reservering_klant.reserveringklantid, naam, adres, kamernummer, plaats, postcode, telefoonnummer, beginDatum, eindDatum, kamertype FROM reservering_klant
                    INNER JOIN klantgegevens
                        ON reservering_klant.klantgegevensid = klantgegevens.klantgegevensid
                    INNER JOIN kamer
                        ON reservering_klant.kamerid = kamer.kamerid";
            
            $prep = $this->pdo->prepare($query);

            $prep->execute();

            $rows = $prep->fetchAll(PDO::FETCH_ASSOC);
            
            return $rows;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function loginMedewerker($gebruikersnaam, $wachtwoord){
        $sql="SELECT * FROM medewerker WHERE gebruikersnaam = :gebruikersnaam";

        $stmt = $this->pdo->prepare($sql); 
        $stmt->execute(['gebruikersnaam'=>$gebruikersnaam]); 

        $result = $stmt->fetch(PDO::FETCH_ASSOC); 

        if($result){
            echo 'account gevonden';
            if ($wachtwoord == $result["wachtwoord"]) {
                echo 'ww komt overeen';
                // Start the session
                SESSION_START();
                
                $_SESSION['gebruikersnaam'] = $result;

                print_r($_SESSION['gebruikersnaam']);

                header("location: reserverings_overzicht.php");
            } else {
                echo "Invalid Password!";
            }
        } else {
            echo "Invalid Login";
        }

    }

    public function deleteReservering($reserveringklantid){
        try {
            $query = $this->pdo->prepare(
                "DELETE FROM reservering_klant
                 WHERE reserveringklantid = :reserveringklantid;"
            );

            $query->execute([
                'reserveringklantid' => $reserveringklantid
            ]);

            header("Location: reserverings_overzicht.php");
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    public function selectSpecificKlant($reserveringklantid){
        try {
            $query = "SELECT reservering_klant.reserveringklantid, naam, adres, kamernummer, plaats, postcode, telefoonnummer, beginDatum, eindDatum, kamertype FROM reservering_klant
            INNER JOIN klantgegevens
                ON reservering_klant.klantgegevensid = klantgegevens.klantgegevensid
            INNER JOIN kamer
                ON reservering_klant.kamerid = kamer.kamerid WHERE reserveringklantid = :reserveringklantid;";

            $prep = $this->pdo->prepare($query);

            $prep->execute([
                'reserveringklantid' => $reserveringklantid
            ]);

            $row = $prep->fetch(PDO::FETCH_ASSOC);
        
            return $row;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function updateKlant($reserveringklantid, $naam, $adres, $plaats, $postcode, $telefoonnummer, $beginDatum, $eindDatum, $kamertype){
        try {
            $query = 
            "UPDATE reservering_klant
            INNER JOIN klantgegevens 
                ON reservering_klant.klantgegevensid = klantgegevens.klantgegevensid
            INNER JOIN kamer
                ON reservering_klant.kamerid = kamer.kamerid 
            SET 
              klantgegevens.naam = :naam,
              klantgegevens.adres = :adres,
              klantgegevens.plaats = :plaats,
              klantgegevens.postcode = :postcode,
              klantgegevens.telefoonnummer = :telefoonnummer,
              reservering_klant.beginDatum = :beginDatum,
              reservering_klant.eindDatum = :eindDatum,
              klantgegevens.kamertype = :kamertype
            WHERE reservering_klant.reserveringklantid = :reserveringklantid";

            $prep = $this->pdo->prepare($query);
print_r($query);
            $prep->execute([
                'naam' => $naam,
                'adres' => $adres,
                'plaats' => $plaats,
                'postcode' => $postcode,
                'telefoonnummer' => $telefoonnummer,
                'beginDatum' => $beginDatum,
                'eindDatum' => $eindDatum,
                'kamertype' => $kamertype,
                'reserveringklantid' => $reserveringklantid
            ]);

            header('Location: reserverings_overzicht.php');

            exit;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    
    public function createKlant($naam, $adres, $plaats, $postcode, $telefoonnummer, $kamertype){
        try {
            $query = "INSERT INTO klantgegevens(naam, adres, plaats, postcode, telefoonnummer, kamertype) 
            VALUES (:naam, :adres, :plaats, :postcode, :telefoonnummer, :kamertype)";

            $prep = $this->pdo->prepare($query);

            $prep->execute([
                'naam' => $naam,
                'adres' => $adres,
                'plaats' => $plaats,
                'postcode' => $postcode,
                'telefoonnummer' => $telefoonnummer,
                'kamertype' => $kamertype
            ]);

            //header('Location: reserveren.php');

            exit;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}