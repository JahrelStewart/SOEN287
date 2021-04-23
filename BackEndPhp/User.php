<?php
session_start();

if (isset($_REQUEST['deleteUserID'])) {
    $deleteUser = $_REQUEST['deleteUserID'];

    $file = '../xml/users.xml';
    $users = simplexml_load_file($file);

    foreach ($users->children() as $u) {
        if ($u->userID == $deleteUser) {
            $dom = dom_import_simplexml($u);
            $dom->parentNode->removeChild($dom);
            break;
        }
    }

    $users->asXML($file);

    $showUserRow = '';

    foreach ($users->children() as $user) {
        $showUserRow .= '
        <li class="list-item">
            <div>
                <img src="../images/other/blank-profile.png" class="list-item-image">
            </div>
            <div class="list-item-content">
                <form class="list-item-content-form" action="../BackEndPhp/User.php">
                    <h4>' . $user->firstName . ' ' . $user->lastName . '</h4>
                    <p>ID: ' . $user->userID . '</p>
                    <input type="hidden" name="editUserID" value="' . $user->userID . '"/>
                    <input class="deleteEditUser p9but" type="submit" name="BackEndEditUser" value="Edit User">
                    <input class="deleteEditUser p9but" id="userDelete" type="submit" name="BackEndDeleteUser" value="Delete User">
                </form>
            </div>                            
        </li>
        ';
    }

    echo $showUserRow;
}

if (isset($_GET['BackEndEditUser'])) {
    $_SESSION['editUserID'] = $_GET['editUserID'];
    $_SESSION['userToEdit'] = true;

    // echo $_SESSION['editUserID'];

    header('Location: ../BackEnd/backEnd10.php');
}

// if (!isset($_SESSION['userToEdit'])) {
//     $_SESSION['userToEdit'] = false;
// }

if (isset($_GET['submit'])) {
    $firstname = $_GET['firstName'];
    $lastname = $_GET['lastName'];
    $email = $_GET['emailEmail'];
    $password = $_GET['password'];

    $file = '../xml/users.xml';

    $users = simplexml_load_file($file);
    $user = $users->addChild("user");

    if (!isset($_SESSION['userID'])) {
        $_SESSION['userID'] = 0;
    } else {
        $_SESSION['userID'] = $_SESSION['userID'] + 1;
    }

    $user->addChild('userID', $_SESSION['userID']);
    $user->addChild('firstName', $firstname);
    $user->addChild('lastName', $lastname);
    $user->addChild('Email', $email);
    $user->addChild('Password', $password);

    $users->asXML($file);

    header('Location: ../index.php');
}

if (!isset($_SESSION['islogged'])) {
    $_SESSION['islogged'] = false;
}

if (isset($_GET['BackEndAddUser'])) {
    $firstname = $_GET['fName'];
    $lastname = $_GET['lName'];
    $email = $_GET['eMail'];
    $password = $_GET['userPassword'];

    $file = '../xml/users.xml';

    $users = simplexml_load_file($file);

    if ($_SESSION['userToEdit'] == false) {
        $user = $users->addChild("user");

        if (!isset($_SESSION['userID'])) {
            $_SESSION['userID'] = 0;
        } else {
            $_SESSION['userID'] = $_SESSION['userID'] + 1;
        }

        $user->addChild('userID', $_SESSION['userID']);
        $user->addChild('firstName', $firstname);
        $user->addChild('lastName', $lastname);
        $user->addChild('Email', $email);
        $user->addChild('Password', $password);
    } else {
        foreach ($users->children() as $u) {
            if ($u->userID == $_SESSION['editUserID']) {
                $u->firstName = $firstname;
                $u->lastName = $lastname;
                $u->Email = $email;
                $u->Password = $password;

                break;
            }
        }

        $_SESSION['userToEdit'] = false;
    }

    $users->asXML($file);

    header('Location: ../BackEnd/backEnd9.php');
}


if (isset($_GET['login'])) {
    $logEmail = $_GET['logEmail'];
    $logPassword = $_GET['logPassword'];

    $_SESSION['islogged'] = true;

    header('Location: ../index.php');
}
