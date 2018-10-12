<?php
include '/home/avoin/07/c7paja00/public_html/functions/phpfunc.php';
try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // määritellään muuttujat
      $enimi = $snimi = $hetu = $psw = "";
      $enimErr = $snimiErr = $hetuErr = $pswErr = "";

      // formista tiedot muuttujiin validoinnin kautta
      // testataan samalla myös ettei kentätä ole tyhjiä
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["etunimi"])) {
          $enimiErr = "Etunimi vaaditaan";
        } else {
          $enimi = test_input($_POST["etunimi"]);
        }

        if (empty($_POST["sukunimi"])) {
          $snimiErr = "Sukunimi vaaditaan";
        } else {
          $snimi = test_input($_POST["sukunimi"]);
        }

        if (empty($_POST["hetu"])) {
          $hetuErr = "Henkilötunnus vaaditaan";
        } else {
          $hetu = test_input($_POST["hetu"]);
        }

        if (empty($_POST["psw"])) {
          $pswErr = "Salasana vaaditaan";
        } else {
          $psw = test_input($_POST["psw"]);
        }

      }
      $pdoLause = "INSERT INTO asiakas(etunimi, sukunimi, henkilotunnus, salasana) VALUES (:etunimi,:sukunimi,:hetu,:psw)";
      $pdoTulos = $conn->prepare($pdoLause);
      $pdoSyotto = $pdoTulos->execute(array(":etunimi"=>$enimi,":sukunimi"=>$snimi,":hetu"=>$hetu,":psw"=>$psw));

          // tarkistetaan onnistuiko syöttö
      if($pdoSyotto){
            echo 'Syöttö onnistui';
        }else{
            echo 'Syöttö ei onnistunut';
        }
    }
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;



?>
