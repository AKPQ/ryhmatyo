<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>PHP info</title>
    </head>
    <body>
      <?php
        $servername = "mysli.oamk.fi";
        $username = "c7paja00";
        $password = "9Y5gXKWm8XBG7ok9";
        $dbname = "opisk_c7paja00";

        function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }


      ?>




        <!-- <?php

        $con=mysqli_connect($host,$username,$password,$dbname);

        if (mysqli_connect_errno())
        {
            echo "Yhteys epäonnistui" . mysqli_connect_error();
        }

        $result = mysqli_query($con,"SELECT * FROM tilitapahtumat");
        echo "<table>
        <tr>
        <th>Päivämäärä</th>
        <th>Tapahtuma</th>
        <th>Viesti</th>
        <th>Tili</th>
        <th>Määrä</th>
        </tr>";
        while($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['pvm'] . "</td>";
            echo "<td>" . $row['tapahtuma'] . "</td>";
            echo "<td>" . $row['viesti'] . "</td>";
            echo "<td>" . $row['tili'] . "</td>";
            echo "<td>" . $row['maara'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";

        mysqli_close($con);
        ?>
        <?php
        phpinfo();
        ?> -->
    </body>
</html>
