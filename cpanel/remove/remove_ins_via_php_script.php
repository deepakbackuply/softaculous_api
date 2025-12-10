<?php

// The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
			'&api=serialize'.
			'&act=remove'.
			'&insid=26_12345';

$post = array('removeins' => '1',
              'remove_dir' => '1', // Pass this if you want the directory to be removed
              'remove_datadir' => '1', // Pass this if you want the data directory to be removed
              'remove_db' => '1', // Pass this if you want the database to be removed
              'remove_dbuser' => '1' // Pass this if you want the database user to be removed
		);

// Set the curl parameters.
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $time);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Turn off the server and peer verification (TrustManager Concept).
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

if(!empty($post)){
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
}
 
// Get response from the server.
$resp = curl_exec($ch);

$res = unserialize($resp);
print_r($res);

?>
