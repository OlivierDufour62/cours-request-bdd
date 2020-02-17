<?php

require('config/db.php');

if (isset($_POST['last_name'])) {
    //$zip = (int) $_POST['zip_code'];
    // $sth = $dbh->prepare("UPDATE `users` SET `nom`=:lastname,`prenom`=:firstname,`adresse`=:address,`code_postal`=:zipcode,`ville`=:city,`email`=:email,`password`=:pwd WHERE id_users={$_GET['id']}");
    $id = $_POST['id'];
    $lastname = htmlspecialchars($_POST['last_name']);
    $firstname = htmlspecialchars($_POST['first_name']);
    $address = htmlspecialchars($_POST['address']);
    $zip = htmlspecialchars($_POST['zip_code']);
    $city = htmlspecialchars($_POST['city']);
    $email = htmlspecialchars($_POST['email']);
    $pwd = htmlspecialchars($_POST['password']);
    $dbh->update('users',['nom' => $lastname, 'prenom'=>$firstname , 'adresse'=>$address , 'code_postal'=>$zip , 'ville'=>$city, 'email'=>$email, 'password'=>$pwd], ['id_users'=>$id]);
    // if ($sth->execute()) {
    //     header('Location: index.php');
    // }
}