<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <link rel="stylesheet" href="../css/backend.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <form class="form" action="../BackEndPhp/Product.php">
                <h1>Product Editor</h1>
                <label for="productAisle">Aisle</label>
                <select id="orderStatus" name="productAisle" style="font-family: Amaranth; font-size: 15px;">
                    <option value="Fruit Aisle">Fruit Aisle</option>
                    <option value="Dairy Aisle">Dairy Aisle</option>
                    <option value="Pasta Aisle">Pasta Aisle</option>
                    <option value="Meat Aisle">Meat Aisle</option>
                    <option value="Seafood Aisle">Seafood Aisle</option>
                    <option value="Candy Aisle">Candy Aisle</option>
                </select>

                <label for="productImage" class="imagelbl">Image</label>
                <input placeholder=" Enter URL" name="productImage" type="text" id="image">
                <label for="productName" class="namelbl">Name</label>
                <input placeholder="Enter product Name" name="productName" type="name" id="name">
                <label for="productWeight" class="quantitylbl">Weight</label>
                <input placeholder="1" name="productWeight" type="number" step=".01" id="weight">
                <label for="productPrice" class="quantitylbl">Price</label>
                <input placeholder="1" name="productPrice" type="number" step=".01" id="price">

                <input type="submit" name="productSubmit" value="Save">

            </form>
        </div>
    </div>
    <div class="BEfooter">
    </div>

</body>

</html>