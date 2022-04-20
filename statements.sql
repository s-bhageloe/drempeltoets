

CREATE TABLE `kamer` (
 `kamerid`                  int(11) NOT NULL AUTO_INCREMENT,
 PRIMARY KEY(kamerid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `klantgegevens` (
`klantgegevensid`           int(11) NOT NULL AUTO_INCREMENT,
`naam`                      VARCHAR(255) NOT NULL,
`adres`                     VARCHAR(255) NOT NULL,
`plaats`                    VARCHAR(255) NOT NULL,
`postcode`                  VARCHAR(255) NOT NULL,
`telefoonnummer`            VARCHAR(255) NOT NULL,
PRIMARY KEY(klantgegevensid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `reservering_klant` (
  `reserveringklantid`      int(11) NOT NULL AUTO_INCREMENT,
  `klantgegevensid`         int(11) NOT NULL,
  `kamerid`                 int(11) NOT NULL,
  `beginDatum`              DATE    NOT NULL,
  `eindDatum`               DATE    NOT NULL,
  PRIMARY KEY(reserveringklantid),
  FOREIGN KEY(klantgegevensid)          REFERENCES klantgegevens(klantgegevensID),
  FOREIGN KEY(kamerid)                  REFERENCES kamer(kamerid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- CREATE TABLE `reservering_overzicht` 
-- (
--   `reserveringsoverzichtid` int(11) NOT NULL AUTO_INCREMENT,
--   `reserveringklantid`      int(11) NOT NULL,
--   `kamerid`                 int(11) NOT NULL,
--   `beginDatum`              DATE    NOT NULL,
--   `eindDatum`               DATE    NOT NULL,
--   FOREIGN KEY(reserveringklantid)       REFERENCES reservering_klant(reserveringklantid),
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `overzicht` 
(
  `overzichtsnummer`      int(11) NOT NULL AUTO_INCREMENT,
  -- `reserveringsoverzichtid` int(11) NOT NULL,
  `reserveringklantid`      int(11) NOT NULL,
  `klantgegevensid`         int(11) NOT NULL,
  -- `kamerid`                 int(11) NOT NULL,
  PRIMARY KEY(overzichtsnummer),
  -- FOREIGN KEY(reserveringsoverzichtid)  REFERENCES reservering_overzicht(reserveringsoverzichtid),
  FOREIGN KEY(reserveringklantid)       REFERENCES reservering_klant(reserveringklantid),
  FOREIGN KEY(klantgegevensid)          REFERENCES klantgegevens(klantgegevensid),
  -- FOREIGN KEY(kamerid)                  REFERENCES kamer(kamerid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- selecteer de kolomnamen
SELECT naam, adres, kamernummer FROM reservering_klant
INNER JOIN klantgegevens
    -- reservering_klant.klantgegevensid  -> klantgegevensid is de foreign key in tabel reservering_klant
    -- klantgegevens.klantgegevensid      -> klantgegevensid is de primary key in tabel klantgegevens
    -- de foreign key van tabel reservering_klant word gelinkt aan de primary key van tabel klantgegevens
    ON reservering_klant.klantgegevensid = klantgegevens.klantgegevensid
INNER JOIN kamer
    ON reservering_klant.kamerid = kamer.kamerid


UPDATE reservering_klant, klantgegevens, kamer
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
  reservering_klant.eindDatum = :eindDatum
WHERE reservering_klant.reserveringklantid = :reserveringklantid