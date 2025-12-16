<?php

// The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
			'&api=serialize'.
			'&act=backup'.
			'&insid=26_4545';

$post = array('backupins' => '1',
              'backup_dir' => '1', // Pass this if you want to backup the directory
              'backup_datadir' => '1', // Pass this if you want to backup the data directory
              'backup_db' => '1', // Pass this if you want to backup the database
              'backup_location' => '2' //Pass this if you want the current backup to be stored at a different location.
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
$res = unserialize($resp);

echo '<pre>';
print_r($res);
echo '</pre>';

?>
