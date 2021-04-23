<?php
session_start();

if (isset($_REQUEST['deleteID'])) {
    $deleteProduct = $_REQUEST['deleteID'];

    $file = '../xml/products.xml';
    $aisles = simplexml_load_file($file);

    foreach ($aisles->children() as $aisle) {
        foreach ($aisle->children() as $product) {
            if ($product->productID == $deleteProduct) {
                $dom = dom_import_simplexml($product);
                $dom->parentNode->removeChild($dom);
                break;
            }
        }
    }

    $aisles->asXML($file);

    $showUpdatedTable = '';

    foreach ($aisles->children() as $aisle) {
        foreach ($aisle->children() as $product) {
            $showUpdatedTable .= '
            <tr>
            <td>' . $product->productID . '</td>
            <td><img style="max-width: 75px" src="' . $product->image . '" /></td>
            <td>' . $product->name . '</td>
            <td>' . $product->weight . '</td>
            <td>$' . $product->price . '</td>
            <th><input type="radio" name="select" value="select"></th>
            </tr>
            ';
        }
    }

    echo $showUpdatedTable;
}


if (isset($_REQUEST['editID'])) {
    $_SESSION['editID'] = $_REQUEST['editID'];
    $_SESSION['toEdit'] = $_REQUEST['toEdit'];
}

if (!isset($_SESSION['toEdit'])) {
    $_SESSION['toEdit'] = false;
}

