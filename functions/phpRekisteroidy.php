<?php
include '/home/avoin/07/c7paja00/public_html/functions/phpfunc.php';
try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // määritellään muuttujat
      $nimi = $kayttaja = $psw = "";
      $nimiErr = $kayttajaErr = $pswErr = "";

      // formista tiedot muuttujiin validoinnin kautta
      // testataan samalla myös ettei kentätä ole tyhjiä
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["nimi"])) {
          $nimiErr = "nimi vaaditaan";
        } else {
          $nimi = test_input($_POST["nimi"]);
        }

        if (empty($_POST["kayttaja"])) {
          $kayttajaErr = "käyttäjätunnus vaaditaan";
        } else {
          $kayttaja = test_input($_POST["kayttaja"]);
        }

        if (empty($_POST["psw"])) {
          $pswErr = "Salasana vaaditaan";
        } else {
          $psw = test_input($_POST["psw"]);
        }

      }
      $pdoLause = "INSERT INTO asiakas(nimi, kayttajatunnus, salasana) VALUES (:nimi,:kayttaja,:psw)";
      $pdoTulos = $conn->prepare($pdoLause);
      $pdoSyotto = $pdoTulos->execute(array(":nimi"=>$nimi,":kayttaja"=>$kayttaja,":psw"=>$psw));

          // tarkistetaan onnistuiko syöttö
      if($pdoSyotto){

            echo '<h2>Rekisteröinti onnistui! Tervetuloa AKPQ:n perheeseen!</h2>';
            echo '<br><br><a href="../index.html">Etusivulle</a>';
        }else{
            echo 'Rekisteröinti ei onnistunut';
            echo '<br><br><a href="../index.html">Etusivulle</a>';
        }
    }
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;



?>
