<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>OnlineShop - Book Orders (Client)</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	<body>
<?php

		session_start();
			$totalPrice = $_Get['SOAdata'];
			$books = $_GET['']
	
	//////////////////////////////////////////////////////////////
	// Author: Michael Heydeck, 04.12.2013
	
	echo "<h1>Web Service Client: BookTrade - DoOrder</h1>";

	//////////////////////////////////////////////////////////////
	// WSDL and Web-Service addresses
	$wsdlAddr = 'http://141.56.131.108:8080/Reseller/BookTrade/?wsdl';
	$wsAddr = 'http://141.56.131.108/ewa/G17/soa/OS_Book-Order_Server.php';
	
	// echo "Creating SOAP-Client for ".$wsAddr." with wsdl: ".$wsdlAddr."<br/><br/>";
	//////////////////////////////////////////////////////////////
	// Web Service Client
	$client = new SoapClient($wsdlAddr, array('location' => $wsAddr, 'trace' => 1));

	// PHP: wrong xml encoding in Request (uses ISO-8859-1 instead of UTF-8, see http://stackoverflow.com/questions/5317858/nusoap-and-content-type)
	$client->soap_defencoding = 'UTF-8';
	$client->decode_utf8 = false;
	
	try
	{
		// Call operation with parameter
		$result = $client->DoOrder(array(
			"orderID" => uniqid(),
			// "traderID" => "G17",
			"traderID" => "G17",
			"customer" => "John Doe",
			"totalPrice" => 2500,
			"positions" => array(
				"OrderPosition" => array(
					array("ISBN" => "123456789X", "Quantity" => 3), 
					array("ISBN" => "456457456X", "Quantity" => 1)
					)
				)
			));

		// echo "DoOrder(...) called successfully - TrackingID: ".$result->DoOrderResult;
		
		// Debug ouptput
		soapDebug($client);
	}
	catch(SoapFault $exception)
	{
		soapDebug($client);
		
		// echo "<h3>Error</h3>";
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