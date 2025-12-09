<?php

$server_ip = '';
$hostname = '';
$username = '';
$password = '';
$plesk_url='https://'.$server_ip.':8443';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $plesk_url.'/login_up.php');
curl_setopt($ch, CURLOPT_VERBOSE, 1);

// Turn off the server and peer verification (TrustManager Concept).
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

$post = array('login_name' => $username,
		'passwd' => $password);

curl_setopt($ch, CURLOPT_POST, 1);
$nvpreq = http_build_query($post);
curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);

// Check the Header
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Get response from the server.
$resp = curl_exec($ch);

curl_close($ch);

$resp = explode("\n", $resp);

// Find the cookies
foreach($resp as $k => $v){
	if(preg_match('/^'.preg_quote('set-cookie:', '/').'(.*?)$/is', $v, $mat)){
		$cookie = $mat[1];
	}
}

if(empty($cookie)){
	echo "Unble to fetch cookie";
	return;
}


$new_login = $plesk_url.'/modules/softaculous/index.php?'.
			'&api=serialize'.
			'&act=software'.
        	'&soft=26';

$resp = $ch = '';

// Set the curl parameters.
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $new_login);

// Turn off the server and peer verification (TrustManager Concept).
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

$post = array('softsubmit' => '1',
		'softdomain' => 'domain.com',
		'softdirectory' => 'wp',
		'softdb' => 'wpapi',
		'admin_username' => 'admin',
		'admin_pass' => 'password',
		'admin_email' => 'admin@example.com',
		'language' => 'en',
		'site_name' => 'WordPress Site',
		'site_desc' => 'My Blog',
		'dbprefix' => 'wpapi_'); // Keep empty to install in Web Root);

curl_setopt($ch, CURLOPT_POST, 1);
$nvpreq = http_build_query($post);
curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);

// Is there a Cookie
if(!empty($cookie)){
	curl_setopt($ch, CURLOPT_COOKIESESSION, true);
	curl_setopt($ch, CURLOPT_COOKIE, $cookie);
}

curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Get response from the server.
$resp = curl_exec($ch);

// Did we reach out to that place ?
if($resp === false){
	echo 'Installation not completed. cURL Error : '.curl_error($ch);
}

curl_close($ch);

// Was there any error ?
if($resp != 'installed') {
	echo 'not installed';
}
		
print_r($resp);

?>
