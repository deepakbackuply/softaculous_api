<?php 

// The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
			'&api=serialize'.
			'&act=sign_on'.
			'&insid=26_12345'.
			'&autoid=abcdefghijklmnopqrstuvwxyz0123456789';


// Set the curl parameters.
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Turn off the server and peer verification (TrustManager Concept).
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
 
// Get response from the server.
$resp = curl_exec($ch);
$op = unserialize($resp);

print_r($res);
// On using this API, you will get the sign_on_url, upon accessing which the user will be logged in to the admin panel of the script. 
//You can use the same URL to redirect the user to the WordPress dashboard. Uncomment the below line to redirect to the WordPress admin dashboard.

//header('Location: '.$res['sign_on_url']);

?>
