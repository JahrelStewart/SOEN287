<?php
//include('./BackEndPhp/User.php');
//session_set_cookie_params(0);
session_start();
$pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
if ($pageWasRefreshed) {
    $_SESSION['islogged'] = false;
    //unset($_SESSION["isLogged"]);
} else {
}


//unset($_SESSION["isLogged"]);
$pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';

if ($pageWasRefreshed) {
    $_SESSION['islogged'] = false;
    //unset($_SESSION["isLogged"]);
} else {
}
if (!isset($_SESSION['isLogged'])) {
    $_SESSION['isLogged'] = false;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/Aisle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>Candy</title>
</head>

<body>

    <div class="container-fluid">

        <!-- This is a header division -->
        <div class="row">
            <div class="header col-12">
                <div class="logo">
                    Grocery
                </div>
                <div class="cart_and_accont">
                    <a href="../shoppingCart.php" class="cart">
                        <img src="../icons/shopping-cart.svg" height="18px" width="18px">
                        <span>Cart</span>
                    </a>
                    <a href="../LoginPage.html" class="Account">
                        <img src="../icons/account.png" height="18px" width="18px">
                        <span>Account</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- This is the division for navagation bar -->
        <div class="row">

            <div class="navbar col-12">
                <!--Home brings us back to main page -->
                <div class="inner-Navbar">
                    <a href="../index.php">Home</a>

                    <!--class drop down Aisle in menu bar -->
                    <div class="dropdown">
                        <div class="dropbutton">Aisle</div>
                        <div class="dropdown-content">
                            <a href="../Aisles/fruitsAisle.php">Fruits and Vegetables</a>
                            <a href="../Aisles/dairyAisle.php">Dairy</a>
                            <a href="../Aisles/pastaAisle.php">Pasta</a>
                            <a href="../Aisles/meatAisle.php">Meats</a>
                            <a href="../Aisles/seafoodAisle.php">Seafood</a>
                            <a href="../Aisles/candyAisle.php">Candy</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- This is the division for Banner -->
        <div class="row">
            <div class="Banner col-12">
                <div class="title">Candy</div>
            </div>
        </div>

        <!-- This is the division for Products -->
        <div class="row">
            <div class="background col-12">
                <?php
                $showAisleProducts = '';
                $getTable = '../xml/products.xml';
                $aisles = simplexml_load_file($getTable);
                $aisle = $aisles->candy;

                foreach ($aisle->children() as $product) {
                    $showAisleProducts .= '
                        <a href="../ProductDescriptions/candyProductDescriptions/' . $product->getName() . '.php">
                            <div class="item">
                                <div class="image" style="background-image: url(' . $product->image . ')"></div>
                                <h1>' . $product->name . '</h1>
                                <h2>' . $product->weight . 'g</h2>
                            </div>
                        </a>
                            ';
                }

                echo $showAisleProducts;
                ?>
            </div>
        </div>

        <!-- This is the division for Footer -->
        <div class="row">
            <div class="footer">

                <div class="section">
                    <div class="title">Grocery</div>
                    <img src="../icons/shopping-bag.svg" height="158px" width="158px">
                </div>

                <div class="section">
                    <div class="member-title">Group Members</div>
                    <div class="members">
                        <ul class="member-list">
                            <li>Annika Timermanis</li>
                            <li>Phuong Anh Trinh</li>
                            <li>Osama Hussein</li>
                            <li>Axel Solano</li>
                            <li>Jahrel Stewart</li>
                            <li>Charles Antoine</li>
                        </ul>
                    </div>
                </div>

                <div class="section">
                    <div class="innerSection">
                        <div class="contact-title">Contact</div>
                        <ul class="contact-list">
                            <li>XXX-XXX-XXXX</li>
                            <li>XXXX@gmail.com</li>
                        </ul>
                    </div>

                    <?php
                    if ($_SESSION['islogged'] === true) {
                        echo "<a href='../BackEnd/backEnd7.php' class='backEnd'>Back End</a>";
                        //session_destroy();
                    } else {
                    }

                    ?>
                    <button id="logout" onclick=" <?php $_SESSION['isLogged'] = false; ?> location.reload(); ">LOG OUT</button>

                </div>
            </div>
        </div>

    </div>

</body>

</html>