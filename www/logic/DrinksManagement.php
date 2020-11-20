<?php

require_once('logic/HistoryManagement.php');

function addDrink(&$connection, $drink) {
    $query = 'INSERT INTO drinks (Name, price) VALUES (:name, :price)';
    $prepared = $connection->prepare($query);
    $prepared->bindValue(':name', $drink['name']);
    $prepared->bindValue(':price', $drink['price']);
    $prepared->execute();
    //header('Location: ' . $_SERVER['HTTP_REFERER']);
    echo '<script>window.location.href = "'. $_SERVER['HTTP_REFERER'] .'"</script>';
    exit;
}

function deleteDrink(&$connection, int $id) {
    $query = 'DELETE FROM drinks WHERE id = :id';
    $prepared = $connection->prepare($query);
    $prepared->bindValue(':id', $id);
    $prepared->execute();
    //header('Location: ' . $_SERVER['HTTP_REFERER']);
    echo '<script>window.location.href = "'. $_SERVER['HTTP_REFERER'] .'"</script>';
    exit;
}

function getDrinks(&$connection)
{
    $query = 'SELECT * FROM drinks';
    $prepared = $connection->prepare($query);
    $prepared->execute();
    return $prepared->fetchAll(PDO::FETCH_ASSOC);
}

function getDrinkById(&$connection, int $id)
{
    $query = 'SELECT * FROM drinks WHERE id = :id';
    $prepared = $connection->prepare($query);
    $prepared->bindValue(':id', $id);
    $prepared->execute();
    return $prepared->fetchAll(PDO::FETCH_ASSOC);
}

function getDrinksByTableNum(&$connection, $tableNum) {
    $drinks = [];
    $query = 'SELECT id, Table_order FROM tables WHERE TableNumber = :tn';
    $prepared = $connection->prepare($query);
    $prepared->bindValue(':tn', $tableNum);
    $prepared->execute();
    while ($row = $prepared->fetch(PDO::FETCH_ASSOC)) {
        $q = 'SELECT * FROM drinks WHERE id = :id';
        $p = $connection->prepare($q);
        $p->bindValue(':id', $row['Table_order']);
        $p->execute();
        while ($r = $p->fetch(PDO::FETCH_ASSOC)) {
            $r['order_id'] = $row['id'];
            $drinks[] = $r;
        }
    }
    return $drinks;
}

function updateDrink(&$connection , $drink) {
    $query = 'UPDATE drinks SET Name = :name, price = :price WHERE id = :drinkID';
    $prepared = $connection->prepare($query);
    $prepared->bindValue(':name', $drink['name']);
    $prepared->bindValue(':price', $drink['price']);
    $prepared->bindValue(':drinkID', $drink['id']);
    $prepared->execute();
    //header('Location: ' . $_SERVER['HTTP_REFERER']);
    echo '<script>window.location.href = "'. $_SERVER['HTTP_REFERER'] .'"</script>';
    exit;
}

function DebugArray(array $arrayToDebug) {
    echo '<pre>';
    print_r($arrayToDebug);
    echo '</pre>';
    die();
}
