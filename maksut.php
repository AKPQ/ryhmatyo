<?php
include 'functions/phpfunc.php';
session_start();
?>

<h3>Maksut</h3>
<form action="functions/luoMaksu.php" method="post">
  <table>
    <tr>
      <td><label for="tililta">Tililtä</label></td>
      <td><select name="tililta" required>
        <option value="Kayttotili" selected>Käyttötili</option>
        <option value="saastotili">Säästötili</option>
        <option value="asptili">ASP-tili</option>
      </td>
      <td><label for="saaja">Saaja</label></td>
      <td><input type="text" placeholder="Saajan nimi" name="saaja"></td required>
    </tr>
    <tr>
      <td><label for="maksupohja">maksupohjan nimi</label></td>
      <td><select name="maksupohja" required>
        <option value="Kayttotili" selected>Käyttötili</option>
        <option value="saastotili">Säästötili</option>
        <option value="asptili">ASP-tili</option>
      </td>
      <td><label for="tilinro">Tilinumero</label></td>
      <td><input type="text" placeholder="tilinumero" name="tilinro"></td>
    </tr>
    <tr>
      <td><label for="maara">Määrä</label></td>
      <td><input type="number" placeholder="Määrä" name="maara"></td>
      <td><label for="viesti">Viesti</label></td>
      <td><input type="text" placeholder="Viesti" name="viesti"></td>
    </tr>
    <tr>
      <td><label for="erapv">Eräpäivä</label></td>
      <td><input type="date" name="erapv"></td>
      <td><label for="viite">Viite</label></td>
      <td><input type="text" placeholder="Viite" name="viite"></td>
    </tr>
  </table>
  <input type="radio" name="maksukerta" value="kerta" checked> Kertamaksu<br>
    <input type="radio" name="maksukerta" value="kk"> Kuukausittain
    <input type="number" placeholder=" #" name="kk_maara" size="4"> kertaa (ensimmäinen kerta mukaanlukien)<br>
    <input type="radio" name="maksukerta" value="kk_toist"> kuukausittain toistaiseksi<br>

  <div class="oikeakohdistus">
    <input type="submit" name="" value="Hyväksy">
  </div>


</form>

<h3>Viimeisimmät maksut</h3>
<table>
  <tr>
    <td>Tilinumero</td>
    <td>Päiväys</td>
    <td>Määrä</td>
  </tr>
  <?php try {

    //Yhdistetään tietokantaan
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Haetaan tiedot
    $stmt = $conn->prepare("select * from tilitapahtumat
        join asiakas_tili on tilitapahtumat.tiliID=asiakas_tili.tiliID
        join asiakas on asiakas_tili.asiakasID=asiakas.asiakasID
        where kayttajatunnus=:knimi");

      $stmt->bindparam(':knimi', $_SESSION["knimi"]);
      $stmt->execute();

      // tulostetaan rivit
      $result = $stmt->fetchAll();
      foreach ($result as $key => $value) {
        echo "<tr>";
        echo "<td>" . $value["tilinumero"] . "</td>";
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
