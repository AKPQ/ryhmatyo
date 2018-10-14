<div class="otsikko">
<p>Tietoa omistamistanne tileistä ja niiden tilitapahtumista</p>
<p>Voitte avata tai piilottaa haluamanne osion klikkaamalla hiirellä kyseisen palkin päällä.</p>
</div>
<div class="nayta_paneeli" onclick="nayta()">
  <p>Käyttötili</p>
</div>
<div id="piilo_ikkuna">

  <div>
  <table>
    <tr>
      <th>Tilinumero</th>
      <th>Tapahtuma</th>
      <th>Päiväys</th>
      <th>Määrä</th>
    </tr>
    <?php
    include 'functions/phpfunc.php';
    session_start();
    try {

      //Yhdistetään tietokantaan
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      // Haetaan tiedot
      $stmt = $conn->prepare("SELECT * from tilitapahtumat
          join tilit on tilit.tiliID=tilitapahtumat.tiliID
          join asiakas_tili on tilit.tiliID=asiakas_tili.tiliID
          join asiakas on asiakas_tili.asiakasID=asiakas.asiakasID
          where asiakas.kayttajatunnus=:knimi AND tilit.tilin_tyyppi='kayttotili'");

        $stmt->bindparam(':knimi', $_SESSION["knimi"]);
        $stmt->execute();

        // tulostetaan rivit
        $result = $stmt->fetchAll();
        foreach ($result as $key => $value) {
          echo "<tr>";
          echo "<td>" . $value["tilinumero"] . "</td>";
          echo "<td>" . $value["tapahtuma"] . "</td>";
          echo "<td>" . $value["PVM"] . "</td>";
          echo "<td>" . $value["maksun_maara"] . "</td>";
          echo "</tr>";
        }
      }
      catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
    ?>

  </table>
  </div><br>
</div>
<div class="nayta_paneeli" onclick="nayta2()">
  <p>Säästötili</p>

</div>
<div id="piilo_ikkuna2">


  <table>
  <tr>
    <th>Tilinumero</th>
    <th>Tapahtuma</th>
    <th>Päiväys</th>
    <th>Määrä</th>
  </tr>

  <?php
  try {

    //Yhdistetään tietokantaan
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Haetaan tiedot
    $stmt = $conn->prepare("SELECT * from tilitapahtumat
        join tilit on tilit.tiliID=tilitapahtumat.tiliID
        join asiakas_tili on tilit.tiliID=asiakas_tili.tiliID
        join asiakas on asiakas_tili.asiakasID=asiakas.asiakasID
        where asiakas.kayttajatunnus=:knimi AND tilit.tilin_tyyppi='saastotili'");

      $stmt->bindparam(':knimi', $_SESSION["knimi"]);
      $stmt->execute();

      // tulostetaan rivit
      $result = $stmt->fetchAll();
      foreach ($result as $key => $value) {
        echo "<tr>";
        echo "<td>" . $value["tilinumero"] . "</td>";
        echo "<td>" . $value["tapahtuma"] . "</td>";
        echo "<td>" . $value["PVM"] . "</td>";
        echo "<td>" . $value["maksun_maara"] . "</td>";
        echo "</tr>";
      }
    }
    catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
 $conn = null;

   ?>
 </table>

</div><br>
<!-- <div class="nayta_paneeli" onclick="nayta3()">

</div>-->
