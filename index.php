<?php
require('config/db.php');
require __DIR__ . '/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;



// $html2pdf = new Html2Pdf();
// $html2pdf->writeHTML('<h1>HelloWorld</h1>This is my first test');
// $html2pdf->output();


$dbh = Db::getInstance()->_pdo;

        $sql = "SELECT * FROM users";
        $stmt = $dbh->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        



        $html = '<table class="table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Lastname</th>
                    <th scope="col">Firstname</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>';
                
                foreach ($result as $key => $value) {
                    $html .= '<tr>';
                    $html .= '<th scope="row">' . $value['id_users'] . '</th>';
                    $html .= '<td>' . utf8_encode($value['nom']) . '</td>';
                    $html .= '<td>' . $value['prenom'] . '</td>';
                    $html .= '<td>' . $value['email'] . '</td>';
                    $html .= '<td><a class=text-black href=listes.php?id=' . $value['id_users'] . '>Voir les listes</a></td>';
                    $html .= '<td><a class=text-black href=modify.php?id=' . $value['id_users'] . '>Modifier Utilisateur</a></td>';
                    $html .= '<td><a class=btn btn-primary text-white text-white href=delete.php?id=' . $value['id_users'] . '>Supprimer</a></td>';
                    $html .= '</tr>';
                }
                //$result[0]['nom'];
                
                $html .= "</tbody>";
                $html .= "</table>";
        
        
        if (isset($_GET['pdf'])) {
            $html2pdf = new Html2Pdf('p', 'A4', 'fr');
            $html2pdf->writeHTML($html);
            $html2pdf->output();
        }
        
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
        <p>Il y a <?= $stmt->rowcount(); ?> Utilisateurs.</p>
        <?php echo $html; ?>
    </div>

    <form action="">
        <button type="" class="btn btn-primary"><a class="text-white" href="adduser.php">Ajouter utilisateurs</a></button>
        <button name="pdf" type="" class="btn btn-primary"><a class="text-white" href="?pdf">Télécharger au format pdf</a></button>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>