<?php

require('config/connect.php');




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Title</title>
</head>

<body>
    <div>
        <?php
        $sql = "SELECT * FROM users";
        $stmt = $dbh->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <p>Il y a <?= $stmt->rowcount(); ?> Utilisateurs.</p>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Lastname</th>
                    <th scope="col">Firstname</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php


                foreach ($result as $key => $value) {

                    echo '<tr>';
                    echo '<th scope="row">' . $value['id_users'] . '</th>';
                    echo '<td>' . utf8_encode($value['nom']) . '</td>';
                    echo '<td>' . $value['prenom'] . '</td>';
                    echo '<td>' . $value['email'] . '</td>';
                    echo '<td><a class=text-black href=listes.php?id=' . $value['id_users'] . '>Voir les listes</a></td>';
                    echo '<td><a class=text-black href=modify.php?id=' . $value['id_users'] . '>Modifier Utilisateur</a></td>';
                    echo '<td><button name="delete" type="" class="btn btn-primary text-white"><a class=text-white href=delete.php?id=' . $value['id_users'] . '>Supprimer</a></button></td>';
                    echo '</tr>';
                }
                //$result[0]['nom'];
                ?>
            </tbody>
        </table>
        <form action="">
            <button type="" class="btn btn-primary"><a class="text-white" href="adduser.php">Ajouter utilisateurs</a></button>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>