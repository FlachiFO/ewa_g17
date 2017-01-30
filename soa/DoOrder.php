<?php
	// Create SoapClient with wsdl address
	$client = new SoapClient("http://141.56.131.108:8080/Reseller/BookTrade/?wsdl");
	
 
	// Create parameter array
	$param_arr = array('traderID' => "G17",'ISBN' => "8749037403" );
	// $param_arr2 = array('ISBN' => 17);
 
	// Call operation with parameter
	// $response = $client->GetRandom($param_arr);
	$response = $client->GetDeliveryTime($param_arr);
	
	// Convert response to useable array
	$response_arr = objectToArray($response);
	
	// Extract array from response structure
	$getDeliveryTimeResult = $response_arr['GetDeliveryTimeResult'];
	
	echo 'GetDeliveryTime('.$param_arr['traderID'].') returns: '.$getDeliveryTimeResult;
	
	
	// Helper function to convert an object to an array
	function objectToArray($d)
	{
		if (is_object($d))
		{
			$d = get_object_vars($d);
		}
 
		if (is_array($d))
		{
			return array_map(__FUNCTION__, $d);
		}
		else
		{
			return $d;
		}
	}
 ?>