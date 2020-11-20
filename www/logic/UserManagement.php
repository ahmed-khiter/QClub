<?php

function login(&$connection, $userData) {
    $query = 'SELECT id FROM login WHERE username = :username AND password = :password';
    $prepared = $connection->prepare($query);
    $prepared->bindValue(':username', $userData['username']);
    $prepared->bindValue(':password', $userData['password']);
    $prepared->execute();
    $userID = $prepared->fetchColumn();
    if (!empty($userID)) {
        $_SESSION['userID'] = $userID;
    } else {
        $_SESSION['error'] = 'Wrong username or password';
    }
    // header('Location: ' . $_SERVER['HTTP_REFERER']);
    echo '<script>window.location.href = "'. $_SERVER['HTTP_REFERER'] .'"</script>';
    exit;
}

function logout() {
    session_unset();
    session_destroy();
    //header('Location: '. $_SERVER['HTTP_REFERER']);
    echo '<script>window.location.href = "'. $_SERVER['HTTP_REFERER'] .'"</script>';
    exit;
}
