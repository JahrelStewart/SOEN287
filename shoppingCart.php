<?php
include('./php/cartClass.php');
session_start(); 

if(!isset($_SESSION['ShoppingCartSession'])){        
    $_SESSION['ShoppingCartSession'] = array();
}

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="./css/shoppingCart.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>Cart</title>
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
                    <a href="shoppingCart.php" class="cart">
                        <img src="./icons/shopping-cart.svg" height="18px" width="18px">
                        <span>Cart</span>
                    </a>
                    <a href="LoginPage.html" class="Account">
                        <img src="./icons/account.png" height="18px" width="18px">
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
                    <a href="index.html">Home</a>

                    <!--class drop down Aisle in menu bar -->
                    <div class="dropdown">
                        <div class="dropbutton">Aisle</div>
                        <div class="dropdown-content">
                            <a href="./Aisles/fruitsAisle.html">Fruits and Vegetables</a>
                            <a href="./Aisles/dairyAisle.html">Dairy</a>
                            <a href="./Aisles/pastaAisle.html">Pasta</a>
                            <a href="./Aisles/meatAisle.html">Meats</a>
                            <a href="./Aisles/seafoodAisle.html">Seafood</a>
                            <a href="./Aisles/candyAisle.html">Candy</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="shopping-cart">
                <!-- Title -->
                <div class="cartTitle">Shopping Cart</div>

                <div class="information">
                    <div class="itemList">
                        
                        <?php 
                            $showItem = '';                                                    

                            foreach($_SESSION['ShoppingCartSession'] as $key => $value){
                                $showItem .= '
                                <div class="item">
                                    <div class="column">
                                        <div class="delete-btn">
                                            <div class="delete-image" style="background-image: url(../images/other/cross.png)">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="column">
                                        <div style="background-image:url('.$value->item_image.')"></div>
                                    </div>

                                    <div class="column">
                                        <a href="'.$value->item_link.'">'.$value->item_name.'</a>
                                    </div>

                                    <div class="column">
                                        <button type="button" class="plusMinus">-</button>

                                        <input class="input-quantity" type="number" value="'.$value->item_quantity.'">

                                        <button type="button" class="plusMinus">+</button>
                                    </div>

                                    <div class="column" data-value="'.$value->item_price.'">$'.number_format($value->item_price * $value->item_quantity, 2, '.', '').'</div>
                                </div>
                                ';
                            }
                            
                            echo $showItem;
                        ?>

                    </div>

                    <div class="summary">
                        <div class="summaryMessage">Summary</div>
                        <div class="totalPrice">
                            <div class="price"><span>TOTAL</span> $49.13</div>
                            <div class="price"><span>NUMBER OF ITEMS</span> 4</div>
                            <div class="price"><span>GST</span> 5%</div>
                            <div class="price"><span>QST</span> 9.98%</div>
                        </div>
                        <div class="options">
                            <a href="./index.html" class="cart-button">Continue Shopping</a>
                            <a class="cart-button">Proceed to Checkout</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Footer-->
        <div class="row">
            <div class="footer">

                <div class="section">
                    <div class="title">Grocery</div>
                    <img src="./icons/shopping-bag.svg" height="158px" width="158px">
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

                    <a href="./BackEnd/backEnd7.html" class="backEnd">Back End</a>

                </div>
            </div>
        </div>

    </div>

    <script src="./script/shoppingCart.js"></script>

</body>

</html>
