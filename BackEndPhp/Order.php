<?php
session_start();

if (isset($_REQUEST['deleteOrderID'])) {
    $deleteOrder = $_REQUEST['deleteOrderID'];

    $file = '../xml/orders.xml';
    $orders = simplexml_load_file($file);

    foreach ($orders->children() as $o) {
        if ($o->orderID == $deleteOrder) {
            $dom = dom_import_simplexml($o);
            $dom->parentNode->removeChild($dom);
            break;
        }
    }

    $orders->asXML($file);

    $showUpdatedOrderTable = '';

    foreach ($orders->children() as $order) {
        $showUpdatedOrderTable .= '
        <tr>
        <td>' . $order->orderID . '</td>
        <td>' . $order->customerID . '</td>
        <td>' . $order->orderCustomerName . '</td>
        <td>' . $order->orderDate . '</td>
        <td>' . $order->orderNumberItems . '</td>
        <td>' . $order->orderStatus . '</td>
        <th><input type="radio" name="select" value="select"></th>
        </tr>
        ';
    }

    echo $showUpdatedOrderTable;
}


if (isset($_REQUEST['editOrderID'])) {
    $_SESSION['editOrderID'] = $_REQUEST['editOrderID'];
    $_SESSION['orderToEdit'] = true;
}

if (!isset($_SESSION['orderToEdit'])) {
    $_SESSION['orderToEdit'] = false;
}

if (isset($_GET['orderSubmit'])) {
    $orderCustomerName = $_GET['customerName'];
    $orderDate = $_GET['orderDate'];
    $orderNumberItems = $_GET['numberItems'];
    $orderStatus = $_GET['orderStatus'];

    $file = '../xml/orders.xml';
    $orders = simplexml_load_file($file);

    if ($_SESSION['orderToEdit'] == false) {
        $order = $orders->addChild("order");

        if (!isset($_SESSION['orderID'])) {
            $_SESSION['orderID'] = 0;
        } else {
            $_SESSION['orderID'] = $_SESSION['orderID'] + 1;
        }

        if (!isset($_SESSION['customerID'])) {
            $_SESSION['customerID'] = 0;
        } else {
            $_SESSION['customerID'] = $_SESSION['customerID'] + 2;
        }

        $order->addChild('orderID', $_SESSION['orderID']);
        $order->addChild('customerID', $_SESSION['customerID']);
        $order->addChild('orderCustomerName', $orderCustomerName);
        $order->addChild('orderDate', $orderDate);
        $order->addChild('orderNumberItems', $orderNumberItems);
        $order->addChild('orderStatus', $orderStatus);
    } else {
        foreach ($orders->children() as $o) {
            if ($o->orderID == $_SESSION['editOrderID']) {
                $o->orderCustomerName = $orderCustomerName;
                $o->orderDate = $orderDate;
                $o->orderNumberItems = $orderNumberItems;
                $o->orderStatus = $orderStatus;

                break;
            }
        }

        $_SESSION['orderToEdit'] = false;
    }

    $orders->asXML($file);

    header('Location: ../BackEnd/backEnd11.php');
}
