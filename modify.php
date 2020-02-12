<?php
require('config/connect.php');

$sql = "SELECT * FROM `users` WHERE id_users = {$_GET['id']}";
$stmt = $dbh->query($sql);
$result = $stmt->fetch(PDO::FETCH_ASSOC);


// foreach($result as $key => $value){
//     extract($result);
// }

// $upd=  "UPDATE `users` SET `nom`=:lastname,`prenom`=:fistname,`adresse`=:address,`code_postal`=:zipcode,`ville`=:city,`email`=:email,`password`=:pwd WHERE id_users={$_GET['id']}";

if (isset($_POST['last_name'])) {
    //$zip = (int) $_POST['zip_code'];
    $sth = $dbh->prepare("UPDATE `users` SET `nom`=:lastname,`prenom`=:firstname,`adresse`=:address,`code_postal`=:zipcode,`ville`=:city,`email`=:email,`password`=:pwd WHERE id_users={$_GET['id']}");
    $lastname = htmlspecialchars($_POST['last_name']);
    $firstname = htmlspecialchars($_POST['first_name']);
    $address = htmlspecialchars($_POST['address']);
    $zip = htmlspecialchars($_POST['zip_code']);
    $city = htmlspecialchars($_POST['city']);
    $email = htmlspecialchars($_POST['email']);
    $pwd = htmlspecialchars($_POST['password']);
    $sth->bindParam(':lastname', $lastname);
    $sth->bindParam(':firstname', $firstname);
    $sth->bindParam(':address', $address);
    $sth->bindParam(':zipcode', $zip);
    $sth->bindParam(':city', $city);
    $sth->bindParam(':email', $email);
    $sth->bindParam(':pwd', $pwd);
    if ($sth->execute()) {
        header('Location: index.php');
    }
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

    <form method="POST" class="col-6 mx-auto">
        <div class="form-group">
            <label for="first_name">first_name</label>
            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter first name" value="<?= $result['prenom'] ?>">
        </div>
        <div class="form-group">
            <label for="last_name">last_name</label>
            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter last name" value="<?= $result['nom'] ?>">
        </div>
        <div class="form-group">
            <label for="adresse">Adress</label>
            <input type="text" class="form-control" name="address" id="adresse" placeholder="Enter Adress" value="<?= $result['adresse'] ?>">
        </div>
        <div class="form-group">
            <label for="code_postal">zipcode</label>
            <input type="number" class="form-control" name="zip_code" id="postal_code" placeholder="Enter Postal code" value="<?= $result['code_postal'] ?>">
        </div>
        <div class="form-group">
            <label for="ville">city</label>
            <input type="text" class="form-control" name="city" id="ville" placeholder="Enter city" value="<?= $result['ville'] ?>">
        </div>
        <div class="form-group">
            <label for="inputemail">Email</label>
            <input type="email" class="form-control" name="email" id="inputemail" placeholder="Enter email" value="<?= $result['email'] ?>">
        </div>
        <div class="form-group">
            <label for="inputpassword">Password</label>
            <input type="password" class="form-control" name="password" id="inputpassword" placeholder="Password" value="<?= $result['password'] ?>">
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>