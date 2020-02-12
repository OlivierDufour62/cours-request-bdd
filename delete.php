<?php
require('config/connect.php');

$sth = $dbh->prepare("SELECT * FROM users where id_users= :param");
$sth->bindParam(':param', $_GET['id'], PDO::PARAM_INT);

try{
    $dbh->beginTransaction();
    $sth->execute();
    $dbh->commit();
}catch(Exception $e){
    $dbh->rollback();
    echo $e->getMessage();
}

if (isset($_GET['delete'])) {

    $sth = $dbh->prepare("DELETE FROM users where id_users= :param");
    $sth->bindParam(':param', $_GET['id'], PDO::PARAM_INT);

    if ($sth->execute()) {
        header('Location: index.php');
    } //else {
    //     $sth = $dbh->prepare("UPDATE `users` SET activate =:id WHERE id_users=:param");
    //     $sth->bindParam(':param', $_GET['id'], PDO::PARAM_INT);
        
    //     if ($sth->execute()) {
    //         header('Location: index.php');
    //     }
    // }
}