<?php
session_start();

$aURL = $_REQUEST['aURL'];
$inputquantity = $_REQUEST['inputquantity'];

if (!isset($_SESSION['allSessions'])) {
    $_SESSION['allSessions'] = array();
} else {
    if (array_key_exists($aURL, $_SESSION['allSessions'])) {
        $_SESSION['allSessions'][$aURL] = $inputquantity;
    } else {
        $newURL = array($aURL => $inputquantity);
        $_SESSION['allSessions'] = array_merge($_SESSION['allSessions'], $newURL);
    }

    if (!isset($_SESSION[$aURL])) {
        $_SESSION[$aURL] = 1;
    } else {
        $_SESSION[$aURL] = $_SESSION['allSessions'][$aURL];
    }
}

//Used to destroy all sessions:
// unset($_SESSION['allSessions']);
// unset($_SESSION[$aURL]);

//Used to observe changes made to quantity values on differnet product description pages:
foreach ($_SESSION['allSessions'] as $key => $value) {
    echo "{$key} => {$value} ";
}
