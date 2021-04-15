<?php
if ( isset( $_GET['submit'] ) ) { 
    $firstname = $_GET['firstName']; 
    $lastname = $_GET['lastName'];     
    $email = $_GET['emailEmail'];   
    $password = $_GET['password'];       

    $file = '../xml/users.xml';

    $users = simplexml_load_file($file);
    $user = $users->addChild('user');
  
    $user->addChild('firstName', $firstname);
    $user->addChild('lastName', $lastname);
    $user->addChild('Email', $email);
    $user->addChild('Password', $password);

    $users->asXML($file);
}
?>



