<?php
require_once('logic/HistoryManagement.php');
function addOrder(&$connection, $order) {
    $query ='INSERT INTO tables (TableNumber, Table_order) VALUES (:TableNumber, :IdDrink)';
    $prepared = $connection->prepare($query);
    $prepared->bindValue(':TableNumber', $order['TableNumber']);
    $prepared->bindValue(':IdDrink', $order['IdDrink']);
    $prepared->execute();
    Tracking($connection,$order);
    //header('Location: ' . $_SERVER['HTTP_REFERER']);
    echo '<script>window.location.href = "'. $_SERVER['HTTP_REFERER'] .'"</script>';
    exit;
}

function deleteOrder(&$connection, int $tableNumber) {
    $query = 'DELETE FROM tables WHERE TableNumber = :tableNumber';
    $prepared = $connection->prepare($query);
    $prepared->bindValue(':tableNumber', $tableNumber);
    $prepared->execute();
    //header('Location: ' . $_SERVER['HTTP_REFERER']);
    echo '<script>window.location.href = "'. $_SERVER['HTTP_REFERER'] .'"</script>';
    exit;
}

function deleteSingleOrder(&$connection, int $orderId) {
    $query = 'DELETE FROM tables WHERE id = :id';
    $prepared = $connection->prepare($query);
    $prepared->bindValue(':id', $orderId);
    $prepared->execute();
    //header('Location: ' . $_SERVER['HTTP_REFERER']);
    echo '<script>window.location.href = "'. $_SERVER['HTTP_REFERER'] .'"</script>';
    exit;
}
