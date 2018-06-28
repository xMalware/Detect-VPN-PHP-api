<?php
	
	/*
		This PHP file is used to determine if an IP is good or bad (VPN/host/proxy) by using the IPDetector API
		You can use the free offer (30 requests per minute) or the paid offer.
		Create your API key at https://ipdetector.info
	*/
	
	function isGoodIp($apiKey, $ip, $defaultErrorIpResult = true)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, 'https://api.ipdetector.info/'.$ip);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('API-Key: '.$apiKey));
		$result = curl_exec($ch);
		curl_close($ch);
	 
		if ($result == null)
		{
			return $defaultErrorIpResult;
		}
		
		$obj = json_decode($result, true);
		
		if ($obj == null)
		{
			return $defaultErrorIpResult;
		}
		
		if (isset($obj['error']))
		{
			// If you want to get the error
			// or print it, you can uncomment this part
			//var_dump($obj);
			return $defaultErrorIpResult;
		}
		
		return $obj['goodIp'] == '1';
	}
	
	$apiKey = "Your API key"; // Please replace this value by setting your API key
	$ip = $_SERVER['REMOTE_ADDR']; // IP
	
	if (!isGoodIP($apiKey, $ip))
	{
		// This IP is bad
		echo 'Bad IP';
	}
	else
	{
		// This IP is good
		echo 'Good IP';
	}

?>
