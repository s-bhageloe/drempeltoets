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
            $query = "SELECT * FROM klant;";
            
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

    public function deleteReservering($klantnummer){
        try {
            $query = $this->pdo->prepare(
                "DELETE FROM klant
                 WHERE klantnummer = :klantnummer;"
            );

            $query->execute([
                'klantnummer' => $klantnummer
            ]);

            header("Location: reserverings_overzicht.php");
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    public function selectSpecificKlant($klantnummer){
        try {
            $query = "SELECT * FROM klant WHERE klantnummer = :klantnummer;";

            $prep = $this->pdo->prepare($query);

            $prep->execute([
                'klantnummer' => $klantnummer
            ]);

            $row = $prep->fetch(PDO::FETCH_ASSOC);
        
            return $row;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function updateKlant($klantnummer, $naam, $adres, $plaats, $postcode, $telefoonnummer, $begin_datum, $eind_datum){
        try {
            $query = "UPDATE klant SET naam = :naam, adres = :adres, plaats = :plaats, postcode = :postcode, telefoonnummer = :telefoonnummer, begin_datum = :begin_datum, eind_datum = :eind_datum WHERE klantnummer = :klantnummer;";

            $prep = $this->pdo->prepare($query);

            $prep->execute([
                'klantnummer' => $klantnummer,
                'naam' => $naam,
                'adres' => $adres,
                'plaats' => $plaats,
                'postcode' => $postcode,
                'telefoonnummer' => $telefoonnummer,
                'begin_datum' => $begin_datum,
                'eind_datum' => $eind_datum
            ]);

            header('Location: reserverings_overzicht.php');

            exit;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    
    public function createKlant($klantnummer, $naam, $adres, $plaats, $postcode, $telefoonnummer, $begin_datum, $eind_datum){
        try {
            $query = "INSERT INTO klant(naam, adres, plaats, postcode, telefoonnummer, begin_datum, eind_datum) VALUES (:naam, :adres, :plaats, :postcode, :telefoonnummer, :begin_datum, :eind_datum WHERE klantnummer = :klantnummer;)";

            $prep = $this->pdo->prepare($query);

            $prep->execute([
                'naam' => $naam,
                'adres' => $adres,
                'plaats' => $plaats,
                'postcode' => $postcode,
                'telefoonnummer' => $telefoonnummer,
                'begin_datum' => $begin_datum,
                'eind_datum' => $eind_datum
            ]);

            header('Location: index.php');

            exit;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}