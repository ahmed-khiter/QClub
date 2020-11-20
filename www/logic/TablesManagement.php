<?php

function getTables(&$connection) {
    $query = 'SELECT * from tablesnumber';
    $prepared = $connection->prepare($query);
    $prepared->execute();
    return $prepared->fetchAll(PDO::FETCH_ASSOC);
}

function getTablesUnique(&$connection) {
    $query = 'SELECT DISTINCT TableNumber FROM tables ORDER BY TableNumber ASC';
    $prepared = $connection->prepare($query);
    $prepared->execute();
    return $prepared->fetchAll(PDO::FETCH_ASSOC);
}
