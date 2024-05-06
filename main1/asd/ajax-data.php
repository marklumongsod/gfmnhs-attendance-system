<?php
require '../config.php';

if (isset($_POST['id'])) {
    $id=$_POST['id'];
    $stmt = $db->prepare("SELECT * FROM tbl_users WHERE id='$id' ");
    $stmt->execute();
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($books);
}



?>