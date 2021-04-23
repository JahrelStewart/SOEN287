<!-- start this one -->
<?php
if (isset($_GET['action'])) {
    $orders = simplexml_load_file('../xml/orders.xml');
    $orderID = $_GET['orderID'];
    $index = 0;
    $i = 0;
    foreach ($orders->order as $order) {
        if ($order['orderID'] == $orderID) {
            $index = $i;
            break;
        }
        $i++;
    }
    unset($orders->order[$index]);
    file_put_contents('../xml/orders.xml', $orders->asXML());
}

$orders = simplexml_load_file('../xml/orders.xml');
?> 
<!-- end this one -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/backend.css">
    <title>Order List</title>
<!-- 
    <script>
        window.addEventListener("load", function () {
            getRows();
        });

        function getRows() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("get", "../xml/orders.xml", true);
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    showResult(this);
                }
            };
            xmlhttp.send(null);
        }

        function showResult(xmlhttp) {
            var xmlDoc = xmlhttp.responseXML.documentElement;
            removeWhitespace(xmlDoc);
            var outputResult = document.getElementById("BodyRows");
            var rowData = xmlDoc.getElementsByTagName("order");

            addTableRowsFromXmlDoc(rowData, outputResult);
        }

        function addTableRowsFromXmlDoc(xmlNodes, tableNode) {
            var theTable = tableNode.parentNode;
            var newRow, newCell, i;
            console.log("Number of nodes: " + xmlNodes.length);
            for (i = 0; i < xmlNodes.length; i++) {
                newRow = tableNode.insertRow(i);
                newRow.className = (i % 2) ? "OddRow" : "EvenRow";
                for (j = 0; j < xmlNodes[i].childNodes.length; j++) {
                    newCell = newRow.insertCell(newRow.cells.length);
                    if (xmlNodes[i].childNodes[j].firstChild) {
                        newCell.innerHTML = xmlNodes[i].childNodes[j].firstChild.nodeValue;
                    } else {
                        newCell.innerHTML = "-";
                    }
                    console.log("cell: " + newCell);
                }
            }
            theTable.appendChild(tableNode);
        }

        function removeWhitespace(xml) {
            var loopIndex;
            for (loopIndex = 0; loopIndex < xml.childNodes.length; loopIndex++) {
                var currentNode = xml.childNodes[loopIndex];
                if (currentNode.nodeType == 1) {
                    removeWhitespace(currentNode);
                }
                if (!(/\S/.test(currentNode.nodeValue)) && (currentNode.nodeType == 3)) {
                    xml.removeChild(xml.childNodes[loopIndex--]);
                }
            }
        }
    </script>  -->
</head>

<body>
    <div class="BEheader">
        <div class="logo">
            <a href="backEnd7.html">Grocery</a>
        </div>
        <a href="../index.html" class="frontEnd">Front End</a>
    </div>

    <div class="mainGrid">
        <div class="sideBar">
            <div class="NavCard">

                <a href="backEnd7.html">PRODUCTS</a>
                <a href="backEnd9.html">ACCOUNTS</a>
                <a href="backEnd11.php">ORDERS</a>

            </div>
        </div>

        <div class="BEmain">
            <div class="addDeleteEditbutton" style="width: 80%">
                <div class="inner-addDeleteEditbutton">
                    <a href="backEnd12.html"><img src="../icons/backEnd/plus-square.svg"> Add</a>
                </div>
                <div class="inner-addDeleteEditbutton">
                    <a href="backEnd12.html"><img src="../icons/backEnd/pencil-square.svg"> Edit</a>
                </div>
                <div class="inner-addDeleteEditbutton">
                    <!-- start -->
                    <a onclick="alert('Click on \'Delete\' in the row you want to do so')"><img src="../icons/backEnd/x-square.svg"> Delete</a>
                    <!-- end -->
                </div>
           
            <table class="tableOrderList" id="MainTable">
                <tr class="tableHeadings">
                    <th>Order ID</th>
                    <th>Customer ID</th>
                    <th>Customer Name</th>
                    <th>Order Date</th>
                    <th>Number of items</th>
                    <th>Order Status</th>
                    <th></th>
                </tr>
                <!-- start -->
                <?php
                $showOrderRow='';
                foreach ($orders->children() as $order) {
                        $showOrderRow .= '
                            <tr>
                            <td>' . $order->orderID . '</td>
                            <td>' . $order->customerID . '</td>
                            <td>' . $order->customerName . '</td>
                            <td>' . $order->orderDate . '</td>
                            <td>' . $order->numberOfItems . '</td>
                            <td>' . $order->orderStatus . '</td>
                            <th><a href="backend11.php?action=delete&orderID=<?php echo $order[\'orderID\']; ?>" 
                            onclick="return confirm(\'Are you sure to delete this row?\')">Delete</a></th>
                            </tr>
                            ';
                    }

                    echo $showOrderRow;
                ?>
                <!-- end -->

                
                <!-- <?php foreach ($orders->order as $order) { ?>
                    <tr>
                        <td><?php echo $order->orderID; ?></td>
                        <td><?php echo $order->customerID; ?></td>
                        <td><?php echo $order->customerName; ?></td>
                        <td><?php echo $order->orderDate; ?></td>
                        <td><?php echo $order->numberOfItems; ?></td>
                        <td><?php echo $order->orderStatus; ?></td>
                        <td>
                            <a href="backend11.php?action=delete&orderID=<?php echo $order['orderID']; ?>" 
                            onclick="return confirm('Are you sure to delete this row?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?> -->
                <tbody id="BodyRows">

                </tbody>


            </table>

        </div>

    </div>


</body>

</html>