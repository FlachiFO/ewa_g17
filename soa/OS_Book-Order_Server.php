<?php
	////////////////////////////////////////////////////////////
	// Author: Michael Heydeck, 03.12.2013
	require_once "C:\\xampp14\\htdocs\\SOAlution\\Docs\\OnlineShop\\libs\\nusoap-0.9.5\\nusoap.php";
	
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
	// Method
	function DoOrder($orderID, $traderID, $customer, $totalPrice, $positions)
	{
		if(preg_match("/^G\d{2}$/i", $traderID) == FALSE)
		{
			throw new Exception("TraderID is not valid. Please use your group id (Gxx).");
		}
	
		$order = new Order($orderID, $traderID, $customer, $totalPrice, $positions);
		$ser = serialize($order);
		file_put_contents('BookTrade-Orders.txt', $ser."\r\n", FILE_APPEND | LOCK_EX);
		
		return array("DoOrderResult" => $order->TrackingID);
	}


	//////////////////////////////////////////////////////////////
	// Web Service Server
	$server = new soap_server();
	$server->soap_defencoding = 'UTF-8';
	$server->decode_utf8 = false;

	$server->configureWSDL("BookTradeWebService", "http://SOAlution/BookTrade", '', "document");
	
	//http://stackoverflow.com/questions/18779953/how-to-deal-with-array-complextype-in-nusoap
	$server->wsdl->addComplexType('OrderPosition', 'complexType', 'struct', 'sequence', '', array(
        'ISBN' => array('name' => 'ISBN', 'type' => 'xsd:string'),
        'Quantity' => array('name' => 'Quantity', 'type' => 'xsd:int')
    ));
	
	$server->wsdl->addComplexType('ArrayOfOrderPosition', 'complexType', 'array', '',
		'SOAP-ENC:Array',
		array(),
		array(array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:OrderPosition[]')),
		'tns:OrderPosition'
	);

	doRegisterMethod($server, 'DoOrder', array(
					'in' => array('orderID' => 'xsd:string', 'traderID' => 'xsd:string', 'customer' => 'xsd:string', 'totalPrice' => 'xsd:double', 'positions' => 'tns:ArrayOfOrderPosition'),
					'out' => array('DoOrderResult' => 'xsd:string')));

	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
	$server->service($HTTP_RAW_POST_DATA);


	function doRegisterMethod(&$server, $methodName, $params)
	{
		$server->register($methodName, 
			$params["in"],
			$params["out"],
			'http://SOAlution/BookTrade', // namespace
			'http://SOAlution/BookTrade/'.$methodName, // soapaction
			'document', // style
			'literal', // use
			'' // documentation
		);
	}
?>