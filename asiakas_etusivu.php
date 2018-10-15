<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="latin1" http-equiv="refresh">
    <link rel="stylesheet" href="css/style.css">
    <script src="functions/jsfunctions.js" charset="latin1"></script>

    <title>A-K-P-Q</title>
  </head>
  <body>
    <div id="mainheader">
      <div class="headerlogo">
        <a href="index.html">
          <img src="images/akpq_logo1.jpg" alt="logo">
        </a>
      </div>
      <div class="header">
        <div class="keski">
          <b>AKPQ - Älykkäät rahastajat</b>
        </div>
        <div class="oikeakulma">
          <?php
           //kirjautuminen onnistunut
           session_start();
           if(isset($_SESSION["knimi"]))
           {
                echo '<b>Tervetuloa <br> '.$_SESSION["knimi"].'</b>';
           }
           else
           {
                header("location:index.html");
           }
         ?>
        </div>
      </div>

    </div>
    <div id="menu">
      <ul>
        <li><a onclick="loadXMLDoc('asiakas_tilit.php')">Etusivu</a></li>
        <li><a onclick="loadXMLDoc('tilit.php')">Tilit</a></li>
        <li><a onclick="loadXMLDoc('maksut.php')">Maksut</a></li><br>
        <li><a onclick="loadXMLDoc('kortit.html')">Korttien hallinta</a></li>
        <li><a href="logout.php">Kirjaudu ulos</a></li>
      </ul>
    </div>

    <div id="content">
      <div class="otsikko">
        <h2>Tervetuloa asioimaan pankkiimme</h2>
        <p> Etusivullanne näette tilijenne yhteenvedon. Pääsette näkemään tilijenne tarkempia
          tilitapahtumia klikkaamalla tilit-linkkiä vasemmalta. Tilisiirtoja tai maksuja pääsette
          suorittamaan Maksut-sivulta. Korttienne tiedot näette Kortit-sivulta.
        </p>
      </div>
    <div class="nayta_paneeli" onclick="nayta()">
      <p>Tilit</p>
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

        //Yhdistetään tietokantaan
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Haetaan tiedot
        $stmt = $conn->prepare("SELECT tilin_tyyppi, IBAN, tilin_saldo from tilit
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
  </body>
</html>
