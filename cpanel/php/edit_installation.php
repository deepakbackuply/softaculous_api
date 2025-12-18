<?php

$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
			  '&api=serialize'.
			  '&act=editdetail'.
			  '&insid=26_12345';

$post = array('editins' => '1',
              'edit_dir' => '/path/to/installation/', // Must be the path to installation
              'edit_url' => 'http://example.com', // Must be the URL to installation
              'edit_dbname' => 'wpdb',
              'edit_dbuser' => 'dbusername',
              'edit_dbpass' => 'dbuserpass',
              'edit_dbhost' => 'dbhost',
              'admin_username' => 'adminusername', //Provide this only if script provides as well as password needs to be reset
              'admin_pass' => 'adminpassword' //Provide this only if script provides
			);

// Set the curl parameters.
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
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

// Print the entire output just incase !
print_r($res);

?>
