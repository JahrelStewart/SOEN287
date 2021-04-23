<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/backend.css">
    <title>Order List</title>
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
            <div class="addDeleteEditbutton" style="width: 80%">
                <div class="inner-addDeleteEditbutton">
                    <a href="backend12.php"><img src="../icons/backEnd/plus-square.svg"> Add</a>
                </div>
                <div class="inner-addDeleteEditbutton">
                    <a href="backend12.php"><img src="../icons/backEnd/pencil-square.svg"> Edit</a>
                </div>
                <div class="inner-addDeleteEditbutton">
                    <a><img src="../icons/backEnd/x-square.svg"> Delete</a>
                </div>
            </div>

            <table class="tableOrderList">
                <tr class="tableHeadings">
                    <th>Order ID</th>
                    <th>Customer ID</th>
                    <th>Customer Name</th>
                    <th>Order Date</th>
                    <th>Number of items</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                <tbody class="tableOrderBody">
                    <?php
                    $showOrderRow = '';
                    $getOrderTable = '../xml/orders.xml';
                    $getOrders = simplexml_load_file($getOrderTable);

                    foreach ($getOrders->children() as $order) {
                        $showOrderRow .= '
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

                    echo $showOrderRow;
                    ?>

                </tbody>
            </table>

        </div>

    </div>

    <script src="../script/backEnd11.js"></script>
</body>

</html>