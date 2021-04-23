<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <link rel="stylesheet" href="../css/backend.css">
    <meta charset="utf-8">
    <title>Admin</title>
</head>

<body>

    <div class="BEheader">
        <div class="logo">
            <a href="backEnd7.php">Grocery</a>
        </div>
        <a href="../index.php" class="frontEnd">Front End</a>
    </div>

    <div class="mainGrid">
        <div class="sideBar">
            <div class="NavCard">

                <a href="backEnd7.php">PRODUCTS</a>
                <a href="backEnd9.php">ACCOUNTS</a>
                <a href="backend11.php">ORDERS</a>

            </div>
        </div>

        <div class="BEmain">
            <h1 id="p10Heading">Profile Settings </h1>
            <div class="profile-picture">
                <img src="../images/other/blank-profile.png" class="list-item-image" style="width:200px;">
                <button class="profileBut p9but">Upload Image</button>
            </div>
            <div class="userForm">
                <form action="../BackEndPhp/User.php">
                    <label for="fName">First Name</label>
                    <input placeholder="firstName" name="fName" type="text">
                    <br>

                    <label for="lName">Last Name</label>
                    <input placeholder="firstName" name="lName" type="text">
                    <br>

                    <label for="eMail">Email</label>
                    <input placeholder="someone@hotmail.com" name="eMail" type="text">
                    <br>

                    <label for="userPassword">Password</label>
                    <input placeholder="Enter password" name="userPassword" type="password">

                    <input id="p10Save" type="submit" name="BackEndAddUser" value="Save">
                </form>
            </div>
        </div>
    </div>

</body>

</html>