if (isset($_GET['productSubmit'])) {
    $productAisle = $_GET['productAisle'];
    $productName = $_GET['productName'];
    $productImage = $_GET['productImage'];
    $productWeight = $_GET['productWeight'];
    $productPrice = $_GET['productPrice'];

    $file = '../xml/products.xml';
    $aisles = simplexml_load_file($file);

    if ($productAisle == "Fruit Aisle") {
        $aisle = $aisles->fruits;
    } else if ($productAisle == "Dairy Aisle") {
        $aisle = $aisles->dairy;
    } else if ($productAisle == "Pasta Aisle") {
        $aisle = $aisles->pasta;
    } else if ($productAisle == "Meat Aisle") {
        $aisle = $aisles->meats;
    } else if ($productAisle == "Seafood Aisle") {
        $aisle = $aisles->seafood;
    } else {
        $aisle = $aisles->candy;
    }


    if ($_SESSION['toEdit'] == false) {
        $product = $aisle->addChild($productName);

        if (!isset($_SESSION['productID'])) {
            $_SESSION['productID'] = 54;
        } else {
            $_SESSION['productID'] = $_SESSION['productID'] + 1;
        }

        $product->addChild('productID', $_SESSION['productID']);
        $product->addChild('name', $productName);
        $product->addChild('image', $productImage);
        $product->addChild('weight', $productWeight);
        $product->addChild('price', $productPrice);


        // create new product description php page for the added product
        $newProductDescription = fopen("../ProductDescriptions/" . $aisle->getName() . "ProductDescriptions/" . $product->getName() . ".php", "w") or die("Unable to open file!");
        $contents = "<?php                                                          
            session_start();            

            \$filename = explode(\"/\", \$_SERVER[\"SCRIPT_NAME\"]);
            \$filename = \$filename[count(\$filename) - 1];

            if (!isset(\$_SESSION['allSessions'])) {
                \$_SESSION['allSessions'] = array();
            }

            if (!isset(\$_SESSION[\$filename])) {
                \$_SESSION[\$filename] = 1;
            }

            ?>

            <!DOCTYPE html>
            <html>

            <head>
                <link rel=\"stylesheet\" href=\"../../css/productDescription.css\">
                <meta charset=\"utf-8\">
                <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
                <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css\">

                <title>Chocolate Milk 2%</title>

            </head>

            <body>
                <div class=\"container-fluid\">

                    <!-- This is a header division -->
                    <div class=\"row\">
                        <div class=\"header col-12\">
                            <div class=\"logo\">
                                Grocery
                            </div>
                            <div class=\"cart_and_accont\">
                                <a href=\"../../shoppingCart.php\" class=\"cart\">
                                    <img src=\"../../icons/shopping-cart.svg\" height=\"18px\" width=\"18px\">
                                    <span>Cart</span>
                                </a>
                                <a href=\"../../LoginPage.html\" class=\"Account\">
                                    <img src=\"../../icons/account.png\" height=\"18px\" width=\"18px\">
                                    <span>Account</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- This is the division for navagation bar -->
                    <div class=\"row\">

                        <div class=\"navbar col-12\">
                            <!--Home brings us back to main page -->
                            <div class=\"inner-Navbar\">
                                <a href=\"../../index.php\">Home</a>

                                <!--class drop down Aisle in menu bar -->
                                <div class=\"dropdown\">
                                    <div class=\"dropbutton\">Aisle</div>
                                    <div class=\"dropdown-content\">
                                        <a href=\"../../Aisles/fruitsAisle.php\">Fruits and Vegetables</a>
                                        <a href=\"../../Aisles/dairyAisle.php\">Dairy</a>
                                        <a href=\"../../Aisles/pastaAisle.php\">Pasta</a>
                                        <a href=\"../../Aisles/meatAisle.php\">Meats</a>
                                        <a href=\"../../Aisles/seafoodAisle.php\">Seafood</a>
                                        <a href=\"../../Aisles/candyAisle.php\">Candy</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- This is the division for Product Description bar -->

                    <div class=\"row\">

                        <?php
                        \$getProductDescription = '../../xml/products.xml';
                        \$aisles = simplexml_load_file(\$getProductDescription);
                        \$product = \$aisles->" . $aisle->getName() . "->" . $product->getName() . ";

                        \$showProductDescription = '
                            <div class=\"middle\">
                                <div class=\"directory\">
                                    <div class=\"message\">' . \$product->name . '</div>
                                    <div class=\"innerAisle\">FRUITS AND VEGETABLES</div>
                                </div>

                                <div class=\"product_and_description\">
                                    <div class=\"box picture-container\">
                                        <div class=\"picture\" style=\"background-image: url(' . \$product->image . ')\">
                                        </div>
                                    </div>

                                    <!-- Slider for different colour apples -->
                                    <div class=\"box description\">
                                        <div class=\"align\">

                                            <div class=\"descriptionRow\" data-value=\"' . \$product->weight . '\" data-measure=\"g\"><span>WEIGHT</span> ' . \$product->weight . 'g</div>

                                            <div class=\"descriptionRow\" data-value=\"' . \$product->price . '\"><span>PRICE</span> \$' . \$product->price . '</div>

                                            <div class=\"descriptionRow\">
                                                <button type=\"button\" class=\"plusMinus\">-</button>

                                                <input class=\"input-quantity\" type=\"number\" value=\"\">

                                                <button type=\"button\" class=\"plusMinus\">+</button>
                                            </div>

                                            <button class=\"descriptionRow\">Add to Cart</button>

                                            <button class=\"descriptionRow\" id=\"moreDescription\">More Description...</button>
                                        </div>

                                        <div class=\"smallCarousel\">
                                            <div class=\"goBack\" style=\"background-image: url(../../icons/right-arrow.svg)\"></div>
                                            <!-- more description -->
                                            <div class=\"detail\">An excellent source of nutrition packed with flavour!</div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            ';

                        echo \$showProductDescription;
                        ?>
                    </div>

                    <!-- This is the division for Footer bar -->

                    <div class=\"row\">
                        <div class=\"footer\">

                            <div class=\"section\">
                                <div class=\"title\">Grocery</div>
                                <img src=\"../../icons/shopping-bag.svg\" height=\"158px\" width=\"158px\">
                            </div>

                            <div class=\"section\">
                                <div class=\"member-title\">Group Members</div>
                                <div class=\"members\">
                                    <ul class=\"member-list\">
                                        <li>Annika Timermanis</li>
                                        <li>Phuong Anh Trinh</li>
                                        <li>Osama Hussein</li>
                                        <li>Axel Solano</li>
                                        <li>Jahrel Stewart</li>
                                        <li>Charles Antoine</li>
                                    </ul>
                                </div>
                            </div>

                            <div class=\"section\">
                                <div class=\"innerSection\">
                                    <div class=\"contact-title\">Contact</div>
                                    <ul class=\"contact-list\">
                                        <li>XXX-XXX-XXXX</li>
                                        <li>XXXX@gmail.com</li>
                                    </ul>
                                </div>

                                <a href=\"../../BackEnd/backEnd7.php\" class=\"backEnd\">Back End</a>

                            </div>
                        </div>
                    </div>

                </div>

                <script type=\"text/javascript\">
                    const inputQuantity = document.querySelector('.descriptionRow:nth-child(3) .input-quantity');
                    inputQuantity.value = <?php echo (\$_SESSION[\$filename] == \"\") ? 1 : \$_SESSION[\$filename]; ?>;
                </script>

                <script type=\"text/javascript\" src=\"../../script/productDescription.js\"></script>

            </body>

            </html>
        ";

        fwrite($newProductDescription, $contents);
        fclose($newProductDescription);
    } else {
        foreach ($aisle->children() as $product) {
            if ($product->productID == $_SESSION['editID']) {
                $product->name = $productName;
                $product->image = $productImage;
                $product->weight = $productWeight;
                $product->price = $productPrice;

                break;
            }
        }

        $_SESSION['toEdit'] = false;
    }

    $aisles->asXML($file);

    header('Location: ../BackEnd/backEnd7.php');
}
