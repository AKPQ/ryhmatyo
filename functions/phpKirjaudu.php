<?php
include 'phpfunc.php';
session_start();
try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      if(isset($_POST["kirjaudu"]))
      {
           if(empty($_POST["knimi"]) || empty($_POST["ssana"]))
           {
                $message = '<label>Kentät eivät voi olla tyhjiä</label>';
           }
           else
           {
                $query = "SELECT * FROM asiakas WHERE kayttajatunnus = :knimi AND salasana = :ssana";
                $statement = $conn->prepare($query);
                $statement->execute(
                     array(
                          'knimi'     =>     $_POST["knimi"],
                          'ssana'     =>     $_POST["ssana"]
                     )
                );
                $count = $statement->rowCount();
                if($count > 0)
                {
                     $_SESSION["knimi"] = $_POST["knimi"];
                     header("location:../asiakas_etusivu.php");
                }
                else
                {
                     $message = '<label>Väärät tiedot</label>';
                }
           }
      }
    }
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;



?>
