<?php
	////////////////////////////////////////////////////////////
	// Author: Michael Heydeck, 03.12.2013
	
	//////////////////////////////////////////////////////////////
	// Order classes
	class Order
	{
		function __construct($orderID, $traderID, $customer, $totalPrice, $orderPositions)
		{
			$this->OrderID = $orderID;
			$this->TraderID = $traderID;
			$this->Customer = $customer;
			$this->TotalPrice = $totalPrice;
			$this->Positions = $orderPositions;
			$this->DateTime = date('Y-m-d H:i:s', time());
			$this->State = OrderState::Open;
			$this->TrackingID = "0";
		}
	
		public $OrderID;
		public $TraderID;
		public $Customer;
		public $TotalPrice;
		public $Positions;
		public $DateTime;
		public $State;
		public $TrackingID;
	}
	
	class OrderState
	{
		const Open = 0;
		const Accepted = 1;
	}
	
	class OrderPosition
	{
		public $ISBN;
		public $Quantity;
	}
	
	
	//////////////////////////////////////////////////////////////
	// Read, accept and write orders from file
	$_orders = readOrdersFromFile();
	
	if(isset($_GET['accept']) && empty($_GET['accept']) == FALSE)
	{
		$orderID = $_GET['accept'];
		$orderToAccept = null;
		
		foreach($_orders as $order)
		{
			if($order->OrderID == $orderID)
			{
				$orderToAccept = $order;
			}
		}
		
		if($orderToAccept != null && $orderToAccept->State == OrderState::Open)
		{
			// Address for WSDL
			$wsdlAddr = 'http://141.56.131.108:8080/Reseller/BookTrade/?wsdl';
			// Address for Web-Service Request
			$wsAddr = 'http://141.56.131.108:8080/G17/Shop-AcceptedOrder/';
			$client = new SoapClient($wsdlAddr, array('location' => $wsAddr, 'trace' => true));
			$client->soap_defencoding = 'UTF-8';
			$client->decode_utf8 = false;
			
			// Call operation with parameter
			$result = $client->DoOrder(array("orderID" => $orderToAccept->OrderID, "traderID" => $orderToAccept->TraderID, "customer" => $orderToAccept->Customer, "totalPrice" => $orderToAccept->TotalPrice, "positions" => correctArrayNesting($orderToAccept->Positions['OrderPosition'])));
			
			$orderToAccept->TrackingID = $result->DoOrderResult;
			$orderToAccept->State = OrderState::Accepted;
			
			writeOrdersToFile($_orders);
		}
	}
	
	
	//////////////////////////////////////////////////////////////
	// Functions
	function writeOrdersToFile($orders)
	{
		$ser = '';
		foreach($orders as $order)
		{
			$ser = $ser.serialize($order)."\r\n";
		}
		
		file_put_contents('BookTrade-Orders.txt', $ser, LOCK_EX);
	}
	
	function readOrdersFromFile()
	{
		$orders = array();
		
		$fileHandle = fopen("BookTrade-Orders.txt", "r");
		if($fileHandle)
		{
			while(($line = fgets($fileHandle)) !== FALSE)
			{
				$order = unserialize($line);
				array_push($orders, $order);
			}
			
			fclose($fileHandle);
			
			return $orders;
		} 
		else
		{
			echo "Unable to open BookTrade.txt";
			exit;
		}
	}
	
	// PHP doesn´t create an array for one-element in a list
	function correctArrayNesting($arr)
	{
		if(is_array($arr[key($arr)]) == FALSE)
		{
			$arr = array($arr);
		}
		
		return $arr;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>OnlineShop - Book Orders (Admin)</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	<body>
		<h1>OnlineShop - Book Orders (Admin)</h1>
		<table border="1" style="width:100%;text-align:left;">
			<tr>
				<th>Time</th>
				<th>Tracking ID</th>
				<th>Order ID</th>
				<th>Trader ID</th>
				<th>Customer</th>
				<th>Total price</th>
				<th>Positions</th>
				<th>Action</th>
			</tr>
		<?php
			foreach($_orders as $order)
			{
				?>
				<tr>
					<td><?php echo $order->DateTime; ?></td>
					<td><?php echo $order->TrackingID; ?></td>
					<td><?php echo $order->OrderID; ?></td>
					<td><?php echo $order->TraderID; ?></td>
					<td><?php echo $order->Customer; ?></td>
					<td><?php echo $order->TotalPrice; ?></td>
					<td>
						<?php 
						$orderPositions = correctArrayNesting($order->Positions['OrderPosition']);

						foreach($orderPositions as $position)
						{
							?>
							<div><?php echo $position['ISBN']." (Quantity: ".$position['Quantity'].")"; ?></div>
							<?php
						}
						?>
					</td>
					<td>
						<?php if($order->State == OrderState::Open)
						{?>
							<a href="<?php echo $_SERVER['PHP_SELF']."?accept=".$order->OrderID; ?>">Accept</a>
						<?php
						}
						else
						{
						?>
							<a>Accepted</a>
						<?php
						}
						?>
					</td>
				</tr>
				<?php
			}
		?>
		</table> 
	</body>
</html>