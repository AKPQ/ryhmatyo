<div class="otsikko">
<p>Tietoa omistamistanne tileistä ja niiden tilitapahtumista</p>
<p>Voitte avata tai piilottaa haluamanne osion klikkaamalla hiirellä kyseisen palkin päällä.</p>
</div>
<div class="nayta_paneeli" onclick="nayta()">
  <p>Käyttötili</p>
</div>
<div id="piilo_ikkuna">

  <?php
  include 'functions/phpfunc.php';

  echo "<table>";
  echo "<tr>
  <th>Nimi</th>
  <th>Tilinumero (IBAN)</th>
  <th>Saldo</th>
  </tr>";

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
    session_start();

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $stmt = $conn->prepare("SELECT tilin_tyyppi as Nimi, IBAN as Tilinumero, tilin_saldo as Saldo from tilit
      join asiakas_tili on tilit.tiliID=asiakas_tili.tiliID
      join asiakas on asiakas_tili.asiakasID=asiakas.asiakasID where asiakas.kayttajatunnus=:knimi AND tilit.tilin_tyyppi='kayttotili'");
    $stmt->bindparam(':knimi', $_SESSION["knimi"]);
    $stmt->execute();

     // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
      echo $v;
    }
 }
 catch(PDOException $e) {
     echo "Error: " . $e->getMessage();
 }
 $conn = null;
 echo "</table>";
  ?>
</div><br>
<div class="nayta_paneeli" onclick="nayta2()">
  <p>Säästötili</p>

</div>
<div id="piilo_ikkuna2">
  <?php

  echo "<table>";
  echo "<tr>
  <th>Nimi</th>
  <th>Tilinumero (IBAN)</th>
  <th>Saldo</th>
  </tr>";

    try {

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $stmt = $conn->prepare("SELECT tilin_tyyppi as Nimi, IBAN as Tilinumero, tilin_saldo as Saldo from tilit
      join asiakas_tili on tilit.tiliID=asiakas_tili.tiliID
      join asiakas on asiakas_tili.asiakasID=asiakas.asiakasID where asiakas.kayttajatunnus=:knimi AND tilit.tilin_tyyppi='saastotili'");
    $stmt->bindparam(':knimi', $_SESSION["knimi"]);
    $stmt->execute();

     // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
      echo $v;
    }
 }
 catch(PDOException $e) {
     echo "Error: " . $e->getMessage();
 }
 $conn = null;
 echo "</table>";
  ?>
</div><br>
<!-- <div class="nayta_paneeli" onclick="nayta3()">
  <p>ASP-tili</p>
</div> -->
<!-- <div id="piilo_ikkuna3">
  <table>
    <tr>
      <th>Päivämäärä</th>
      <th>Tilinro.</th>
      <th>Nimi</th>
      <th>Viite/viesti</th>
      <th>Määrä</th>
    </tr>
    <tr>
      <td>10.10.2018</td>
      <td>FIxx xxxx xxxx xxxx xx</td>
      <td>Elisa</td>
      <td>1234 1234</td>
      <td>-80,00</td>
    </tr>
    <tr>
      <td>5.10.2018</td>
      <td>FIxx xxxx xxxx xxxx xx</td>
      <td>K-market</td>
      <td>pankkikorttimaksu</td>
      <td>-45,00</td>
    </tr>
  </table>
</div>
</div>-->
