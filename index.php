<?php
	function getIpServer() {
		$ipServerKeys = [
			'HTTP_CLIENT_IP',
			'HTTP_X_FORWARDED_FOR',
			'REMOTE_ADDR'
	 	];

		foreach ($ipServerKeys as $key) {
			if (!empty($_SERVER[$key])) {
				$ip = trim(end(explode(',', $_SERVER[$key])));
				if (filter_var($ip, FILTER_VALIDATE_IP)) {
					return $ip;
				}
			}
		}
	}

	$ip = getIpServer();

	require_once 'geo/SxGeo.php';

	$SxGeo = new SxGeo('geo/SxGeo.dat', SXGEO_BATCH | SXGEO_MEMORY);

	$country_code = $SxGeo->getCountry($ip);

	if ($country_сode === 'RU') {
		echo "RU";
	} else {
		echo "Any";
	}

?>