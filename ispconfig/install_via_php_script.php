<?php

$url = 'https://user:password@domain.com:8080/softaculous/index.php?'.
			'&api=serialize'.
			'&act=software'.
			'&soft=26';

$post = array('softsubmit' => '1',
              'softdomain' => 'example.com', // Must be a valid Domain
              'softdirectory' => 'wp', // Keep empty to install in Web Root
              'softdb' => 'wpdb',
              'admin_username' => 'admin',
              'admin_pass' => 'adminpassword',
              'admin_email' => 'admin@example.com',
              'language' => 'en',
              'site_name' => 'WordPress Site',
              'site_desc' => 'My Blog',
              'dbprefix' => 'dbpref_',
              'sets_name[]' => 'set-name'
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
 
// The response will hold a string as per the API response method. In this case its PHP Serialize
$res = unserialize($resp);
 
// Done ?
if(!empty($res['done'])){

	print_r($res);

// Error
}else{

	echo 'Some error occured';
	print_r($res['error']);

}
?>
