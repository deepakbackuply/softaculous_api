## via PHP script

```php
<?php

$hostname = '';
$username = '';
$password = '';
$domain = '';
$da_url = 'https://'.$hostname.':2222';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $da_url.'/CMD_LOGIN');
curl_setopt($ch, CURLOPT_VERBOSE, 1);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

$post = array('username' => $username,
		'password' => $password,
		'referer' => '/');

curl_setopt($ch, CURLOPT_POST, 1);
$nvpreq = http_build_query($post);
curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);

curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

$resp = curl_exec($ch);

if($resp === false){
	die('Could not login to the server. cURL Error : '.curl_error($ch));
	return false;
}

curl_close($ch);

$resp = explode("\n", $resp);

foreach($resp as $k => $v){
	if(preg_match('/^'.preg_quote('set-cookie:', '/').'(.*?)$/is', $v, $mat)){
		$newcookie= trim($mat[1]);
	}
}

$newlogin = $da_url.'/CMD_PLUGINS/softaculous/index.raw?api=json&act=software&soft=26';

$resp = $ch = '';

// Login and get the cookies
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $newlogin);
curl_setopt($ch, CURLOPT_VERBOSE, 1);

// Turn off the server and peer verification (TrustManager Concept).
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

$post = array('softsubmit' => '1',
              'softdomain' => $domain, // Must be a valid Domain
              'softdirectory' => 'wpapi', // Keep empty to install in Web Root
              'softdb' => 'wpapi',
              'admin_username' => 'admin',
              'admin_pass' => 'password',
              'admin_email' => 'admin@example.com',
              'language' => 'en',
              'site_name' => 'WordPress Site',
              'site_desc' => 'My Blog',
              'dbprefix' => 'wpapi_'
);

curl_setopt($ch, CURLOPT_POST, 1);
$nvpreq = http_build_query($post);
curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);

if(!empty($newcookie)){
	curl_setopt($ch, CURLOPT_COOKIESESSION, true);
	curl_setopt($ch, CURLOPT_COOKIE, $newcookie);
}

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_REFERER, $da_url); // This is required as Directadmin checks for Referer

$resp = curl_exec($ch);
echo $resp;

if($resp === false){
	die('Could not login to the server. cURL Error : '.curl_error($ch));
	return false;
}

curl_close($ch);

?>
```
