<div class="otsikko">
  <h2>Tervetuloa asioimaan pankkiimme</h2>
  <p> Etusivullasi näet tilijesi yhteenvedon. Pääset näkemään tiliesi tarkempia tilitapahtumia klikkaamalla tilin nimeä.
  Tilisiirtoja tai maksuja pääset suorittamaan Maksut-sivulta. Korttiesi tiedot näet Kortit-sivulta.
  </p>
</div>
<div class="nayta_paneeli" onclick="nayta()">
  <p>Tilit</p>
</div>
<div id="piilo_ikkuna">
  <?php
  include 'functions/phpfunc.php';
  session_start();
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

    //Yhdistetään tietokantaan
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Haetaan tiedot
    $stmt = $conn->prepare("SELECT tilin_tyyppi as Nimi, IBAN as Tilinumero, tilin_saldo as Saldo from tilit
      join asiakas_tili on tilit.tiliID=asiakas_tili.tiliID
      join asiakas on asiakas_tili.asiakasID=asiakas.asiakasID where asiakas.kayttajatunnus=:knimi");
    $stmt->bindparam(':knimi', $_SESSION["knimi"]);
    $stmt->execute();

     // tulostetaan rivit
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
</div>
<br>
<div id="footer">
</div>
