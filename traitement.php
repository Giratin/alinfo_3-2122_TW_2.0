<?php

    if(
            isset($_GET["id"]) and isset($_GET["nom"]) and isset($_GET["description"])
            and isset($_GET["domaine"]) and isset($_GET["adresse"])
            and !(empty($_GET["id"])) and !(empty($_GET["nom"])) and !(empty($_GET["description"]))
            and !(empty($_GET["domaine"])) and !(empty($_GET["adresse"]))
    ){
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <center>
        <h1> Affichage des clubs </h1>
        <table border="1">
            <tr>
                <td> ID </td>
                <td> Nom </td>
                <td> Description </td>
                <td> Adresse </td>
                <td> Domaine </td>
            </tr>
            <tr>
                <td> <?php echo $_GET["id"]; ?> </td>
                <td> <?php echo $_GET["nom"]; ?> </td>
                <td> <?php echo $_GET["description"]; ?> </td>
                <td> <?php echo $_GET["adresse"]; ?> </td>
                <td> <?php echo $_GET["domaine"]; ?> </td>
            </tr>
        </table>
    </center>
</body>
</html>
<?php
    }else{
        echo "Champs Manquants";
    }
?>