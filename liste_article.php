<?php
header('Content-Type: text/html; charset=utf-8');
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
                // $sth = $dbh->prepare("SELECT * FROM `article` INNER JOIN liste_article on liste_article.id_article = article.id_article WHERE liste_article.id_liste_course = ?");

                $sth = $dbh->prepare("SELECT * FROM `article` INNER JOIN liste_article on liste_article.id_article = article.id_article WHERE liste_article.id_liste_course = :idlistart");
                $sth->bindParam(':idlistart', $_GET['id'], PDO::PARAM_INT);
                $sth->execute();

                //$sql = "SELECT * FROM `article` INNER JOIN liste_article on liste_article.id_article = article.id_article WHERE liste_article.id_liste_course = {$_GET['id']}";
                //$stmt = $dbh->query($sql);

                $result = $sth->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $key => $value) {
                    echo '<tr>';
                    echo '<th scope="row">' . $value['id_liste_article'] . '</th>';
                    echo '<td>' . utf8_encode($value['nom']) . '</td>';
                    //echo '<td><a href=listes_article.php?id=' . $value['id_liste_course'] . '>Voir les listes</a></td>' ;
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