<?php
    include "Club.php";

    $test = new Club(1,"test","description","Esprit Ghazela", "Electromecanique");
    $liste = $test->afficherClubs();

?>


<h1> Affchage </h1>

<table border="1">
    <tr>
        <td> ID </td>
        <td> Nom </td>
        <td> Description </td>
        <td> Adresse </td>
        <td> Domaine </td>
    </tr>
    <?php
    foreach($liste as $row){
      ?>
        <tr>
            <td>  <?php echo $row["id"];  ?>  </td>
            <td>  <?php echo $row["nom"];  ?> </td>
            <td>  <?php echo $row["description"];  ?> </td>
            <td>  <?php echo $row["adresse"];  ?> </td>
            <td>  <?php echo $row["domaine"];  ?> </td>
        </tr>
    <?php
    }
    ?>
</table>
