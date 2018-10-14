<?php
include 'phpfunc.php';
session_start();
try {

  //Yhdistetään tietokantaan
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // Haetaan tiedot
  $stmt = $conn->prepare("INSERT INTO tilitapahtumat
    VALUES (NULL, NULL, CURDATE(), :viitenumero, :viesti, :tilinumero, :maksun_maara, :tiliID)");

  $stmt->bindparam(':viitenumero', $_POST["viite"]);
  $stmt->bindparam(':viesti', $_POST["viesti"]);
  $stmt->bindparam(':tilinumero', $_POST["tilinro"]);
  $stmt->bindparam(':maksu_maara', $_POST["maara"]);
  $tiliID = 1;
  $stmt->bindparam(':tiliID', $tiliID); //TODO
  $stmt->execute();

}
catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}

header("Location: ../asiakas_etusivu.php")

?>
