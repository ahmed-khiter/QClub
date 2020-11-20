<?php
function Tracking(&$connection , $info){

    $query = 'INSERT INTO history (Time, tableNumber , Description) VALUES (:Time, :TableNumber , :Description)';
    $prepared = $connection->prepare($query);
    $prepared->bindValue(':Time', $info['Time']);
    $prepared->bindValue(':TableNumber', $info['TableNumber']);
    $prepared->bindValue(':Description', $info['Description']);
    $prepared->execute();
    //header('Location: ' . $_SERVER['HTTP_REFERER']);
    echo '<script>window.location.href = "'. $_SERVER['HTTP_REFERER'] .'"</script>';
    Exit();
}

