<?php

//The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
			'&api=serialize'.
                        '&act=wordpress'.
                        '&upload=1';

// Plugin zip file
$file_name_with_full_path = 'loginizer.1.6.7.zip';

// php 5.5+
if (function_exists('curl_file_create')) { 
  $cFile = curl_file_create($file_name_with_full_path);
} else { 
  $cFile = '@' . realpath($file_name_with_full_path);
}

$post = array('insid' => '26_31793',
              'type' => 'plugins',
              'activate' => '1',
              'custom_file' => $cFile
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
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
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
