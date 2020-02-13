<?php
require('config/db.php');

//$sth = $dbh->prepare("SELECT * FROM users where id_users= :param");
//$sth->bindParam(':param', $_GET['id'], PDO::PARAM_INT);
$sql = "SELECT * FROM `users` WHERE id_users = {$_GET['id']}";
$stmt = $dbh->query($sql);
$result = $dbh->getResult();
$id = $_GET['id'];
$dbh->delete('users', ['id_users'=>$id]);
header('Location: index.php');
// try{
//     $dbh->beginTransaction();
//     $stmt->execute();
//     $dbh->commit();
// }catch(Exception $e){
//     $dbh->rollback();
//     echo $e->getMessage();
// }

// if (isset($_GET['delete'])) {

//     $sth = $dbh->prepare("DELETE FROM users where id_users= :param");
//     $sth->bindParam(':param', $_GET['id'], PDO::PARAM_INT);

//     if ($sth->execute()) {
//         header('Location: index.php');
//     } //else {
    //     $sth = $dbh->prepare("UPDATE `users` SET activate =:id WHERE id_users=:param");
    //     $sth->bindParam(':param', $_GET['id'], PDO::PARAM_INT);
        
    //     if ($sth->execute()) {
    //         header('Location: index.php');
    //     }
    // }
//}