<?php
$query = 'UPDATE drinks SET Name = :name, price = :price WHERE id = :id';
$prepared = $connection->prepare($query);
$prepared->bindValue(':id', trim($_POST['id']));
$prepared->bindValue(':name', trim($_POST['name']));
$prepared->bindValue(':price', trim($_POST['price']));
$prepared->execute();
header('Location: /');
die();