<?php 

// The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
			'&api=serialize'.
			'&act=import'.
			'&soft=26';

$post = array('remote_submit' => '1',
              'domain' => 'source.example.com', // Source installation domain
              'server_host' => 'ftp.example.com', // Optional
              'protocol' => 'ftp',
              'port' => '21',
              'ftp_user' => 'ftp_user',
              'ftp_pass' => 'ftp_pass',
              'ftp_path' => '/public_html',
              'Installed_path' => 'wp', // Optional
              'softdomain' => 'destination.example.com', // Destination domain
              'dest_directory' => 'wp_dest', // Optional Directory
              'softdb' => 'dbname' // Database name (Option for scripts that do not have database name)
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

?>
