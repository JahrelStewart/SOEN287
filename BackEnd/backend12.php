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
            <form class="form" action="../BackEndPhp/Order.php">
                <h1>Order Editor</h1>

                <label for="customerName">Customer Name:</label>
                <input type="text" name="customerName" id="customerName" placeholder="Joy Boy">

                <label for="orderDate">Order Date:</label>
                <input type="date" name="orderDate" id="orderDate" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" placeholder="YYYY-MM-DD" maxlength="10">

                <label for="numberItems">Number of Items:</label>
                <input type="number" min="1" max="9999" name="numberItems" id="numberOfItems" placeholder="00" maxlength="2">

                <label for="orderStatus">Status</label>
                <select id="orderStatus" name="orderStatus" style="font-family: Amaranth; font-size: 15px;">
                    <option value="processed">Proccessed</option>
                    <option value="shipped">Shipped</option>
                    <option value="enroute">En Route</option>
                    <option value="arrived">Arrived</option>
                </select>

                <input type="submit" name="orderSubmit" value="Save">

            </form>
        </div>

    </div>


</body>

</html>