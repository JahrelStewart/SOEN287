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
            <div class="addDeleteEditbutton" style="width: 80%">
                <div class="inner-addDeleteEditbutton">
                    <a href="backEnd8.php"><img src="../icons/backEnd/plus-square.svg"> Add</a>
                </div>
                <div class="inner-addDeleteEditbutton">
                    <a href="backEnd8.php"><img src="../icons/backEnd/pencil-square.svg"> Edit</a>
                </div>
                <div class="inner-addDeleteEditbutton">
                    <a><img src="../icons/backEnd/x-square.svg"> Delete</a>
                </div>
            </div>

            <table class="tableList">
                <tr class="tableHeadings">
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Weight</th>
                    <th>Price</th>
                    <th></th>
                </tr>
                <tbody class="tableBody">
                    <?php
                    $showProductRow = '';
                    $getTable = '../xml/products.xml';
                    $aisles = simplexml_load_file($getTable);


                    foreach ($aisles->children() as $aisle) {
                        foreach ($aisle->children() as $product) {
                            $showProductRow .= '
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

                    echo $showProductRow;
                    ?>
                </tbody>
            </table>

        </div>
    </div>

    <script src="../script/backEnd7.js"></script>
</body>

</html>
