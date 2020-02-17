<?php
require('config/db.php');

if (isset($_POST['last_name'])) {
    //$zip = (int) $_POST['zip_code'];

    $lastname = htmlspecialchars($_POST['last_name']);
    $firstname = htmlspecialchars($_POST['first_name']);
    $address = htmlspecialchars($_POST['address']);
    $zip = htmlspecialchars($_POST['zip_code']);
    $city = htmlspecialchars($_POST['city']);
    $email = htmlspecialchars($_POST['email']);
    $pwd = $_POST['password'];
    $last = $dbh->insert('users', ['nom' => $lastname, 'prenom' => $firstname, 'adresse' => $address, 'code_postal' => $zip, 'ville' => $city, 'email' => $email, 'password' => $pwd]);
    $std = new stdClass;
    $std->last_name = $lastname;
    $std->first_name = $firstname;
    $std->address = $address;
    $std->zip = $zip;
    $std->city = $city;
    $std->email = $email;
    $std->pwd = $pwd;
// ajoute éléments au tableau sans recharger la page 
    $value['id_users'] = $last;


    echo '<tr>';
    echo '<th scope="row">' . $value['id_users'] . '</th>';
    echo '<td>' . utf8_encode($lastname) . '</td>';
    echo '<td>' . $firstname . '</td>';
    echo '<td>' . $email . '</td>';
    echo '<td><a class=text-black href=listes.php?id=' . $value['id_users'] . '>Voir les listes</a></td>';
    echo '<td><a class=text-black href=modify.php?id=' . $value['id_users'] . '>Modifier Utilisateur</a></td>';
    echo '<td><a class=btn btn-primary text-white text-white href=delete.php?id=' . $value['id_users'] . '>Supprimer</a></td>';
    echo '</tr>';

}
// try{
//     $dbh->beginTransaction();
//     $dbh->commit();
//     $dbh->rollback();
// }catch(Exception $e){
//     echo $e->getMessage();
// }

