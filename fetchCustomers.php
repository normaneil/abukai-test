<?php
include "config.php";

$sql = "SELECT id, firstname, lastname, email, city, country, created_at, image_path FROM customers;";
$sth = $db_conn->prepare($sql);
$sth->execute();
$rows = $sth->fetchAll();

$data = [];
foreach($rows as $row) {
    $data[]=array(
        'id' => $row['id'],
        'firstname' => $row['firstname'],
        'lastname' => $row['lastname'],
        'email' => $row['email'],
        'city' => $row['city'],
        'country' => $row['country'],
        'created_at' => $row['created_at'],
        'image_path' => $row['image_path'],
    );
}

echo json_encode([
    'success' => true,
    'data' => $data
]);
exit;

?>