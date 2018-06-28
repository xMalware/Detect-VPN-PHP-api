<?php
	
	/*
		This PHP file is used to get data about an IP address by using the IPDetector API
		You can use the free offer (30 requests per minute) or the paid offer.
		Create your API key at https://ipdetector.info
	*/
	
	function getIpData($apiKey, $ip)
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
			return null;
		}
		
		$obj = json_decode($result, true);
		
		if ($obj != null && isset($obj['error']))
		{
			// If you want to get the error
			// or print it, you can uncomment this part
			//var_dump($obj);
		}
		
		return $obj;
	}
	
	$apiKey = "Your API key"; // Please replace this value by setting your API key
	$ip = $_SERVER['REMOTE_ADDR']; // IP
	
	$data = getIpData($apiKey, $ip);

	if ($data != null && isset($data['ip']))
	{
		echo 'IP address: '.$data['ip'].'<br />'.
		'Hostname: '.$data['hostname'].'<br />'.
		'Country name: '.$data['countryName'].'<br />'.
		'Country ISO: '.$data['countryIso'].'<br />'.
		'Continent name: '.$data['continentName'].'<br />'.
		'Continent code: '.$data['continentCode'].'<br />'.
		'Postal code: '.$data['postalCode'].'<br />'.
		'City name: '.$data['cityName'].'<br />'.
		'Response time: '.$data['responseTime'].' ms<br />'.
		'ASN id: '.$data['asnId'].'<br />'.
		'ASN name: '.$data['asnName'].'<br />'.
		'Organization: '.$data['organization'].'<br />'.
		'ISP: '.$data['isp'].'<br />'.
		'Good IP: '.($data['goodIp'] ? "Yes" : "No");
	}
	else if ($data != null && isset($data['error']))
	{
		echo 'Error: '.$data['error'];
	}
	
?>
