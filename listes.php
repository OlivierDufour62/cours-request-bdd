<?php

require('config/connect.php')

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
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nom de la liste</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //sécurisé la faille injection sql
                //$sth = $dbh->prepare("SELECT * FROM liste_course where id_users= ?");
                //$sth->execute(array($_GET['id']));

                $sth = $dbh->prepare("SELECT * FROM liste_course where id_users= :param");
                $sth->bindParam(':param', $_GET['id'], PDO::PARAM_INT);
                $sth->execute();
                //$sql = "SELECT * FROM liste_course where id_users=".$_GET['id'];
                //$stmt = $dbh->query($sql);
                
                $result = $sth->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $key => $value) {
                    echo '<tr>';
                    echo '<th scope="row">' . $value['id_liste_course'] . '</th>';
                    echo '<td>' . $value['nom'] . '</td>';
                    echo '<td><a href=liste_article.php?id=' . $value['id_liste_course'] . '>Voir les articles</a></td>';
                    echo '</tr>';
                }
                //$result[0]['nom'];
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>