<?php
include('cartClass.php');
session_start();

if (!isset($_REQUEST['itemName'])) {
    $itemName = '';
} else {
    $itemName = $_REQUEST['itemName'];
}

if (!isset($_REQUEST['itemImage'])) {
    $itemImage = '';
} else {
    $itemImage = $_REQUEST['itemImage'];
}

if (!isset($_REQUEST['itemLink'])) {
    $itemLink = '';
} else {
    $itemLink = $_REQUEST['itemLink'];
}

if (!isset($_REQUEST['itemQuantity'])) {
    $itemQuantity = '';
} else {
    $itemQuantity = $_REQUEST['itemQuantity'];
}

if (!isset($_REQUEST['itemPrice'])) {
    $itemPrice = '';
} else {
    $itemPrice = $_REQUEST['itemPrice'];
}

if (!isset($_SESSION['ShoppingCartSession'])) {
    $_SESSION['ShoppingCartSession'] = array();
} else {
    if (array_key_exists($itemLink, $_SESSION['ShoppingCartSession'])) {
        $_SESSION['ShoppingCartSession'][$itemLink]->item_name = $itemName;
        $_SESSION['ShoppingCartSession'][$itemLink]->item_image = $itemImage;
        $_SESSION['ShoppingCartSession'][$itemLink]->item_link = $itemLink;
        $_SESSION['ShoppingCartSession'][$itemLink]->item_quantity = $itemQuantity;
        $_SESSION['ShoppingCartSession'][$itemLink]->item_price = $itemPrice;
    } else {
        $newItem = array($itemLink => new cartItems($itemName, $itemImage, $itemLink, $itemQuantity, $itemPrice));
        $_SESSION['ShoppingCartSession'] = array_merge($_SESSION['ShoppingCartSession'], $newItem);
    }
}


if (!isset($_REQUEST['itemDeleteKey'])) {
    $itemDeleteKey = '';
} else {
    $itemDeleteKey = $_REQUEST['itemDeleteKey'];

    unset($_SESSION['ShoppingCartSession'][$itemDeleteKey]);

    $arrWithoutEmpty = array_filter($_SESSION['ShoppingCartSession']);
    $arrSize = count($_SESSION['ShoppingCartSession']) - 1;
    $_SESSION['ShoppingCartSession'] = array_splice($arrWithoutEmpty, 0, $arrSize);

    //Send over new list of items when an item is deleted:
    $showItem = '';

    foreach ($_SESSION['ShoppingCartSession'] as $key => $value) {
        $showItem .= '
        <div class="item">
            <div class="column">
                <div class="delete-btn">
                    <div class="delete-image" style="background-image: url(../images/other/cross.png)">
                    </div>
                </div>

            </div>

            <div class="column">
                <div style="background-image:url(' . $value->item_image . ')"></div>
            </div>

            <div class="column">
                <a href="' . $value->item_link . '">' . $value->item_name . '</a>
            </div>

            <div class="column">
                <button type="button" class="plusMinus">-</button>

                <input class="input-quantity" type="number" value="' . $value->item_quantity . '">

                <button type="button" class="plusMinus">+</button>
            </div>

            <div class="column" data-value="' . $value->item_price . '">$' . number_format($value->item_price * $value->item_quantity, 2, '.', '') . '</div>
        </div>
        ';
    }

    echo $showItem;

    // echo count($_SESSION['ShoppingCartSession']);

    // foreach ($_SESSION['ShoppingCartSession'] as $key => $value) {    
    //     // echo $value->item_name;    
    //     echo "\n{$value->item_name}";   
    //     // echo $value->item_link; 
    //     // echo $value->item_quantity; 
    // }

    // echo "\n---";
}

// $itemDetails = new \stdClass;
// $itemDetails->count = count($_SESSION['ShoppingCartSession']);
// $itemDetails->itemArr = array();

// foreach ($_SESSION['ShoppingCartSession'] as $key => $value) {    
//     $item = new \stdClass;
//     $item->itemName = $value->item_name;
//     $item->itemImage = $value->item_image;
//     $item->itemLink = $value->item_link;
//     $item->itemQuantity = $value->item_quantity;

//     array_push($itemDetails->itemArr, $item);
// }


//Used to destroy all sessions:
// unset($_SESSION['ShoppingCartSession']);
