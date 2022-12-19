<?php

require_once '../classes/user.php';

$titre = 'Réservations';

session_start();


?>


<?php include '../includes/header.php'; ?>

<main>


<section id="event">

    
  <h1>Les réservations déjà effectuées<h1>


<?php




    $bdd = new PDO('mysql:host=localhost;dbname=reservationsalles', 'root', '');
    //$bdd = new PDO('mysql:host=localhost;dbname=mehdi-douib_reservation-salles', 'mehdidouib', 'J77hm8t7%');
    $requser = $bdd->prepare("SELECT utilisateurs.login, titre, description,DATE_FORMAT(debut,'%d/%m/%Y, %H:%i:%s') as 'date de début', DATE_FORMAT(fin,'%d/%m/%Y, %H:%i:%s') as 'date de fin' FROM reservations INNER JOIN utilisateurs ON reservations.id_utilisateur = utilisateurs.id");
    $requser->execute();


$i=0;

echo "<table>" ;

while ($result = $requser->fetch(PDO::FETCH_ASSOC))
{
    if ($i == 0)
  {

    foreach ($result as $key => $value)
    {
      echo "<th>$key</th>";
    }
    $i++;

  }

  echo "<tr>";
  foreach ($result as $key => $value) {
    if ($key == "posté"){
      date_default_timezone_set('Europe/Paris');
      $value =  date("d-m-Y", strtotime($value));  ;
    echo "<td>$value</td>";
    }
    else
      echo "<td>" .nl2br($value). "</td>";
  }
  echo "</tr>";
}

echo "</table>";
?>


 </section>

</main>


<?php include '../includes/footer.php'; ?>