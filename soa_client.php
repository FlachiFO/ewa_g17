<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>OnlineShop - Book Orders (Client)</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	<body>
<?php

	session_start();
    $i = 0;
	$Array = $_GET['SOAArray'];
    $Total = $_GET['SOATotal'];
//    print_r($Total);
    $array_decode = json_decode($Array);
    $length = count($array_decode);
//    for ($i = 0; $i <$length; $i++) {
//        $array_decode[$i]->ID;
//        echo '<br>';
//        echo $array_decode[$i]->Name;
//        echo '<br>';
//    }
	
	//////////////////////////////////////////////////////////////
	// WSDL and Web-Service addresses
	$wsdlAddr = 'http://141.56.131.108:8080/Reseller/BookTrade/?wsdl';
	$wsAddr = 'http://141.56.131.108/ewa/G17/soa/OS_Book-Order_Server.php';
	
	//////////////////////////////////////////////////////////////
	// Web Service Client
	$client = new SoapClient($wsdlAddr, array('location' => $wsAddr, 'trace' => 1));

	// PHP: wrong xml encoding in Request (uses ISO-8859-1 instead of UTF-8, see http://stackoverflow.com/questions/5317858/nusoap-and-content-type)
	$client->soap_defencoding = 'UTF-8';
	$client->decode_utf8 = false;
        
        for ($i; $i <$length; $i++) {
            $boosks = array("ISBN" => $array_decode[$i]->ISBN, "Quantity" => $array_decode[$i]->Quantity);
        }
        print_r($books);
	
	try
	{
		// Call operation with parameter
		$result = $client->DoOrder(array(
			"orderID" => uniqid(),
			"traderID" => "G17",
			"customer" => $_SESSION['user_session_name'],
			"totalPrice" => $Total,
			"positions" => array("OrderPosition" => array($books))
			));
		
		// Debug ouptput
		soapDebug($client);
	}
	catch(SoapFault $exception)
	{
		soapDebug($client);

		throw $exception;
	}
	
	
	//////////////////////////////////////////////////////////////
	// Functions
	function prettyXml($xmlText)
	{
		$dom = new DOMDocument("1.0");
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($xmlText);
		
		return $dom->saveXML();
	}

	function soapDebug($client)
	{
		$requestHeaders = $client->__getLastRequestHeaders();
		$request = prettyXml($client->__getLastRequest());
		$responseHeaders = $client->__getLastResponseHeaders();
		$response = prettyXml($client->__getLastResponse());

		// echo "<h3>Request</h3>";
		// echo '<code>' . nl2br(htmlspecialchars($requestHeaders, true)) . '</code>';
		// echo highlight_string($request, true) . "<br/>\n";

		// echo "<h3>Response</h3>";
		// echo '<code>' . nl2br(htmlspecialchars($responseHeaders, true)) . '</code>' . "<br/>\n";
		// echo highlight_string($response, true) . "<br/>\n";
	}
?>
	</body>
</html>






































