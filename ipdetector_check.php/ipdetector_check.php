<?php
	
	/**
		This PHP file is used to determine if an IP is good or bad (VPN/host/proxy) using the IPDetector API
		You can use the free offer (30 requests per minute) or the paid offer.
		Create your API key at https://ipdetector.info
	**/
	
	function isGoodIp($apiKey, $ip)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, 'https://api.ipdetector.info/'.$ip);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('API-Key: '.$apiKey));
		$result = curl_exec($ch);
		curl_close($ch);
	 
		$obj = json_decode($result, true);
		return $obj['goodIp'] == '1';
	}
	
	$apiKey = "Votre clé API"; // Mettez votre clé API
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
