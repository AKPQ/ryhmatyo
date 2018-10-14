<?php
include 'phpfunc.php';
session_start();


class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
        return "<td>" . parent::current(). "</td>";
    }

    function beginChildren() {
        echo "<tr>";
    }

    function endChildren() {
        echo "</tr>" . "\n";
    }
}



try {

  //Yhdistetään tietokantaan
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // Haetaan tiedot

  $sql = $conn->prepare("SELECT tilit.tiliID from tilit
    join asiakas_tili on tilit.tiliID=asiakas_tili.tiliID
    join asiakas on asiakas_tili.asiakasID=asiakas.asiakasID where asiakas.kayttajatunnus=:knimi AND tilit.tilin_tyyppi=:tili_tyyppi");
  $sql->bindparam(':knimi', $_SESSION["knimi"]);
  $sql->bindparam(':tili_tyyppi', $_POST['tililta']);
  $sql->execute();
   while($row=$sql->fetch()){
      $maksu_tili=$row['tiliID'];
    }



  $stmt = $conn->prepare("INSERT INTO tilitapahtumat VALUES (NULL, :tapahtuma, CURDATE(), :viitenumero, :viesti, :tilinumero, :maksun_maara, :tiliID)");

  $stmt->bindparam(':tapahtuma', $_POST["saaja"]);
  $stmt->bindparam(':viitenumero', $_POST["viite"]);
  $stmt->bindparam(':viesti', $_POST["viesti"]);
  $stmt->bindparam(':tilinumero', $_POST["tilinro"]);
  $stmt->bindparam(':maksun_maara', $_POST["maara"]);
  $stmt->bindparam(':tiliID', $maksu_tili);
  $stmt->execute();

}
catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}

if($stmt){

      echo '<h2>Maksu suoritettu.</h2>';
      echo '<br><br><a href="../asiakas_etusivu.php">Etusivulle</a>';
  }else{
      echo 'MAksu ei onnistunut';
      echo '<br><br><a href="../asiakas_etusivu.php">Etusivulle</a>';
  }

?>
