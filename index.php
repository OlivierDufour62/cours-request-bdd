<?php
require('config/db.php');
require __DIR__ . '/vendor/autoload.php';

// use Spipu\Html2Pdf\Html2Pdf;
use Dompdf\Dompdf;


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


//duplication du code pour ne pas afficher certains éléments dans le pdf
$html2 = '<table class="table" style="width:100%;border:1px solid black;border-collapse:collapse">
            <thead>
                <tr>
                    <th scope="col" style="margin-bottom:3px;border:1px solid black">id</th>
                    <th scope="col" style="margin-bottom:3px;border:1px solid black">Lastname</th>
                    <th scope="col" style="margin-bottom:3px;border:1px solid black">Firstname</th>
                    <th scope="col" style="margin-bottom:3px;border:1px solid black">Email</th>
                </tr>
            </thead>
            <tbody>';

foreach ($result as $key => $value) {
    $html2 .= '<tr>';
    $html2 .= '<th scope="row" style="margin-bottom:3px;border:1px solid black">' . $value['id_users'] . '</th>';
    $html2 .= '<td style="margin-bottom:3px;border:1px solid black">' . utf8_encode($value['nom']) . '</td>';
    $html2 .= '<td style="margin-bottom:3px;border:1px solid black">' . $value['prenom'] . '</td>';
    $html2 .= '<td style="margin-bottom:3px;border:1px solid black">' . $value['email'] . '</td>';
    $html2 .= '</tr>';
}
//$result[0]['nom'];

$html2 .= "</tbody>";
$html2 .= "</table>";


// if (isset($_GET['pdf'])) {
//     $html2pdf = new Html2Pdf('p', 'A4', 'fr');
//     $html2pdf->writeHTML($html2);
//     $html2pdf->output();
// }
if (isset($_GET['pdf'])) {
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html2);
    $dompdf->setPaper('A4');
    $dompdf->render();
    $dompdf->stream();
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

    <title>Title</title>
</head>


<body>
    <div class="table">
        <p>Il y a <?= $stmt->rowcount(); ?> Utilisateurs.</p>
        <?php echo $html; ?>
    </div>
    <button type="" class="add btn btn-primary">Ajouter utilisateurs</button>
    <button name="pdf" type="" class="btn btn-primary"><a class="text-white" href="?pdf">Télécharger au format pdf</a></button>

    <div class="">
        <form class="adduser col-6 mx-auto">
            <div class="form-group">
                <label for="first_name">first_name</label>
                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter first_name">
            </div>
            <div class="form-group">
                <label for="last_name">last_name</label>
                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter last_name">
            </div>
            <div class="form-group">
                <label for="adresse">Adress</label>
                <input type="text" class="form-control" name="address" id="adresse" placeholder="Enter Adress">
            </div>
            <div class="form-group">
                <label for="code_postal">zipcode</label>
                <input type="number" class="form-control" name="zip_code" id="postal_code" placeholder="Enter Postal code">
            </div>
            <div class="form-group">
                <label for="ville">city</label>
                <input type="text" class="form-control" name="city" id="ville" placeholder="Enter city">
            </div>
            <div class="form-group">
                <label for="inputemail">Email</label>
                <input type="email" class="form-control" name="email" id="inputemail" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="inputpassword">Password</label>
                <input type="password" class="form-control" name="password" id="inputpassword" placeholder="Password">
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" id="add" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="libs/js/test_ajax.js"></script>
</body>

</html>
<?php
