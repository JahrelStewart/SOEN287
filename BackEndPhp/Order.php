<?php
        session_start();

        if (isset($_GET['submit'])) {
            $orderID = $_GET['orderID'];
            $customerID = $_GET['customerID'];
            $customerName = $_GET['customerName'];
            $orderDate = $_GET['orderDate'];
            $numberOfItems = $_GET['numberOfItems'];
            $orderStatus = $_GET['orderStatus'];

            $file = '../xml/orders.xml';

            $orders = simplexml_load_file($file); //load xml file
            //for Edit, if the order ID is already in the xml, remove the row
            foreach ($orders->children() as $obj) {
                if ($obj->orderID == $orderID) {
                    $dom = dom_import_simplexml($obj);
                    $dom->parentNode->removeChild($dom);
                }
            }

            $order = $orders->addChild("order"); //add data to xml

            $order->addChild('orderID', $orderID);
            $order->addChild('customerID', $customerID);
            $order->addChild('customerName', $customerName);
            $order->addChild('orderDate', $orderDate);
            $order->addChild('numberOfItems', $numberOfItems);
            $order->addChild('orderStatus', $orderStatus);

            $orders->asXML($file);
            // header('Location: ../backend12.html');
        }

        ?>

<!-- try new ADD -->
<?php
if (isset($_POST['submit'])) {
    $orders = simplexml_load_file('../xml.orders.xml');
    // foreach($orders->order as $order){
    // 	if($order['orderID']==$_POST['orderID']){
    // 		$order->customerID = $_POST['customerID'];
    // 		$order->customerName = $_POST['customerName'];
    //         $order->orderDate = $_POST['orderDate'];
    // 		$order->numberOfItems = $_POST['numberOfItems'];
    //         $order->orderStatus = $_POST['orderStatus'];
    // 		break;
    // 	}
    // }
    // file_put_contents('../xml.orders.xml', $orders->asXML());
    // header('location:backend11.php');

    $order = $orders->addChild('order');
    // $order->addAttribute('orderID', $_POST['orderID']);
    $order->addChild('orderID', $_POST['orderID']);

    $order->addChild('customerID', $_POST['customerID']);
    $order->addChild('customerName', $_POST['customerName']);
    $order->addChild('orderDate', $_POST['orderDate']);
    $order->addChild('numberOfItems', $_POST['numberOfItems']);
    $order->addChild('orderStatus', $_POST['orderStatus']);

    file_put_contents('../xml.orders.xml', $orders->asXML());
    header('location:backend11.php');
}
// foreach($orders->order as $order){
// 	if($order['orderID']==$_GET['orderID']){
// 		$orderID = $order['orderID'];
// 		$customerID = $order->customerID;
// 		$customerName = $order->customerName;
//         $orderDate = $order->orderDate;
// 		$numberOfItems = $order->numberOfItems;
//         $orderStatus = $order->orderStatus;
// 		break;
// 	}
// }
// 
?>
<form method="post">
    <table>
        <tr>
            <td>Order ID</td>
            <td><input type="text" name="orderID"></td>
        </tr>
        <tr>
            <td>customerID</td>
            <td><input type="text" name="customerID"></td>
        </tr>
        <tr>
            <td>customerName</td>
            <td><input type="text" name="customerName"></td>
        </tr>
        <tr>
            <td>orderDate</td>
            <td><input type="text" name="orderDate"></td>
        </tr>
        <tr>
            <td>numberOfItems</td>
            <td><input type="text" name="numberOfItems"></td>
        </tr>
        <tr>
            <td>orderStatus</td>
            <td><input type="text" name="orderStatus"></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" value="Save" name="submit"></td>
        </tr>
    </table>
</form>

<!-- 
<?php
$orders = simplexml_load_file('../xml.orders.xml');

if (isset($_POST['submit'])) {

    foreach($orders->order as $order){
    	if($order['orderID']==$_POST['orderID']){
    		$order->customerID = $_POST['customerID'];
    		$order->customerName = $_POST['customerName'];
            $order->orderDate = $_POST['orderDate'];
    		$order->numberOfItems = $_POST['numberOfItems'];
            $order->orderStatus = $_POST['orderStatus'];
    		break;
    	}
    }
    file_put_contents('../xml.orders.xml', $orders->asXML());
    header('location:backend11.php');
}

foreach($orders->order as $order){
	if($order['orderID']==$_GET['orderID']){
		$orderID = $order['orderID'];
		$customerID = $order->customerID;
		$customerName = $order->customerName;
        $orderDate = $order->orderDate;
		$numberOfItems = $order->numberOfItems;
        $orderStatus = $order->orderStatus;
		break;
	}
}

?>
<form method="post">
    <table>
        <tr>
            <td>orderID</td>
            <td><input type="text" name="orderID" value="<?php echo $orderID; ?>" readonly="readonly"></td>
        </tr>
        <tr>
            <td>customerID</td>
            <td><input type="text" name="customerID" value="<?php echo $customerID; ?>"></td>
        </tr>
        <tr>
            <td>customerName</td>
            <td><input type="text" name="customerName" value="<?php echo $customerName; ?>"></td>
        </tr>
        <tr>
            <td>orderDate</td>
            <td><input type="text" name="orderDate"></td>
        </tr>
        <tr>
            <td>numberOfItems</td>
            <td><input type="text" name="numberOfItems"></td>
        </tr>
        <tr>
            <td>orderStatus</td>
            <td><input type="text" name="orderStatus"></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" value="Save" name="submit"></td>
        </tr>
    </table>
</form> -->